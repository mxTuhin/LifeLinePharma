@extends('layouts.LoginLayout')
@section('title')
    Admin Password Change
@endsection
@section('formSection')
    <form method="POST" action="{{route('changePassword')}}" class="login100-form validate-form">
        @csrf
        <div align="center" class="login100-form-avatar">
            <img src="../authAsset/images/user.png" alt="AVATAR">
        </div>

        <span class="login100-form-title p-t-20 p-b-45">
						Hello Dear<br><small style="font-size: 14px">Type Old and New Password</small>
					</span>
        <input name="email" value="{{$req->email}}" hidden>
        <input name="hash"  value="{{$req->hash}}" hidden>

        <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
            <input class="input100" type="password" name="oldPass" placeholder="Type Old Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
        </div>

        <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
            <input class="input100" type="password" name="newPassOne" placeholder="Type New Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
        </div>

        <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
            <input class="input100" type="password" name="newPassTwo" placeholder="Type New Password Again">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
        </div>

        <div class="container-login100-form-btn p-t-10">
            <input type="submit" value="Reset" class="login100-form-btn">


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
