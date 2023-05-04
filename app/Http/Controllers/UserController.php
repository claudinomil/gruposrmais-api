<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Funcionario;
use App\Models\Grupo;
use App\Models\Modulo;
use App\Models\Notificacao;
use App\Models\SistemaAcesso;
use App\Models\Situacao;
use App\Models\Submodulo;
use App\Models\Ferramenta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $registros = $this->user->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }

    public function show($id)
    {
        try {
            $registro = $this->user->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, []), 404);
            } else {
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

            //Grupos
            $registros['grupos'] = Grupo::all();

            //Situações
            $registros['situacoes'] = Situacao::all();

            //Funcionários
            $registros['funcionarios'] = Funcionario::all();

            //Sistema Acessos
            $registros['sistema_acessos'] = SistemaAcesso::all();

            return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registros), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function store(UserStoreRequest $request)
    {
        try {
            //Preparando request
            $data = $request->all();

            //Campo avatar
            $data['avatar'] = 'build/assets/images/users/avatar-0.png';

            //grava uma senha provisoria (usuário tem que redefinir)
            $data['password'] = Hash::make('12345678');

            //Incluindo registro
            $this->user->create($data);

            return response()->json(ApiReturn::data('Registro criado com sucesso.', 2010, null, null), 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $registro = $this->user->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                //Preparando request
                $data = $request->all();

                //Alterando registro
                $registro->update($data);

                return response()->json(ApiReturn::data('Registro atualizado com sucesso.', 2000, null, $registro), 200);
            }
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function profileData($id)
    {
        try {
            $registro = array();

            //User
            $user = DB::table('users')
                ->leftJoin('grupos', 'grupos.id', '=', 'users.grupo_id')
                ->leftJoin('situacoes', 'situacoes.id', '=', 'users.situacao_id')
                ->select(['users.*', 'grupos.name as groupName', 'situacoes.name as situacaoName'])
                ->where('users.id', '=', $id)
                ->get();

            $registro['user'] = $user[0];

            //Transacoes Table
            $transacoes = DB::table('transacoes')
                ->leftJoin('submodulos', 'submodulos.id', '=', 'transacoes.submodulo_id')
                ->leftJoin('operacoes', 'operacoes.id', '=', 'transacoes.operacao_id')
                ->select(['transacoes.*', 'submodulos.name as submoduloName', 'operacoes.name as operacaoName'])
                ->where('transacoes.user_id', '=', $id)
                ->orderBy('transacoes.date', 'desc')
                ->limit(30)
                ->get();

            $registro['transacoesTable']['transacoes'] = $transacoes;

            //Transacoes Count
            $inclusions = DB::table('transacoes')->where('user_id', '=', $id)->where('operacao_id', '=', 1)->count();
            $alterations = DB::table('transacoes')->where('user_id', '=', $id)->where('operacao_id', '=', 2)->count();
            $exclusions = DB::table('transacoes')->where('user_id', '=', $id)->where('operacao_id', '=', 3)->count();

            $registro['transacoesCount']['inclusions'] = $inclusions;
            $registro['transacoesCount']['alterations'] = $alterations;
            $registro['transacoesCount']['exclusions'] = $exclusions;

            return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registro), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function updateAvatar(Request $request, $id)
    {
        try {
            $registro = $this->user->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                //Alterando registro
                $registro->update($request->all());

                return response()->json(ApiReturn::data('Avatar atualizado com sucesso.', 2000, null, $registro), 200);
            }
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function editPassword(Request $request, $id)
    {
        try {
            $registro = $this->user->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                if (Hash::check($request['current_password'], $registro['password'])) {
                    //Alterando registro
                    $registro->update($request->all());

                    return response()->json(ApiReturn::data('Senha atualizada com sucesso.', 2000, null, $registro), 200);
                } else {
                    return response()->json(ApiReturn::data('Senha Atual não confere.', 4040, null, null), 404);
                }
            }
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function editEmail(Request $request, $id)
    {
        try {
            $registro = $this->user->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                if ($request['current_email'] != $registro['new_email']) {
                    //Zerando campo para confirmação do E-mail do Usuário
                    $request['user_confirmed_at'] = NULL;

                    //Alterando registro
                    $registro->update($request->all());

                    return response()->json(ApiReturn::data('E-mail atualizado com sucesso.', 2000, null, $registro), 200);
                } else {
                    return response()->json(ApiReturn::data('E-mail Atual não confere.', 4040, null, null), 404);
                }
            }
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function editmodestyle(Request $request, $id)
    {
        try {
            $registro = $this->user->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                //Alterando registro
                $registro->update($request->all());

                return response()->json(ApiReturn::data('Modo/Style atualizado com sucesso.', 2000, null, null), 200);
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
            $registro = $this->user->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, $registro), 404);
            } else {
                //Verificar Relacionamentos'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                //Tabela transacoes
                $qtd = DB::table('transacoes')->where('user_id', $id)->count();

                if ($qtd > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado em outras tabelas.', 2040, null, null), 200);
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

    public function search($field, $value)
    {
        $registros = $this->user->where($field, 'like', '%' . $value . '%')->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn)
    {
        $registros = $this->user->where($fieldSearch, 'like', '%' . $fieldValue . '%')->get($fieldReturn);

        return response()->json(ApiReturn::data('', 2000, '', $registros), 200);
    }

    public function userPermissoesSettings($searchSubmodulo)
    {
        try {
            if (!Auth::check()) {
                return response()->json(ApiReturn::data('Usuário não está logado.', 4040, null, null), 404);
            } else {
                //Cria array
                $registros = array();

                //Dados Usuário Logado
                $registros['userData'] = Auth::user();

                //Permissões Usuário Logado
                $registros['userPermissoes'] = DB::table('grupos_permissoes')
                    ->join('grupos', 'grupos_permissoes.grupo_id', '=', 'grupos.id')
                    ->join('permissoes', 'grupos_permissoes.permissao_id', '=', 'permissoes.id')
                    ->select('permissoes.name as permissao')
                    ->where('grupos_permissoes.grupo_id', Auth::user()->grupo_id)
                    ->get();

                //Menu Módulos
                $registros['menuModulos'] = Modulo::where('mobile', '=', '0')->where('viewing_order', '>', '0')->orderBy('viewing_order', 'asc')->orderBy('name', 'asc')->get();

                //Menu Submódulos
                $registros['menuSubmodulos'] = Submodulo::where('mobile', '=', '0')->where('viewing_order', '>', '0')->orderBy('viewing_order', 'asc')->orderBy('name', 'asc')->get();

                //Menu Módulos Mobile
                $registros['menuModulosMobile'] = Modulo::where('mobile', '=', '1')->where('viewing_order', '>', '0')->orderBy('viewing_order', 'asc')->orderBy('name', 'asc')->get();

                //Menu Submódulos Mobile
                $registros['menuSubmodulosMobile'] = Submodulo::where('mobile', '=', '1')->where('viewing_order', '>', '0')->orderBy('viewing_order', 'asc')->orderBy('name', 'asc')->get();

                //Ferramentas
                $registros['ferramentas'] = DB::table('ferramentas')
                    ->join('users', 'ferramentas.user_id', '=', 'users.id')
                    ->select(['ferramentas.*', 'users.name as userName'])
                    ->where('ferramentas.user_id', Auth::user()->id)
                    ->orderBy('name', 'asc')
                    ->get();


                //Notificações não lidas pelo Usuário Logado''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                //Buscar ids das notificações lidas pelo Usuário
                $notIn = DB::table('notificacoes_lidas')
                    ->leftJoin('notificacoes', 'notificacoes.id', '=', 'notificacoes_lidas.notificacao_id')
                    ->select('notificacoes_lidas.notificacao_id')
                    ->where('notificacoes_lidas.user_id', '=', Auth::user()->id)
                    ->get();

                $notificacoesNotIn = array();
                foreach ($notIn as $item) {$notificacoesNotIn[] = $item->notificacao_id;}

                //Buscando Notificações não lidas
                $registros['notificacoes'] = DB::table('notificacoes')
                    ->leftJoin('users', 'users.id', '=', 'notificacoes.user_id')
                    ->leftJoin('notificacoes_lidas', 'notificacoes_lidas.notificacao_id', '=', 'notificacoes.id')
                    ->select(['notificacoes.*', 'users.name as userName', 'users.avatar as userAvatar'])
                    ->whereNotIn('notificacoes.id', $notificacoesNotIn)
                    ->orderBy('notificacoes.date', 'desc')
                    ->orderBy('notificacoes.time', 'desc')
                    ->orderBy('notificacoes.title', 'asc')
                    ->limit(10)
                    ->get();
                //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                //Dados para o CRUD ajax''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                //Submódulo variavel Permissão
                $registros['ajaxPrefixPermissaoSubmodulo'] = Submodulo::select('prefix_permissao')->where('menu_route', '=', $searchSubmodulo)->get();

                //Submódulo variavel Nome
                $registros['ajaxNameSubmodulo'] = Submodulo::select('name')->where('menu_route', '=', $searchSubmodulo)->get();

                //Submódulo nome dos campos

                //verificar se veio de um submódulo MOBILE e, se precisa trocar nome para buscar campos da tabela
                if (substr($searchSubmodulo, 0 , 7) == 'mobile_') {$searchSubmodulo = substr($searchSubmodulo, 7);}

                $registros['ajaxNamesFieldsSubmodulo'] = Schema::getColumnListing($searchSubmodulo);
                //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
            }
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function userLoggedData()
    {
        try {
            if (!Auth::check()) {
                return response()->json(ApiReturn::data('Usuário não está logado.', 4040, null, null), 404);
            } else {
                //Cria array
                $registro = array();

                //Dados Usuário Logado
                $registro['userData'] = Auth::user();

                return response()->json(ApiReturn::data('Registro enviada com sucesso.', 2000, null, $registro), 200);
            }
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            //Removendo Token
            $user = Auth::user()->token();
            $user->revoke();

            return response()->json(ApiReturn::data('Logout realizado com sucesso e o token foi excluído.', 4001, null, null), 401);

        }

        return response()->json(ApiReturn::data('Logout não realizado.', 5000, null, null), 500);
    }

    public function exist($email)
    {
        $registro = $this->user->where('email', '=', $email)->count();

        return response()->json(ApiReturn::data('Exist enviado com sucesso.', 2000, '', $registro), 200);
    }

    public function confirm($email)
    {
        $registro = $this->user->where('email', '=', $email)->get();

        if (count($registro) == 1) {
            if ($registro[0]['user_confirmed_at'] != '') {
                return response()->json(ApiReturn::data('Usuário confirmado.', 2000, null, null), 200);
            } else {
                return response()->json(ApiReturn::data('Usuário não confirmado.', 2004, null, null), 200);
            }
        } else {
            return response()->json(ApiReturn::data('Usuário não existe.', 2005, null, null), 200);
        }
    }

    public function update_confirm(Request $request)
    {
        try {
            //Alterar tabela users
            $user = User::where('email', $request->email)->update(['user_confirmed_at' => date('Y-m-d H:i:s')]);

            if (!$user) {
                return response()->json(ApiReturn::data('Operação não concluída.', 4040, null, null), 404);
            }

            return response()->json(ApiReturn::data('Operações realizadas com sucesso.', 2000, null, null), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }
}
