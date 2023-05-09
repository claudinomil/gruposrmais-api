<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Http\Requests\BancoStoreRequest;
use App\Http\Requests\BancoUpdateRequest;
use App\Models\GrupoPermissao;
use App\Models\Permissao;
use App\Models\Submodulo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Grupo;

class GrupoController extends Controller
{
    private $grupo;

    public function __construct(Grupo $grupo)
    {
        $this->grupo = $grupo;
    }

    public function index()
    {
        //Registros
        $registros = array();

        //Varrendo Grupos para pegar Permissoes
        $grupos = $this->grupo->get();
        foreach ($grupos as $key => $grupo) {
            $grupo_id = $grupo->id;
            $grupo_name = $grupo->name;

            $permissoes = "<div class='row'>";

            //Varrendo Submodulos para pegar Permissoes por submodulos
            $submodulos = Submodulo::all();
            foreach ($submodulos as $key => $submodulo) {
                $submodulo_id = $submodulo->id;
                $submodulo_name = $submodulo->name;

                //Buscando Permissoes
                $dados = DB::table('grupos_permissoes')
                    ->join('grupos', 'grupos.id', '=', 'grupos_permissoes.grupo_id')
                    ->leftJoin('permissoes', 'permissoes.id', '=', 'grupos_permissoes.permissao_id')
                    ->select(['permissoes.name as permissaoName'])
                    ->where('grupos_permissoes.grupo_id', $grupo_id)
                    ->where('permissoes.submodulo_id', $submodulo_id)
                    ->get();

                $permissoesSubmodulo = "<div class='col-12 col-md-3 pb-3'>";
                $permissoesSubmodulo .= "<b class='pb-3'>".$submodulo_name."</b>";

                $ctrl = 0;
                foreach ($dados as $key => $dado) {
                    $ctrl++;

                    $p = explode('_', $dado->permissaoName);
                    $p = $p[count($p)-1];

                    if ($p == 'list') {$perm = "<div class='col-12'><label class='form-check-label'><i class='fa fa-check text-primary'></i> Listar</label></div>";}
                    if ($p == 'show') {$perm = "<div class='col-12'><label class='form-check-label'><i class='fa fa-check text-info'></i> Mostrar</label></div>";}
                    if ($p == 'create') {$perm = "<div class='col-12'><label class='form-check-label'><i class='fa fa-check text-success'></i> Criar</label></div>";}
                    if ($p == 'edit') {$perm = "<div class='col-12'><label class='form-check-label'><i class='fa fa-check text-warning'></i> Editar</label></div>";}
                    if ($p == 'destroy') {$perm = "<div class='col-12'><label class='form-check-label'><i class='fa fa-check text-danger'></i> Deletar</label></div>";}

                    $permissoesSubmodulo .= $perm;
                }

                $permissoesSubmodulo .= "</div>";

                if ($ctrl > 0) {$permissoes .= $permissoesSubmodulo;}
            }

            $permissoes .= "</div>";

            //Montando registros de retorno
            $registros[] = [
                'id' => $grupo_id,
                'name' => $grupo_name,
                'permissoes' => $permissoes
            ];
        }

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }

