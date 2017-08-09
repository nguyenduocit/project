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
    /**
     * Gets the list transaction
     *
     * @return     <type>  The list transaction
     */
    public function getList(Request $request){

        // The number of elements displayed on a page . Eit in file constant.php (NUMBER_PAGINATE = 15)
        $num = NUMBER_PAGINATE;

        if(isset($request->num)){

            $num = $request->num;

            $listTransaction = Transaction::select('id','category_id','user_id','wallets_id','amount','describe', 'created_at', 'updated_at')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->skip(0)->take($num)->get();

            foreach($listTransaction as $transaction){
                $wallets = Wallets::select('id','name')->where('id',$transaction->wallets_id)->get()->toArray();
                $transaction->nameWallets = $wallets[0]['name'];
            }

            foreach($listTransaction as $transaction){
                $category = Categorys::select('id','name','type')->where('id',$transaction->category_id)->get()->toArray();

                $transaction->nameCategory = $category[0]['name'];
                $transaction->nameType     = $category[0]['type'];

            }

            foreach($listTransaction as $transaction){

                $transaction ->format_time = \Carbon\Carbon::createFromTimestamp(strtotime($transaction ->created_at))->diffForHumans();

            }
            die(json_encode($listTransaction));


        }else{

            $sumAmountTransaction = DB::table('transactions')->where('user_id',Auth::user()->id)->sum('amount'); 

            $listTransaction = Transaction::select('id','category_id','user_id','wallets_id','amount','describe', 'created_at', 'updated_at')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate($num);

            foreach($listTransaction as $transaction){
                $wallets = Wallets::select('id','name')->where('id',$transaction->wallets_id)->get()->toArray();
                $transaction->nameWallets = $wallets[0]['name'];
            }

            foreach($listTransaction as $transaction){
                $category = Categorys::select('id','name','type')->where('id',$transaction->category_id)->get()->toArray();

                $transaction->nameCategory = $category[0]['name'];
                $transaction->nameType     = $category[0]['type'];
            }

            return view('quanlytaichinh.transaction.list',compact("listTransaction","sumAmountTransaction"));

        }
    }

    /**
     * Gets the add.
     *
     * @return     <type>  The add.
     */
    public function getAdd(){

		$wallets  = Wallets::select('id','name')->where('user_id',Auth::user()->id)->get()->toArray();
    	return view('quanlytaichinh.transaction.add',compact('wallets','category'));
    }

    public function getCategorys(Request $request){

        $type = $request ->type;

        $listCategory = Categorys::select('id','name','parent_id','type')->where('user_id',Auth::user()->id)->where('type',$type)->get()->toArray();

        die(json_encode($listCategory));

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
        $transaction ->amount      = $request->amount;
        $transaction ->type     = $request->type;
        $transaction ->describe    = $request->describe;

		$transaction ->save();

		return redirect('transection/getList')->with(['flash_level'=>'success','flash_message'=>'More successful transactions!!!']);
    }

    /**
     * Gets the edit transaction.
     *
     * @param      <type>  $id     The identifier
     *
     * @return     <type>  The edit.
     */


    public function getEdit($id){


        $wallets  = Wallets::select('id','name')->where('user_id',Auth::user()->id)->get()->toArray();

        $transaction = Transaction::find($id);
        $category = Categorys::select('id','name',"parent_id",'type')->where('user_id',Auth::user()->id)->where('id',$transaction ->category_id)->get()->toArray();

        return view('quanlytaichinh.transaction.edit',compact('wallets','category','transaction'));
    }

    /**
     * Gets the delete transaction.
     *
     * @param      <type>  $id     The identifier
     *
     * @return     string  The delete.
     */

    public function postEdit($id,TransactionRequest $request){

        $transaction = Transaction::find($id);
        $transaction ->category_id = $request->category_id;
        $transaction ->wallets_id  = $request->wallets_id;
        $transaction ->amount      = $request->amount;
        $transaction ->type        = $request->type;
        $transaction ->describe    = $request->describe;
        $transaction ->save();

        return redirect('transection/getList')->with(['flash_level'=>'success','flash_message'=>'Edit successful transactions !!!']);

    }
    public function getDelete($id){

        $transaction = Transaction::find($id);
        if(empty($transaction)){
            return "error";
        }

        $transaction->delete($id);

    }


}
