<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Wallets;
use App\Http\Requests;

class TransfersMoneyController extends Controller
{
    /**
     * Gets the transfers money.
     *
     * @return     <type>  The transfers money.
     */
    protected function getTransfersMoney()
    {
    	$listwallets = Wallets::all();
    	if(empty($listwallets)){

    		return redirect('home')->with(['flash_level'=>'success','flash_message'=>'You do not have wallets']);

    	}

    	return view('quanlytaichinh.transfers-money.transfersMoney',compact('listwallets'));
    }

    /**
     * Posts a transfers money.
     *
     * @param      TransfersMoneyRequest  $request  The request
     */

    protected function postTransfersMoney(TransfersMoneyRequest $request){

    }


}
