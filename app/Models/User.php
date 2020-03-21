<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;

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
     * @param string $email
     * @param string $userName
     * @return array
     */
    public static function checkExistenceOfUser(string $email, string $userName)
    {
        if (self::checkEmail($email)) {
            return [
                'status' => false,
                'message' => trans('auth.email_exists')
            ];
        }

        if (self::checkUserName($userName)) {
            return [
                'status' => false,
                'message' => trans('auth.username_exists')
            ];
        }

        return [
            'status' => true,
        ];
    }

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

    public static function checkEmail(string $email)
    {
        $info = self::where('mail', $email)->first();

        if (is_null($info)) {
            return false;
        }

        return true;
    }
}