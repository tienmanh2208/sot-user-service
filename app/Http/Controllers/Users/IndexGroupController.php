<?php

namespace App\Http\Controllers\Users;

use App\Models\UserGroup;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexGroupController extends Controller
{
    protected $userGroup;

    public function __construct(UserGroup $userGroup)
    {
        $this->userGroup = $userGroup;
    }

    /**
     * Get all group of current user
     */
    public function main()
    {
        return response()->json([
            'status' => 200,
            'code' => $this->userGroup->getAllGroupOfAnUser(Auth::id())
        ], 200);
    }
}
