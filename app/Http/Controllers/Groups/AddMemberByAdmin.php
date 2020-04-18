<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;

class AddMemberByAdmin extends Controller
{
    protected $userGroup;
    protected $user;

    public function __construct(UserGroup $userGroup, User $user)
    {
        $this->userGroup = $userGroup;
        $this->user = $user;
    }

    public function main(Request $request)
    {
        try {
            if (!$this->user->checkExistenceOfUserById($request->member_id)) {
                return response()->json([
                    'code' => 400,
                    'message' => trans('server_response.user_not_found'),
                ]);
            }

            $this->userGroup->addMemberToGroup($request->group_id, $request->member_id);

            return response()->json([
                'data' => 200,
                'message' => trans('server_response.add_user_successfully')
            ]);
        } catch (\Exception $e) {
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
}
