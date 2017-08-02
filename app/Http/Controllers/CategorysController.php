<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Categorys;


class CategorysController extends Controller
{
	/**
	 * Gets the list.
	 *
	 * @return     <type>  The list.
	 */
	protected function getList(Request $request){

		$num = 15;

		if(isset($request->num)){

			$num = $request->num;

			$listCategory = Categorys::select('id','name','type','parent_id','created_at','updated_at')->where('user_id',Auth::user()->id)->skip(0)->take($num)->get();

			if(!empty($listCategory)){

				foreach($listCategory as $category){

					if($category->parent_id != 0){

						$listNameParent = Categorys::select('name')->where('user_id',Auth::user()->id )->where('id',$category->parent_id)->get();

						$category ->nameParent = $listNameParent[0]->name;

					}else{
						$category ->nameParent = "Category parent";
					}
					

				}

			}

			die(json_encode($listCategory));

		}else{

			$listCategory = Categorys::select('id','name','type','parent_id','created_at','updated_at')->where('user_id',Auth::user()->id)->paginate($num);

			if(!empty($listCategory)){

				foreach($listCategory as $category){

					if($category->parent_id != 0){

						$listNameParent = Categorys::select('name')->where('user_id',Auth::user()->id )->where('id',$category->parent_id)->get();

						$category ->nameParent = $listNameParent[0]->name;

					}else{
						$category ->nameParent = "Category parent";
					}
					

				}

			}

			return view('quanlytaichinh.categorys.list',compact('listCategory'));

		}
	}

    /**
     * Gets the add.
     *
     * @return     <type>  The add.
     */
    protected function getAdd(){

    	$parent = Categorys::select('id','name','parent_id')->where('user_id',Auth::user()->id)->get()->toArray();

    	return view('quanlytaichinh.categorys.add',compact('parent'));
    }

    /**
     * Posts an add.
     *
     * @param      \App\Http\CategoryRequest  $request  The request
     */
    protected function postAdd(CategoryRequest $request){

		$category            = new Categorys;
		$category->name      = $request->name;
		$category->type      = $request->type;
		$category->parent_id = $request->parent_id;
		$category->user_id   = Auth::user()->id;
		
		$category ->save();

		return redirect('categorys/getList')->with(['flash_level'=>'success','flash_message'=>"Add category successfully !!!"]);
    }

    /**
     * Gets the edit.
     *
     * @return     <type>  The edit.
     */
    
    protected function getEdit($id){
    	
    	$parent = Categorys::select('id','name','parent_id')->where('user_id',Auth::user()->id)->get()->toArray();

    	$category = Categorys::select('id','name','parent_id','type')->where('id',$id)->get();


    	return view('quanlytaichinh.categorys.edit',compact('parent','category'));


    }

    /**
     * Posts an edit.
     *
     * @param      <type>                              $id       The identifier
     * @param      \App\Http\Requests\CategoryRequest  $request  The request
     *
     * @return     <type>                              ( description_of_the_return_value )
     */

    protected function postEdit($id,CategoryRequest $request){

    	$category = Categorys::find($id);

    	if(empty($category)){

    		return redirect('categorys/getList')->with(['flash_level'=>'danger','flash_message'=>"Category does not exist !!!"]);
    	}

    	$category->name      = $request->name;
		$category->type      = $request->type;
		$category->parent_id = $request->parent_id;

		$category ->save();


		return redirect('categorys/getList')->with(['flash_level'=>'success','flash_message'=>"Edit the category successfully !!!"]);

    }

    /**
     * Gets the delete.
     *
     * @param      <type>  $id     The identifier
     *
     * @return     string  The delete.
     */
    
    protected function getDelete($id){

    	$category = Categorys::find($id);

    	if(empty($category)){

    		return "error";
    	}

    	$parrent = Categorys::select('id')->where('parent_id',$id)->get()->toArray();



    	if(!empty($parrent)){
    		return "error";
    	}

    	$category ->delete($id);

    }




}
