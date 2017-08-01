<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\WalletsRequest;
use App\Http\Requests;
use App\Wallets;
use App\TransfersMoney;
use DB;

class WalletsController extends Controller
{
    // public function __construct()
    // {
    //     return checkLoginSuccess();
    // }

    protected function getInfoWallets($id){


        
        $transfersMoney = DB::table('transfers_moneys')->where('transfer_wallet',$id)->orWhere('receive_wallet',$id)->orderBy('id','DESC')->paginate(15);
        
        foreach($transfersMoney as $transfers){
            $nameWalletTransfers = DB::table('wallets')->where('id',$transfers->transfer_wallet)->get();

            $transfers ->name_transfer_wallet = $nameWalletTransfers[0]->name;
        }

        foreach($transfersMoney as $transfer){
            $nameWalletTransfer = DB::table('wallets')->where('id',$transfer->receive_wallet)->get();

            $transfer ->name_receive_wallet = $nameWalletTransfer[0]->name;
        }

        
        return view('quanlytaichinh.wallets.infoWallets',compact('transfersMoney'));

    }


   
    /**
     * load form creat wallets 
     * @return [type] [description]
     */
    protected function getAdd(){

        if(!Auth::check()){

            return redirect('users/getLogin')->with(['flash_level'=>'danger','flash_message'=>'You need to sign in to use']);

        }
    	//
        return view('quanlytaichinh.wallets.add');
    }

    /**
     * inset info wallets in database
     * @param  WalletsRequest $request [description]
     * @return [type]                  [description]
     */
    protected function postAdd(WalletsRequest $request){

		$wallets              = new Wallets;
		$wallets->user_id     = Auth::user()->id;
		$wallets->name        = $request->name;
		$wallets->color       = $request->colors;
		$wallets->amount      = $request->amount;
		$wallets->save();

		return redirect('home')->with(['flash_level'=>'success','flash_message'=>'Congratulations, you have successfully added your wallet.']);
    }

    /**
     * show list wallets
     *
     * @return     <type>  The list. $listWallets
     */

    protected function getList(Request $request){
       
        if(!Auth::check()){

            return redirect('users/getLogin')->with(['flash_level'=>'danger','flash_message'=>'You need to sign in to use']);

        }

        $id =  Auth::user()->id;

        if(isset($request->num) || isset($request->arrange)){
            

           if(isset($request->num)){

                $num = $request->num;

                $listWallets = Wallets::where('user_id',$id)->orderBy('id','DESC')->skip(0)->take($num)->get();
            }

            die(json_encode($listWallets));

        }else{
            $num =10;
             $listWallets = Wallets::where('user_id',$id)->orderBy('id','DESC')->paginate($num);

             return view('quanlytaichinh.wallets.list', compact('listWallets'));
        }  

    }

 

    /**
     * search data name and amount 
     *
     * @param      <type>  $key    The key
     */

    protected function keySearch($key){

        $listWallets = Wallets::where('name','like',"%$key%")->orWhere('amount','like',"%$key%")->get();

        die (json_encode($listWallets));
        
    }

    /**
     * Gets form edit.
     *
     * @param      <type>  $id     The identifier
     *
     * @return     <type>  The edit.
     */

    protected function getEdit($id){

        $wallets = Wallets::find($id);

        if(empty($wallets)){
            return redirect('wallets/getList')->with(['flash_level'=>'danger','flash_message'=>'Does not exist in the database']);
        }

        return view('quanlytaichinh.wallets.edit', compact('wallets'));
    }

    /**
     * Posts an edit wallets.
     *
     * @param      <type>                             $id       The identifier
     * @param      \App\Http\Requests\WalletsRequest  $request  The request
     *
     * @return     <type>                             ( description_of_the_return_value )
     */

    protected function postEdit($id,WalletsRequest $request){

        $wallets = Wallets::find($id);

        if(empty($wallets)){
            return redirect('wallets/getList')->with(['flash_level'=>'danger','flash_message'=>'Does not exist in the database']);
        }

        $wallets->user_id     = Auth::user()->id;
        $wallets->name        = $request->name;
        $wallets->color       = $request->colors;
        $wallets->amount      = $request->amount;
        $wallets->save();

        return redirect('wallets/getList')->with(['flash_level'=>'success','flash_message'=>'Edit successfully wallets']);

    }

       /**
     * Gets the delete.
     *
     * @param      <type>  $id     The identifier
     *
     * @return     <type>  The delete. $id
     */

    protected function getDelete($id){

        $wallets = Wallets::find($id);

        if(empty($wallets)){
            return redirect('wallets/getList')->with(['flash_level'=>'danger','flash_message'=>'Does not exist in the database']);
        }

        $wallets->delete($id);
        return $id;

    }

    /**
     * Gets the delete all.
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <type>                    The delete all.
     */

    protected function getDeleteAll(Request $request){

        $id_Wallets = $request->ids;

        foreach($id_Wallets as $id )
        {
            $wallets = Wallets::find($id);

            if(empty($wallets)){
                return redirect('wallets/getList')->with(['flash_level'=>'danger','flash_message'=>'Does not exist in the database']);
            }

            $wallets->delete($id);


        }

    }

    


}
