<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Auth;
use DB;
use Hash;
use Session;
use Mail;
use Cookie;
use App\User;


class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     *  function forgot Password 
     */
    
    protected function getForgotPassword(){

        return view("quanlytaichinh.forgotPass");
        
    }

    /**
     * I forgot my password
     *
     * @param      \App\Http\Requests\ForgotPasswordRequest  $request  The request email
     */
    protected function postForgotPassword(ForgotPasswordRequest $request){

        // select information user
        $user = DB::table('users')->where('email', $request->email)->get();

        //If user information does not exist
        if(empty($user)){

            return redirect('users/getForgotPassword')->with(['flash_level'=>'danger','flash_message'=>'Email accounts do not exist in the database.']);

        }
            // Send mail 
            // create session 
            Session::put('email', $user[0]->email);
            Session::put('name',  $user[0]->name);
            $token  = $user[0]->remember_token;
        
        // Send mail 
        // 
        $data  = ['token' => $token ];
        
        // function send mail 
        sendMail($link,$data);

        return redirect('users/getForgotPassword')->with(['flash_level'=>'success','flash_message'=>'Check the email we sent you a password.']);

    }

    /**
     * comfirm validate reset password 
     *
     * @param      $token
     *
     * @return     <type>  The token reset password.
     */
    protected function getTokenResetPassword($token){

        // select information user
        $user = DB::table('users')->where('remember_token', $token)->get();

         //If user information does not exist
        if(empty($user)){

            return redirect('users/getForgotPassword')->with(['flash_level'=>'danger','flash_message'=>'Accounts do not exist in the database.']);

        }

        Session::put('id', $val->id);

        return redirect('users/getResetPassword')->with(['flash_level'=>'success','flash_message'=>'Enter password change information']);

    }

    /**
     * 
     *
     * @return     <type>  The reset password.
     */

    protected function getResetPassword(){

        return view('quanlytaichinh.resetPassword');
    }

    /**
     * Posts a reset password.
     *
     * @param      \App\Http\Requests\ResetPasswordRequest  $request  The request
     *
     * @return     <type>                                   ( description_of_the_return_value )
     */
    protected function postResetPassword(ResetPasswordRequest $request){

        if(Session::has('id')){

            $id = Session::get('id');

            $user = User::find($id);

            $user->password = Hash::make($request->password);

            $user->save();

            Session::forget('id');
            
            return redirect('users/getLogin')->with(['flash_level'=>'success','flash_message'=>'Change password successfully invite you to login']);

        }else{

            return redirect('users/getForgotPassword')->with(['flash_level'=>'danger','flash_message'=>'Enter email to change password']);

        }

    
    }

}
