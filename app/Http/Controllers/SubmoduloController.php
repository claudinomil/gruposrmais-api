<?php

namespace App\Http\Controllers;

use App\API\ApiReturn;
use App\Models\Submodulo;

class SubmoduloController extends Controller
{
    private $submodulo;

    public function __construct(Submodulo $submodulo)
    {
        $this->submodulo = $submodulo;
    }

    public function research($fieldSearch, $fieldValue, $fieldReturn, $empresa_id)
    {
        $registros = $this->submodulo->where($fieldSearch, 'like', '%' . $fieldValue . '%')->get($fieldReturn);

        return response()->json(ApiReturn::data('', 2000, '', $registros), 200);
    }
}
