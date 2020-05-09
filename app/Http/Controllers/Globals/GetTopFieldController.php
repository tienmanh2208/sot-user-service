<?php

namespace App\Http\Controllers\Globals;

use App\Http\Controllers\Controller;
use App\Models\Field;

class GetTopFieldController extends Controller
{
    protected $field;

    public function __construct(Field $field)
    {
        $this->field = $field;
    }

    public function main()
    {
        return response()->json([
            'code' => 200,
            'data' => $this->getTopFields()
        ], 200);
    }

    public function getTopFields()
    {
        return $this->field->getTopField();
    }
}
