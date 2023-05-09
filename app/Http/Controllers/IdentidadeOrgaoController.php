<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Http\Requests\IdentidadeOrgaoStoreRequest;
use App\Http\Requests\IdentidadeOrgaoUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\IdentidadeOrgao;

class IdentidadeOrgaoController extends Controller
{
    private $identidadeOrgao;

    public function __construct(IdentidadeOrgao $identidadeOrgao)
    {
        $this->identidadeOrgao = $identidadeOrgao;
    }

    public function index()
    {
        $registros = $this->identidadeOrgao->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }

    public function show($id)
    {
        try {
            $registro = $this->identidadeOrgao->find($id);

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

    public function store(IdentidadeOrgaoStoreRequest $request)
    {
        try {
            //Incluindo registro
            $this->identidadeOrgao->create($request->all());

            return response()->json(ApiReturn::data('Registro criado com sucesso.', 2010, null, null), 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function update(IdentidadeOrgaoUpdateRequest $request, $id)
    {
        try {
            $registro = $this->identidadeOrgao->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, null), 404);
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
            $registro = $this->identidadeOrgao->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, $registro), 404);
            } else {
                //Verificar Relacionamentos'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                //Tabela Fornecedores
                $qtd = DB::table('fornecedores')->where('identidade_orgao_id', $id)->count();

                if ($qtd > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado em Fornecedores.', 2040, null, null), 200);
                }

                //Tabela Clientes
                $qtd = DB::table('clientes')->where('identidade_orgao_id', $id)->count();

                if ($qtd > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado em Clientes.', 2040, null, null), 200);
                }

                //Tabela Funcionários
                $qtd = DB::table('funcionarios')->where('personal_identidade_orgao_id', $id)->count();

                if ($qtd > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado em Funcionários.', 2040, null, null), 200);
                }

                //Tabela Funcionários
                $qtd = DB::table('funcionarios')->where('professional_identidade_orgao_id', $id)->count();

                if ($qtd > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado em Funcionários.', 2040, null, null), 200);
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
        $registros = DB::table('identidade_orgaos')
            ->select(['identidade_orgaos.*'])
            ->where($field, 'like', '%' . $value . '%')
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn)
    {
        $registros = DB::table('identidade_orgaos')
            ->select(['identidade_orgaos.*'])
            ->where($fieldSearch, 'like', '%' . $fieldValue . '%')
            ->get($fieldReturn);

        return response()->json(ApiReturn::data('', 2000, null, $registros), 200);
    }
}
