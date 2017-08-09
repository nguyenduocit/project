<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\TransfersMoney;
use App\Transaction;
use App\Categorys;
use App\Http\Requests;
use App\Wallets;
use App\date;
use DB;

class HomeController extends Controller
{

    /**
     * get list wallets
     * @return listWallets
     */
    public function index(){

    	if(!Auth::check()){

            return redirect('users/getLogin')->with(['flash_level'=>'danger','flash_message'=>'You need to sign in to use']);

        }

        $id =  Auth::user()->id;
        $date = \Carbon\Carbon::now();

        $year = $date->year;

    	$listWallets = Wallets::where('user_id',$id)->orderBy('id','DESC')->paginate(4);

        $dataExpenses = DB::table('transactions')->selectRaw( ' DATE_FORMAT( created_at,  "%Y-%m" ) AS DATE ,DATE_FORMAT( created_at,  "%m" ) AS MONTH, DATE_FORMAT( created_at,  "%Y" ) AS YEAR , SUM( amount ) AS total ')->where('type',TYPE_EXPENSES)->where('user_id', $id)->groupBy('DATE')->having('YEAR','=',$year)->orderBy('DATE')->get();

       foreach($dataExpenses as $key =>$val){

        $arrayExpenses[intval($val ->MONTH)] = $val ->total;

       }

        $dataMonth = array('0'=>0,'1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'11'=>0);

        $resultExpenses = $arrayExpenses + $dataMonth;

        ksort($resultExpenses);

        $dataIncom =  DB::table('transactions')->selectRaw( ' DATE_FORMAT( created_at,  "%Y-%m" ) AS DATE ,DATE_FORMAT( created_at,  "%m" ) AS MONTH, DATE_FORMAT( created_at,  "%Y" ) AS YEAR , SUM( amount ) AS total ')->where('type',TYPE_INCOM)->where('user_id', $id)->groupBy('DATE')->having('YEAR','=',$year)->orderBy('DATE')->get();

        foreach($dataIncom as $key =>$val){

        $arrayIncom[intval($val ->MONTH)] = $val ->total;

        }

        $resultIncom = $arrayIncom + $dataMonth;

        ksort($resultIncom);


        $dataCategoryExpenses =  DB::table('transactions')->selectRaw( ' DATE_FORMAT( transactions.created_at,  "%Y" ) AS YEAR , SUM( amount ) AS total , category_id ,categorys.name , transactions.type')->join('categorys',function($join){

            $join-> on ('categorys.id' ,'=','transactions.category_id')
                ->where('transactions.user_id','=', Auth::user()->id)
                ->where('transactions.type','=',TYPE_EXPENSES);

        })->groupBy('transactions.category_id')->having('YEAR','=',$year)->orderBy('transactions.category_id')->get();


        foreach($dataCategoryExpenses as $categorys){
            $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
            $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
            $categorys ->color =  $color;
        }

        $dataCategoryIncom =  DB::table('transactions')->selectRaw( ' DATE_FORMAT( transactions.created_at,  "%Y" ) AS YEAR , SUM( amount ) AS total , category_id ,categorys.name , transactions.type')->join('categorys',function($join){

            $join-> on ('categorys.id' ,'=','transactions.category_id')
                ->where('transactions.user_id','=', Auth::user()->id)
                ->where('transactions.type','=',TYPE_INCOM);

        })->groupBy('transactions.category_id')->having('YEAR','=',$year)->orderBy('transactions.category_id')->get();

        foreach($dataCategoryIncom as $categoryIcome){
            $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
            $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
            $categoryIcome ->color = $color;

        }


        return view('quanlytaichinh.home.index',compact('listWallets',"resultExpenses",'resultIncom','dataCategoryExpenses','dataCategoryIncom'));
    }
}
