<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Models\Banco;
use App\Models\ClienteSegurancaMedida;
use App\Models\EdificacaoClassificacao;
use App\Models\Funcionario;
use App\Models\Genero;
use App\Models\IdentidadeOrgao;
use App\Models\Estado;
use App\Models\IncendioRiscos;
use App\Models\SegurancaMedida;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;

class ClienteController extends Controller
{
    private $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function index()
    {
        $registros = DB::table('clientes')
            ->leftJoin('identidade_orgaos', 'clientes.identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'clientes.identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'clientes.genero_id', '=', 'generos.id')
            ->leftJoin('clientes as principal_clientes', 'clientes.principal_cliente_id', '=', 'principal_clientes.id')
            ->leftJoin('funcionarios as responsavel_funcionarios', 'clientes.responsavel_funcionario_id', '=', 'responsavel_funcionarios.id')
            ->leftJoin('bancos', 'clientes.banco_id', '=', 'bancos.id')
            ->select(['clientes.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'principal_clientes.name as principalClienteName', 'responsavel_funcionarios.name as responsavelFuncionarioName', 'bancos.name as bancoName'])
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

    public function auxiliary()
    {
        try {
            $registros = array();

            //Gêneros
            $registros['generos'] = Genero::all();

            //Principal Clientes
            $registros['principal_clientes'] = Cliente::all();

            //Responsavel Funcionarios
            $registros['responsavel_funcionarios'] = Funcionario::all();

            //Bancos
            $registros['bancos'] = Banco::all();

            //Órgãos Identidades
            $registros['identidade_orgaos'] = IdentidadeOrgao::all();

            //Estados para a Identidade
            $registros['identidade_estados'] = Estado::all();

            //Edificacao Classificacoes
            $registros['edificacao_classificacoes'] = EdificacaoClassificacao::all();

            //Incêndio Riscos
            $registros['incendio_riscos'] = IncendioRiscos::all();

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

    public function store(ClienteStoreRequest $request)
    {
        try {
            //Incluindo registro
            $registro = $this->cliente->create($request->all());

            //Gravar dados na tabela clientes_seguranca_medidas'''''''''''''''''''''''''''''''''''''''''''''''''''''''''
            $cliente_id = $registro['id'];
            $numero_pavimentos = $request['numero_pavimentos'];
            $maior_id_tabela_seguranca_medidas = $request['maior_id_tabela_seguranca_medidas'];

            for($i=1; $i<=$numero_pavimentos; $i++) {
                for ($m = 1; $m <= $maior_id_tabela_seguranca_medidas; $m++) {
                    if (isset($request['seguranca_medida_' . $i . '_' . $m])) {
                        $data = array();
                        $data['pavimento'] = $i;
                        $data['cliente_id'] = $cliente_id;
                        $data['seguranca_medida_id'] = $m;

                        ClienteSegurancaMedida::create($data);
                    }
                }
            }
            //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

            return response()->json(ApiReturn::data('Registro criado com sucesso.', 2010, null, null), 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function update(ClienteUpdateRequest $request, $id)
    {
        try {
            $registro = $this->cliente->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                //Alterando registro
                $registro->update($request->all());

                //Apagarr dados na tabela clientes_seguranca_medidas''''''''''''''''''''''''''''''''''''''''''''''''''''
                ClienteSegurancaMedida::where('cliente_id', '=', $id)->delete();
                //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                //Gravar dados na tabela clientes_seguranca_medidas'''''''''''''''''''''''''''''''''''''''''''''''''''''
                $cliente_id = $id;
                $numero_pavimentos = $request['numero_pavimentos'];
                $maior_id_tabela_seguranca_medidas = $request['maior_id_tabela_seguranca_medidas'];

                for($i=1; $i<=$numero_pavimentos; $i++) {
                    for ($m = 1; $m <= $maior_id_tabela_seguranca_medidas; $m++) {
                        if (isset($request['seguranca_medida_' . $i . '_' . $m])) {
                            $data = array();
                            $data['pavimento'] = $i;
                            $data['cliente_id'] = $cliente_id;
                            $data['seguranca_medida_id'] = $m;

                            ClienteSegurancaMedida::create($data);
                        }
                    }
                }
                //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

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
                    $incendio_risco = IncendioRiscos::where('id', '=', $registro['incendio_risco_id'])->get('name');
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
                $cliente_seguranca_medidas = DB::table('clientes_seguranca_medidas')
                    ->leftJoin('seguranca_medidas', 'clientes_seguranca_medidas.seguranca_medida_id', '=', 'seguranca_medidas.id')
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
            $cliente = DB::table('clientes')
                ->leftJoin('identidade_orgaos', 'clientes.identidade_orgao_id', '=', 'identidade_orgaos.id')
                ->leftJoin('estados', 'clientes.identidade_estado_id', '=', 'estados.id')
                ->leftJoin('generos', 'clientes.genero_id', '=', 'generos.id')
                ->leftJoin('clientes as principal_clientes', 'clientes.principal_cliente_id', '=', 'principal_clientes.id')
                ->leftJoin('funcionarios as responsavel_funcionarios', 'clientes.responsavel_funcionario_id', '=', 'responsavel_funcionarios.id')
                ->leftJoin('bancos', 'clientes.banco_id', '=', 'bancos.id')
                ->select(['clientes.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'principal_clientes.name as principalClienteName', 'responsavel_funcionarios.name as responsavelFuncionarioName', 'bancos.name as bancoName'])
                ->where('clientes.id', '=', $id)
                ->get();

            $registro['cliente'] = $cliente[0];

            //Transacoes
            $transacoes = ['Transação 1', 'Transação 2', 'Transação 3'];

            $registro['transacoesTable']['transacoes'] = $transacoes;

            return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registro), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function updateFoto(Request $request, $id)
    {
        try {
            $registro = $this->cliente->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                //Alterando registro
                $registro->update($request->all());

                return response()->json(ApiReturn::data('Foto atualizada com sucesso.', 2000, null, $registro), 200);
            }
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $registro = $this->cliente->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, $registro), 404);
            } else {
                //Verificar Relacionamentos'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                //Tabela Propostas
                $qtd = DB::table('propostas')->where('cliente_id', $id)->count();

                if ($qtd > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Propostas.', 2040, null, null), 200);
                }

                //Tabela Clientes
                $qtd = DB::table('clientes')->where('principal_cliente_id', $id)->count();

                if ($qtd > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Clientes.', 2040, null, null), 200);
                }

                //Tabela Visitas Técnicas
                $qtd = DB::table('visitas_tecnicas')->where('cliente_id', $id)->count();

                if ($qtd > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Visitas Técnicas.', 2040, null, null), 200);
                }

                //Tabela clientes_seguranca_medidas
                $qtd = DB::table('clientes_seguranca_medidas')->where('cliente_id', $id)->count();

                if ($qtd > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Clientes.', 2040, null, null), 200);
                }
                //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                //Deletar'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                //Apagarr dados na tabela clientes_seguranca_medidas
                ClienteSegurancaMedida::where('cliente_id', '=', $id)->delete();

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

    public function search($field, $value)
    {
        $registros = DB::table('clientes')
            ->leftJoin('identidade_orgaos', 'clientes.identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'clientes.identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'clientes.genero_id', '=', 'generos.id')
            ->leftJoin('clientes as principal_clientes', 'clientes.principal_cliente_id', '=', 'principal_clientes.id')
            ->leftJoin('funcionarios as responsavel_funcionarios', 'clientes.responsavel_funcionario_id', '=', 'responsavel_funcionarios.id')
            ->leftJoin('bancos', 'clientes.banco_id', '=', 'bancos.id')
            ->select(['clientes.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'principal_clientes.name as principalClienteName', 'responsavel_funcionarios.name as responsavelFuncionarioName', 'bancos.name as bancoName'])
            ->where($field, 'like', '%' . $value . '%')
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn)
    {
        $registros = DB::table('clientes')
            ->leftJoin('identidade_orgaos', 'clientes.identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'clientes.identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'clientes.genero_id', '=', 'generos.id')
            ->leftJoin('clientes as principal_clientes', 'clientes.principal_cliente_id', '=', 'principal_clientes.id')
            ->leftJoin('funcionarios as responsavel_funcionarios', 'clientes.responsavel_funcionario_id', '=', 'responsavel_funcionarios.id')
            ->leftJoin('bancos', 'clientes.banco_id', '=', 'bancos.id')
            ->select(['clientes.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'principal_clientes.name as principalClienteName', 'responsavel_funcionarios.name as responsavelFuncionarioName', 'bancos.name as bancoName'])
            ->where($fieldSearch, 'like', '%' . $fieldValue . '%')
            ->get($fieldReturn);

        return response()->json(ApiReturn::data('', 2000, null, $registros), 200);
    }
}
