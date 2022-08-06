<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainModel;
use App\Exports\ApplicantListExport;
use App\Imports\ImportList;
use Excel;
use PDF;
use Alert;
use App\Models\Announcement;
use App\Models\User;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function listOfApplicant(){
        $app = MainModel::all();
        $appNo = User::all();
        return view('admin.body.application',['app'=>$app]);
    }

    public function displayPDF(){
        $data = MainModel::all();
        return view('admin.export.body.pdfbody',['data'=>$data]);
    }
    public function exportfile(Request $request){
        
        if($request->input('exportFile') == 'csv'){
                
            return Excel::download(new ApplicantListExport,'ListofApplicants.csv');
        }else if($request->input('exportFile') =="pdf"){
            $data = MainModel::all();
            $pdf = PDF::loadView('admin.export.body.pdfbody',compact('data'));
            return $pdf->download('ListofApplicants.pdf');
           
        }else{
            
             return Excel::download(new ApplicantListExport,'ListofApplicants.xlsx');
        }
    }
    public function importfile(Request $request){
         $import = Excel::import(new ImportList,$request->file('file'));
            
            return back()->with('success','Successfully Imported');
      
    }
    public function announcement(Request $request){
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);


        if($request->hasfile('filename'))
         {
            $image = array();
            if($files = $request->file('filename')){
                foreach($files as $file){
                    $image_name = md5(rand(1000,10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name.'.'.$ext;
                    $upload_path = 'images/';
                    $image_url = $upload_path.$image_full_name;
                    $file->move($upload_path,$image_full_name);
                    $image[] = $image_url;
                }
            }
            Announcement::insert([
                'title' =>$request->title,
                'file' =>implode('|',$image),
                'content' =>$request->content,
            ]);

            return back();
        }
    }   
        //     foreach($request->file('filename') as $image)
        //     {
        //         $name=$image->getClientOriginalName();
        //         $image->move(public_path().'/images/', $name);  
        //         $data[] = $name;  
        //     }
        //  }
    

        //  $form= new Announcement();
        //  $form->title = $request->title;
        //  $form->file=json_encode($data);
        //  $form->content = $request->content; 
        
        // $form->save();

        // return back()->with('success', 'Your images has been successfully');

   
    public function displayAnnouncements(){
        $image = Announcement::all();
   //    $images = explode('|',$image->file);
       
      return view('admin.body.announcement',['anc'=>$image]);
    }
   
    public function deleteAnnouncement($id){
     
        
        $data = Announcement::find($id);
        $files = $data->file;
        $image = explode('|',$files);
        foreach ($image as $a) {
          
           Storage::delete("/".$a);
        }
        $data->delete();
        return back();
    }
    public function createAdmin(Request $request){

    
        $latest = MainModel::all()->last()->id;
          $user_admin = User::where('role','=','admin')->count();
        $isEmpty = User::count();
        $latestID = $user_admin + 00001;
        $adminID = '2022ADMIN'.$latestID;
     //   dd($user_admin);
       $admin = User::create([
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
            'role' => 'admin',
        ]);
        return back();
    }
    public function showEdit( $id){
        $edit = Announcement::find($id);
        return view('admin.body.editAnnouncement',['edit'=>$edit]);
    }
    public function deleteImage($id,$image){
        $del = Announcement::find($id);
        $newlink = str_replace('images','',$del->file);
        $updatedfile = str_replace('|images/'.$image,'',$del->file);
        
        //$image = MainModel::where('id','=',$id)->first();
        //$image = MainModel::delete('')
        if(substr_count($del->file,'images') == 1){
            Storage::delete("/images/".$newlink);
            $del->file = "";
            $del->update();
            return back();
        }else{
            Storage::delete("/images/".$newlink);
            $del->file = $updatedfile;
            $del->update();
            return back();
        }
       
       
       
      


    }
    public function updateAnnouncement(Request $request,$id){

        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
        $annc = Announcement::find($id);

        $currentfile = $annc->file;

        if($request->hasfile('filename'))
         {
            $image = array();
            if($files = $request->file('filename')){
                foreach($files as $file){
                    $image_name = md5(rand(1000,10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name.'.'.$ext;
                    $upload_path = 'images/';
                    $image_url = $upload_path.$image_full_name;
                    $file->move($upload_path,$image_full_name);
                    $image[] = $image_url;
                }
            }

       
            if($annc->file == "")
            {
                $currentfile .= implode('|',$image);
            }
            else{
                $currentfile .= '|'. implode('|',$image);
            
            }
        
        
         }
         $annc->title = $request->title;
        $annc->content = $request->content;
        $annc->file = $currentfile;
        $annc->update();
        return redirect('/admin/announcement');
    }
}
