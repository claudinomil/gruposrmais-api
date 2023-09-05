<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Facades\SuporteFacade;
use App\Http\Requests\FornecedorStoreRequest;
use App\Http\Requests\FornecedorUpdateRequest;
use App\Models\Banco;
use App\Models\Genero;
use App\Models\IdentidadeOrgao;
use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    private $fornecedor;

    public function __construct(Fornecedor $fornecedor)
    {
        $this->fornecedor = $fornecedor;
    }

    public function index($empresa_id)
    {
        $registros = DB::table('fornecedores')
            ->leftJoin('identidade_orgaos', 'fornecedores.identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'fornecedores.identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'fornecedores.genero_id', '=', 'generos.id')
            ->leftJoin('bancos', 'fornecedores.banco_id', '=', 'bancos.id')
            ->select(['fornecedores.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'bancos.name as bancoName'])
            ->where('fornecedores.empresa_id', $empresa_id)
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function show($id)
    {
        try {
            $registro = $this->fornecedor->find($id);

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

    public function auxiliary($empresa_id)
    {
        try {
            $registros = array();

            //Gêneros
            $registros['generos'] = Genero::all();

            //Bancos
            $registros['bancos'] = Banco::all();

            //Órgãos Identidades
            $registros['identidade_orgaos'] = IdentidadeOrgao::all();

            //Estados para a Identidade
            $registros['identidade_estados'] = Estado::all();

            return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registros), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function store(FornecedorStoreRequest $request, $empresa_id)
    {
        try {
            //Atualisar objeto Auth::user()
            SuporteFacade::setUserLogged($empresa_id);

            //Colocar empresa_id no Request
            $request['empresa_id'] = $empresa_id;

            //Incluindo registro
            $this->fornecedor->create($request->all());

            return response()->json(ApiReturn::data('Registro criado com sucesso.', 2010, null, null), 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function update(FornecedorUpdateRequest $request, $id, $empresa_id)
    {
        try {
            $registro = $this->fornecedor->find($id);

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

    public function extraData($id)
    {
        try {
            $registro = array();

            //Fornecedor
            $fornecedor = Fornecedor::
                where('fornecedores.id', '=', $id)
                ->get();

            $registro['fornecedor'] = $fornecedor[0];

            //Compras no Fornecedor
            $fornecedor_compras = [];

            $registro['fornecedor_compras'] = $fornecedor_compras;

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
            $registro = $this->fornecedor->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, $registro), 404);
            } else {
                //Atualisar objeto Auth::user()
                SuporteFacade::setUserLogged($empresa_id);

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

    public function search($field, $value, $empresa_id)
    {
        $registros = DB::table('fornecedores')
            ->leftJoin('identidade_orgaos', 'fornecedores.identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'fornecedores.identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'fornecedores.genero_id', '=', 'generos.id')
            ->leftJoin('bancos', 'fornecedores.banco_id', '=', 'bancos.id')
            ->select(['fornecedores.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'bancos.name as bancoName'])
            ->where('fornecedores.empresa_id', '=', $empresa_id)
            ->where($field, 'like', '%' . $value . '%')
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn, $empresa_id)
    {
        $registros = DB::table('fornecedores')
            ->leftJoin('identidade_orgaos', 'fornecedores.identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'fornecedores.identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'fornecedores.genero_id', '=', 'generos.id')
            ->leftJoin('bancos', 'fornecedores.banco_id', '=', 'bancos.id')
            ->select(['fornecedores.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'bancos.name as bancoName'])
            ->where('fornecedores.empresa_id', '=', $empresa_id)
            ->where($fieldSearch, 'like', '%' . $fieldValue . '%')
            ->get($fieldReturn);

        return response()->json(ApiReturn::data('', 2000, null, $registros), 200);
    }
}