    public function show($id)
    {
        try {
            //Buscando registro (Vem com Permissoes)
            $dados = DB::table('grupos')
                ->leftJoin('grupos_permissoes', 'grupos_permissoes.grupo_id', '=', 'grupos.id')
                ->leftJoin('permissoes', 'permissoes.id', '=', 'grupos_permissoes.permissao_id')
                ->select(['grupos.*', 'permissoes.name as permissaoName'])
                ->where('grupos.id', $id)
                ->get();

            //Montar registro para retorno
            $registro = array();

            $registro['id'] = $dados[0]->id; //Guarda id do Grupo
            $registro['name'] = $dados[0]->name; //Guarda name do Grupo

            foreach ($dados as $key => $dado) {
                $registro[$dado->permissaoName] = true; //Guarda nome das Permissoes do Grupo
            }

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
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

            //Submódulos
            $registros['submodulos'] = Submodulo::all();

            return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registros), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function store(BancoStoreRequest $request)
    {
        try {
            //Incluindo registro na tabela grupos
            $grupo = $this->grupo->create($request->all());
            $grupo_id = $grupo['id'];

            //Incluindo registros na tabela grupos_permissoes
            for($i=1; $i<=100; $i++) {
                if (isset($request['listar_'.$i])) {
                    $id = Permissao::where('name', $request['listar_'.$i])->get();
                    if (isset($id[0]['id'])) {
                        $permissao_id = $id[0]['id'];
                        GrupoPermissao::create(['grupo_id' => $grupo_id, 'permissao_id' => $permissao_id]);
                    }
                }

                if (isset($request['mostrar_'.$i])) {
                    $id = Permissao::where('name', $request['mostrar_'.$i])->get();
                    if (isset($id[0]['id'])) {
                        $permissao_id = $id[0]['id'];
                        GrupoPermissao::create(['grupo_id' => $grupo_id, 'permissao_id' => $permissao_id]);
                    }
                }

                if (isset($request['criar_'.$i])) {
                    $id = Permissao::where('name', $request['criar_'.$i])->get();
                    if (isset($id[0]['id'])) {
                        $permissao_id = $id[0]['id'];
                        GrupoPermissao::create(['grupo_id' => $grupo_id, 'permissao_id' => $permissao_id]);
                    }
                }

                if (isset($request['editar_'.$i])) {
                    $id = Permissao::where('name', $request['editar_'.$i])->get();
                    if (isset($id[0]['id'])) {
                        $permissao_id = $id[0]['id'];
                        GrupoPermissao::create(['grupo_id' => $grupo_id, 'permissao_id' => $permissao_id]);
                    }
                }

                if (isset($request['deletar_'.$i])) {
                    $id = Permissao::where('name', $request['deletar_'.$i])->get();
                    if (isset($id[0]['id'])) {
                        $permissao_id = $id[0]['id'];
                        GrupoPermissao::create(['grupo_id' => $grupo_id, 'permissao_id' => $permissao_id]);
                    }
                }
            }

            return response()->json(ApiReturn::data('Registro criado com sucesso.', 2010, null, null), 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function update(BancoUpdateRequest $request, $id)
    {
        try {
            $registro = $this->grupo->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, '', $registro), 404);
            } else {
                //Alterando registro na tabela grupos
                $registro->update($request->all());

                $grupo_id = $id;

                //Deletando registros na tabela grupoPermissoes
                GrupoPermissao::where('grupo_id', $grupo_id)->delete();

                //Incluindo registros na tabela grupos_permissoes
                for($i=1; $i<=100; $i++) {
                    if (isset($request['listar_'.$i])) {
                        $id = Permissao::where('name', $request['listar_'.$i])->get();
                        if (isset($id[0]['id'])) {
                            $permissao_id = $id[0]['id'];
                            GrupoPermissao::create(['grupo_id' => $grupo_id, 'permissao_id' => $permissao_id]);
                        }
                    }

                    if (isset($request['mostrar_'.$i])) {
                        $id = Permissao::where('name', $request['mostrar_'.$i])->get();
                        if (isset($id[0]['id'])) {
                            $permissao_id = $id[0]['id'];
                            GrupoPermissao::create(['grupo_id' => $grupo_id, 'permissao_id' => $permissao_id]);
                        }
                    }

                    if (isset($request['criar_'.$i])) {
                        $id = Permissao::where('name', $request['criar_'.$i])->get();
                        if (isset($id[0]['id'])) {
                            $permissao_id = $id[0]['id'];
                            GrupoPermissao::create(['grupo_id' => $grupo_id, 'permissao_id' => $permissao_id]);
                        }
                    }

                    if (isset($request['editar_'.$i])) {
                        $id = Permissao::where('name', $request['editar_'.$i])->get();
                        if (isset($id[0]['id'])) {
                            $permissao_id = $id[0]['id'];
                            GrupoPermissao::create(['grupo_id' => $grupo_id, 'permissao_id' => $permissao_id]);
                        }
                    }

                    if (isset($request['deletar_'.$i])) {
                        $id = Permissao::where('name', $request['deletar_'.$i])->get();
                        if (isset($id[0]['id'])) {
                            $permissao_id = $id[0]['id'];
                            GrupoPermissao::create(['grupo_id' => $grupo_id, 'permissao_id' => $permissao_id]);
                        }
                    }
                }

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
            $registro = $this->grupo->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, $registro), 404);
            } else {
                //Verificar Relacionamentos'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                //Tabela Users
                $qtd = DB::table('users')->where('grupo_id', $id)->count();

                if ($qtd > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado em Usuários.', 2040, null, null), 200);
                }
                //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                //Deletar'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                //Deletar antes na tabela grupopermissoes
                DB::table('grupos_permissoes')->where('grupo_id', $id)->delete();

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
        //Registros
        $registros = array();

        //Varrendo Grupos para pegar Permissoes
        $grupos = $this->grupo->where($field, 'like', '%'.$value.'%')->get();
        foreach ($grupos as $key => $grupo) {
            $grupo_id = $grupo->id;
            $grupo_name = $grupo->name;

            $permissoes = "<div class='row'>";

            //Varrendo Submodulos para pegar Permissoes por submodulos
            $submodulos = Submodulo::all();
            foreach ($submodulos as $key => $submodulo) {
                $submodulo_id = $submodulo->id;
                $submodulo_name = $submodulo->name;

                //Buscando Permissoes
                $dados = DB::table('grupos_permissoes')
                    ->leftJoin('permissoes', 'permissoes.id', '=', 'grupos_permissoes.permissao_id')
                    ->select(['permissoes.name as permissaoName'])
                    ->where('grupos_permissoes.grupo_id', $grupo_id)
                    ->where('permissoes.submodulo_id', $submodulo_id)
                    ->get();

                $permissoesSubmodulo = "<div class='col-12 col-md-3 pb-3'>";
                $permissoesSubmodulo .= "<b class='pb-3'>".$submodulo_name."</b>";

                $ctrl = 0;
                foreach ($dados as $key => $dado) {
                    $ctrl++;

                    $p = explode('_', $dado->permissaoName);
                    $p = $p[count($p)-1];

                    if ($p == 'list') {$perm = "<div class='col-12'><label class='form-check-label'><i class='fa fa-check text-primary'></i> Listar</label></div>";}
                    if ($p == 'show') {$perm = "<div class='col-12'><label class='form-check-label'><i class='fa fa-check text-info'></i> Mostrar</label></div>";}
                    if ($p == 'create') {$perm = "<div class='col-12'><label class='form-check-label'><i class='fa fa-check text-success'></i> Criar</label></div>";}
                    if ($p == 'edit') {$perm = "<div class='col-12'><label class='form-check-label'><i class='fa fa-check text-warning'></i> Editar</label></div>";}
                    if ($p == 'destroy') {$perm = "<div class='col-12'><label class='form-check-label'><i class='fa fa-check text-danger'></i> Deletar</label></div>";}

                    $permissoesSubmodulo .= $perm;
                }

                $permissoesSubmodulo .= "</div>";

                if ($ctrl > 0) {$permissoes .= $permissoesSubmodulo;}
            }

            $permissoes .= "</div>";

            //Montando registros de retorno
            $registros[] = [
                'id' => $grupo_id,
                'name' => $grupo_name,
                'permissoes' => $permissoes
            ];
        }

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn)
    {
        //Registros
        $registros = array();

        //Varrendo Grupos para pegar Permissoes
        $grupos = $this->grupo->where($fieldSearch, 'like', '%' . $fieldValue . '%')->get($fieldReturn);
        foreach ($grupos as $key => $grupo) {
            $grupo_id = $grupo->id;
            $grupo_name = $grupo->name;

            $permissoes = "<div class='row'>";

            //Varrendo Submodulos para pegar Permissoes por submodulos
            $submodulos = Submodulo::all();
            foreach ($submodulos as $key => $submodulo) {
                $submodulo_id = $submodulo->id;
                $submodulo_name = $submodulo->name;

                //Buscando Permissoes
                $dados = DB::table('grupos_permissoes')
                    ->leftJoin('permissoes', 'permissoes.id', '=', 'grupos_permissoes.permissao_id')
                    ->select(['permissoes.name as permissaoName'])
                    ->where('grupos_permissoes.grupo_id', $grupo_id)
                    ->where('permissoes.submodulo_id', $submodulo_id)
                    ->get();

                $permissoesSubmodulo = "<div class='col-12 col-md-3 pb-3'>";
                $permissoesSubmodulo .= "<b class='pb-3'>".$submodulo_name."</b>";

                $ctrl = 0;
                foreach ($dados as $key => $dado) {
                    $ctrl++;

                    $p = explode('_', $dado->permissaoName);
                    $p = $p[count($p)-1];

                    if ($p == 'list') {$perm = "<div class='col-12'><label class='form-check-label'><i class='fa fa-check text-primary'></i> Listar</label></div>";}
                    if ($p == 'show') {$perm = "<div class='col-12'><label class='form-check-label'><i class='fa fa-check text-info'></i> Mostrar</label></div>";}
                    if ($p == 'create') {$perm = "<div class='col-12'><label class='form-check-label'><i class='fa fa-check text-success'></i> Criar</label></div>";}
                    if ($p == 'edit') {$perm = "<div class='col-12'><label class='form-check-label'><i class='fa fa-check text-warning'></i> Editar</label></div>";}
                    if ($p == 'destroy') {$perm = "<div class='col-12'><label class='form-check-label'><i class='fa fa-check text-danger'></i> Deletar</label></div>";}

                    $permissoesSubmodulo .= $perm;
                }

                $permissoesSubmodulo .= "</div>";

                if ($ctrl > 0) {$permissoes .= $permissoesSubmodulo;}
            }

            $permissoes .= "</div>";

            //Montando registros de retorno
            $registros[] = [
                'id' => $grupo_id,
                'name' => $grupo_name,
                'permissoes' => $permissoes
            ];
        }

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }
}
