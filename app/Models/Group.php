<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Group extends Model
{
    protected $table = 'group_infos';

    protected $fillable = [
        'creator',
        'title',
        'default_coin',
        'privacy',
        'key'
    ];

    /**
     * @param array $params [
     *  'title' => string,
     *  'default_coin' => integer,
     *  'privacy' => integer
     * ]
     */
    public function createGroup(array $params)
    {
        $this->create([
            'creator' => Auth::id(),
            'title' => $params['title'],
            'default_coin' => (int) $params['default_coin'],
            'privacy' => (int) $params['privacy'],
            'key' => Auth::id() . round(microtime(true), 0)
        ]);
    }

    /**
     * Get group by invited key
     *
     * @param string $invitedKey
     */
    public function getGroupByInvitedKey(string $invitedKey)
    {
        return $this->where('key', $invitedKey)
            ->first();
    }

    /**
     * Check if an user is the creator of that group or not
     * 
     * @param integer $userId
     * @param integer $groupId
     * 
     * @return boolean
     */
    public function isCreator(int $userId, int $groupId)
    {
        $info = $this->where('creator', $userId)
            ->where('id', $groupId)
            ->first();

        if (is_null($info)) {
            return false;
        }

        return true;
    }
}
