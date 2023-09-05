<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Facades\SuporteFacade;
use App\Http\Requests\NotificacaoStoreRequest;
use App\Http\Requests\NotificacaoUpdateRequest;
use App\Models\NotificacaoRead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Notificacao;

class NotificacaoController extends Controller
{
    private $notificacao;

    public function __construct(Notificacao $notificacao)
    {
        $this->notificacao = $notificacao;
    }

    public function index($empresa_id)
    {
        $registros = $this->notificacao->where('notificacoes.empresa_id', $empresa_id)->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }

    public function show($id)
    {
        try {
            $registro = DB::table('notificacoes')
                ->join('users', 'notificacoes.user_id', '=', 'users.id')
                ->select(['notificacoes.*', 'users.name as userName'])
                ->where('notificacoes.id', $id)
                ->get();

            //Retornar o array no padrao (simples)
            $registro = $registro[0];

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, []), 404);
            } else {
                //Verificar se Usuário Logado já leu a Notificação
                if (DB::table('notificacoes_lidas')
                    ->where('notificacao_id', $id)
                    ->where('user_id', Auth::user()->id)
                    ->doesntExist()) {

                    //Se não leu, marcar Notificação como lida
                    DB::table('notificacoes_lidas')->insert([
                        'notificacao_id' => $id,
                        'user_id' => Auth::user()->id,
                        'date' => date('Y-m-d'),
                        'time' => date('H:i:s')
                    ]);
                }

                return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registro), 200);
            }
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function store(NotificacaoStoreRequest $request, $empresa_id)
    {
        try {
            //Atualisar objeto Auth::user()
            SuporteFacade::setUserLogged($empresa_id);

            //Colocar empresa_id no Request
            $request['empresa_id'] = $empresa_id;

            //Incluindo registro
            $this->notificacao->create($request->all());

            return response()->json(ApiReturn::data('Registro criado com sucesso.', 2010, null, null), 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function update(NotificacaoUpdateRequest $request, $id, $empresa_id)
    {
        try {
            $registro = $this->notificacao->find($id);

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
            $registro = $this->notificacao->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, $registro), 404);
            } else {
                //Atualisar objeto Auth::user()
                SuporteFacade::setUserLogged($empresa_id);

                //Verificar Relacionamentos'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                //Tabela notificacoes_lidas
                if (SuporteFacade::verificarRelacionamento('notificacoes_lidas', 'notificacao_id', $id) > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Notificações Lidas.', 2040, null, null), 200);
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
        $registros = $this->notificacao->where('notificacoes.empresa_id', '=', $empresa_id)->where($field, 'like', '%'.$value.'%')->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn, $empresa_id)
    {
        $registros = $this->notificacao->where('notificacoes.empresa_id', '=', $empresa_id)->where($fieldSearch, 'like', '%' . $fieldValue . '%')->get($fieldReturn);

        return response()->json(ApiReturn::data('', 2000, '', $registros), 200);
    }

    public function unreadNotificacoes($id)
    {
        //Buscar ids das notificações lidas pelo Usuário
        $notIn = DB::table('notificacoes_lidas')->select('notificacao_id')->where('user_id', '=', $id)->get();

        $notificacoesNotIn = array();
        foreach ($notIn as $item) {
            $notificacoesNotIn[] = $item->notificacao_id;
        }

        //Buscando Notificações não lidas
        $registros = DB::table('notificacoes')
            ->leftJoin('users', 'users.id', '=', 'notificacoes.user_id')
            ->leftJoin('notificacoes_lidas', 'notificacoes_lidas.notificacao_id', '=', 'notificacoes.id')
            ->select(['notificacoes.*', 'users.name as userName', 'users.avatar as userAvatar'])
            ->whereNotIn('notificacoes.id', $notificacoesNotIn)
            ->orderBy('notificacoes.date', 'desc')
            ->orderBy('notificacoes.time', 'desc')
            ->orderBy('notificacoes.title', 'asc')
            ->limit(10)
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }
}
