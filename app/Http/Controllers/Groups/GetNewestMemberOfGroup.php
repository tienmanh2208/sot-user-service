<?php

namespace App\Http\Controllers\Groups;

use App\Models\UserGroup;
use App\Services\LogService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GetNewestMemberOfGroup extends Controller
{
    protected $userGroup;
    protected $logService;

    public function __construct(UserGroup $userGroup, LogService $logService)
    {
        $this->userGroup = $userGroup;
        $this->logService = $logService;
    }

    public function main(Request $request)
    {
        try {
            if (!$this->userGroup->doesMemberBelongToGroup(Auth::id(), $request->group_id)) {
                return response()->json([
                    'code' => 403,
                    'message' => trans('server_response.request_forbidden'),
                ], 200);
            }

            return response()->json([
                'code' => 200,
                'data' => $this->userGroup->getNewestMemberOfGroup($request->group_id)
            ], 200);
        } catch (\Exception $e) {
            $this->logService->writeLogException('Get newest members of group', $e);

            return response()->json([
                'code' => 400,
                'message' => trans('server_response.server_error'),
            ]);
        }
    }
}
