<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdditionalInfo;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function main(Request $request)
    {
        try {
            $params = $this->getParams($request);
            $validator = $this->validator($params);

            if ($validator->fails()) {
                return [
                    'code' => 400,
                    'message' => $validator->errors()->first(),
                ];
            }

            $checkExistence = User::checkExistenceOfUser($params['mail'], $params['username']);

            if (!$checkExistence['status']) {
                return [
                    'code' => 400,
                    'message' => $checkExistence['message'],
                ];
            }

            DB::beginTransaction();
            $userInfo = $this->create($params);
            $this->createAdditionalInfo(['user_id' => $userInfo->user_id]);
            DB::commit();

            return response()->json([
                'code' => 201,
                'message' => trans('auth.user_created_successfully')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::info('=======================Create user=========================');
            \Log::info('Error: ' . $e->getMessage());
            \Log::info('Line: ' . $e->getLine());
            \Log::info('File: ' . $e->getFile());
            \Log::info('===========================================================');

            return response()->json([
                'code' => 400,
                'message' => trans('server_response.server_error'),
            ], 200);
        }
    }

    protected function getParams(Request $request)
    {
        return $request->only([
            'username',
            'password',
            'first_name',
            'date_of_birth',
            'last_name',
            'mail',
            'password_confirmation'
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'string', 'max:255'],
            'mail' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'first_name' => $data['first_name'],
            'date_of_birth' => $data['date_of_birth'],
            'last_name' => $data['last_name'],
            'mail' => $data['mail'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function createAdditionalInfo(array $data)
    {
        return AdditionalInfo::create([]);
    }
}
