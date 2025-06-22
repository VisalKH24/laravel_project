<?php

namespace App\Http\Controllers\BackendController;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function viewCate(){
        $select=Category::query()
                ->orderBy('id','DESC')
                ->get();
        return view('backend.viewCategory',compact('select'));
    }
    public function addCategory(){
        return view('backend.addCategory');
    }
    public function addCateSubmit(Request $request){
            $btn=$request->input('btn');
            if($btn=='Add Category'){
                $input=$request->all();
                $exists = Category::where('category_name', $input['category_name'])->exists();
                if ($exists) {
                    return redirect('/admin/add-category')->with('error', 'Category name already exists!');
                }
                $insert=Category::create($input);
                if($insert){
                    return redirect('/admin/add-category')->with('message','Add Category Success!');
                }else{
                    return redirect('/admin/add-category')->with('error','Not Success!');
                }
            }else{
                $input=$request->all();
                $update=Category::query()
                        ->where('id',$input['id'])
                        ->update([
                            'category_name'=>$input['category_name'],
                        ]);
                if($update){
                    return redirect('/admin/list-category')->with('message','Update Category Success!');
                }
            }



    }
    public function editCate(Category $category){
        $select=Category::query()
                ->where('id',$category->id)
                ->first();
        return view('backend.addCategory',compact('select'));
    }
    public function deleteCate(Request $request){
        $input=$request->all();
        $delete=Category::query()->where('id',$input['remove-id'])->delete();
        if($delete){
            return redirect('/admin/list-category')->with('message','Delete Category Success!');
        }
    }
}
