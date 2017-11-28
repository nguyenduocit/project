$id =  Auth::user()->id;
    	$listWallets = Wallets::where('user_id',$id)->orderBy('id','DESC')->get()->toArray();

    	foreach($listWallets as $Wallets){

    		$data_sum_transfer_wallet = TransfersMoney::where('transfer_wallet',$Wallets['id'])->sum('amount');
    		$data_sum_receive_wallet = TransfersMoney::where('receive_wallet',$Wallets['id'])->sum('amount');

    		$data_Expenses = Transaction::where('wallets_id',$Wallets['id'])->where('type',1)->sum('amount');
    		$data_income = Transaction::where('wallets_id',$Wallets['id'])->where('type',1)->sum('amount');

    		$data_update = $Wallets['amount'] - ($data_sum_transfer_wallet  + $data_Expenses) + ($data_sum_receive_wallet + $data_income);

    		$wallets = Wallets::find($Wallets['id']);
    		$wallets->amount      = $data_update;
        	$wallets->save();
    	}

    	