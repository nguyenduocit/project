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
use Illuminate\Support\Facades\Auth;
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
    public function __construct()
    {

       // $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
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
    protected function create(array $data)
    {
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
    
    protected function postRegister(RegisterRequest $request)
    {

        // Save register ;

        $user                 = new User ;
        $image                = $request->file('Image');
        $nameimg              = $image->getClientOriginalName();
        $user->name           = $request->name;
        $user->avata          = $nameimg;
        $user->email          = $request->email;
        $user->password       = Hash::make($request->rpassword);
        $user->phone          = $request->phone;
        $user->address        = $request->address;
        $user->birthday       = $request->birthday;
        $user->remember_token = $request->_token;
        $user->sex            = $request->sex;
        $des                  = "public/upload/images";
        $image->move($des,$nameimg);

        // Send mail 
        // create session 
        Session::put('email', $request->email);
        Session::put('name', $request->name);

        
        $data  = ['token' => $request->_token ];
        Mail::send('emails.blanks', $data, function ($message) {


            $message->from('duocnguyenit1994@gmail.com', 'Administrator');
            
            $message->to( Session::get('email'), Session::get('name'))->subject('Confirmation Email');
        
        });


        $user->save();
            return redirect('users/getLogin')->with(['flash_level'=>'success','flash_message'=>'You need to confirm your email before signing in']);

    }

    /**
     * Send mail test
     *
     * @return    
     */
    protected function sendMail()
    {
        $data = ['hoten'=>'Nguyenduoc'];
        Mail::send('emails.blanks', $data, function ($message) {
            $message->from('duocnguyenit1994@gmail.com', 'John Doe');
            
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


        foreach($user as $val){
            $status = $val->status;
        }


        if( $status != 1 ){
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


        // 
        
        if(Session::has('number') && Session::get('number') > 5)
        {
            $response = new Response();

            // create cookie
            $response ->withCookie('status-login','status-login',3);

            return redirect('users/getLogin')->with(['flash_level'=>'danger','flash_message'=>'The login account has been locked. Login after 15 minutes.']);

        }


        // check  Information login
        
        if(Auth::attempt($login,$remember)){

            // remove session
            
            Session::forget('number');

            // move page
            
            return redirect('home')->with(['flash_level'=>'success','flash_message'=>"Chúc mừng bạn đã đăng nhập thành công"]);


        }else{

            // add session number
            $number = Session::get('number') +1 ;

            Session::put('number', $number);

            return redirect('users/getLogin')->with(['flash_level'=>'danger','flash_message'=>'The account information is incorrect.']);
        }

        
    }

    protected function postConfirmEmail($token){
        
        pre($token);
    }

    /**
     * logout
     */
    
    protected function getLogout(){

        Auth::logout();

        return redirect('users/getLogin');
    }




   

    

    

}