<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Facades\SuporteFacade;
use App\Http\Requests\PropostaStoreRequest;
use App\Http\Requests\PropostaUpdateRequest;
use App\Models\Cliente;
use App\Models\PropostaServico;
use App\Models\Servico;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Proposta;

class PropostaController extends Controller
{
    private $proposta;

    public function __construct(Proposta $proposta)
    {
        $this->proposta = $proposta;
    }

    public function index($empresa_id)
    {
        $registros = DB::table('propostas')
            ->leftJoin('clientes', 'propostas.cliente_id', '=', 'clientes.id')
            ->select(['propostas.*', 'clientes.name as clienteName'])
            ->where('propostas.empresa_id', $empresa_id)
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function show($id)
    {
        try {
            $registro = $this->proposta->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                //buscar dados dos servicos para a proposta
                $registro['proposta_servicos'] = PropostaServico::where('proposta_id', '=', $id)->get();

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

            //Clientes
            $registros['clientes'] = Cliente::where('empresa_id', '=', $empresa_id)->get();

            //Servicos
            $registros['servicos'] = Servico::where('empresa_id', '=', $empresa_id)->get();

            return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registros), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function store(PropostaStoreRequest $request, $empresa_id)
    {
        try {
            //Atualisar objeto Auth::user()
            SuporteFacade::setUserLogged($empresa_id);

            //Colocar empresa_id no Request
            $request['empresa_id'] = $empresa_id;

            //Incluindo registro
            $registro = $this->proposta->create($request->all());

            //Editar dados na tabela propostas_servicos
            SuporteFacade::editPropostaServico(1, $registro['id'], $request);

            //Return
            return response()->json(ApiReturn::data('Registro criado com sucesso.', 2010, null, null), 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function update(PropostaUpdateRequest $request, $id, $empresa_id)
    {
        try {
            $registro = $this->proposta->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                //Atualisar objeto Auth::user()
                SuporteFacade::setUserLogged($empresa_id);

                //Alterando registro
                $registro->update($request->all());

                //Editar dados na tabela propostas_servicos
                SuporteFacade::editPropostaServico(3, $registro['id'], $request);

                //Return
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
            $registro = $this->proposta->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, $registro), 404);
            } else {
                //Atualisar objeto Auth::user()
                SuporteFacade::setUserLogged($empresa_id);

                //Verificar Relacionamentos'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                //Editar dados na tabela propostas_servicos
                SuporteFacade::editPropostaServico(2, $registro['id'], '');

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
        $registros = DB::table('propostas')
            ->leftJoin('clientes', 'propostas.cliente_id', '=', 'clientes.id')
            ->select(['propostas.*', 'clientes.name as clienteName'])
            ->where('propostas.empresa_id', '=', $empresa_id)
            ->where($field, 'like', '%' . $value . '%')
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn, $empresa_id)
    {
        $registros = DB::table('propostas')
            ->leftJoin('clientes', 'propostas.cliente_id', '=', 'clientes.id')
            ->select(['propostas.*', 'clientes.name as clienteName'])
            ->where('propostas.empresa_id', '=', $empresa_id)
            ->where($fieldSearch, 'like', '%' . $fieldValue . '%')
            ->get($fieldReturn);

        return response()->json(ApiReturn::data('', 2000, null, $registros), 200);
    }
}
