<?php

namespace App\Http\Controllers\BackendController;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;



class LogoController extends Controller
{
    public function addLogo(){
        return view('backend.add-logo');
    }
    public function listLogo(){
        $logo=Logo::query()
                ->orderBy('id','DESC')
                ->get();
        return view('backend.list-logo',compact('logo'));
    }
    // public function addLogoSubmit(Request $request){
    //     $input=$request->all();
    //     $request->validate([
    //         // 'logo'=>'required'
    //     ]);
    //     if(($request->hasFile('logo'))){
    //         $file=$request->file('logo');
    //         $filename=date('ymdhis').'_'.$file->getClientOriginalName();
    //         $file->move('images',$filename);
    //         $input['logo']=url('images/'.$filename);

    //     }else{
    //         $input['logo']=$request->old_image;
    //     }
    //     $btn=$request->btn;
    //     if($btn=='Add Logo'){
    //         $insert =Logo::create($input);
    //         return redirect('/admin/add-logo')->with('success','Product Added Successfully');
    //     }else{

    //         $id=$request->id;
    //         $update=Logo::query()->where('id',$id)->update($input);
    //         return redirect('/admin/list-logo')->with('success','Product Updated Successfully');
    //     }
        

    // }
    public function addLogoSubmit(Request $request)
{
    // Only get the relevant input
    $input = $request->except(['_token', 'btn', 'id', 'old_image']);

    // Validation
    $request->validate([
        'logo' => $request->btn === 'Add Logo' ? 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable',
    ]);

    // Handle file upload
    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $filename = date('ymdhis') . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);
        $input['logo'] = url('images/' . $filename);
    } else {
        $input['logo'] = $request->old_image ?? null;
    }

    // Add or update based on button
    if ($request->btn === 'Add Logo') {
        Logo::create($input);
        return redirect('/admin/add-logo')->with('success', 'Logo Added Successfully');
    } else {
        Logo::where('id', $request->id)->update($input);
        return redirect('/admin/list-logo')->with('success', 'Logo Updated Successfully');
    }
}

    public function editLogo(Logo $logo){

        return view('Backend.add-logo',compact('logo'));
    }
   
    // public function deleteLogo(Request $request){
    //     $id=$request->remove_id;
    //     $delete=Logo::query()->where('id',$id)->delete();
    //     if($delete){
    //         return redirect('/admin/list-logo')->with('success','Product Deleted Successfully');
    //     }
    //     return redirect('/admin/list-logo')->with('error','Something went wrong');
    // }
    public function deleteLogo(Request $request)
{
    $id = $request->remove_id;

    $logo = Logo::find($id);
    if (!$logo) {
        return redirect('/admin/list-logo')->with('error', 'Logo not found');
    }

    // If you store logo images, optionally delete the file from storage
    // Storage::delete('images/' . $logo->logo);

    $delete = $logo->delete();

    if ($delete) {
        return redirect('/admin/list-logo')->with('success', 'Logo deleted successfully');
    }

    return redirect('/admin/list-logo')->with('error', 'Something went wrong');
}

   
}
