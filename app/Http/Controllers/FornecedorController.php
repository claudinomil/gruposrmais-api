<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Http\Requests\FornecedorStoreRequest;
use App\Http\Requests\FornecedorUpdateRequest;
use App\Models\Banco;
//use App\Models\FornecedorAddress;
//use App\Models\FornecedorTelephone;
use App\Models\Genero;
use App\Models\IdentidadeOrgao;
use App\Models\EstadoCivil;
use App\Models\Nacionalidade;
use App\Models\Naturalidade;
use App\Models\Funcao;
use App\Models\Escolaridade;
use App\Models\Estado;
use Carbon\Carbon;
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

    public function index()
    {
        $registros = DB::table('fornecedores')
            ->leftJoin('identidade_orgaos', 'fornecedores.identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'fornecedores.identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'fornecedores.genero_id', '=', 'generos.id')
            ->leftJoin('bancos', 'fornecedores.banco_id', '=', 'bancos.id')
            ->select(['fornecedores.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'bancos.name as bancoName'])
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

    public function auxiliary()
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

    public function store(FornecedorStoreRequest $request)
    {
        try {
            //Preparando request
            $data = $request->all();

            if ($request['data_nascimento'] != '') {$data['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $request['data_nascimento'])->format('Y-m-d');}
            if ($request['identidade_data_emissao'] != '') {$data['identidade_data_emissao'] = Carbon::createFromFormat('d/m/Y', $request['identidade_data_emissao'])->format('Y-m-d');}

            //Campo foto
            $data['foto'] = 'build/assets/images/fornecedores/fornecedor-0.png';

            //Incluindo registro
            $this->fornecedor->create($data);

            return response()->json(ApiReturn::data('Registro criado com sucesso.', 2010, null, null), 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function update(FornecedorUpdateRequest $request, $id)
    {
        try {
            $registro = $this->fornecedor->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                //Preparando request
                $data = $request->all();

                if ($request['data_nascimento'] != '') {$data['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $request['data_nascimento'])->format('Y-m-d');}
                if ($request['identidade_data_emissao'] != '') {$data['identidade_data_emissao'] = Carbon::createFromFormat('d/m/Y', $request['identidade_data_emissao'])->format('Y-m-d');}

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

    public function extraData($id)
    {
        try {
            $registro = array();

            //Fornecedor
            $fornecedor = DB::table('fornecedores')
                ->leftJoin('identidade_orgaos', 'fornecedores.identidade_orgao_id', '=', 'identidade_orgaos.id')
                ->leftJoin('estados', 'fornecedores.identidade_estado_id', '=', 'estados.id')
                ->leftJoin('generos', 'fornecedores.genero_id', '=', 'generos.id')
                ->leftJoin('bancos', 'fornecedores.banco_id', '=', 'bancos.id')
                ->select(['fornecedores.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'bancos.name as bancoName'])
                ->where('fornecedores.id', '=', $id)
                ->get();

            $registro['fornecedor'] = $fornecedor[0];

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
            $registro = $this->fornecedor->find($id);

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
            $registro = $this->fornecedor->find($id);

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
        $registros = DB::table('fornecedores')
            ->leftJoin('identidade_orgaos', 'fornecedores.identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'fornecedores.identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'fornecedores.genero_id', '=', 'generos.id')
            ->leftJoin('bancos', 'fornecedores.banco_id', '=', 'bancos.id')
            ->select(['fornecedores.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'bancos.name as bancoName'])
            ->where($field, 'like', '%' . $value . '%')
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn)
    {
        $registros = DB::table('fornecedores')
            ->leftJoin('identidade_orgaos', 'fornecedores.identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'fornecedores.identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'fornecedores.genero_id', '=', 'generos.id')
            ->leftJoin('bancos', 'fornecedores.banco_id', '=', 'bancos.id')
            ->select(['fornecedores.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'bancos.name as bancoName'])
            ->where($fieldSearch, 'like', '%' . $fieldValue . '%')
            ->get($fieldReturn);

        return response()->json(ApiReturn::data('', 2000, null, $registros), 200);
    }
}
