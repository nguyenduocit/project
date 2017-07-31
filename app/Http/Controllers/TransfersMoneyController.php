<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\TransfersMoneyRequest;
use App\Wallets;
use App\TransfersMoney;
use App\Http\Requests;

class TransfersMoneyController extends Controller
{
    /**
     * Gets the transfers money. readonly="readonly"
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
     * show amount receive-wallet and transfer wallet 
     *  @param $id
     *  @return amount 
     */

    protected function getAmountTransfers($id){

        $amountWallets = Wallets::select('amount')->where('id',$id)->get();

        return $amountWallets[0]->amount;
        
    }

    /**
     * Posts a transfers money.
     *
     * @param      TransfersMoneyRequest  $request  The request
     */
    
   
    protected function postTransfersMoney(TransfersMoneyRequest $request){

        if($request->transfer_wallet == $request->receive_wallet ){

            return redirect('wallets/getTransfersMoney')->with(['flash_level'=>'danger','flash_message'=>"You can not transfer money in the same wallet !"]);
        }

        //Get wallet data  Transfers 
        $amountTransfer = Wallets::select('amount')->where('id',$request->transfer_wallet)->get();

        $amountTran = $amountTransfer[0]->amount;

        if($amountTran < $request->amount || $amountTran == 0 ){

            return redirect('wallets/getTransfersMoney')->with(['flash_level'=>'danger','flash_message'=>"The money in the wallet is not enough to transfer !"]);
        }

        // Get data received
        $amountReceive = Wallets::select('amount')->where('id',$request->receive_wallet)->get();

        $amountRec = $amountReceive[0]->amount;

        $amountReceiveUpdate = $amountRec + $request->amount;

        // Update Receive Wallet
        $wallets = Wallets::find($request->receive_wallet);
        $wallets->amount      = $amountReceiveUpdate;
        $wallets->save();

        // Update Transfer wallet 
        $amountTransferUpdate = $amountTran - $request->amount;
        $wallets = Wallets::find($request->transfer_wallet);
        $wallets->amount      = $amountTransferUpdate;
        $wallets->save();

        // insert Transfers Money
        $transfersMoney                   = new TransfersMoney;
        $transfersMoney ->transfer_wallet = $request->transfer_wallet;
        $transfersMoney ->receive_wallet  = $request->receive_wallet;
        $transfersMoney ->amount          = $request->amount;
        $transfersMoney ->user_id         = Auth::user()->id;
        
        $transfersMoney ->save();


        return redirect('wallets/getTransfersMoney')->with(['flash_level'=>'success','flash_message'=>'Transfer money successfully!!!']);
    }




}
