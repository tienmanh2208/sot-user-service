<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class CheckGroupCreator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $group = new Group();

        if (!$group->isCreator(Auth::id(), $request->group_id) || (int)$request->member_id === Auth::id()) {
            return response()->json([
                'code' => 403,
                'message' => trans('server_response.request_forbidden'),
            ], 200);
        };

        return $next($request);
    }
}
