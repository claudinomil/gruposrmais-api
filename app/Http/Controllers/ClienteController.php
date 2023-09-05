<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Facades\SuporteFacade;
use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Models\Banco;
use App\Models\ClienteSegurancaMedida;
use App\Models\ClienteServico;
use App\Models\EdificacaoClassificacao;
use App\Models\Genero;
use App\Models\IdentidadeOrgao;
use App\Models\Estado;
use App\Models\IncendioRisco;
use App\Models\SegurancaMedida;
use App\Models\Cliente;

class ClienteController extends Controller
{
    private $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function index($empresa_id)
    {
        $registros = $this->cliente
            ->leftJoin('identidade_orgaos', 'clientes.identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'clientes.identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'clientes.genero_id', '=', 'generos.id')
            ->leftJoin('clientes as principal_clientes', 'clientes.principal_cliente_id', '=', 'principal_clientes.id')
            ->leftJoin('bancos', 'clientes.banco_id', '=', 'bancos.id')
            ->select(['clientes.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'principal_clientes.name as principalClienteName', 'bancos.name as bancoName'])
            ->where('clientes.empresa_id', $empresa_id)
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function show($id)
    {
        try {
            $registro = $this->cliente->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                //buscar dados das medidas de segurança
                $registro['cliente_seguranca_medidas'] = ClienteSegurancaMedida::where('cliente_id', '=', $id)->get();

                return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registro), 200);
            }
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function auxiliary($empresa_id)
    {
        try {
            $registros = array();

            //Gêneros
            $registros['generos'] = Genero::all();

            //Principal Clientes
            $registros['principal_clientes'] = Cliente::where('empresa_id', '=', $empresa_id)->get();

            //Bancos
            $registros['bancos'] = Banco::all();

            //Órgãos Identidades
            $registros['identidade_orgaos'] = IdentidadeOrgao::all();

            //Estados para a Identidade
            $registros['identidade_estados'] = Estado::all();

            //Edificacao Classificacoes
            $registros['edificacao_classificacoes'] = EdificacaoClassificacao::all();

            //Incêndio Riscos
            $registros['incendio_riscos'] = IncendioRisco::all();

            //Segurança Medidas
            $registros['seguranca_medidas'] = SegurancaMedida::all();

            return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registros), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function store(ClienteStoreRequest $request, $empresa_id)
    {
        try {
            //Atualisar objeto Auth::user()
            SuporteFacade::setUserLogged($empresa_id);

            //Colocar empresa_id no Request
            $request['empresa_id'] = $empresa_id;

            //Incluindo registro
            $registro = $this->cliente->create($request->all());

            //Editar dados na tabela clientes_seguranca_medidas
            SuporteFacade::editClienteSegurancaMedida(1, $registro['id'], $request);

            //Return
            return response()->json(ApiReturn::data('Registro criado com sucesso.', 2010, null, null), 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function update(ClienteUpdateRequest $request, $id, $empresa_id)
    {
        try {
            $registro = $this->cliente->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                //Atualisar objeto Auth::user()
                SuporteFacade::setUserLogged($empresa_id);

                //Alterando registro
                $registro->update($request->all());

                //Editar dados na tabela clientes_seguranca_medidas
                SuporteFacade::editClienteSegurancaMedida(1, $id, $request);

                //Atualizar Visitas Técnicas para esse Cliente''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                SuporteFacade::updateVisitaTecnicaCliente($id);
                //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                return response()->json(ApiReturn::data('Registro atualizado com sucesso.', 2000, null, $registro), 200);
            }
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function visita_tecnica($id)
    {
        try {
            $registro = $this->cliente->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                //Buscando Risco Incendio
                if (isset($registro['incendio_risco_id']) and $registro['incendio_risco_id'] != '') {
                    $incendio_risco = IncendioRisco::where('id', '=', $registro['incendio_risco_id'])->get('name');
                    $registro['incendio_risco'] = $incendio_risco[0]['name'];
                } else {
                    $registro['incendio_risco'] = [];
                }

                //Edificacao Classificacao
                if (isset($registro['edificacao_classificacao_id']) and $registro['edificacao_classificacao_id'] != '') {
                    $edificacao_classificacao = EdificacaoClassificacao::where('id', '=', $registro['edificacao_classificacao_id'])->get();
                    $registro['grupo'] = $edificacao_classificacao[0]['grupo'];
                    $registro['ocupacao_uso'] = $edificacao_classificacao[0]['ocupacao_uso'];
                    $registro['divisao'] = $edificacao_classificacao[0]['divisao'];
                    $registro['descricao'] = $edificacao_classificacao[0]['descricao'];
                    $registro['definicao'] = $edificacao_classificacao[0]['definicao'];
                } else {
                    $registro['grupo'] = '';
                    $registro['ocupacao_uso'] = '';
                    $registro['divisao'] = '';
                    $registro['descricao'] = '';
                    $registro['definicao'] = '';
                }

                //buscar dados das medidas de segurança
                $cliente_seguranca_medidas = ClienteSegurancaMedida
                    ::leftJoin('seguranca_medidas', 'clientes_seguranca_medidas.seguranca_medida_id', '=', 'seguranca_medidas.id')
                    ->select(['clientes_seguranca_medidas.*', 'seguranca_medidas.name as seguranca_medida_nome'])
                    ->where('clientes_seguranca_medidas.cliente_id', '=', $id)
                    ->orderBy('clientes_seguranca_medidas.pavimento')
                    ->orderBy('seguranca_medidas.name')
                    ->get();

                $registro['cliente_seguranca_medidas'] = $cliente_seguranca_medidas;

                return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registro), 200);
            }
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function extraData($id)
    {
        try {
            $registro = array();

            //Cliente
            $cliente = Cliente::
                leftJoin('clientes as principal_clientes', 'clientes.principal_cliente_id', '=', 'principal_clientes.id')
                ->select(['clientes.*', 'principal_clientes.name as principalClienteName'])
                ->where('clientes.id', '=', $id)
                ->get();

            $registro['cliente'] = $cliente[0];

            //Serviços do Cliente
            $cliente_servicos = ClienteServico::
                leftJoin('servicos', 'clientes_servicos.servico_id', '=', 'servicos.id')
                ->select(['clientes_servicos.*', 'servicos.name as servicoName'])
                ->where('clientes_servicos.cliente_id', '=', $id)
                ->get();

            $registro['cliente_servicos'] = $cliente_servicos;

            return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registro), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function destroy($id, $empresa_id)
    {
        try {
            $registro = $this->cliente->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, $registro), 404);
            } else {
                //Atualisar objeto Auth::user()
                SuporteFacade::setUserLogged($empresa_id);

                //Verificar Relacionamentos'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                //Tabela clientes
                if (SuporteFacade::verificarRelacionamento('clientes', 'principal_cliente_id', $id) > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Clientes.', 2040, null, null), 200);
                }

                //Tabela propostas
                if (SuporteFacade::verificarRelacionamento('propostas', 'cliente_id', $id) > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Propostas.', 2040, null, null), 200);
                }

                //Tabela clientes_servicos
                if (SuporteFacade::verificarRelacionamento('clientes_servicos', 'cliente_id', $id) > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Clientes Serviços.', 2040, null, null), 200);
                }
                //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                //Deletar'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                //Editar dados na tabela clientes_seguranca_medidas
                SuporteFacade::editClienteSegurancaMedida(3, $id, '');

                $registro->delete();

                return response()->json(ApiReturn::data('Registro excluído com sucesso.', 2000, null, null), 200);
                //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
            }
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function search($field, $value, $empresa_id)
    {
        $registros = $this->cliente
            ->leftJoin('identidade_orgaos', 'clientes.identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'clientes.identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'clientes.genero_id', '=', 'generos.id')
            ->leftJoin('clientes as principal_clientes', 'clientes.principal_cliente_id', '=', 'principal_clientes.id')
            ->leftJoin('bancos', 'clientes.banco_id', '=', 'bancos.id')
            ->select(['clientes.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'principal_clientes.name as principalClienteName', 'bancos.name as bancoName'])
            ->where('clientes.empresa_id', '=', $empresa_id)
            ->where($field, 'like', '%' . $value . '%')
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn, $empresa_id)
    {
        $registros = $this->cliente
            ->leftJoin('identidade_orgaos', 'clientes.identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'clientes.identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'clientes.genero_id', '=', 'generos.id')
            ->leftJoin('clientes as principal_clientes', 'clientes.principal_cliente_id', '=', 'principal_clientes.id')
            ->leftJoin('bancos', 'clientes.banco_id', '=', 'bancos.id')
            ->select(['clientes.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'principal_clientes.name as principalClienteName', 'bancos.name as bancoName'])
            ->where('clientes.empresa_id', $empresa_id)
            ->where($fieldSearch, 'like', '%' . $fieldValue . '%')
            ->get($fieldReturn);

        return response()->json(ApiReturn::data('', 2000, null, $registros), 200);
    }
}
