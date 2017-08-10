<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\WalletsRequest;
use App\Http\Requests;
use App\User;
use App\Wallets;
use App\TransfersMoney;
use App\Transaction;
use DB;

class WalletsController extends Controller
{
    // public function __construct()
    // {
    //     return checkLoginSuccess();
    // }

    public function getInfoWallets($id){


        // $transfersMoney = TransfersMoney::select('*')
        // ->join('wallets','wallets.id','=','transfers_moneys.transfer_wallet')
        // ->where('transfer_wallet',$id)
        // ->orWhere('receive_wallet',$id)->get();
        // pre($transfersMoney);
        // The number of elements displayed on a page . Eit in file constant.php (NUMBER_PAGINATE = 15)
        $num = NUMBER_PAGINATE;
        $transfersMoney = DB::table('transfers_moneys')->where('user_id',Auth::user()->id)->where('transfer_wallet',$id)->orWhere('receive_wallet',$id)->orderBy('id','DESC')->paginate($num);
        foreach($transfersMoney as $transfers){
            $nameWalletTransfers = DB::table('wallets')->where('id',$transfers->transfer_wallet)->get();
            $transfers ->name_transfer_wallet = $nameWalletTransfers[0]->name;
        }

        foreach($transfersMoney as $transfer){
            $nameWalletReceive = DB::table('wallets')->where('id',$transfer->receive_wallet)->get();
            $transfer ->name_receive_wallet = $nameWalletReceive[0]->name;
        }


        $datatransactionexpenses =  Transaction::select('transactions.amount','transactions.type','categorys.name as nameCategory','wallets.name as nameWallets','describe','transactions.created_at')
        ->join('categorys','categorys.id' ,'=','transactions.category_id')
        ->join('wallets','wallets.id' ,'=','transactions.wallets_id')
        ->where('wallets_id','=',$id)->where('transactions.type','=',TYPE_EXPENSES)->orderBy('transactions.id','DESC')->paginate($num);

        $totalexpenses = DB::table('transactions')->where('wallets_id','=',$id)->where('transactions.type','=',TYPE_EXPENSES)->orderBy('transactions.id','DESC')->sum('amount');

        $totalincom = DB::table('transactions')->where('wallets_id','=',$id)->where('transactions.type','=',TYPE_INCOM)->orderBy('transactions.id','DESC')->sum('amount');

        $datatransactionincom =  Transaction::select('transactions.amount','transactions.type','categorys.name as nameCategory','wallets.name as nameWallets','describe','transactions.created_at')
        ->join('categorys','categorys.id' ,'=','transactions.category_id')
        ->join('wallets','wallets.id' ,'=','transactions.wallets_id')
        ->where('wallets_id','=',$id)->where('transactions.type','=',TYPE_INCOM)->orderBy('transactions.id','DESC')->paginate($num);

        return view('quanlytaichinh.wallets.infoWallets',compact('datatransactionexpenses','datatransactionincom','transfersMoney','id','totalexpenses','totalincom'));

    }


    /**
     * load form creat wallets
     * @return [type] [description]
     */
    public function getAdd(){
        return view('quanlytaichinh.wallets.add');
    }

    /**
     * inset info wallets in database
     * @param  WalletsRequest $request [description]
     * @return [type]                  [description]
     */
    public function postAdd(WalletsRequest $request){

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

    public function getList(Request $request){

        // $data = User::with('wallets')->find(8)->toArray();
        // pre($data['wallets']);

        $id =  Auth::user()->id;

        // The number of elements displayed on a page . Eit in file constant.php (NUMBER_PAGINATE = 15)
        $num = NUMBER_PAGINATE;
        if(isset($request->num)){
            $num = $request->num;

            $listWallets = Wallets::where('user_id',$id)->orderBy('id','DESC')->skip(0)->take($num)->get();

            foreach($listWallets as $wallets){

                $wallets ->format_time = \Carbon\Carbon::createFromTimestamp(strtotime($wallets ->created_at))->diffForHumans();
            }
            die(json_encode($listWallets));

        }else{

            $listWallets = Wallets::where('user_id',$id)->orderBy('id','DESC')->paginate($num);

            $sumAmount = DB::table('wallets')->where('user_id',$id)->sum('amount');

            return view('quanlytaichinh.wallets.list', compact('listWallets','sumAmount'));
        }

    }


    /**
     * search data name and amount
     *
     * @param      <type>  $key    The key
     */

    public function keySearch($key){

        $listWallets = Wallets::where('name','like',"%$key%")->orWhere('amount','like',"%$key%")->get();

        foreach($listWallets as $wallets){

            $wallets ->format_time = \Carbon\Carbon::createFromTimestamp(strtotime($wallets ->created_at))->diffForHumans();
        }

        die (json_encode($listWallets));
    }

    /**
     * Gets form edit.
     *
     * @param      <type>  $id     The identifier
     *
     * @return     <type>  The edit.
     */

    public function getEdit($id){

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

    public function postEdit($id,WalletsRequest $request){

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

    public function getDelete($id){

        $wallets = Wallets::find($id);

        if(empty($wallets)){

            return 'error';
        }

        $transfersMoney = DB::table('transfers_moneys')->where('transfer_wallet',$id)->orWhere('receive_wallet',$id)->get();
        if(!empty($transfersMoney)){

            return 'error';

        }
        $transaction = Transaction::select('id')->where('wallets_id',$id)->get();
        if(!empty($transaction)){

            return 'error';

        }
        $wallets->delete($id);

    }

    // /**
    //  * Gets the delete all.
    //  *
    //  * @param      \Illuminate\Http\Request  $request  The request
    //  *
    //  * @return     <type>                    The delete all.
    //  */

    // public function getDeleteAll(Request $request){

    //     $id_Wallets = $request->ids;

    //     foreach($id_Wallets as $id )
    //     {
    //         $wallets = Wallets::find($id);

    //         if(empty($wallets)){
    //             return redirect('wallets/getList')->with(['flash_level'=>'danger','flash_message'=>'Does not exist in the database']);
    //         }

    //         $wallets->delete($id);


    //     }

    // }
}
