<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Facades\SuporteFacade;
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

    public function index($empresa_id)
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

    public function store(IdentidadeOrgaoStoreRequest $request, $empresa_id)
    {
        try {
            //Atualisar objeto Auth::user()
            SuporteFacade::setUserLogged($empresa_id);

            //Colocar empresa_id no Request
            $request['empresa_id'] = $empresa_id;

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

    public function update(IdentidadeOrgaoUpdateRequest $request, $id, $empresa_id)
    {
        try {
            $registro = $this->identidadeOrgao->find($id);

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
            $registro = $this->identidadeOrgao->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, $registro), 404);
            } else {
                //Atualisar objeto Auth::user()
                SuporteFacade::setUserLogged($empresa_id);

                //Verificar Relacionamentos'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                //Tabela fornecedores
                if (SuporteFacade::verificarRelacionamento('fornecedores', 'identidade_orgao_id', $id) > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Fornecedores.', 2040, null, null), 200);
                }

                //Tabela clientes
                if (SuporteFacade::verificarRelacionamento('clientes', 'identidade_orgao_id', $id) > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Clientes.', 2040, null, null), 200);
                }

                //Tabela funcionarios
                if (SuporteFacade::verificarRelacionamento('funcionarios', 'personal_identidade_orgao_id', $id) > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Funcionários.', 2040, null, null), 200);
                }

                //Tabela funcionarios
                if (SuporteFacade::verificarRelacionamento('funcionarios', 'professional_identidade_orgao_id', $id) > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Funcionários.', 2040, null, null), 200);
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

    public function filter($array_dados, $empresa_id)
    {
        //Filtros enviados pelo Client
        $filtros = explode(',', $array_dados);

        //Limpar Querys executadas
        //DB::enableQueryLog();


        //Registros
        $registros = $this->identidadeOrgao
            ->select(['identidades_orgaos.*'])
            ->where(function($query) use($filtros) {
                //Variavel para controle
                $qtdFiltros = count($filtros) / 4;
                $indexCampo = 0;

                for($i=1; $i<=$qtdFiltros; $i++) {
                    //Valores do Filtro
                    $condicao = $filtros[$indexCampo];
                    $campo = $filtros[$indexCampo+1];
                    $operacao = $filtros[$indexCampo+2];
                    $dado = $filtros[$indexCampo+3];

                    //Operações
                    if ($operacao == 1) {
                        if ($condicao == 1) {$query->where($campo, 'like', '%'.$dado.'%');} else {$query->orwhere($campo, 'like', '%'.$dado.'%');}
                    }
                    if ($operacao == 2) {
                        if ($condicao == 1) {$query->where($campo, '=', $dado);} else {$query->orwhere($campo, '=', $dado);}
                    }
                    if ($operacao == 3) {
                        if ($condicao == 1) {$query->where($campo, '>', $dado);} else {$query->orwhere($campo, '>', $dado);}
                    }
                    if ($operacao == 4) {
                        if ($condicao == 1) {$query->where($campo, '>=', $dado);} else {$query->orwhere($campo, '>=', $dado);}
                    }
                    if ($operacao == 5) {
                        if ($condicao == 1) {$query->where($campo, '<', $dado);} else {$query->orwhere($campo, '<', $dado);}
                    }
                    if ($operacao == 6) {
                        if ($condicao == 1) {$query->where($campo, '<=', $dado);} else {$query->orwhere($campo, '<=', $dado);}
                    }
                    if ($operacao == 7) {
                        if ($condicao == 1) {$query->where($campo, 'like', $dado.'%');} else {$query->orwhere($campo, 'like', $dado.'%');}
                    }
                    if ($operacao == 8) {
                        if ($condicao == 1) {$query->where($campo, 'like', '%'.$dado);} else {$query->orwhere($campo, 'like', '%'.$dado);}
                    }

                    //Atualizar indexCampo
                    $indexCampo = $indexCampo + 4;
                }
            }
            )->get();

        //Código SQL Bruto
        //$sql = DB::getQueryLog();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }
}
