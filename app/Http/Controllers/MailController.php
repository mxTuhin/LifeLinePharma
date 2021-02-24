<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MailController extends Controller
{
    //
    public function resetPassword(Request $request){
        $hashData=bcrypt(Str::random(8));
        $user=DB::table('admins')->where('email','=',$request->email)->first();
        $response['status']=true;
        if($user!=null) {
            $admin=Admin::find($user->id);
            $admin->remember_token = $hashData;
            $admin->save();
            $response['status']=true;
            $response['msg']="Please Check Your Mail";
            $data = array(
                'user'=>$user,
                'email'=>$request->email,
                'hash'=>$hashData
            );
            Mail::send('Mail.resetMail', $data, function($message) use ($data) {
                $message->to($data['email'])->subject
                ('Password Reset | '.config('app.name'));
                $message->from('admin@lifelinepharma.com',config('app.name'));
            });
        }
        else{
            $response['status']=false;
            $response['msg']="Email Doesn't Exists";
        }
        return Response($response);


    }
    public function resetMail(Request $request){
        $hashData=bcrypt(Str::random(8));
        $user=DB::table('admins')->where('email','=',$request->email)->first();
        $admin=Admin::find($user->id);
        $admin->remember_token = $hashData;
        $admin->save();

        return view('Mail.resetMail',[
            'user'=>$user,
            'email'=>$request->email,
            'hash'=>$hashData
        ]);
    }

    public function changePasswordView(Request $request){
        return view('Admin.changePass',[
            'req'=>$request
        ]);

    }

    public function changePassword(Request $request){
        $user=DB::table('admins')
            ->where('email','=',$request->email)
            ->where('remember_token', '=', $request->hash)
            ->first();
        if($user!=null){
            if(Hash::check($request->oldPass, $user->password)){
                if($request->newPassOne == $request->newPassTwo){
                    $admin = Admin::find($user->id);
                    $admin->password = bcrypt($request->newPassOne);
                    $admin->remember_token = bcrypt(Str::random(8));
                    $admin->save();
                    return redirect()->to(route('login'));

                }
                else{
                    return abort('404', '707');

                }
            }
            else{
                return abort('404', '707');

            }
        }
        else{
            return abort('404', '707');

        }

//        ddd($user);
    }

    public function resetPasswordView(){
        return view('Admin.resetPassword');

    }
}
