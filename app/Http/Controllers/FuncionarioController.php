<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Http\Requests\FuncionarioStoreRequest;
use App\Http\Requests\FuncionarioUpdateRequest;
use App\Models\FuncionarioAddress;
use App\Models\FuncionarioTelephone;
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
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    private $funcionario;

    public function __construct(Funcionario $funcionario)
    {
        $this->funcionario = $funcionario;
    }

    public function index()
    {
        $registros = DB::table('funcionarios')
            ->leftJoin('identidade_orgaos', 'funcionarios.personal_identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'funcionarios.personal_identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'funcionarios.genero_id', '=', 'generos.id')
            ->leftJoin('estados_civis', 'funcionarios.estado_civil_id', '=', 'estados_civis.id')
            ->select(['funcionarios.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'estados_civis.name as estado_civilName'])
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function show($id)
    {
        try {
            $registro = $this->funcionario->find($id);

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

            //Estados Civis
            $registros['estados_civis'] = EstadoCivil::all();

            //Escolaridades
            $registros['escolaridades'] = Escolaridade::all();

            //Nacionalidades
            $registros['nacionalidades'] = Nacionalidade::all();

            //Naturalidades
            $registros['naturalidades'] = Naturalidade::all();

            //Órgãos Identidades
            $registros['identidade_orgaos'] = IdentidadeOrgao::all();

            //Estados para a Identidade
            $registros['identidade_estados'] = Estado::all();

            //Funções
            $registros['funcoes'] = Funcao::all();

            return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registros), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function store(FuncionarioStoreRequest $request)
    {
        try {
            //Preparando request
            $data = $request->all();

            if ($request['data_nascimento'] != '') {$data['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $request['data_nascimento'])->format('Y-m-d');}
            if ($request['data_admissao'] != '') {$data['data_admissao'] = Carbon::createFromFormat('d/m/Y', $request['data_admissao'])->format('Y-m-d');}
            if ($request['data_demissao'] != '') {$data['data_demissao'] = Carbon::createFromFormat('d/m/Y', $request['data_demissao'])->format('Y-m-d');}
            if ($request['personal_identidade_data_emissao'] != '') {$data['personal_identidade_data_emissao'] = Carbon::createFromFormat('d/m/Y', $request['personal_identidade_data_emissao'])->format('Y-m-d');}
            if ($request['professional_identidade_data_emissao'] != '') {$data['professional_identidade_data_emissao'] = Carbon::createFromFormat('d/m/Y', $request['professional_identidade_data_emissao'])->format('Y-m-d');}

            //Campo foto
            $data['foto'] = 'build/assets/images/funcionarios/funcionario-0.png';

            //Incluindo registro
            $this->funcionario->create($data);

            return response()->json(ApiReturn::data('Registro criado com sucesso.', 2010, null, null), 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function update(FuncionarioUpdateRequest $request, $id)
    {
        try {
            $registro = $this->funcionario->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
            } else {
                //Preparando request
                $data = $request->all();

                if ($request['data_nascimento'] != '') {$data['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $request['data_nascimento'])->format('Y-m-d');}
                if ($request['data_admissao'] != '') {$data['data_admissao'] = Carbon::createFromFormat('d/m/Y', $request['data_admissao'])->format('Y-m-d');}
                if ($request['data_demissao'] != '') {$data['data_demissao'] = Carbon::createFromFormat('d/m/Y', $request['data_demissao'])->format('Y-m-d');}
                if ($request['personal_identidade_data_emissao'] != '') {$data['personal_identidade_data_emissao'] = Carbon::createFromFormat('d/m/Y', $request['personal_identidade_data_emissao'])->format('Y-m-d');}
                if ($request['professional_identidade_data_emissao'] != '') {$data['professional_identidade_data_emissao'] = Carbon::createFromFormat('d/m/Y', $request['professional_identidade_data_emissao'])->format('Y-m-d');}

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

            //Funcionario
            $funcionario = DB::table('funcionarios')
                ->leftJoin('identidade_orgaos', 'funcionarios.personal_identidade_orgao_id', '=', 'identidade_orgaos.id')
                ->leftJoin('estados', 'funcionarios.personal_identidade_estado_id', '=', 'estados.id')
                ->leftJoin('generos', 'funcionarios.genero_id', '=', 'generos.id')
                ->leftJoin('funcoes', 'funcionarios.funcao_id', '=', 'funcoes.id')
                ->leftJoin('escolaridades', 'funcionarios.escolaridade_id', '=', 'escolaridades.id')
                ->leftJoin('estados_civis', 'funcionarios.estado_civil_id', '=', 'estados_civis.id')
                ->select(['funcionarios.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'escolaridades.name as escolaridadeName', 'funcoes.name as funcaoName', 'estados_civis.name as estado_civilName'])
                ->where('funcionarios.id', '=', $id)
                ->get();

            $registro['funcionario'] = $funcionario[0];

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
            $registro = $this->funcionario->find($id);

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
            $registro = $this->funcionario->find($id);

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
        $registros = DB::table('funcionarios')
            ->leftJoin('identidade_orgaos', 'funcionarios.personal_identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'funcionarios.personal_identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'funcionarios.genero_id', '=', 'generos.id')
            ->leftJoin('estados_civis', 'funcionarios.estado_civil_id', '=', 'estados_civis.id')
            ->select(['funcionarios.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'estados_civis.name as estado_civilName'])
            ->where($field, 'like', '%' . $value . '%')
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn)
    {
        $registros = DB::table('funcionarios')
            ->leftJoin('identidade_orgaos', 'funcionarios.personal_identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'funcionarios.personal_identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'funcionarios.genero_id', '=', 'generos.id')
            ->leftJoin('estados_civis', 'funcionarios.estado_civil_id', '=', 'estados_civis.id')
            ->select(['funcionarios.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'estados_civis.name as estado_civilName'])
            ->where($fieldSearch, 'like', '%' . $fieldValue . '%')
            ->get($fieldReturn);

        return response()->json(ApiReturn::data('', 2000, null, $registros), 200);
    }
}
