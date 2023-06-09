<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Proposta;
use App\Models\User;
use App\Models\VisitaTecnica;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index($data)
    {
        $content = array();

        //Users
        if (substr($data, 0, 1) == 1) {
            //Quantidade de Registros
            $content['dashboardsUsersQtd'] = User::count();

            //Distribuição por Grupos
            $content['dashboardsUsersGrupos'] = DB::select("SELECT grupos.name, count(users.id) as qtd FROM users INNER JOIN grupos ON users.grupo_id=grupos.id GROUP BY grupos.name ORDER BY grupos.name");

            //Distribuição por Situacoes
            $content['dashboardsUsersSituacoes'] = DB::select("SELECT situacoes.name, count(users.id) as qtd FROM users INNER JOIN situacoes ON users.situacao_id=situacoes.id GROUP BY situacoes.name ORDER BY situacoes.name");
        }

        //Funcionarios
        if (substr($data, 2, 1) == 1) {
            $content['dashboardsFuncionariosQtd'] = Funcionario::count();

            //Distribuição por Funções
            $content['dashboardsFuncionariosFuncoes'] = DB::select("SELECT funcoes.name, count(funcionarios.id) as qtd FROM funcionarios INNER JOIN funcoes ON funcionarios.funcao_id=funcoes.id GROUP BY funcoes.name ORDER BY funcoes.name");

            //Distribuição por Gêneros
            $content['dashboardsFuncionariosGeneros'] = DB::select("SELECT generos.name, count(funcionarios.id) as qtd FROM funcionarios INNER JOIN generos ON funcionarios.genero_id=generos.id GROUP BY generos.name ORDER BY generos.name");
        }

        //Clientes
        if (substr($data, 4, 1) == 1) {
            $content['dashboardsClientesQtd'] = Cliente::count();

            //Distribuição por Status
            $content['dashboardsClientesStatus'] = DB::select("SELECT status, count(clientes.id) as qtd FROM clientes GROUP BY status ORDER BY status");

            //Distribuição por Tipos
            $content['dashboardsClientesTipos'] = DB::select("SELECT tipo, count(clientes.id) as qtd FROM clientes GROUP BY tipo ORDER BY tipo");
        }

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $content), 200);
    }

    public function index_mobile($id)
    {
        $content = array();

        //Pegando valor do funcionario_id do usuáriologado
        if (Auth::user()->funcionario_id === null) {
            $funcionario_id = 0;
        } else {
            $funcionario_id = Auth::user()->funcionario_id;
        }

        //Clientes
        if (substr($id, 0, 1) == 1) {
            //Qtd
            $content['dashboardsClientesQtd'] = Cliente::where('responsavel_funcionario_id', '=', $funcionario_id)->count();

            //Propostas
            $content['dashboardsClientesPropostas'] = count(DB::select("SELECT id FROM propostas WHERE cliente_id IN(SELECT id FROM clientes WHERE responsavel_funcionario_id=" . $funcionario_id . ")"));

            //Visitas Tecnicas
            $content['dashboardsClientesVisitasTecnicas'] = count(DB::select("SELECT id FROM visitas_tecnicas WHERE cliente_id IN(SELECT id FROM clientes WHERE responsavel_funcionario_id=" . $funcionario_id . ")"));
        }

        //Propostas
        if (substr($id, 2, 1) == 1) {
            //Qtd
            $content['dashboardsPropostasQtd'] = count(DB::select("SELECT id FROM propostas WHERE cliente_id IN(SELECT id FROM clientes WHERE responsavel_funcionario_id=" . $funcionario_id . ")"));
        }

        //Visitas Tecnicas
        if (substr($id, 4, 1) == 1) {
            $content['dashboardsVisitasTecnicasQtd'] = VisitaTecnica::where('responsavel_funcionario_id', '=', $funcionario_id)->count();

            //Aguardando Visita
            $content['dashboardsVisitasTecnicasAguardando'] = VisitaTecnica::where('responsavel_funcionario_id', '=', $funcionario_id)->where('visita_tecnica_status_id', '=', 1)->count();

            //Visita Executada
            $content['dashboardsVisitasTecnicasExecutadas'] = VisitaTecnica::where('responsavel_funcionario_id', '=', $funcionario_id)->where('visita_tecnica_status_id', '=', 2)->count();
        }

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $content), 200);
    }
}
