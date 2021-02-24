<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" href="{{asset('ldp/dist/images/logo.png')}}" type="image/icon type">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('authAsset/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('authAsset/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('authAsset/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('authAsset/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('authAsset/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('authAsset/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('authAsset/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('authAsset/css/main.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" rel="stylesheet">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('{{asset('authAsset/images/img-01.jpg')}}');">
        <div class="wrap-login100 p-t-190 p-b-30">
            @yield('formSection')
        </div>
    </div>
</div>




<!--===============================================================================================-->
<script src="{{asset('authAsset/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('authAsset/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('authAsset/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('authAsset/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('authAsset/js/main.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function PasswordChange(){
        Swal.fire({
            icon: 'info',
            title: 'No Access',
            text: 'Please Contant The Admin!',
            footer: '<span>Only Super Admin have the right to change your password </span>'
        })
    }



    function CreateAccount(){
        Swal.fire({
            icon: 'info',
            title: 'No Access',
            text: 'Ask Admin for a New Account!',
            footer: '<span>Only Super Admin have the right to Create an account </span>'
        })
    }


</script>


<script type="text/javascript">
    $("#file-upload").change(function(){
        document.getElementById('notifierSpan').style.display = 'block';
        document.getElementById('alertSpan').style.display = 'none';
    });
</script>

<script>
    function sendResetLink(){
        var email=document.getElementById("email").value;
        console.log(email);
        Swal.fire({
            title: 'Processing...',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        });

        $.ajax({
            type : 'get',
            url : '{{URL::to('resetPassword')}}',
            data:{
                'email':email
            },
            success:function(data){
                Swal.fire({
                    icon: 'info',
                    title: 'Password Change Requested',
                    text: data.msg,
                })
            }
        });

    }
</script>

</body>
</html>
