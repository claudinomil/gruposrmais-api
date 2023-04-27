<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
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

    public function index()
    {
        $registros = DB::table('propostas')
            ->leftJoin('clientes', 'propostas.cliente_id', '=', 'clientes.id')
            ->select(['propostas.*', 'clientes.name as clienteName'])
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

    public function auxiliary()
    {
        try {
            $registros = array();

            //Clientes
            $registros['clientes'] = Cliente::all();

            //Servicos
            $registros['servicos'] = Servico::all();

            return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registros), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function store(PropostaStoreRequest $request)
    {
        try {
            //Incluindo registro
            $registro = $this->proposta->create($request->all());

            //Gravar dados na tabela propostas_servicos'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
            $proposta_id = $registro['id'];

            $servico_id = $request['servico_id'];
            $servico_item = $request['servico_item'];
            $servico_nome = $request['servico_nome'];
            $servico_valor = $request['servico_valor'];
            $servico_quantidade = $request['servico_quantidade'];
            $servico_valor_total = $request['servico_valor_total'];

            for($i=0; $i<=200; $i++) {
                if (isset($servico_id[$i])) {
                    $data = array();
                    $data['proposta_id'] = $proposta_id;
                    $data['servico_id'] = $servico_id[$i];
                    $data['servico_item'] = $servico_item[$i];
                    $data['servico_nome'] = $servico_nome[$i];
                    $data['servico_valor'] = $servico_valor[$i];
                    $data['servico_quantidade'] = $servico_quantidade[$i];
                    $data['servico_valor_total'] = $servico_valor_total[$i];

                    PropostaServico::create($data);
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

    public function update(PropostaUpdateRequest $request, $id)
    {
        try {
            $registro = $this->proposta->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                //Alterando registro
                $registro->update($request->all());

                //Apagarr dados na tabela propostas_servicos''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                PropostaServico::where('proposta_id', '=', $id)->delete();
                //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                //Gravar dados na tabela propostas_servicos'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                $proposta_id = $id;

                $servico_id = $request['servico_id'];
                $servico_item = $request['servico_item'];
                $servico_nome = $request['servico_nome'];
                $servico_valor = $request['servico_valor'];
                $servico_quantidade = $request['servico_quantidade'];
                $servico_valor_total = $request['servico_valor_total'];

                for($i=0; $i<=200; $i++) {
                    if (isset($servico_id[$i])) {
                        $data = array();
                        $data['proposta_id'] = $proposta_id;
                        $data['servico_id'] = $servico_id[$i];
                        $data['servico_item'] = $servico_item[$i];
                        $data['servico_nome'] = $servico_nome[$i];
                        $data['servico_valor'] = $servico_valor[$i];
                        $data['servico_quantidade'] = $servico_quantidade[$i];
                        $data['servico_valor_total'] = $servico_valor_total[$i];

                        PropostaServico::create($data);
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

    public function destroy($id)
    {
        try {
            $registro = $this->proposta->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, $registro), 404);
            } else {
                //Verificar Relacionamentos'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
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

    public function search($field, $value)
    {
        $registros = DB::table('propostas')
            ->leftJoin('clientes', 'propostas.cliente_id', '=', 'clientes.id')
            ->select(['propostas.*', 'clientes.name as clienteName'])
            ->where($field, 'like', '%' . $value . '%')
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn)
    {
        $registros = DB::table('propostas')
            ->leftJoin('clientes', 'propostas.cliente_id', '=', 'clientes.id')
            ->select(['propostas.*', 'clientes.name as clienteName'])
            ->where($fieldSearch, 'like', '%' . $fieldValue . '%')
            ->get($fieldReturn);

        return response()->json(ApiReturn::data('', 2000, null, $registros), 200);
    }
}
