<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AccountController extends Controller
{
    public function showusers(){

        $users =  User::get();

        return view('admin.users', compact($users));

    }

    public function showwaiters(){

        $waiters =  Waiter::get();

        return view('admin.users', compact($waiters));

    }

    public function viewuser(Request $request){

        return view('admin.user',compact(User::find($request['id'])->toArray()));
    }

    public function store(Request $request){
        if($request['password'] == $request['password_confirm']){

            $user = new User;

            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
            $user->authentication = $request['authentication'];
            $user->image = $request['image'];

            $user->save();

        }else{


        }
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $user->name = $request['name'];
        $user->mobilenumber = $request['mobilenumber'];
        $user->image = $request['image'];

        $user->save();
    }

    public function delete(Request $request){

        $user = User::find($request['id']);
        $user->deleted = '1';
    }

}
