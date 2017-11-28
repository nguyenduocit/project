<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Categorys;
use App\Transaction;


class CategorysController extends Controller
{
	/**
	 * Gets the list.
	 *
	 * @return     <type>  The list.
	 */
	public function getList(Request $request){

        // The number of elements displayed on a page . Eit in file constant.php (NUMBER_PAGINATE = 15)
		$num = NUMBER_PAGINATE;

		if(isset($request->num)){

			$num = $request->num;

			$listCategory = Categorys::select('id','name','type','parent_id','created_at','updated_at')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->skip(0)->take($num)->get();

			if(!empty($listCategory)){

				foreach($listCategory as $category){

					if($category->parent_id != 0){

						$listNameParent = Categorys::select('name')->where('user_id',Auth::user()->id )->where('id',$category->parent_id)->get();

						$category ->nameParent = $listNameParent[0]->name;

					}else{
						$category ->nameParent = "";
					}
                    $category ->format_time = \Carbon\Carbon::createFromTimestamp(strtotime($category ->created_at))->diffForHumans();
				}

			}

			die(json_encode($listCategory));

		}else{

			$listCategory = Categorys::select('id','name','type','parent_id','created_at','updated_at')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate($num);

			if(!empty($listCategory)){

				foreach($listCategory as $category){

					if($category->parent_id != 0){

						$listNameParent = Categorys::select('name')->where('user_id',Auth::user()->id )->where('id',$category->parent_id)->get();

						$category ->nameParent = $listNameParent[0]->name;

					}else{
						$category ->nameParent = "";
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
    public function getAdd(){

    	//$parent = Categorys::select('id','name','parent_id')->where('user_id',Auth::user()->id)->where('parent_id',0)->get()->toArray();

    	return view('quanlytaichinh.categorys.add');
    }

    /**
     * Posts an add.
     *
     * @param      \App\Http\CategoryRequest  $request  The request
     */
    public function postAdd(CategoryRequest $request){

		$category            = new Categorys;
		$category->name      = $request->name;
		$category->type      = $request->type;
		$category->parent_id = "";
		$category->user_id   = Auth::user()->id;
		$category ->save();

		return redirect('categorys/getList')->with(['flash_level'=>'success','flash_message'=>"Add category successfully !!!"]);
    }

    /**
     * Gets the edit.
     *
     * @return     <type>  The edit.
     */
    public function getEdit($id){
    	$category = Categorys::select('id','name','parent_id','type')->where('id',$id)->get();

    	return view('quanlytaichinh.categorys.edit',compact('category'));


    }

    /**
     * Posts an edit.
     *
     * @param      <type>                              $id       The identifier
     * @param      \App\Http\Requests\CategoryRequest  $request  The request
     *
     * @return     <type>                              ( description_of_the_return_value )
     */

    public function postEdit($id,CategoryRequest $request){

    	$category = Categorys::find($id);

    	if(empty($category)){

    		return redirect('categorys/getList')->with(['flash_level'=>'danger','flash_message'=>"Category does not exist !!!"]);
    	}

    	$category->name      = $request->name;

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
    public function getDelete($id){

    	$category = Categorys::find($id);

    	if(empty($category)){

    		return "error";
    	}

    	$parrent = Categorys::select('id')->where('parent_id',$id)->get()->toArray();

        $transaction = Transaction::select('id')->where('category_id',$id)->get()->toArray();

    	if(!empty($transaction)){
    		return "error-transaction";
    	}
        if(!empty($parrent)){
            return "error";
        }
        
    	$category ->delete($id);

    }

    /**
     * Gets the add subcategories.
     *
     * @param      <type>  $id     The identifier
     */

    public function getAddSubcategories($id){

        $listCategory = Categorys::select('id','name','type','parent_id','created_at','updated_at')->where('id',$id)->get();

        if(!empty($listCategory)){

            foreach($listCategory as $category){

                if($category->parent_id != 0){

                    $listNameParent = Categorys::select('name')->where('user_id',Auth::user()->id )->where('id',$category->parent_id)->get();

                    $category ->nameParent = $listNameParent[0]->name;

                }else{

                    $category ->nameParent = "";
                }
            }

        }
        return view('quanlytaichinh.categorys.addSubcategories',compact('listCategory'));

    }

    /**
     * Posts add subcategories.
     *
     * @param      <type>  $id     The identifier
     */
    public function postAddSubcategories(CategoryRequest $request){

        $category            = new Categorys;
        $category->name      = $request->name;
        $category->type      = $request->type;
        $category->parent_id = $request->parent_id;
        $category->user_id   = Auth::user()->id;
        $category ->save();

        return redirect('categorys/getList')->with(['flash_level'=>'success','flash_message'=>"Add category successfully !!!"]);
    }




}
