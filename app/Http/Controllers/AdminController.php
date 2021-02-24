<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    //
    public function index(){
        if(Auth::guard('admin')->check()) {
            return redirect()->to('/admin/dashboard');
        }
        else{
            return view('Admin.login');
        }
    }

    public function register(){
        return view('Admin.register');
    }
    public function store(){
        $this->validate(\request(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|unique:admins,email',
            'address'=>'required',
            'username'=>'required|unique:admins,username',
            'password'=>'required'
        ]);
        $input=\request()->all();

        if(\request()->hasFile('image')){
            $image = \request()->file('image');
            $new_name = Str::random(8) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/adm/assets/images'), $new_name);


        }

        DB::table('admins')->insert([
            'firstname'=>$input['first_name'],
            'lastname'=>$input['last_name'],
            'email'=>$input['email'],
            'address'=>$input['address'],
            'username'=>$input['username'],
            'cellnum'=>$input['cellnum'],
            'password'=>bcrypt($input['password']),
            'imageURL'=>$new_name
        ]);
        Auth::guard('admin')->attempt(\request(['username', 'password']));

        return redirect()->to('/admin');

    }

    public function login(){
        $this->validate(\request(),[
            'username'=>'required',
            'password'=>'required'
        ]);
        $input = \request()->all();
        try{
            $fieldType = filter_var(\request()->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if(Auth::guard('admin')->attempt(array($fieldType => $input['username'], 'password'=>$input['password']))){
                return redirect()->to('/admin/dashboard');
            }
            else{
                return redirect()->to('/admin/');
            }
        }
        catch(\Throwable $e){
            return abort(404, '701');
        }
    }
}
