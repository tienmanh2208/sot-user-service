<?php

namespace App\Http\Controllers\Groups;

use App\Models\UserGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Validator;

class DeleteMemberInGroupController extends Controller
{
    protected $userGroup;

    public function __construct(UserGroup $userGroup)
    {
        $this->userGroup = $userGroup;
    }

    public function main(Request $request)
    {
        try {
            $params = $this->getParams($request);

            $validation = Validator::make($params, $this->rules());

            if ($validation->fails()) {
                return [
                    'code' => 400,
                    'message' => $validation->errors()->first(),
                ];
            }

            if (!$this->removeMember($params['member_id'], $params['group_id'])) {
                return response()->json([
                    'code' => 400,
                    'message' => trans('server_response.can_not_delete_yourself'),
                ], 200);
            };

            return response()->json([
                'code' => 204,
                'message' => trans('server_response.delete_member_successfully'),
            ]);
        } catch (Exception $e) {
            \Log::info('=======================Create user=========================');
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

    /**
     * Get params from request
     */
    public function getParams(Request $request)
    {
        return $request->only(['group_id', 'member_id']);
    }

    /**
     * Rules for validation
     */
    public function rules()
    {
        return [
            'group_id' => 'required|integer',
            'member_id' => 'required|integer'
        ];
    }

    /**
     * Remove member from group
     */
    public function removeMember(int $memberId, int $groupId)
    {
        if ($memberId == $groupId) {
            return false;
        }

        $this->userGroup->removeMember($memberId, $groupId);

        return true;
    }
}
