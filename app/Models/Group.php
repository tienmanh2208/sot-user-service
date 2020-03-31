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
}
