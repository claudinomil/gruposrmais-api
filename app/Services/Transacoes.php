<?php

namespace App\Services;

use App\Models\Banco;
use App\Models\Cliente;
use App\Models\ContratacaoTipo;
use App\Models\Funcionario;
use App\Models\Genero;
use App\Models\Grupo;
use App\Models\IdentidadeOrgao;
use App\Models\EstadoCivil;
use App\Models\Modulo;
use App\Models\Nacionalidade;
use App\Models\Naturalidade;
use App\Models\Funcao;
use App\Models\Escolaridade;
use App\Models\ServicoTipo;
use App\Models\Situacao;
use App\Models\Estado;
use App\Models\Transacao;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Transacoes
{
    //Função para Gravar Transação
    public function transacaoRecord($operacao, $submodulo, $beforeData, $laterData) {
        //Gravar transação
        if (Auth::check()) {
            //submodulo_id'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
            $data = DB::table('submodulos')->select(['id'])->where('prefix_route', $submodulo)->get()->toArray();

            $submodulo_id = $data[0]->id;
            //'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

            //montar campo dados'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
            $dados = '';

            //modulos
            if ($submodulo_id == 1) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";

                if ($beforeData['menu_text'] != $laterData['menu_text']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Menu Texto: " . $y . $laterData['menu_text'] . "<br>";

                if ($beforeData['menu_url'] != $laterData['menu_url']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Menu URL: " . $y . $laterData['menu_url'] . "<br>";

                if ($beforeData['menu_route'] != $laterData['menu_route']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Menu Rota: " . $y . $laterData['menu_route'] . "<br>";

                if ($beforeData['menu_icon'] != $laterData['menu_icon']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Menu Ícone: " . $y . $laterData['menu_icon'] . "<br>";

                if ($beforeData['viewing_order'] != $laterData['viewing_order']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Ordem Visualização: " . $y . $laterData['viewing_order'] . "<br>";
            }

            //submodulos
            if ($submodulo_id == 2) {
                if ($beforeData['modulo_id'] != $laterData['modulo_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['modulo_id'] != "") and ($laterData['modulo_id'] != 0)) {
                    $search = Modulo::where('id', $laterData['modulo_id'])->get(['name']);
                    $dados .= $x . "Módulo: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";

                if ($beforeData['menu_text'] != $laterData['menu_text']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Menu Texto: " . $y . $laterData['menu_text'] . "<br>";

                if ($beforeData['menu_url'] != $laterData['menu_url']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Menu URL: " . $y . $laterData['menu_url'] . "<br>";

                if ($beforeData['menu_route'] != $laterData['menu_route']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Menu Rota: " . $y . $laterData['menu_route'] . "<br>";

                if ($beforeData['menu_icon'] != $laterData['menu_icon']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Menu Ícone: " . $y . $laterData['menu_icon'] . "<br>";

                if ($beforeData['prefix_permissao'] != $laterData['prefix_permissao']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Prefixo Permissão: " . $y . $laterData['prefix_permissao'] . "<br>";

                if ($beforeData['prefix_route'] != $laterData['prefix_route']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Prefixo Rota: " . $y . $laterData['prefix_route'] . "<br>";

                if ($beforeData['viewing_order'] != $laterData['viewing_order']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Ordem Visualização: " . $y . $laterData['viewing_order'] . "<br>";
            }

            //grupos
            if ($submodulo_id == 4) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";
            }

            //users
            if ($submodulo_id == 5) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";

                if ($beforeData['email'] != $laterData['email']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "E-mail: " . $y . $laterData['email'] . "<br>";

                if ($beforeData['avatar'] != $laterData['avatar']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Avatar: " . $y . $laterData['avatar'] . "<br>";

                if ($beforeData['layout_style'] != $laterData['layout_style']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Layout Style: " . $y . $laterData['layout_style'] . "<br>";

                if ($beforeData['layout_mode'] != $laterData['layout_mode']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Layout Mode: " . $y . $laterData['layout_mode'] . "<br>";

                if ($beforeData['grupo_id'] != $laterData['grupo_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['grupo_id'] != "") and ($laterData['grupo_id'] != 0)) {
                    $search = Grupo::where('id', $laterData['grupo_id'])->get(['name']);
                    $dados .= $x . "Grupo: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['situacao_id'] != $laterData['situacao_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['situacao_id'] != "") and ($laterData['situacao_id'] != 0)) {
                    $search = Situacao::where('id', $laterData['situacao_id'])->get(['name']);
                    $dados .= $x . "Situação: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['funcionario_id'] != $laterData['funcionario_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['funcionario_id'] != "") and ($laterData['funcionario_id'] != 0)) {
                    $search = Funcionario::where('id', $laterData['funcionario_id'])->get(['name']);
                    $dados .= $x . "Funcionário: " . $y . $search[0]['name'] . "<br>";
                }
            }

            //notificacoes
            if ($submodulo_id == 7) {
                if ($beforeData['date'] != $laterData['date']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Data: " . $y . $laterData['date'] . "<br>";

                if ($beforeData['time'] != $laterData['time']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Hora: " . $y . $laterData['time'] . "<br>";

                if ($beforeData['title'] != $laterData['title']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Título: " . $y . $laterData['title'] . "<br>";

                if ($beforeData['notificacao'] != $laterData['notificacao']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Notificação: " . $y . $laterData['notificacao'] . "<br>";

                if ($beforeData['user_id'] != $laterData['user_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['user_id'] != "") and ($laterData['user_id'] != 0)) {
                    $search = User::where('id', $laterData['user_id'])->get(['name']);
                    $dados .= $x . "Usuário: " . $y . $search[0]['name'] . "<br>";
                }
            }

            //ferramentas
            if ($submodulo_id == 9) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";

                if ($beforeData['descricao'] != $laterData['descricao']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Descrição: " . $y . $laterData['descricao'] . "<br>";

                if ($beforeData['url'] != $laterData['url']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "URL: " . $y . $laterData['url'] . "<br>";

                if ($beforeData['icon'] != $laterData['icon']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Ícone: " . $y . $laterData['icon'] . "<br>";

                if ($beforeData['viewing_order'] != $laterData['viewing_order']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Ordem Visualização: " . $y . $laterData['viewing_order'] . "<br>";
            }
            //'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

            //bancos
            if ($submodulo_id == 10) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";
            }

            //departamentos
            if ($submodulo_id == 11) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";
            }

            //estados_civis
            if ($submodulo_id == 12) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";
            }

            //nacionalidades
            if ($submodulo_id == 13) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";

                if ($beforeData['nation'] != $laterData['nation']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "País: " . $y . $laterData['nation'] . "<br>";
            }

            //escolaridades
            if ($submodulo_id == 14) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";
            }

            //naturalidades
            if ($submodulo_id == 15) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";
            }

            //generos
            if ($submodulo_id == 16) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";
            }

            //funcoes
            if ($submodulo_id == 17) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";
            }

            //funcionarios
            if ($submodulo_id == 18) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";

                if ($beforeData['data_nascimento'] != $laterData['data_nascimento']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Data Nascimento: " . $y . $laterData['data_nascimento'] . "<br>";

                if ($beforeData['contratacao_tipo_id'] != $laterData['contratacao_tipo_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['contratacao_tipo_id'] != "") and ($laterData['contratacao_tipo_id'] != 0)) {
                    $search = ContratacaoTipo::where('id', $laterData['contratacao_tipo_id'])->get(['name']);
                    $dados .= $x . "Tipo Contratação: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['genero_id'] != $laterData['genero_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['genero_id'] != "") and ($laterData['genero_id'] != 0)) {
                    $search = Genero::where('id', $laterData['genero_id'])->get(['name']);
                    $dados .= $x . "Gênero: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['estado_civil_id'] != $laterData['estado_civil_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['estado_civil_id'] != "") and ($laterData['estado_civil_id'] != 0)) {
                    $search = EstadoCivil::where('id', $laterData['estado_civil_id'])->get(['name']);
                    $dados .= $x . "Estado Civil: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['escolaridade_id'] != $laterData['escolaridade_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['escolaridade_id'] != "") and ($laterData['escolaridade_id'] != 0)) {
                    $search = Escolaridade::where('id', $laterData['escolaridade_id'])->get(['name']);
                    $dados .= $x . "Escolaridade: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['nacionalidade_id'] != $laterData['nacionalidade_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['nacionalidade_id'] != "") and ($laterData['nacionalidade_id'] != 0)) {
                    $search = Nacionalidade::where('id', $laterData['nacionalidade_id'])->get(['name']);
                    $dados .= $x . "Nacionalidade: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['naturalidade_id'] != $laterData['naturalidade_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['naturalidade_id'] != "") and ($laterData['naturalidade_id'] != 0)) {
                    $search = Naturalidade::where('id', $laterData['naturalidade_id'])->get(['name']);
                    $dados .= $x . "Naturalidade: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['pai'] != $laterData['pai']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Pai: " . $y . $laterData['pai'] . "<br>";

                if ($beforeData['mae'] != $laterData['mae']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Mãe: " . $y . $laterData['mae'] . "<br>";

                if ($beforeData['banco_id'] != $laterData['banco_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['banco_id'] != "") and ($laterData['banco_id'] != 0)) {
                    $search = Banco::where('id', $laterData['banco_id'])->get(['name']);
                    $dados .= $x . "Banco: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['agencia'] != $laterData['agencia']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Agência: " . $y . $laterData['agencia'] . "<br>";

                if ($beforeData['conta'] != $laterData['conta']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Conta: " . $y . $laterData['conta'] . "<br>";

                if ($beforeData['email'] != $laterData['email']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "E-mail: " . $y . $laterData['email'] . "<br>";

                if ($beforeData['telephone_1'] != $laterData['telephone_1']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Telefone 1: " . $y . $laterData['telephone_1'] . "<br>";

                if ($beforeData['telephone_2'] != $laterData['telephone_2']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Telefone 2: " . $y . $laterData['telephone_2'] . "<br>";

                if ($beforeData['cellular_1'] != $laterData['cellular_1']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Celular 1: " . $y . $laterData['cellular_1'] . "<br>";

                if ($beforeData['cellular_2'] != $laterData['cellular_2']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Celular 2: " . $y . $laterData['cellular_2'] . "<br>";

                if ($beforeData['funcao_id'] != $laterData['funcao_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['funcao_id'] != "") and ($laterData['funcao_id'] != 0)) {
                    $search = Funcao::where('id', $laterData['funcao_id'])->get(['name']);
                    $dados .= $x . "Função: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['data_admissao'] != $laterData['data_admissao']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Data Admissão: " . $y . $laterData['data_admissao'] . "<br>";

                if ($beforeData['data_demissao'] != $laterData['data_demissao']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Data Demissão: " . $y . $laterData['data_demissao'] . "<br>";

                if ($beforeData['data_cadastro'] != $laterData['data_cadastro']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Data Cadastro: " . $y . $laterData['data_cadastro'] . "<br>";

                if ($beforeData['data_afastamento'] != $laterData['data_afastamento']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Data Afastamento: " . $y . $laterData['data_afastamento'] . "<br>";

                if ($beforeData['personal_identidade_orgao_id'] != $laterData['personal_identidade_orgao_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['personal_identidade_orgao_id'] != "") and ($laterData['personal_identidade_orgao_id'] != 0)) {
                    $search = IdentidadeOrgao::where('id', $laterData['personal_identidade_orgao_id'])->get(['name']);
                    $dados .= $x . "Identidade Pessoal (Órgão): " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['personal_identidade_estado_id'] != $laterData['personal_identidade_estado_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['personal_identidade_estado_id'] != "") and ($laterData['personal_identidade_estado_id'] != 0)) {
                    $search = Estado::where('id', $laterData['personal_identidade_estado_id'])->get(['name']);
                    $dados .= $x . "Identidade Pessoal (Estado): " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['personal_identidade_numero'] != $laterData['personal_identidade_numero']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Identidade Pessoal (Número): " . $y . $laterData['personal_identidade_numero'] . "<br>";

                if ($beforeData['personal_identidade_data_emissao'] != $laterData['personal_identidade_data_emissao']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Identidade Pessoal (Emissão): " . $y . $laterData['personal_identidade_data_emissao'] . "<br>";

                if ($beforeData['professional_identidade_orgao_id'] != $laterData['professional_identidade_orgao_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['professional_identidade_orgao_id'] != "") and ($laterData['professional_identidade_orgao_id'] != 0)) {
                    $search = IdentidadeOrgao::where('id', $laterData['professional_identidade_orgao_id'])->get(['name']);
                    $dados .= $x . "Identidade Profissional (Órgão): " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['professional_identidade_estado_id'] != $laterData['professional_identidade_estado_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['professional_identidade_estado_id'] != "") and ($laterData['professional_identidade_estado_id'] != 0)) {
                    $search = Estado::where('id', $laterData['professional_identidade_estado_id'])->get(['name']);
                    $dados .= $x . "Identidade Profissional (Estado): " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['professional_identidade_numero'] != $laterData['professional_identidade_numero']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Identidade Profissional (Número): " . $y . $laterData['professional_identidade_numero'] . "<br>";

                if ($beforeData['professional_identidade_data_emissao'] != $laterData['professional_identidade_data_emissao']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Identidade Profissional (Emissão): " . $y . $laterData['professional_identidade_data_emissao'] . "<br>";

                if ($beforeData['cpf'] != $laterData['cpf']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "CPF: " . $y . $laterData['cpf'] . "<br>";

                if ($beforeData['pis'] != $laterData['pis']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "PIS: " . $y . $laterData['pis'] . "<br>";

                if ($beforeData['pasep'] != $laterData['pasep']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "PASEP: " . $y . $laterData['pasep'] . "<br>";

                if ($beforeData['carteira_trabalho'] != $laterData['carteira_trabalho']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Carteira Trabalho: " . $y . $laterData['carteira_trabalho'] . "<br>";

                if ($beforeData['cep'] != $laterData['cep']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "CEP: " . $y . $laterData['cep'] . "<br>";

                if ($beforeData['numero'] != $laterData['numero']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Número: " . $y . $laterData['numero'] . "<br>";

                if ($beforeData['complemento'] != $laterData['complemento']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Complemento: " . $y . $laterData['complemento'] . "<br>";

                if ($beforeData['logradouro'] != $laterData['logradouro']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Logradouro: " . $y . $laterData['logradouro'] . "<br>";

                if ($beforeData['bairro'] != $laterData['bairro']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Bairro: " . $y . $laterData['bairro'] . "<br>";

                if ($beforeData['localidade'] != $laterData['localidade']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Localidade: " . $y . $laterData['localidade'] . "<br>";

                if ($beforeData['uf'] != $laterData['uf']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "UF: " . $y . $laterData['uf'] . "<br>";
            }

            //identidade_orgaos
            if ($submodulo_id == 19) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";

                if ($beforeData['sigla'] != $laterData['sigla']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Sigla: " . $y . $laterData['sigla'] . "<br>";
            }

            //clientes
            if ($submodulo_id == 20) {
                if ($beforeData['principal_cliente_id'] != $laterData['principal_cliente_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['principal_cliente_id'] != "") and ($laterData['principal_cliente_id'] != 0)) {
                    $search = Cliente::where('id', $laterData['principal_cliente_id'])->get(['name']);
                    $dados .= $x . "Cliente Principal: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['responsavel_funcionario_id'] != $laterData['responsavel_funcionario_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['responsavel_funcionario_id'] != "") and ($laterData['responsavel_funcionario_id'] != 0)) {
                    $search = Funcionario::where('id', $laterData['responsavel_funcionario_id'])->get(['name']);
                    $dados .= $x . "Responsável: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['status'] != $laterData['status']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Status: " . $y . $laterData['status'] . "<br>";

                if ($beforeData['tipo'] != $laterData['tipo']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Tipo: " . $y . $laterData['tipo'] . "<br>";

                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";

                if ($beforeData['nome_fantasia'] != $laterData['nome_fantasia']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome Fantasia: " . $y . $laterData['nome_fantasia'] . "<br>";

                if ($beforeData['inscricao_estadual'] != $laterData['inscricao_estadual']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Inscrição Estadual: " . $y . $laterData['inscricao_estadual'] . "<br>";

                if ($beforeData['inscricao_municipal'] != $laterData['inscricao_municipal']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Inscrição Municipal: " . $y . $laterData['inscricao_municipal'] . "<br>";

                if ($beforeData['cpf'] != $laterData['cpf']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "CPF: " . $y . $laterData['cpf'] . "<br>";

                if ($beforeData['cnpj'] != $laterData['cnpj']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "CNPJ: " . $y . $laterData['cnpj'] . "<br>";

                if ($beforeData['identidade_orgao_id'] != $laterData['identidade_orgao_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['identidade_orgao_id'] != "") and ($laterData['identidade_orgao_id'] != 0)) {
                    $search = IdentidadeOrgao::where('id', $laterData['identidade_orgao_id'])->get(['name']);
                    $dados .= $x . "Identidade (Órgão): " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['identidade_estado_id'] != $laterData['identidade_estado_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['identidade_estado_id'] != "") and ($laterData['identidade_estado_id'] != 0)) {
                    $search = Estado::where('id', $laterData['identidade_estado_id'])->get(['name']);
                    $dados .= $x . "Identidade (Estado): " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['identidade_numero'] != $laterData['identidade_numero']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Identidade (Número): " . $y . $laterData['identidade_numero'] . "<br>";

                if ($beforeData['identidade_data_emissao'] != $laterData['identidade_data_emissao']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Identidade (Emissão): " . $y . $laterData['identidade_data_emissao'] . "<br>";

                if ($beforeData['genero_id'] != $laterData['genero_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['genero_id'] != "") and ($laterData['genero_id'] != 0)) {
                    $search = Genero::where('id', $laterData['genero_id'])->get(['name']);
                    $dados .= $x . "Gênero: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['data_nascimento'] != $laterData['data_nascimento']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Data Nascimento: " . $y . $laterData['data_nascimento'] . "<br>";

                if ($beforeData['cep'] != $laterData['cep']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "CEP: " . $y . $laterData['cep'] . "<br>";

                if ($beforeData['numero'] != $laterData['numero']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Número: " . $y . $laterData['numero'] . "<br>";

                if ($beforeData['complemento'] != $laterData['complemento']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Complemento: " . $y . $laterData['complemento'] . "<br>";

                if ($beforeData['logradouro'] != $laterData['logradouro']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Logradouro: " . $y . $laterData['logradouro'] . "<br>";

                if ($beforeData['bairro'] != $laterData['bairro']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Bairro: " . $y . $laterData['bairro'] . "<br>";

                if ($beforeData['localidade'] != $laterData['localidade']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Localidade: " . $y . $laterData['localidade'] . "<br>";

                if ($beforeData['uf'] != $laterData['uf']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "UF: " . $y . $laterData['uf'] . "<br>";

                if ($beforeData['cep_cobranca'] != $laterData['cep_cobranca']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "CEP Cobrança: " . $y . $laterData['cep_cobranca'] . "<br>";

                if ($beforeData['numero_cobranca'] != $laterData['numero_cobranca']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Número Cobrança: " . $y . $laterData['numero_cobranca'] . "<br>";

                if ($beforeData['complemento_cobranca'] != $laterData['complemento_cobranca']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Complemento Cobrança: " . $y . $laterData['complemento_cobranca'] . "<br>";

                if ($beforeData['logradouro_cobranca'] != $laterData['logradouro_cobranca']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Logradouro Cobrança: " . $y . $laterData['logradouro_cobranca'] . "<br>";

                if ($beforeData['bairro_cobranca'] != $laterData['bairro_cobranca']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Bairro Cobrança: " . $y . $laterData['bairro_cobranca'] . "<br>";

                if ($beforeData['localidade_cobranca'] != $laterData['localidade_cobranca']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Localidade Cobrança: " . $y . $laterData['localidade_cobranca'] . "<br>";

                if ($beforeData['uf_cobranca'] != $laterData['uf_cobranca']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "UF Cobrança: " . $y . $laterData['uf_cobranca'] . "<br>";

                if ($beforeData['banco_id'] != $laterData['banco_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['banco_id'] != "") and ($laterData['banco_id'] != 0)) {
                    $search = Banco::where('id', $laterData['banco_id'])->get(['name']);
                    $dados .= $x . "Banco: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['agencia'] != $laterData['agencia']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Agência: " . $y . $laterData['agencia'] . "<br>";

                if ($beforeData['conta'] != $laterData['conta']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Conta: " . $y . $laterData['conta'] . "<br>";

                if ($beforeData['email'] != $laterData['email']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "E-mail: " . $y . $laterData['email'] . "<br>";

                if ($beforeData['site'] != $laterData['site']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Site: " . $y . $laterData['site'] . "<br>";

                if ($beforeData['telefone_1'] != $laterData['telefone_1']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Telefone 1: " . $y . $laterData['telefone_1'] . "<br>";

                if ($beforeData['telefone_2'] != $laterData['telefone_2']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Telefone 2: " . $y . $laterData['telefone_2'] . "<br>";

                if ($beforeData['celular_1'] != $laterData['celular_1']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Celular 1: " . $y . $laterData['celular_1'] . "<br>";

                if ($beforeData['celular_2'] != $laterData['celular_2']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Celular 2: " . $y . $laterData['celular_2'] . "<br>";
            }

            //fornecedores
            if ($submodulo_id == 23) {
                if ($beforeData['status'] != $laterData['status']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Status: " . $y . $laterData['status'] . "<br>";

                if ($beforeData['tipo'] != $laterData['tipo']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Tipo: " . $y . $laterData['tipo'] . "<br>";

                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";

                if ($beforeData['nome_fantasia'] != $laterData['nome_fantasia']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome Fantasia: " . $y . $laterData['nome_fantasia'] . "<br>";

                if ($beforeData['inscricao_estadual'] != $laterData['inscricao_estadual']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Inscrição Estadual: " . $y . $laterData['inscricao_estadual'] . "<br>";

                if ($beforeData['inscricao_municipal'] != $laterData['inscricao_municipal']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Inscrição Municipal: " . $y . $laterData['inscricao_municipal'] . "<br>";

                if ($beforeData['cpf'] != $laterData['cpf']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "CPF: " . $y . $laterData['cpf'] . "<br>";

                if ($beforeData['cnpj'] != $laterData['cnpj']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "CNPJ: " . $y . $laterData['cnpj'] . "<br>";

                if ($beforeData['identidade_orgao_id'] != $laterData['identidade_orgao_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['identidade_orgao_id'] != "") and ($laterData['identidade_orgao_id'] != 0)) {
                    $search = IdentidadeOrgao::where('id', $laterData['identidade_orgao_id'])->get(['name']);
                    $dados .= $x . "Identidade (Órgão): " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['identidade_estado_id'] != $laterData['identidade_estado_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['identidade_estado_id'] != "") and ($laterData['identidade_estado_id'] != 0)) {
                    $search = Estado::where('id', $laterData['identidade_estado_id'])->get(['name']);
                    $dados .= $x . "Identidade (Estado): " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['identidade_numero'] != $laterData['identidade_numero']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Identidade (Número): " . $y . $laterData['identidade_numero'] . "<br>";

                if ($beforeData['identidade_data_emissao'] != $laterData['identidade_data_emissao']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Identidade (Emissão): " . $y . $laterData['identidade_data_emissao'] . "<br>";

                if ($beforeData['genero_id'] != $laterData['genero_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['genero_id'] != "") and ($laterData['genero_id'] != 0)) {
                    $search = Genero::where('id', $laterData['genero_id'])->get(['name']);
                    $dados .= $x . "Gênero: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['data_nascimento'] != $laterData['data_nascimento']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Data Nascimento: " . $y . $laterData['data_nascimento'] . "<br>";

                if ($beforeData['cep'] != $laterData['cep']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "CEP: " . $y . $laterData['cep'] . "<br>";

                if ($beforeData['numero'] != $laterData['numero']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Número: " . $y . $laterData['numero'] . "<br>";

                if ($beforeData['complemento'] != $laterData['complemento']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Complemento: " . $y . $laterData['complemento'] . "<br>";

                if ($beforeData['logradouro'] != $laterData['logradouro']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Logradouro: " . $y . $laterData['logradouro'] . "<br>";

                if ($beforeData['bairro'] != $laterData['bairro']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Bairro: " . $y . $laterData['bairro'] . "<br>";

                if ($beforeData['localidade'] != $laterData['localidade']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Localidade: " . $y . $laterData['localidade'] . "<br>";

                if ($beforeData['uf'] != $laterData['uf']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "UF: " . $y . $laterData['uf'] . "<br>";

                if ($beforeData['cep_cobranca'] != $laterData['cep_cobranca']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "CEP Cobrança: " . $y . $laterData['cep_cobranca'] . "<br>";

                if ($beforeData['numero_cobranca'] != $laterData['numero_cobranca']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Número Cobrança: " . $y . $laterData['numero_cobranca'] . "<br>";

                if ($beforeData['complemento_cobranca'] != $laterData['complemento_cobranca']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Complemento Cobrança: " . $y . $laterData['complemento_cobranca'] . "<br>";

                if ($beforeData['logradouro_cobranca'] != $laterData['logradouro_cobranca']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Logradouro Cobrança: " . $y . $laterData['logradouro_cobranca'] . "<br>";

                if ($beforeData['bairro_cobranca'] != $laterData['bairro_cobranca']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Bairro Cobrança: " . $y . $laterData['bairro_cobranca'] . "<br>";

                if ($beforeData['localidade_cobranca'] != $laterData['localidade_cobranca']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Localidade Cobrança: " . $y . $laterData['localidade_cobranca'] . "<br>";

                if ($beforeData['uf_cobranca'] != $laterData['uf_cobranca']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "UF Cobrança: " . $y . $laterData['uf_cobranca'] . "<br>";

                if ($beforeData['banco_id'] != $laterData['banco_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['banco_id'] != "") and ($laterData['banco_id'] != 0)) {
                    $search = Banco::where('id', $laterData['banco_id'])->get(['name']);
                    $dados .= $x . "Banco: " . $y . $search[0]['name'] . "<br>";
                }

                if ($beforeData['agencia'] != $laterData['agencia']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Agência: " . $y . $laterData['agencia'] . "<br>";

                if ($beforeData['conta'] != $laterData['conta']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Conta: " . $y . $laterData['conta'] . "<br>";

                if ($beforeData['email'] != $laterData['email']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "E-mail: " . $y . $laterData['email'] . "<br>";

                if ($beforeData['site'] != $laterData['site']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Site: " . $y . $laterData['site'] . "<br>";

                if ($beforeData['telefone_1'] != $laterData['telefone_1']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Telefone 1: " . $y . $laterData['telefone_1'] . "<br>";

                if ($beforeData['telefone_2'] != $laterData['telefone_2']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Telefone 2: " . $y . $laterData['telefone_2'] . "<br>";

                if ($beforeData['celular_1'] != $laterData['celular_1']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Celular 1: " . $y . $laterData['celular_1'] . "<br>";

                if ($beforeData['celular_2'] != $laterData['celular_2']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Celular 2: " . $y . $laterData['celular_2'] . "<br>";
            }

            //Serviço Tipos
            if ($submodulo_id == 24) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";
            }

            //Serviços
            if ($submodulo_id == 25) {
                if ($beforeData['name'] != $laterData['name']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                $dados .= $x . "Nome: " . $y . $laterData['name'] . "<br>";

                if ($beforeData['servico_tipo_id'] != $laterData['servico_tipo_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['servico_tipo_id'] != "") and ($laterData['servico_tipo_id'] != 0)) {
                    $search = ServicoTipo::where('id', $laterData['servico_tipo_id'])->get(['name']);
                    $dados .= $x . "Serviço Tipo: " . $y . $search[0]['name'] . "<br>";
                }
            }

            //Propostas
            if ($submodulo_id == 26) {
                if ($beforeData['cliente_id'] != $laterData['cliente_id']) {
                    $x = "<font class='text-danger'>";
                    $y = "</font>";
                } else {
                    $x = "";
                    $y = "";
                }
                if (($laterData['cliente_id'] != "") and ($laterData['cliente_id'] != 0)) {
                    $search = Cliente::where('id', $laterData['cliente_id'])->get(['name']);
                    $dados .= $x . "Cliente: " . $y . $search[0]['name'] . "<br>";
                }
            }

            //gravar transacao'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
            if ($dados != '') {
                $trasaction = Array();
                $trasaction['date'] = date('Y-m-d');
                $trasaction['time'] = date('H:i:s');
                $trasaction['user_id'] = Auth::user()->id;
                $trasaction['operacao_id'] = $operacao;
                $trasaction['submodulo_id'] = $submodulo_id;
                $trasaction['dados'] = $dados;

                Transacao::create($trasaction);
            }
            //'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
        }

        return true;
    }
}
