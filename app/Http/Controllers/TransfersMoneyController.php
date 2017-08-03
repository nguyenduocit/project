<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\TransfersMoneyRequest;
use App\Wallets;
use App\TransfersMoney;
use App\Http\Requests;
use DB;

class TransfersMoneyController extends Controller
{
    /**
     * Gets the list transfers.
     *
     * @return     <type>  The list transfers.
     */
    
    public function getListTransfers(){

        // The number of elements displayed on a page . Eit in file constant.php (NUMBER_PAGINATE = 15)
        $num = NUMBER_PAGINATE;
        
        $transfersMoney = DB::table('transfers_moneys')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate($num);
        
        
        foreach($transfersMoney as $transfers){
            $nameWalletTransfers = DB::table('wallets')->where('id',$transfers->transfer_wallet)->get();
            $transfers ->name_transfer_wallet = $nameWalletTransfers[0]->name;
        }

        foreach($transfersMoney as $transfer){
            $nameWalletReceive = DB::table('wallets')->where('id',$transfer->receive_wallet)->get();
            $transfer ->name_receive_wallet = $nameWalletReceive[0]->name;


        }
        return view('quanlytaichinh.transfers-money.transfersMoneyList',compact('transfersMoney'));

    }


    /**
     * Gets the transfers money. readonly="readonly"
     *
     * @return     <type>  The transfers money.
     */
    public function getTransfersMoney(){
    	$listwallets = Wallets::select('id','name')->where('user_id',Auth::user()->id)->get();
    	if(empty($listwallets)){

    		return redirect('home')->with(['flash_level'=>'success','flash_message'=>'You do not have wallets']);

    	}

    	return view('quanlytaichinh.transfers-money.transfersMoneyAdd',compact('listwallets'));
    }

    /**
     * show amount receive-wallet and transfer wallet 
     *  @param $id
     *  @return amount 
     */

    public function getAmountTransfers($id){

        $amountWallets = Wallets::select('amount')->where('id',$id)->get();

        return $amountWallets[0]->amount;
        
    }

    /**
     * Posts a transfers money.
     *
     * @param      TransfersMoneyRequest  $request  The request
     */
    
   
    public function postTransfersMoney(TransfersMoneyRequest $request){

        if($request->transfer_wallet == $request->receive_wallet ){

            return redirect('wallets/getTransfersMoney')->with(['flash_level'=>'danger','flash_message'=>"You can not transfer money in the same wallet !"]);
        }

        //Get wallet data  Transfers 
        $amountTransfer = Wallets::select('amount')->where('id',$request->transfer_wallet)->get();

        $amountTran = $amountTransfer[0]->amount;

        if($amountTran < $request->amount || $amountTran == 0 ){

            return redirect('wallets/getTransfersMoney')->with(['flash_level'=>'danger','flash_message'=>"The money in the wallet is not enough to transfer !"]);
        }

        // // Get data received
        // $amountReceive = Wallets::select('amount')->where('id',$request->receive_wallet)->get();

        // $amountRec = $amountReceive[0]->amount;

        // $amountReceiveUpdate = $amountRec + $request->amount;

        // // Update Receive Wallet
        // $wallets = Wallets::find($request->receive_wallet);
        // $wallets->amount      = $amountReceiveUpdate;
        // $wallets->save();

        // // Update Transfer wallet 
        // $amountTransferUpdate = $amountTran - $request->amount;
        // $wallets = Wallets::find($request->transfer_wallet);
        // $wallets->amount      = $amountTransferUpdate;
        // $wallets->save();

        // insert Transfers Money
        $transfersMoney                   = new TransfersMoney;
        $transfersMoney ->transfer_wallet = $request->transfer_wallet;
        $transfersMoney ->receive_wallet  = $request->receive_wallet;
        $transfersMoney ->amount          = $request->amount;
        $transfersMoney ->user_id         = Auth::user()->id;
        
        $transfersMoney ->save();


        return redirect('wallets/getTransfersMoney')->with(['flash_level'=>'success','flash_message'=>'Transfer money successfully!!!']);
    }

    /**
     * Gets the delete transfers.
     *
     * @param      <type>  $id     The identifier
     *
     * @return     <type>  The delete transfers.
     */
    

    public function getDeleteTransfers($id){

        $transfersMoney = TransfersMoney::find($id);

        if(empty($transfersMoney)){
            return redirect('wallets/getList')->with(['flash_level'=>'danger','flash_message'=>'Does not exist in the database']);
        }

        $transfersMoney ->delete($id);
    }

    /**
     * { function_description }
     *
     * @param      <type>  $key    The key
     */
    
    public function keySearchTransfers($key){

        $transfersMoney = TransfersMoney::Where('amount','like',"%$key%")->get();

    
        die (json_encode($transfersMoney));

    }

    /**
     * Gets the edit transfers.
     *
     * @param      <type>  $id     The identifier
     *
     * @return     <type>  The edit transfers.
     */
    
    public function getEditTransfers($id){

        $listwallets = Wallets::select('id','name')->where('user_id',Auth::user()->id)->get();
        if(empty($listwallets)){

            return redirect('home')->with(['flash_level'=>'success','flash_message'=>'You do not have wallets']);

        }

        $transfersMoney = TransfersMoney::find($id);
        

        return view('quanlytaichinh.transfers-money.transfersMoneyEdit',compact('listwallets','transfersMoney'));
    }

    /**
     * Posts edit transfers.
     *
     * @param      <type>                                    $id       The identifier
     * @param      \App\Http\Requests\TransfersMoneyRequest  $request  The request
     *
     * @return     <type>                                    ( description_of_the_return_value )
     */

    public function postEditTransfers($id,TransfersMoneyRequest $request){


        $transfersMoney = TransfersMoney::find($id);

        if(empty($transfersMoney)){

            return redirect('wallets/getListTransfers')->with(['flash_level'=>'danger','flash_message'=>'No transaction exists !!!']);
        }

        $transfersMoney ->transfer_wallet = $request->transfer_wallet;
        $transfersMoney ->receive_wallet  = $request->receive_wallet;
        $transfersMoney ->amount          = $request->amount;

        $transfersMoney ->save();


        return redirect('wallets/getListTransfers')->with(['flash_level'=>'success','flash_message'=>'Edit successfully Transfers !!!']);


    }



}
