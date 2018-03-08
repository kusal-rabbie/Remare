<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'mobilenumber' => 'required|size:10',
            'image' => 'nullable|url'
        ]);
    }

//    public function store(Request $request)
//    {
//        $input = $request->all();
//
//        $employee = $this->employeeRepository->create($input);
//
////        Flash::success('Employee saved successfully.');
//
//        return redirect(route('employees.index'));
//    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
//        echo $data;
//        $data['authentication'] = 'customer';
        dd($data);
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'authentication' => $data['authentication'],
            'image' => $data['image'],
            'mobilenumber' => $data['mobilenumber']
        ]);
//        $employee = $this->employeeRepository->create($data);
//
//        Flash::success('Employee saved successfully.');
//
//        return view("home");
    }
}
