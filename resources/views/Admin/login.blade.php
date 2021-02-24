@extends('layouts.LoginLayout')
@section('title')
    Admin Login
    @endsection
@section('formSection')
    <form method="POST" action="{{route('adminLogin')}}" class="login100-form validate-form">
        @csrf
        <div align="center" class="login100-form-avatar">
            <img src="{{asset('/authAsset/images/user.png')}}" alt="AV">
        </div>

        <span class="login100-form-title p-t-20 p-b-45">
						Hello Dear<br><small style="font-size: 14px">Type Username & Password to login</small>
					</span>

        <div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
            <input class="input100" type="text" name="username" placeholder="Username">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
        </div>
        @error('username')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
        </div>
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="container-login100-form-btn p-t-10">
            <input type="submit" value="Login" class="login100-form-btn">


        </div>

        <div class="text-center w-full p-t-25 p-b-230">
            <a href="{{route('resetPassView')}}" class="txt1">
                Forgot Username / Password?
            </a>
        </div>

        <div class="text-center w-full">
            <button onclick="CreateAccount()" class="txt1" href="#">
                Create new account
                <i class="fa fa-long-arrow-right"></i>
            </button>
        </div>
    </form>
    @endsection
