@extends('layouts.LoginLayout')
@section('title')
    Admin Registration
@endsection
@section('formSection')

    <style>
        input[type="file"] {
            display: none;
        }
        #profile-img-tag{
            display:none;
        }
        .custom-file-upload {
            border: 1px solid #FFFFFF;
            display: inline-block;
            padding: 4px 12px;
            cursor: pointer;
            border-radius: 20% ;
        }
    </style>

    <form method="POST" action="{{route('createAdmin')}}" enctype="multipart/form-data" class="login100-form" >
        @csrf
        <div align="center" class="login100-form-avatar">
            <img src="{{asset('/authAsset/images/user.png')}}" alt="AVATAR">
        </div>

        <span class="login100-form-title p-t-20 p-b-45">
						Hello Dear<br><small style="font-size: 14px">Type Credentials below to register </small>
					</span>

        <div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
            <input class="input100" type="text" name="username" placeholder="Username (For Login)" required>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
        </div>
        @error('username')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="wrap-input100 validate-input m-b-10" data-validate = "Email is required">
            <input class="input100" type="text" name="email" placeholder="Email" required>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
        </div>
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="wrap-input100 validate-input m-b-10" data-validate = "Name is required">
            <input class="input100" type="text" name="first_name" placeholder="First Name" required>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-users"></i>
						</span>
        </div>

        <div class="wrap-input100 validate-input m-b-10" data-validate = "Name is required">
            <input class="input100" type="text" name="last_name" placeholder="Last Name" required>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-users"></i>
						</span>
        </div>

        <div class="wrap-input100 validate-input m-b-10" data-validate = "Address">
            <input class="input100" type="text" name="address" placeholder="Address" required>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-map-marker"></i>
						</span>
        </div>

        <div class="wrap-input100 validate-input m-b-10" data-validate = "cellnum">
            <input class="input100" type="text" name="cellnum" placeholder="Cell Number" required>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-phone"></i>
						</span>
        </div>

        <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
        </div>

        <div align="center" class="wrap-input100 validate-input m-b-10" data-validate = "Image Is Required">
            <label id="profile_image" for="file-upload" class="btn btn-info ">
                <i class="fas fa-cloud-upload-alt"></i>
                Select Image
            </label>
            <input name="image" id="file-upload" type="file">

            <div>
                <span id="alertSpan" style="color:white; font-size:12px">** You must upload a profile picture to proceed through the registration</span>
                <span id="notifierSpan" style="color:springgreen; font-size:12px; display:none; "><span style="color:#07e9f5; font-size:20px">✔</span> <br>Image Selected. Upload Now</span>

            </div>


        </div>

        <div class="container-login100-form-btn p-t-10">
            <input type="submit" value="Create Account" class="login100-form-btn">

        </div>

        <div class="text-center w-full p-t-25 p-b-230">
            <a href="{{route('login')}}" class="txt1">
                Have an account? Login Here
            </a>
        </div>


    </form>
@endsection
