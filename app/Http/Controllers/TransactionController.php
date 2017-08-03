<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Requests\TransactionRequest;
use App\Categorys;
use App\Wallets;
use App\Transaction;
use DB;

class TransactionController extends Controller
{
    public function getList(){
        
    }
    /**
     * Gets the add.
     *
     * @return     <type>  The add.
     */
    public function getAdd(){

		$wallets  = Wallets::all()->toArray();
		$category = Categorys::all()->toArray();

    	return view('quanlytaichinh.transaction.add',compact('wallets','category'));
    }

    /**
     * Posts an add.
     *
     * @param      \App\Http\Requests\TransactionRequest  $request  The request
     *
     * @return     <type>                                 ( description_of_the_return_value )
     */
    public function postAdd(TransactionRequest $request){

    	$transaction = new Transaction;

		$transaction ->category_id = $request->category_id;
		$transaction ->user_id     = Auth::user()->id;
		$transaction ->wallets_id  = $request->wallets_id;
		$transaction ->amount     = $request->amount;
		$transaction ->describe    = $request->describe;

		$transaction ->save();

		return redirect('home')->with(['flash_level'=>'success','flash_message'=>'Congratulations, you have successfully added your wallet.']);
    }


}
