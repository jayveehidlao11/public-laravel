@extends('admin.index')

@section('content')
<div class="logo text-center">
    <h1>Create Admin Account</h1>
  </div>
<div class="registration-form">
    <form action="{{ route('createAdmin') }}" id='registeradmin'>
        <div class="form-icon">
            <span><i class="icon icon-user"></i></span>
        </div>
        <div class="form-group">
            <input type="text" name="name" class="form-control item" id="name" placeholder="FullName">
        </div>
       
        <div class="form-group">
            <input type="text" name="email" class="form-control item" id="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password" class="form-control item" id="password" name="password" placeholder="Password">
        </div>
         <div class="form-group">
            <input type="password" class="form-control item" id="cpassword" placeholder="Confirm Password">
        </div>
        {{-- <div class="form-group">
            <input type="text" class="form-control item" id="phone-number" placeholder="Phone Number">
        </div>
        <div class="form-group">
            <input type="text" class="form-control item" id="birth-date" placeholder="Birth Date">
        </div> --}}
        <div class="form-group">
            <button type="submit" class="btn btn-block create-account">Create Account</button>
        </div>
    </form>
   
   

@endsection