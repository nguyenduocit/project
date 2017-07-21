<?php 
namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

use Illuminate\Support\Facades\Auth;

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

        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
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

    


    public function getRegister(){
        return view('quanlytaichinh.register');
    }

    

    public function postRegister(RegisterRequest $request)
    {
        echo "ok";
        // $user                 = new User ;
        // $image                = $request->file('Image');
        // $nameimg              = $image->getClientOriginalName();
        // $user->name           = $request->name;
        // $user->image          = $nameimg;
        // $user->email          = $request->email;
        // $user->password       = Hash::make($request->password);
        // $user->phone          = $request->phone;
        // $user->address        = $request->address;
        // $user->birthday       = $request->birthday;
        // $user->remember_token = $request->_token;
        // $user->sex            = $request->sex;
        // $des                  = "public/upload/images";
        // $image->move($des,$nameimg);
        // $user->save();

        // return redirect()->route('userinfo');
    }

    public function getLogin(){
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        


        $remember = $request->remember;
        $login = array(
                        'email'    => $request->email,
                        'password' => $request->password
                        
                    );

        if(Auth::attempt($login,$remember)){
            
             return redirect()->route('userinfo')->with(['flash_level'=>'success','flash_message'=>"Chúc mừng bạn đã đăng nhập thành công"]);
        }else{
            return redirect()->route('getLogin')->with(['flash_level'=>'danger','flash_message'=>'Thông tin tài khoản không chính xác']);
        }

    }


   

    

    

}