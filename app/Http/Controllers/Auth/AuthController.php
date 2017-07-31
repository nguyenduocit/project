<?php 
namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Http\Response;
use DB;
use Hash;
use Session;
use Mail;
use Cookie;


class AuthController extends Controller
{


   
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){

       // $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data){
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    
     /**
     * Load form Register.
     *
     */
    protected function getRegister(){

        // If the user is logged in redirect page  home
        if(Auth::check()){

            return redirect('home')->with(['flash_level'=>'success','flash_message'=>" "]);

        }
        return view('quanlytaichinh.register');
    }

    
     /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $request
     * @return 
     */
    protected function postRegister(RegisterRequest $request){

        // Save register ;
        $user                 = new User ;
        $image                = $request->file('Image');
        if(!empty($image)){

                $nameimg              = $image->getClientOriginalName();
                // Directory path upload photos  FOLDER_PHOTOS edit bootstrap constant.php
                $user->avata          = $nameimg;
                $des                  = FOLDER_PHOTOS;
                $image->move($des,$nameimg);

            }
        $user->name           = $request->name;
        $user->email          = $request->email;
        $user->password       = Hash::make($request->rpassword);
        $user->phone          = $request->phone;
        $user->address        = $request->address;
        $user->birthday       = $request->birthday;
        $user->remember_token = $request->_token;
        $user->sex            = $request->sex;
       
       

        // Send mail 
        // create session 
        Session::put('email', $request->email);
        Session::put('name', $request->name);
        $data = ['token' => $request->_token ];
        $link = 'emails.blanks';
        
        // function send mail libtary
        sendMail($link,$data); 

        $user->save();
        return redirect('users/getLogin')->with(['flash_level'=>'success','flash_message'=>'You need to confirm your email before signing in']);

    }

    /**
     * Send mail test
     *
     * @return    
     */
    protected function sendMail(){

        $data = ['hoten'=>'Nguyenduoc'];
        Mail::send('emails.blanks', $data, function ($message) {
            $message->from( EMAIL_ADMIN, NAME_ADMIN );
            
            $message->to('duocnv@rikkeisoft.com', 'John Doe')->subject('test gui mail');
        
        });
    }

    /**
     * load form login
     *
     * @return     <type>  The login.
     */

    protected function getLogin(){

        // If the user is logged in redirect page  home
        if(Auth::check()){

            return redirect('home')->with(['flash_level'=>'success','flash_message'=>" "]);

        }
        return view('quanlytaichinh.login');
    }


    /**
     * Posts a login.
     *
     * @param  request
     *
     * @return
     */
    protected function postLogin(LoginRequest $request){

        // Luu thong tin user vao mang 
        $remember = $request->remember;
        $login = array(
                        'email'    => $request->email,
                        'password' => $request->password
                        
                      );
        // kiem tra nguoi dung da xac nhan email
        $user = DB::table('users')->where('email', $request->email)->get();
       
        
        // Check that the user exists
        if(empty($user)){

            return redirect('users/getLogin')->with(['flash_level'=>'danger','flash_message'=>'The account information is incorrect']);
        }
        //  VERIFY_EMAIL_SUCCESS = 1 User status confirmed  edit bootstrap constant.php
        if( $user[0]->status != VERIFY_EMAIL){
            return redirect('users/getLogin')->with(['flash_level'=>'danger','flash_message'=>'You need to confirm your email before signing in']);
        }

        // check isset cookie
        if(Cookie::get('status-login'))
        {
            return redirect('users/getLogin')->with(['flash_level'=>'danger','flash_message'=>'The login account has been locked. Login after 15 minutes.']);

        }
        
        // create session login
        
        if(Session::has('number')){

            $number = Session::get('number');

            Session::put('number', $number);
            
        }else{

            Session::put('number', '0');

        }

        // number of logins NUMBER_LOGIN_ERORR = 3  edit bootstrap constant.php 
        
        if(Session::has('number') && Session::get('number') > NUMBER_LOGIN_ERORR){
            $response = new Response();

            // create cookie
            // minutes of logins NUMBER_MINUTES_LOCK = 15 edit bootstrap constant.php 
            $response ->withCookie('status-login','status-login',NUMBER_MINUTES_LOCK);

            return redirect('users/getLogin')->with(['flash_level'=>'danger','flash_message'=>'The login account has been locked. Login after 15 minutes.']);

        }
        // check  Information login
        if(Auth::attempt($login,$remember)){

            // remove session
            Session::forget('number');

            // move page
            return redirect('home')->with(['flash_level'=>'success','flash_message'=>"Congratulations on your successful login"]);


        }else{

            // add session number
            $number = Session::get('number') +1 ;

            Session::put('number', $number);

            return redirect('users/getLogin')->with(['flash_level'=>'danger','flash_message'=>'The account information is incorrect.']);
        }

        
    }

    protected function getConfirmEmail($token){
        
        // select information user
        $user = DB::table('users')->where('remember_token', $token)->get();

        // check empty user
        if(empty($user)){

            return redirect('users/getResetPassword')->with(['flash_level'=>'danger','flash_message'=>'Accounts do not exist in the database.']);

        }
        // update status
        $user = User::find($user[0]->id);

        $user->status = 1;

        $user->save();

        return redirect('users/getLogin')->with(['flash_level'=>'success','flash_message'=>'Successful confirmation email']);

        
    }

    protected function getUserProfile(){

        return view('quanlytaichinh.user.userProfile');
    }
     
    protected function postUserProfile(UserProfileRequest $request){

    
        if(Auth::check()){

            $id = Auth::user() ->id;

            $user = User::find($id);

            $image                = $request->file('Image');
            $user->name           = $request->name;

            if(!empty($image)){

                $nameimg              = $image->getClientOriginalName();
                $user->avata          = $nameimg;
                $des                  = FOLDER_PHOTOS;
                $image->move($des,$nameimg);

                File::delete(FOLDER_PHOTOS.'/'.Auth::user()->avata);
            }
            
            $user->phone          = $request->phone;
            $user->address        = $request->address;
            $user->birthday       = $request->birthday;
            $user->sex            = $request->sex;
            // Directory path upload photos  FOLDER_PHOTOS edit bootstrap constant.php
            
            $user->save();

            Session::forget('id');
            
            return redirect('users/getUserProfile')->with(['flash_level'=>'success','flash_message'=>'Edit success information !!!']);

        }
    }

    /**
     * logout
     */
    
    protected function getLogout(){

        Auth::logout();

        return redirect('users/getLogin');
    }




   

    

    

}