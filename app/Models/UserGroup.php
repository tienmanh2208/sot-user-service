<?php

namespace App\Models;

use App\Enums\UserGroupPermission;
use App\Enums\UserGroupRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserGroup extends Model
{
    protected $table = 'user_groups';

    protected $fillable = [
        'group_infos_id',
        'users_id',
        'role',
        'permission',
    ];

    /**
     * Join group vy invited key
     *
     * @param string $invitedKey
     * @param Group $groupId
     */
    public function joinGroupByInvitedKey(string $invitedKey, $groupId)
    {
        $this->firstOrCreate([
            'group_infos_id' => $groupId,
            'users_id' => Auth::id(),
            'role' => UserGroupRole::MEMBER,
            'permission' => UserGroupPermission::CAN_DO_ANYTHING,
        ]);
    }

    /**
     * Remove member from group
     * 
     * @param integer $memberId
     * @param integer $groupId
     */
    public function removeMember(int $memberId, int $groupId)
    {
        $this->where('group_infos_id', $groupId)
            ->where('users_id', $memberId)
            ->delete();
    }
}
