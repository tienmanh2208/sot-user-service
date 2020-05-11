<?php

namespace App\Http\Controllers\Groups;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Group;
use App\Models\UserGroup;

class JoinGroupByInvitedKeyController extends Controller
{
    protected $group;
    protected $userGroup;

    public function __construct(Group $group, UserGroup $userGroup)
    {
        $this->group = $group;
        $this->userGroup = $userGroup;
    }

    public function main(Request $request)
    {
        try {
            $params = $this->getParams($request);
        
            $validation = Validator::make($params, $this->rules());

            if ($validation->fails()) {
                return response()->json([
                    'code' => 400,
                    'message' => $validation->errors()->first(),
                ], 200);
            }

            DB::beginTransaction();
            $responseData = $this->joinGroup($params['invited_key']);
            DB::commit();
            return response()->json($responseData, 200);
        } catch (Exception $e) {
            DB::rollBack();
            
            Log::info('=======================Create user=========================');
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

    /**
     * Get params from request
     */
    public function getParams(Request $request)
    {
        return $request->only(['invited_key']);
    }

    /**
     * Rules for validation
     */
    public function rules()
    {
        return [
            'invited_key' => 'required|string',
        ];
    }

    /**
     * Join group by invited key
     */
    public function joinGroup(string $invitedKey)
    {
        $groupInfo = $this->group->getGroupByInvitedKey($invitedKey);

        if (is_null($groupInfo)) {
            return [
                'code' => 400,
                'message' => trans('server_response.group_not_found_by_invited_key'),
            ];
        }

        $this->userGroup->joinGroupByInvitedKey($invitedKey, $groupInfo->id);

        return [
            'code' => 203,
            'message' => trans('server_response.join_group_successfully'),
        ];
    }
}
