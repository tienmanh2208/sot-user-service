<?php

namespace App\Models;

use App\Enums\UserGroupRole;
use App\Enums\UserGroupPermission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

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
     * @param int $groupId
     */
    public function joinGroupByInvitedKey(string $invitedKey, int $groupId)
    {
        $this->firstOrCreate([
            'group_infos_id' => $groupId,
            'users_id' => Auth::id(),
            'role' => UserGroupRole::MEMBER,
            'permission' => UserGroupPermission::CAN_DO_ANYTHING,
        ]);
    }

    /**
     * Add member to group
     * 
     * @param integer $groupId
     * @param integer $userId
     */
    public function addMemberToGroup(int $groupId, int $userId)
    {
        $this->firstOrCreate([
            'group_infos_id' => $groupId,
            'users_id' => $userId,
            'role' => UserGroupRole::MEMBER,
            'permission' => UserGroupPermission::CAN_DO_ANYTHING,
        ]);
    }

    /**
     * Add user to their own group
     * 
     * @param integer $groupId
     */
    public function createUserGroupForAdmin(int $groupId)
    {
        $this->create([
            'group_infos_id' => $groupId,
            'users_id' => Auth::id(),
            'role' => UserGroupRole::ADMIN,
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

    public function getAllGroupOfAnUser(int $userId)
    {
        return $this->join('group_infos', 'user_groups.group_infos_id', '=', 'group_infos.id')
            ->where('users_id', $userId)
            ->select(
                'group_infos_id',
                'users_id',
                'role',
                'permission',
                'creator',
                'title',
                'privacy'
            )
            ->get()
            ->toArray();
    }

    /**
     * Check if user belongs to group or not
     * 
     * @param integer $userId
     * @param integer $groupId
     * 
     * @return boolean
     */
    public function doesMemberBelongToGroup(int $userId, int $groupId)
    {
        $userInfo = $this->where('group_infos_id', $groupId)
            ->where('users_id', $userId)
            ->first();

        if (is_null($userInfo)) {
            return false;
        }

        return true;
    }

    /**
     * Get list newest members of group
     * 
     * @param integer $groupId
     * @param integer $quantity
     */
    public function getNewestMemberOfGroup(int $groupId, int $quantity = 5)
    {
        return $this->join('users', 'user_groups.users_id', '=', 'users.id')
            ->where('group_infos_id', $groupId)
            ->orderBy('user_groups.created_at', 'DESC')
            ->selectRaw('concat(last_name, " ", first_name) as full_name, users.id as id')
            ->limit($quantity)
            ->get();
    }
}
