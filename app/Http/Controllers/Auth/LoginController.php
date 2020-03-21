<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function main(Request $request)
    {
        $credentials = $this->getParams($request);

        $validation = Validator::make($credentials, $this->rules());

        if ($validation->fails()) {
            return [
                'code' => 400,
                'message' => $validation->errors()->first(),
            ];
        }

        if (!Auth::attempt($credentials)) {
            return [
                'code' => 403,
                'message' => trans('auth.have_no_permission')
            ];
        };

        return [
            'code' => 200,
            'data' => [
                'token' => Auth::user()->createToken('Personal access token')->accessToken,
                'user_id' => Auth::id(),
            ]
        ];
    }

    /**
     * Get credentials
     *
     * @param Request $request
     * @return array
     */
    protected function getParams(Request $request)
    {
        return $request->only(['email', 'password']);
    }

    /**
     * Define rules for validation
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ];
    }
}
