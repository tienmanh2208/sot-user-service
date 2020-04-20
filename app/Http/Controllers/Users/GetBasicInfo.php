<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GetBasicInfo extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function main()
    {
        $additionalInfo = Auth::user()->additionalInfo;
        $basicInfo['full_name'] = Auth::user()->last_name . " " . Auth::user()->first_name;
        $basicInfo['coin_remain'] = 'coin_remain';
        $basicInfo['total_answers'] = $additionalInfo->total_answers;
        $basicInfo['total_questions'] = $additionalInfo->total_questions;

        return response()->json([
            'code' => 200,
            'data' => $basicInfo
        ], 200);
    }
}
