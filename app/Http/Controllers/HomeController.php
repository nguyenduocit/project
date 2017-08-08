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

        $dataExpenses = DB::table('transactions')->selectRaw( ' DATE_FORMAT( created_at,  "%Y-%m" ) AS DATE ,DATE_FORMAT( created_at,  "%m" ) AS MONTH, DATE_FORMAT( created_at,  "%Y" ) AS YEAR , SUM( amount ) AS total ')->where('type',1)->where('user_id', $id)->groupBy('DATE')->orderBy('DATE')->get();

       
        $dataExpenses = array('0'=>0,'1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'11'=>0,);
       
        pre($dataExpenses);

        $dataIncom = DB::table('transactions')->selectRaw( ' DATE_FORMAT( created_at,  "%m" ) AS MONTH, DATE_FORMAT( created_at,  "%Y" ) AS YEAR , SUM( amount ) AS total ')->where(array('type'=>2,'user_id'=> $id,'YEAR'=>$year))->groupBy('MONTH')->orderBy('MONTH')->get();
        
    
    	return view('quanlytaichinh.home.index',compact('listWallets',"dataExpenses",'dataIncom'));
    }
}
