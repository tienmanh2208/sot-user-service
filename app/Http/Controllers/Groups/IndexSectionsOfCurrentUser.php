<?php

namespace App\Http\Controllers\Groups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GroupSection;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Auth;

class IndexSectionsOfCurrentUser extends Controller
{
    protected $groupSection;
    protected $userGroup;

    public function __construct(
        UserGroup $userGroup,
        GroupSection $groupSection
    ) {
        $this->userGroup = $userGroup;
        $this->groupSection = $groupSection;
    }

    public function main(Request $request)
    {

        try {
            $checkPermission = $this->userGroup->doesMemberBelongToGroup(Auth::id(), (int) $request->group_id);

            if (!$checkPermission) {
                return response()->json([
                    'code' => 403,
                    'message' => trans('server_response.request_forbidden'),
                ], 200);
            }

            return response()->json([
                'code' => 200,
                'data' => $this->groupSection->getListSection((int) $request->group_id)
            ], 200);
        } catch (\Exception $e) {
            \Log::info('====================Get list sections======================');
            \Log::info('Error: ' . $e->getMessage());
            \Log::info('Line: ' . $e->getLine());
            \Log::info('File: ' . $e->getFile());
            \Log::info('===========================================================');

            return response()->json([
                'code' => 400,
                'message' => trans('server_response.server_error'),
            ], 200);
        }
    }
}
