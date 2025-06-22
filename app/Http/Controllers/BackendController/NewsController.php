<?php

namespace App\Http\Controllers\BackendController;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function addNews(Request $request){
        return view('backend.add-news');
    }
    // public function listNews(Request $request){
    //     $news=News::query()
    //                 ->orderBy('id','DESC')
    //                 ->get();
    //     return view('backend.list-news',compact('news'));
    // }
    // public function editNews(News $news){
    //     $getNews=News::query()
    //             ->select('news.*')
    //             ->where('news.id',$news->id)
    //             ->first();
    //     $news=News::query()->get();
    //     return view('backend.add-news',compact('news'));

    // }
    public function listNews()
    {
        $news = News::orderBy('id', 'DESC')->paginate(7);
        return view('backend.list-news', compact('news'));
    }

    public function editNews(News $news)
    {
        return view('backend.add-news', compact('news'));
    }

    public function addNewsSubmit(Request $request)
    {
        // Validate input
        $input = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Handle file upload
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = date('ymdhis') . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $input['thumbnail'] = url('images/' . $filename);
        } else {
            $input['thumbnail'] = $request->old_image ?? null;
        }

        // Add or Update
        if ($request->btn === 'Add News') {
            News::create($input);
            return redirect('/admin/add-news')->with('success', 'News Added Successfully');
        } else {
            News::where('id', $request->id)->update($input);
            return redirect('/admin/list-news')->with('success', 'News Updated Successfully');
        }
    }
    public function deleteNews(Request $request)
    {
        $id = $request->remove_id;
        $delete = News::where('id', $id)->delete();
        if ($delete) {
            return redirect('/admin/list-news')->with('success', 'News Deleted Successfully');
        }
        return redirect('/admin/list-news')->with('error', 'Something went wrong');
    }

    
   
    // public function addNewsSubmit(Request $request){
    //     $input=$request->all();
    //     $input=$request->validate([
    //         'title' => 'required',
    //         'description'=> 'required',

    //     ]);

    //     if(($request->hasFile('thumbnail'))){
    //         $file=$request->file('thumbnail');
    //         $filename=date('ymdhis').'_'.$file->getClientOriginalName();
    //         $file->move('images',$filename);
    //         $input['thumbnail']=url('images/'.$filename);

    //     }else{
    //         $input['image']=$request->old_image;
    //     }

    //     $btn=$request->btn;
    //     if($btn=='Add News'){
    //         $insert =News::create($input);
    //         return redirect('/admin/add-news')->with('success','Product Added Successfully');
    //     }else{

    //         $id=$request->id;
    //         $update=News::query()->where('id',$id)->update($input);
    //         return redirect('/admin/list-news')->with('success','Product Updated Successfully');
    //     }
    // }
    // public function deleteNews(Request $request){
    //     $id=$request->remove_id;
    //     $delete=News::query()->where('id',$id)->delete();
    //     if($delete){
    //         return redirect('/admin/list-logo')->with('success','Product Deleted Successfully');
    //     }
    //     return redirect('/admin/list-logo')->with('error','Something went wrong');
    // }
}
 // public function addNewsSubmit(Request $request)
    // {
    //     // Validate input
    //     $input = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //     ]);

    //     // Handle file upload
    //     if ($request->hasFile('thumbnail')) {
    //         $file = $request->file('thumbnail');
    //         $filename = date('ymdhis') . '_' . $file->getClientOriginalName();
    //         $file->move('images', $filename);
    //         $input['thumbnail'] = url('images/' . $filename);
    //     } else {
    //         $input['thumbnail'] = $request->old_image ?? null;
    //     }

    //     // Add or Update
    //     if ($request->btn === 'Add News') {
    //         News::create($input);
    //         return redirect('/admin/add-news')->with('success', 'News Added Successfully');
    //     } else {
    //         News::where('id', $request->id)->update($input);
    //         return redirect('/admin/list-news')->with('success', 'News Updated Successfully');
    //     }
    // }

    

