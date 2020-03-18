<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'first_name',
        'date_of_birth',
        'last_name',
        'mail',
        'role',
        'account_status',
        'coin_remain'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check if an username exists or not
     *
     * @param string $userName
     * @return bool
     */
    public static function checkUserName(string $userName)
    {
        $info = self::where('username', $userName)->first();

        if (is_null($info)) {
            return false;
        }

        return true;
    }
}
