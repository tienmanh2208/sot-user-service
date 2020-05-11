<?php

namespace App\Http\Controllers\Groups;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class RefreshKeyController extends Controller
{
    protected $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    public function main(Request $request)
    {
        try {
            $newKey = $this->group->refreshKey($request->group_id);

            return response()->json([
                'code' => 203,
                'data' => $newKey,
            ], 200);
        } catch (\Exception $e) {
            Log::info('=======================Refresh key=========================');
            Log::info('Error: ' . $e->getMessage());
            Log::info('Line: ' . $e->getLine());
            Log::info('File: ' . $e->getFile());
            Log::info('===========================================================');

            return response()->json([
                'code' => 400,
                'message' => trans('server_response.server_error'),
            ]);
        }
    }
}
