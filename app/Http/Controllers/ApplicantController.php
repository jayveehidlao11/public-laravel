<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\MainModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ApplicantController extends Controller
{
  
    public function profile(){
        $user_id = session()->get('applicantID');
        $acc = MainModel::find($user_id);
        return view('user.body.account',compact('acc'));
    }
    public function dashboard(){
        $announcement = Announcement::all();
        return view('user.body.dashboard',['anc'=>$announcement]);
    }
   
    public function updateprofile(Request $request,$id){
        $id = session()->get('applicantID');
        
        $this->validate($request,[
            'profilepic.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

       
        if($request->hasfile('profilepic'))
        {
           
            if($files = $request->file('profilepic')){
              
                    $image_name = md5(rand(1000,10000));
                    $ext = strtolower($files->getClientOriginalExtension());
                    $image_full_name = $image_name.'.'.$ext;
                    $upload_path = 'images/';
                    $image_url = $upload_path.$image_full_name;
                    $files->move('images/profilepic',$image_full_name);
                    $image = $image_url;
                
            }
            
            $data = MainModel::find($id);

            $currentpic = str_replace($data->profile_pic,'',$image);
            $data->profile_pic = $image;
            $data->firstname = $request->input('fname');
            $data->lastname =$request->input('lname');
            $data->middlename =$request->input('mname');
            $data->email =$request->input('email');
            $data->birthday =$request->input('bday');
            $data->age =$request->input('age');
            $data->phonenumber =$request->input('phonenumber');
            $data->address =$request->input('address');
            $data->postalcode =$request->input('postal');
            $data->update();
            Alert::success('Updated','Successfully Updated');
            return back()->with('success','Successfully Updated!');
        }
    }
   
}
