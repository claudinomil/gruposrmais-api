<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Http\Requests\VisitaTecnicaStoreRequest;
use App\Http\Requests\VisitaTecnicaUpdateRequest;
use App\Models\EdificacaoClassificacao;
use App\Models\IncendioRiscos;
use App\Models\SegurancaMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VisitaTecnica;
use App\Models\Cliente;
use phpseclib3\Math\PrimeField\Integer;

class VisitaTecnicaController extends Controller
{
    private $visita_tecnica;

    public function __construct(VisitaTecnica $visita_tecnica)
    {
        $this->visita_tecnica = $visita_tecnica;
    }

    public function index()
    {
        $registros = DB::table('visitas_tecnicas')
            ->leftJoin('clientes', 'visitas_tecnicas.cliente_id', '=', 'clientes.id')
            ->leftJoin('users', 'visitas_tecnicas.user_id', '=', 'users.id')
            ->select(['visitas_tecnicas.*', 'clientes.name as clienteName', 'users.name as userName'])
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function show($id)
    {
        try {
            $registro = $this->visita_tecnica->find($id);

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

            //Clientes
            $registros['clientes'] = Cliente::all();

            //Edificacao Classificacoes
            $registros['edificacao_classificacoes'] = EdificacaoClassificacao::all();

            //Incêndio Riscos
            $registros['incendio_riscos'] = IncendioRiscos::all();

            //Segurança Medidas
            $registros['seguranca_medidas'] = SegurancaMedida::all();

            return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registros), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function store(VisitaTecnicaStoreRequest $request)
    {
        try {
            //Incluindo registro
            $this->visita_tecnica->create($request->all());

            return response()->json(ApiReturn::data('Registro criado com sucesso.', 2010, null, null), 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }

    public function update(VisitaTecnicaUpdateRequest $request, $id)
    {
        try {
            $registro = $this->visita_tecnica->find($id);

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

    public function extraData($id)
    {
        try {
            $registro = array();

            //VisitaTecnica
            $visita_tecnica = DB::table('visitas_tecnicas')
                ->leftJoin('clientes', 'visitas_tecnicas.cliente_id', '=', 'clientes.id')
                ->leftJoin('users', 'visitas_tecnicas.user_id', '=', 'users.id')
                ->select(['visitas_tecnicas.*', 'clientes.name as clienteName', 'users.name as userName'])
                ->where('visitas_tecnicas.id', '=', $id)
                ->get();

            $registro['visita_tecnica'] = $visita_tecnica[0];

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

    public function destroy($id)
    {
        try {
            $registro = $this->visita_tecnica->find($id);

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
        $registros = DB::table('visitas_tecnicas')
            ->leftJoin('clientes', 'visitas_tecnicas.cliente_id', '=', 'clientes.id')
            ->leftJoin('users', 'visitas_tecnicas.user_id', '=', 'users.id')
            ->select(['visitas_tecnicas.*', 'clientes.name as clienteName', 'users.name as userName'])
            ->where($field, 'like', '%' . $value . '%')
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, null, $registros), 200);
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn)
    {
        $registros = DB::table('visitas_tecnicas')
            ->leftJoin('clientes', 'visitas_tecnicas.cliente_id', '=', 'clientes.id')
            ->leftJoin('users', 'visitas_tecnicas.user_id', '=', 'users.id')
            ->select(['visitas_tecnicas.*', 'clientes.name as clienteName', 'users.name as userName'])
            ->where($fieldSearch, 'like', '%' . $fieldValue . '%')
            ->get($fieldReturn);

        return response()->json(ApiReturn::data('', 2000, null, $registros), 200);
    }

    public function medidas_seguranca(int $np, $atc, string $grupo, string $divisao)
    {
        try {
            //Acerto variaves
            $atc = str_replace('.', '', $atc);
            $atc = str_replace('.', '', $atc);
            $atc = str_replace('.', '', $atc);
            $atc = str_replace(',', '.', $atc);

            //Regras para retornar Medidas de Segurança (DECRETO Nº 42, DE 17 DE DEZEMBRO DE 2018)''''''''''''''''''''''

            //Tabela 2 – Exigências para edificações com área menor ou igual a 900m² e até 02 pavimentos.
            if ($np <= 2 and $atc <= 900) {
                //3     Extintores
                //20    Sinalização de segurança
                //16    Iluminação de Emergência
                //18    Saídas de Emergência
                //17    Plano de emergência
                //10    Controle de Materiais de Acabamento
                //9     Controle de fumaça

                if ($grupo == 'A' or $grupo == 'D' or $grupo == 'E' or $grupo == 'G') {
                    if ($divisao == 'A-1' or $divisao == 'A-4') {$seguranca_medidas_ids = [3, 20, 18];}
                    if ($divisao == 'A-2' or $divisao == 'A-3' or $divisao == 'A-5' or $divisao == 'A-6') {$seguranca_medidas_ids = [3, 20, 16, 18];}
                }
                if ($grupo == 'B') {
                    $seguranca_medidas_ids = [3, 20, 16, 18, 10];
                }
                if ($grupo == 'C') {
                    $seguranca_medidas_ids = [3, 20, 16, 18];
                }
                if ($grupo == 'F') {
                    if ($divisao == 'F-1' or $divisao == 'F-2' or $divisao == 'F-3' or $divisao == 'F-4' or $divisao == 'F-7' or $divisao == 'F-8' or $divisao == 'F-10' or $divisao == 'F-11') {$seguranca_medidas_ids = [3, 20, 16, 18, 10];}
                    if ($divisao == 'F-5' or $divisao == 'F-11') {$seguranca_medidas_ids = [3, 20, 16, 18, 10];}
                    if ($divisao == 'F-6') {$seguranca_medidas_ids = [3, 20, 16, 18, 17, 10, 9];}
                    if ($divisao == 'F-9') {$seguranca_medidas_ids = [3, 20, 16, 18];}
                }
                if ($grupo == 'H') {
                    if ($divisao == 'H-1') {$seguranca_medidas_ids = [3, 20, 18];}
                    if ($divisao == 'H-2' or $divisao == 'H-3') {$seguranca_medidas_ids = [3, 20, 16, 18, 17, 10];}
                    if ($divisao == 'H-4') {$seguranca_medidas_ids = [0];}
                }
                if ($grupo == 'I') {
                    if ($divisao == 'I-1' or $divisao == 'I-2' or $divisao == 'I-3') {$seguranca_medidas_ids = [3, 20, 16, 18];}
                }
                if ($grupo == 'J') {
                    if ($divisao == 'J-1' or $divisao == 'J-2' or $divisao == 'J-3' or $divisao == 'J-4') {$seguranca_medidas_ids = [3, 20, 16, 18];}
                }
                if ($grupo == 'L') {
                    if ($divisao == 'L-1' or $divisao == 'L-2' or $divisao == 'L-3') {$seguranca_medidas_ids = [3, 20, 18, 10];}
                }
                if ($grupo == 'M') {
                    if ($divisao == 'M-1' or $divisao == 'M-2' or $divisao == 'M-3' or $divisao == 'M-4' or $divisao == 'M-5' or $divisao == 'M-6' or $divisao == 'M-7' or $divisao == 'M-8' or $divisao == 'M-9') {$seguranca_medidas_ids = [3, 20, 16, 18];}
                }
            }
            //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

            $registros = array();

            $registros['medidas_seguranca'] = DB::table('seguranca_medidas')->whereIn('id', $seguranca_medidas_ids)->get();

            return response()->json(ApiReturn::data('Registro enviado com sucesso.', 2000, null, $registros), 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiReturn::data($e->getMessage(), 5000, null, null), 500);
            }

            return response()->json(ApiReturn::data('Houve um erro ao realizar a operação.', 5000, null, null), 500);
        }
    }
}
