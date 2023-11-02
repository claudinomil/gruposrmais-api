<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Facades\SuporteFacade;
use App\Facades\Transacoes;
use App\Http\Requests\FuncionarioStoreRequest;
use App\Http\Requests\FuncionarioUpdateRequest;
use App\Models\Departamento;
use App\Models\Genero;
use App\Models\ContratacaoTipo;
use App\Models\IdentidadeOrgao;
use App\Models\EstadoCivil;
use App\Models\Nacionalidade;
use App\Models\Naturalidade;
use App\Models\Funcao;
use App\Models\Banco;
use App\Models\Escolaridade;
use App\Models\Estado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\FuncionarioDocumento;

class FuncionarioController extends Controller
{
    private $funcionario;

    public function __construct(Funcionario $funcionario)
    {
        $this->funcionario = $funcionario;
    }

    public function index($empresa_id)
    {
        $registros = DB::table('funcionarios')
            ->leftJoin('identidade_orgaos', 'funcionarios.personal_identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'funcionarios.personal_identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'funcionarios.genero_id', '=', 'generos.id')
            ->leftJoin('contratacao_tipos', 'funcionarios.contratacao_tipo_id', '=', 'contratacao_tipos.id')
            ->leftJoin('departamentos', 'funcionarios.departamento_id', '=', 'departamentos.id')
            ->leftJoin('funcoes', 'funcionarios.funcao_id', '=', 'funcoes.id')
            ->leftJoin('escolaridades', 'funcionarios.escolaridade_id', '=', 'escolaridades.id')
            ->leftJoin('estados_civis', 'funcionarios.estado_civil_id', '=', 'estados_civis.id')
            ->leftJoin('bancos', 'funcionarios.banco_id', '=', 'bancos.id')
            ->select(['funcionarios.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'contratacao_tipos.name as contratacaoTipoName', 'estados_civis.name as estado_civilName', 'bancos.name as bancoName', 'departamentos.name as departamentoName', 'funcoes.name as funcaoName'])
            ->where('funcionarios.empresa_id', $empresa_id)
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
                //Buscar Documentos
                $registro['funcionarioDocumentos'] = FuncionarioDocumento::where('funcionario_id', '=', $id)->orderby('descricao')->get();

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

            //Contratação Tipos
            $registros['contratacao_tipos'] = ContratacaoTipo::all();

            //Bancos
            $registros['bancos'] = Banco::all();

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

            //Departamentos
            $registros['departamentos'] = Departamento::where('empresa_id', '=', $empresa_id)->get();

            //Funções
            $registros['funcoes'] = Funcao::where('empresa_id', '=', $empresa_id)->get();

            return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registros), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function store(FuncionarioStoreRequest $request, $empresa_id)
    {
        try {
            //Atualisar objeto Auth::user()
            SuporteFacade::setUserLogged($empresa_id);

            //Colocar empresa_id no Request
            $request['empresa_id'] = $empresa_id;

            //Incluindo registro
            $this->funcionario->create($request->all());

            return response()->json(ApiReturn::data('Registro criado com sucesso.', 2010, null, null), 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function update(FuncionarioUpdateRequest $request, $id, $empresa_id)
    {
        try {
            $registro = $this->funcionario->find($id);

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

            //Funcionario
            $funcionario = DB::table('funcionarios')
                ->leftJoin('identidade_orgaos', 'funcionarios.personal_identidade_orgao_id', '=', 'identidade_orgaos.id')
                ->leftJoin('estados', 'funcionarios.personal_identidade_estado_id', '=', 'estados.id')
                ->leftJoin('generos', 'funcionarios.genero_id', '=', 'generos.id')
                ->leftJoin('contratacao_tipos', 'funcionarios.contratacao_tipo_id', '=', 'contratacao_tipos.id')
                ->leftJoin('departamentos', 'funcionarios.departamento_id', '=', 'departamentos.id')
                ->leftJoin('funcoes', 'funcionarios.funcao_id', '=', 'funcoes.id')
                ->leftJoin('escolaridades', 'funcionarios.escolaridade_id', '=', 'escolaridades.id')
                ->leftJoin('estados_civis', 'funcionarios.estado_civil_id', '=', 'estados_civis.id')
                ->leftJoin('bancos', 'funcionarios.banco_id', '=', 'bancos.id')
                ->select(['funcionarios.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'contratacao_tipos.name as contratacaoTipoName', 'estados_civis.name as estado_civilName', 'bancos.name as bancoName', 'departamentos.name as departamentoName', 'funcoes.name as funcaoName'])
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

    public function destroy($id, $empresa_id)
    {
        try {
            $registro = $this->funcionario->find($id);

            if (!$registro) {
                return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, $registro), 404);
            } else {
                //Atualisar objeto Auth::user()
                SuporteFacade::setUserLogged($empresa_id);

                //Verificar Relacionamentos'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                //Tabela users
                if (SuporteFacade::verificarRelacionamento('users', 'funcionario_id', $id) > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Usuários.', 2040, null, null), 200);
                }

                //Tabela funcionarios_documentos
                if (SuporteFacade::verificarRelacionamento('funcionarios_documentos', 'funcionario_id', $id) > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Funcionários Documentos.', 2040, null, null), 200);
                }

                //Tabela clientes_servicos
                if (SuporteFacade::verificarRelacionamento('clientes_servicos', 'responsavel_funcionario_id', $id) > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Clientes Serviços.', 2040, null, null), 200);
                }

                //Tabela brigadas_escalas
                if (SuporteFacade::verificarRelacionamento('brigadas_escalas', 'funcionario_id', $id) > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Brigadas Escalas.', 2040, null, null), 200);
                }

                //Tabela cliente_servicos_brigadistas
                if (SuporteFacade::verificarRelacionamento('cliente_servicos_brigadistas', 'funcionario_id', $id) > 0) {
                    return response()->json(ApiReturn::data('Náo é possível excluir. Registro relacionado com Cliente Serviços Brigadistas.', 2040, null, null), 200);
                }
                //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

                //Apagar dados na tabela funcionarios_documentos''''''''''''''''''''''''''''''''''''''''''''''''''''''''
                FuncionarioDocumento::where('funcionario_id', '=', $id)->delete();
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

//    public function search($field, $value, $empresa_id)
//    {
//        $registros = DB::table('funcionarios')
//            ->leftJoin('identidade_orgaos', 'funcionarios.personal_identidade_orgao_id', '=', 'identidade_orgaos.id')
//            ->leftJoin('estados', 'funcionarios.personal_identidade_estado_id', '=', 'estados.id')
//            ->leftJoin('generos', 'funcionarios.genero_id', '=', 'generos.id')
//            ->leftJoin('contratacao_tipos', 'funcionarios.contratacao_tipo_id', '=', 'contratacao_tipos.id')
//            ->leftJoin('departamentos', 'funcionarios.departamento_id', '=', 'departamentos.id')
//            ->leftJoin('funcoes', 'funcionarios.funcao_id', '=', 'funcoes.id')
//            ->leftJoin('escolaridades', 'funcionarios.escolaridade_id', '=', 'escolaridades.id')
//            ->leftJoin('estados_civis', 'funcionarios.estado_civil_id', '=', 'estados_civis.id')
//            ->leftJoin('bancos', 'funcionarios.banco_id', '=', 'bancos.id')
//            ->select(['funcionarios.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'contratacao_tipos.name as contratacaoTipoName', 'estados_civis.name as estado_civilName', 'bancos.name as bancoName', 'departamentos.name as departamentoName', 'funcoes.name as funcaoName'])
//            ->where('funcionarios.empresa_id', '=', $empresa_id)
//            ->where($field, 'like', '%' . $value . '%')
//            ->get();
//
//        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
//    }

    public function filter($array_dados, $empresa_id)
    {
        //Filtros enviados pelo Client
        $filtros = explode(',', $array_dados);

        //Limpar Querys executadas
        //DB::enableQueryLog();


        //Registros
        $registros = $this->funcionario
            ->leftJoin('identidade_orgaos', 'funcionarios.personal_identidade_orgao_id', '=', 'identidade_orgaos.id')
            ->leftJoin('estados', 'funcionarios.personal_identidade_estado_id', '=', 'estados.id')
            ->leftJoin('generos', 'funcionarios.genero_id', '=', 'generos.id')
            ->leftJoin('contratacao_tipos', 'funcionarios.contratacao_tipo_id', '=', 'contratacao_tipos.id')
            ->leftJoin('departamentos', 'funcionarios.departamento_id', '=', 'departamentos.id')
            ->leftJoin('funcoes', 'funcionarios.funcao_id', '=', 'funcoes.id')
            ->leftJoin('escolaridades', 'funcionarios.escolaridade_id', '=', 'escolaridades.id')
            ->leftJoin('estados_civis', 'funcionarios.estado_civil_id', '=', 'estados_civis.id')
            ->leftJoin('bancos', 'funcionarios.banco_id', '=', 'bancos.id')
            ->select(['funcionarios.*', 'identidade_orgaos.name as identidade_orgaosName', 'estados.name as identidadeEstadoName', 'generos.name as generoName', 'contratacao_tipos.name as contratacaoTipoName', 'estados_civis.name as estado_civilName', 'bancos.name as bancoName', 'departamentos.name as departamentoName', 'funcoes.name as funcaoName'])
            ->where('funcionarios.empresa_id', '=', $empresa_id)
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

    public function store_documentos(Request $request, $empresa_id)
    {
        try {
            //Atualisar objeto Auth::user()
            SuporteFacade::setUserLogged($empresa_id);

            //Incluindo registro
            FuncionarioDocumento::create($request->all());

            //gravar transacao
            Transacoes::transacaoRecord(2, 1, 'funcionarios', $request, $request);

            //Return
            return response()->json(ApiReturn::data('Registro criado com sucesso.', 2010, null, null), 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function deletar_documento($funcionario_documento_id, $empresa_id)
    {
        //Atualisar objeto Auth::user()
        SuporteFacade::setUserLogged($empresa_id);

        $registro = FuncionarioDocumento::find($funcionario_documento_id);

        if (!$registro) {
            return response()->json(ApiReturn::data('Registro não encontrado.', 4040, null, $registro), 404);
        } else {
            //Deletar
            $registro->delete();

            //gravar transacao
            Transacoes::transacaoRecord(2, 3, 'funcionarios', $registro, $registro);

            //Return
            return response()->json(ApiReturn::data('Registro excluído com sucesso.', 2000, null, null), 200);
        }
    }
}
