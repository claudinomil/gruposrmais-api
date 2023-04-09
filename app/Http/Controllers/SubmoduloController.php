<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Http\Requests\SubmoduloStoreRequest;
use App\Http\Requests\SubmoduloUpdateRequest;
use App\Models\Modulo;
use App\Models\Submodulo;
use Illuminate\Support\Facades\DB;

class SubmoduloController extends Controller
{
    private $submodulo;

    public function __construct(Submodulo $submodulo)
    {
        $this->submodulo = $submodulo;
    }

    public function index()
    {
        $registros = $this->submodulo->all();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }

    public function show($id)
    {
        try {
            $registro = $this->submodulo->find($id);

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

            //Módulos
            $registros['modulos'] = Modulo::all();

            return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registros), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function store(SubmoduloStoreRequest $request)
    {
        try {
            //Incluindo registro
            $this->submodulo->create($request->all());

            return response()->json(ApiReturn::data('Registro criado com sucesso.', 2010, null, null), 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function update(SubmoduloUpdateRequest $request, $id)
    {
        try {
            $registro = $this->submodulo->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, '', $registro), 404);
            } else {
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

    public function destroy($id)
    {
        try {
            $registro = $this->submodulo->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, $registro), 404);
            } else {
                //Verificar Relacionamentos'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                //Tabela transacoes
                $qtd = DB::table('transacoes')->where('submodulo_id', $id)->count();

                if ($qtd > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado em outras tabelas.', 2040, null, null), 200);
                }

                //Tabela permissoes
                $qtd = DB::table('permissoes')->where('submodulo_id', $id)->count();

                if ($qtd > 0) {
                    return response()->json(ApiReturn::data('PERM Náo é possível excluir. Registro relacionado em outras tabelas.', 5000, null, null), 500);
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
        $registros = $this->submodulo->where($field, 'like', '%' . $value . '%')->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn)
    {
        $registros = $this->submodulo->where($fieldSearch, 'like', '%' . $fieldValue . '%')->get($fieldReturn);

        return response()->json(ApiReturn::data('', 2000, '', $registros), 200);
    }

    //Retorna todos os Submodulos do Modulo
    public function submodulos_from_modulo($modulo_id)
    {
        return response()->json($this->submodulo->where('modulo_id', '=', $modulo_id)->get());
    }

    public function menu()
    {
        $registros = $this->submodulo->where('viewing_order', '>', '0')->orderBy('viewing_order', 'asc')->orderBy('name', 'asc')->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }

    public function admin_modulos_submodulos_all()
    {
        $registros = DB::table('submodulos')
            ->select('modulos.name as moduloName', 'submodulos.id', 'submodulos.name as submoduloName')
            ->join('modulos', 'modulos.id', '=', 'submodulos.modulo_id')
            ->orderBy('modulos.viewing_order', 'asc', 'submodulos.viewing_order', 'asc')
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }
    public function admin_modulos_submodulos_in($ids='')
    {
        $registros = DB::table('submodulos')
            ->select('modulos.name as moduloName', 'submodulos.id', 'submodulos.name as submoduloName')
            ->join('modulos', 'modulos.id', '=', 'submodulos.modulo_id')
            ->orderBy('modulos.viewing_order', 'asc', 'submodulos.viewing_order', 'asc')
            ->whereIn('submodulos.id', [$ids])
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }
}
