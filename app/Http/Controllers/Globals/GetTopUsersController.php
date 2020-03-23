<?php

namespace App\Http\Controllers\Globals;

use App\Http\Controllers\Controller;
use App\Models\User;

class GetTopUsersController extends Controller
{
    protected $user;

    /**
     * GetTopUsersController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get top users
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function main()
    {
        $topUsers = $this->user->getTopUsers();
        $responseData = [];

        foreach ($topUsers as $user) {
            $responseData[$user['id']] = $user['last_name'] . ' ' . $user['first_name'];
        }

        return response()->json([
            'code' => 200,
            'data' => $responseData
        ], 200);
    }
}
