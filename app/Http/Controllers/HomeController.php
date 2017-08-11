<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChartRequest;
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
     * { function_description }
     *
     * @param      <type>         $id     The identifier
     * @param      <type>         $year   The year
     * @param      <type>         $type   The type
     *
     * @return     array|integer  ( description_of_the_return_value )
     */
    public function dataChartTransaction($id,$year,$type){

        $dataChart = DB::table('transactions')
            ->selectRaw( ' DATE_FORMAT( created_at,  "%Y-%m" ) AS DATE ,DATE_FORMAT( created_at,  "%m" ) AS MONTH, DATE_FORMAT( created_at,  "%Y" ) AS YEAR , SUM( amount ) AS total ')
            ->where('type',$type)
            ->where('user_id', $id)
            ->groupBy('DATE')
            ->having('YEAR','=',$year)
            ->orderBy('DATE')
            ->get();

            $dataMonth = array('0'=>0,'1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'11'=>0);

            if(!empty($dataChart)){

                foreach($dataChart as $key =>$val){

                $arrayChart[intval($val ->MONTH)] = $val ->total;

                }

                $resultChart = $arrayChart + $dataMonth;

                ksort($resultChart);

            }else{

                $resultChart = array('0'=>0,'1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'11'=>0);
            }

        return $resultChart;

    }

    /**
     * { function_description }
     *
     * @param      <type>  $year   The year
     * @param      <type>  $type   The type
     *
     * @return     <type>  ( description_of_the_return_value )
     */

    public function dataChartCategory($year,$type){

         $dataChartCategory =  DB::table('transactions')
            ->selectRaw( ' DATE_FORMAT( transactions.created_at,  "%Y" ) AS YEAR , SUM( amount ) AS total , category_id ,categorys.name , transactions.type')
            ->join('categorys','categorys.id' ,'=','transactions.category_id')
            ->where('transactions.user_id','=', Auth::user()->id)
            ->where('transactions.type','=',$type)
            ->groupBy('transactions.category_id')
            ->having('YEAR','=',$year)
            ->orderBy('transactions.category_id')
            ->get();


            if(!empty($dataChartCategory)){

                foreach($dataChartCategory as $data){
                    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
                    $data ->color =  $color;
                }
            }

        return $dataChartCategory;
    }

    /**
     * get list wallets
     * @return listWallets
     */
    public function index(Request $request){

        
        $id =  Auth::user()->id;
        $date = \Carbon\Carbon::now();

        $year = $date->year;

        $listWallets = Wallets::where('user_id',$id)->orderBy('id','DESC')->paginate(4);

        $resultExpenses = $this->dataChartTransaction($id,$year,TYPE_EXPENSES);

        $resultIncom =  $this->dataChartTransaction($id,$year,TYPE_INCOM);

        $dataCategoryExpenses =  $this->dataChartCategory($year,TYPE_EXPENSES);


        $dataCategoryIncom =  $this->dataChartCategory($year,TYPE_INCOM);

        return view('quanlytaichinh.home.index',compact('listWallets',"resultExpenses",'resultIncom','dataCategoryExpenses','dataCategoryIncom'));

    }

    /**
     * { function_description }
     */

    public function resultAjaxDataChartAll(Request $request){

        $id =  Auth::user()->id;
        $date = \Carbon\Carbon::now();

        $year = $date->year;

        if(isset($request ->year)){

            $year = $request ->year;
        }

        $datas = Wallets::select('id')->where('user_id',$id)->get()->toArray();

        foreach ($datas as $key => $value) {
            # code...
            
            $wallets[] = $value['id'];
        }

       if(isset($request->wallets)){

        $wallets = $request->wallets;

       }


        // $resultExpenses = $this->dataChartTransaction($id,$year,TYPE_EXPENSES);
        $dataExpenses = DB::table('transactions')
            ->selectRaw( ' DATE_FORMAT( created_at,  "%Y-%m" ) AS DATE ,DATE_FORMAT( created_at,  "%m" ) AS MONTH, DATE_FORMAT( created_at,  "%Y" ) AS YEAR , SUM( amount ) AS total ')
            ->where('type',TYPE_EXPENSES)
            ->where('user_id', $id)
            ->whereIn('wallets_id',$wallets)
            ->groupBy('DATE')
            ->having('YEAR','=',$year)
            ->orderBy('DATE')
            ->get();

            $dataMonth = array('0'=>0,'1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'11'=>0);

            if(!empty($dataExpenses)){

                foreach($dataExpenses as $key =>$val){

                $arrayExpenses[intval($val ->MONTH)] = $val ->total;

                }

                $resultExpenses = $arrayExpenses + $dataMonth;

                ksort($resultExpenses);

            }else{

                $resultExpenses = array('0'=>0,'1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'11'=>0);
            }



        //$resultIncom =  $this->dataChartTransaction($id,$year,TYPE_INCOM);
        $dataIncom =  DB::table('transactions')
            ->selectRaw( ' DATE_FORMAT( created_at,  "%Y-%m" ) AS DATE ,DATE_FORMAT( created_at,  "%m" ) AS MONTH, DATE_FORMAT( created_at,  "%Y" ) AS YEAR , SUM( amount ) AS total ')
            ->where('type',TYPE_INCOM)
            ->where('user_id', $id)
            ->whereIn('wallets_id',$wallets)
            ->groupBy('DATE')
            ->having('YEAR','=',$year)
            ->orderBy('DATE')
            ->get();

            $dataMonth = array('0'=>0,'1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'11'=>0);

            if(!empty($dataIncom)){

                foreach($dataIncom as $key =>$val){

                $arrayIncom[intval($val ->MONTH)] = $val ->total;

                }

                $resultIncom = $arrayIncom + $dataMonth;

                ksort($resultIncom);

            }else{

                $resultIncom = array('0'=>0,'1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'11'=>0);
            }

        $data = array('resultExpenses'=> $resultExpenses, 'resultIncom'=>$resultIncom);

        die(json_encode($data));

    }


    public function resultAjaxDataChartYear(ChartRequest $request){

        $id =  Auth::user()->id;
        $date = \Carbon\Carbon::now();

        $year = $date->year;

        if(isset($request ->year)){

            $year = $request ->year;
        }

        $resultExpenses = $this->dataChartTransaction($id,$year,TYPE_EXPENSES);
        $resultIncom =  $this->dataChartTransaction($id,$year,TYPE_INCOM);

        $data = array('dataresultExpenses'=> $resultExpenses, 'dataresultIncom'=>$resultIncom);

        return $data;

        die(json_encode($data));

    }

    
}
