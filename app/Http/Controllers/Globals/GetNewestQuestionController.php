<?php

namespace App\Http\Controllers\Globals;

use App\Http\Controllers\Controller;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class GetNewestQuestionController extends Controller
{
    protected $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    public function main(Request $request)
    {
        return response()->json($this->questionService->getNewestQuestion($request->field_id), 200);
    }
}
