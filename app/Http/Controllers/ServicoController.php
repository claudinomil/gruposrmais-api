<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Facades\SuporteFacade;
use App\Http\Requests\ServicoStoreRequest;
use App\Http\Requests\ServicoUpdateRequest;
use App\Models\PropostaServico;
use App\Models\ServicoTipo;
use App\Models\Servico;

class ServicoController extends Controller
{
    private $servico;

    public function __construct(Servico $servico)
    {
        $this->servico = $servico;
    }

    public function index($empresa_id)
    {
        $registros = $this->servico
            ::leftJoin('servico_tipos', 'servicos.servico_tipo_id', '=', 'servico_tipos.id')
            ->select(['servicos.*', 'servico_tipos.name as servicoTipoName'])
            ->where('servicos.empresa_id', $empresa_id)
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function show($id)
    {
        try {
            $registro = $this->servico->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                //Verificar se pode alterar os campos name e servico_tipo_id - para não afetar outros submódulos
                $qtd = 0;
                $qtd += SuporteFacade::verificarRelacionamento('propostas_servicos', 'servico_id', $id);
                $qtd += SuporteFacade::verificarRelacionamento('clientes_servicos', 'servico_id', $id);

                if ($qtd > 0) {$readonly = true;} else {$readonly = false;}

                $registro['servico_readonly_campos'] = $readonly;

                //Retorno
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

            //Serviço Tipos
            $registros['servico_tipos'] = ServicoTipo::all();

            return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registros), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function store(ServicoStoreRequest $request, $empresa_id)
    {
        try {
            //Atualisar objeto Auth::user()
            SuporteFacade::setUserLogged($empresa_id);

            //Colocar empresa_id no Request
            $request['empresa_id'] = $empresa_id;

            //Incluindo registro
            $this->servico->create($request->all());

            return response()->json(ApiReturn::data('Registro criado com sucesso.', 2010, null, null), 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function update(ServicoUpdateRequest $request, $id, $empresa_id)
    {
        try {
            $registro = $this->servico->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                //Atualisar objeto Auth::user()
                SuporteFacade::setUserLogged($empresa_id);

                //Alterando registro
                $registro->update($request->all());

                return response()->json(ApiReturn::data('Registro atualizado com sucesso.', 2000, null, $registro), 200);
            }
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
            $registro = $this->servico->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, $registro), 404);
            } else {
                //Atualisar objeto Auth::user()
                SuporteFacade::setUserLogged($empresa_id);

                //Verificar Relacionamentos'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                //Tabela propostas_servicos
                if (SuporteFacade::verificarRelacionamento('propostas_servicos', 'servico_id', $id) > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir.<br>Registro relacionado em Propostas Serviços.', 2040, null, null), 200);
                }

                //Tabela clientes_servicos
                if (SuporteFacade::verificarRelacionamento('clientes_servicos', 'servico_id', $id) > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir.<br>Registro relacionado em Clientes Serviços.', 2040, null, null), 200);
                }
                //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                //Deletar'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
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
        $registros = $this->servico
            ::leftJoin('servico_tipos', 'servicos.servico_tipo_id', '=', 'servico_tipos.id')
            ->select(['servicos.*', 'servico_tipos.name as servicoTipoName'])
            ->where('servicos.empresa_id', '=', $empresa_id)
            ->where($field, 'like', '%' . $value . '%')
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn, $empresa_id)
    {
        $registros = $this->servico
            ::leftJoin('servico_tipos', 'servicos.servico_tipo_id', '=', 'servico_tipos.id')
            ->select(['servicos.*', 'servico_tipos.name as servicoTipoName'])
            ->where('servicos.empresa_id', '=', $empresa_id)
            ->where($fieldSearch, 'like', '%' . $fieldValue . '%')
            ->get($fieldReturn);

        return response()->json(ApiReturn::data('', 2000, null, $registros), 200);
    }
}
