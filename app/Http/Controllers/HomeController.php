<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Wallets;

class HomeController extends Controller
{

    /**
     * get list wallets
     * @return listWallets
     */
    protected function index(){

    	if(!Auth::check()){

            return redirect('users/getLogin')->with(['flash_level'=>'danger','flash_message'=>'You need to sign in to use']);

        }

        $id =  Auth::user()->id;
    	
    	$listWallets = Wallets::where('user_id',$id)->orderBy('id','DESC')->paginate(16);

    	return view('quanlytaichinh.home.index',compact('listWallets'));
    }
}
