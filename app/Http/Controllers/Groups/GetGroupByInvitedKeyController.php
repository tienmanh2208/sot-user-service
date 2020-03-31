<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetGroupByInvitedKeyController extends Controller
{
    protected $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * Get group by invited key
     */
    public function main(Request $request)
    {
        $params = $this->getParams($request);

        if (count($params) == 0) {
            return response()->json([
                'code' => 400,
                'message' => trans('server_response.invited_key_is_missing')
            ]);
        }

        $groupInfo = $this->group->getGroupByInvitedKey($params['invitedKey']);

        if(is_null($groupInfo)) {
            return [
                'code' => 400,
                'message' => trans('server_response.group_not_found_by_invited_key'),
            ];
        }

        return response()->json($groupInfo->toArray(), 200);
    }

    /**
     * Get params from request
     * 
     * @return array [
     *  invitedKey => string
     * ]
     */
    public function getParams(Request $request)
    {
        return $request->only(['invitedKey']);
    }
}
