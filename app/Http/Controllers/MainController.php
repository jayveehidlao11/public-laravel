<?php

namespace App\Http\Controllers;

use App\Models\MainModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Mail;
class MainController extends Controller
{
  
    public function login(Request $request){
         $request->validate([
            'user_id' => 'required',
            'password' => 'required',
         ]);
        
         $user_role = User::where('user_id','=',$request->user_id)->first();
         
         //applicant
         
         if( $user_role && ($user_role->role == 'applicant')){
            $user = MainModel::where('email','=',$user_role->email)->first();
           if(Hash::check($request->password,$user_role->password)){
                $request->session()->put('loginID',$user_role->user_id); 
                $request->session()->put('applicantID',$user->id);
                return redirect('/applicant');
           }else{
            return back()->with('fail','Password not matched!!');
           }
         }
         //admin
         else if($user_role && ($user_role->role == 'admin')){
            if(Hash::check($request->password,$user_role->password)){
                $request->session()->put('loginID',$user_role->user_id); 
                
                return redirect('/admin');
           }else{
            return back()->with('fail','Password not matched!!');
           }
         }
         //invalid cridentials
         else{
            return back()->with('fail','This cridentials is not registered'); 
         }
    }
    public function register(Request $request){
        $email = MainModel::where('email','=',$request->email)->first();
        $lastname = MainModel::where('lastname','=',$request->lastname)->first();
        $firstname = MainModel::where('firstname','=',$request->firstname)->first();
    //    $request->validate([
    //         'firstname' =>'required',
    //         'lastname' =>'required',
    //         'middlename' =>'required',
    //         'email' =>'required',
    //         'phonenumber' =>'required',
    //         'gender' =>'required',
    //         'birthday' =>'required',
    //         'age' =>'required',
    //         'birthplace' =>'required',
    //         'address' =>'required',
    //         'postalcode' =>'required',
    //         'password' =>'required',
    //         'agreement' =>'required',
    //    ]);
        $fullname = $request->firstname.' '.$request->middlename.' '.$request->lastname;
       
     
       
       
        if($lastname && $firstname)
        {
            return back()->with('Name','Your name is already registered!');
           
        }else if($email)
        {
            return back()->with('Email','Email is already used!');
        }else if(($lastname && $firstname) && $email ){
            return back()->with('EmailAndName','Name and Email is already registered!');
        }

      //stop error from occuring
        // if(!empty($request->all()) ){
        //     return back();
        // }
           
        
        $isEmpty = MainModel::count();
        $added_id = 0; 
        if($isEmpty == 0){
            $added_id = 1;
            $latestID = 00001;
            $applicationID = '2022A'.$latestID;
        }
        else{
            $latest = MainModel::all()->last()->id;
            $latestID = $latest + 00001;
            $added_id = $latest + 1;
            $applicationID = '2022A'.$latestID;
        }
        $create = MainModel::create([
            'id' => $added_id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename'=>$request->middlename,
            'email' =>$request->email,
            'phonenumber' =>$request->mobile,
            'gender' =>$request->gender,
            'birthday' =>$request->dob,
            'age' => $request->agevalue,
            'birthplace' => $request->bplace,
            'address' => $request->address,
            'postalcode' =>$request->postal,
            'password' =>Hash::make($request->password),
            'agreement' =>$request->agreement
        ]);
       
        User::create([
            'user_id'=>$applicationID,
            'name' =>$fullname,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
            'role' => 'applicant',
        ]);

        // $data = array('name'=>"Virat Gandhi");
   
        // Mail::send(['text'=>'mail'], $data, function($message) {
        //    $message->to('jayveehidlao11@gmail.com', 'Tutorials Point')->subject
        //       ('Laravel Basic Testing Mail');
        //    $message->from('hidlaojayvee18@gmail.com','Virat Gandhi');
        // });
        Alert::success('Registered','Successfully Registered!');
        return redirect('/login');

    }
    public function logout(){
      
        if(Session::has('loginID')){
       
            Session::pull('loginID');
            return redirect('login');
        }
    }
}
