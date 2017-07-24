<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\Auth;
use DB;
use Hash;
use Session;
use Mail;
use Cookie;


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

        return view("quanlytaichinh.forgotpass");
        
    }

    /**
     * I forgot my password
     *
     * @param      \App\Http\Requests\ForgotPasswordRequest  $request  The request
     */

    protected function postForgotPassword(ForgotPasswordRequest $request){

    // select information user
    $user = DB::table('users')->where('email', $request->email)->get();



    //If user information does not exist

    if(empty($user)){

        return redirect('users/getForgotPassword')->with(['flash_level'=>'danger','flash_message'=>'Email accounts do not exist in the database.']);

    }

    echo $request->_token;
    
    pre($user);




    }

}
