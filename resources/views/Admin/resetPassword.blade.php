@extends('layouts.LoginLayout')
@section('title')
    Admin Password Change
@endsection
@section('formSection')
    <form class="login100-form validate-form">
        <div align="center" class="login100-form-avatar">
            <img src="../authAsset/images/user.png" alt="AVATAR">
        </div>

        <span class="login100-form-title p-t-20 p-b-45">
						Hello Dear<br><small style="font-size: 14px">Type Your Email</small>
					</span>

        <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
            <input class="input100" type="text" name="email" id="email" placeholder="Type Your Email">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
        </div>


        <div class="container-login100-form-btn p-t-10">
            <button onclick="sendResetLink()" type="button" class="login100-form-btn">Send Reset Link</button>


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
