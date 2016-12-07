<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|min:3',
            'firstname' => 'max:255|min:3',
            'lastname' => 'max:255|min:3',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone_number' => 'numeric|regex:/(0)[0-9]{8}/',
            'birthday'=>'date_format:"Y-m-d"',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $avatarName = '';
        if(isset($data['avatar'])){
            $avatarName = $this->avatarUpload($data['avatar']);
         }
         if(empty($data['birthday'])){
             $data['birthday'] = null;
         }
        return User::create([
            'username' => $data['username'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone_number' => $data['phone_number'],
            'birthday' => $data['birthday'],
            'avatar' => $avatarName,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    private function avatarUpload($data)
    {
    	//dd($data->getClientOriginalExtension());
        $imageName = time().'.'.$data->getClientOriginalExtension();
        $data->move(public_path('avatar'), $imageName);
    	return $imageName;
    }
}
