<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Transacao;

class TransacaoController extends Controller
{
    private $transacao;

    public function __construct(Transacao $transacao)
    {
        $this->transacao = $transacao;
    }

    public function index()
    {
        $registros = DB::table('transacoes')
            ->join('users', 'transacoes.user_id', '=', 'users.id')
            ->join('operacoes', 'transacoes.operacao_id', '=', 'operacoes.id')
            ->join('submodulos', 'transacoes.submodulo_id', '=', 'submodulos.id')
            ->select(['transacoes.*', 'users.name as userName', 'operacoes.name as operacaoName', 'submodulos.name as submoduloName'])
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }

    public function search($field, $value)
    {
        $registros = DB::table('transacoes')
            ->join('users', 'transacoes.user_id', '=', 'users.id')
            ->join('operacoes', 'transacoes.operacao_id', '=', 'operacoes.id')
            ->join('submodulos', 'transacoes.submodulo_id', '=', 'submodulos.id')
            ->select(['transacoes.*', 'users.name as userName', 'operacoes.name as operacaoName', 'submodulos.name as submoduloName'])
            ->where($field, 'like', '%'.$value.'%')
            ->get();

        return response()->json(ApiReturn::data('Lista de dados enviada com sucesso.', 2000, '', $registros), 200);
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn)
    {
        $registros = $this->transacao->where($fieldSearch, 'like', '%' . $fieldValue . '%')->get($fieldReturn);

        return response()->json(ApiReturn::data('', 2000, '', $registros), 200);
    }
}
