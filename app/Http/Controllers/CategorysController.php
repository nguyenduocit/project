<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CategorysController extends Controller
{
    //
    
    protected function getAdd(){
    	return view('quanlytaichinh.categorys.add');
    }
}
