@extends('admin.index')

@section('content')
{{-- <button class="button-29" role="button">Create Announcement</button> --}}
<div class="space">
    space
</div>

<div class="create-announcement">
  @if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <div class="row">
    <div class="col-sm-12" style="text-align: center; font-size:30px">
      <label>Create Announcement</label>
    </div>
  </div>
 <!-- --> 
 <form method="post" action="{{ route('upload-announce')}}" enctype="multipart/form-data">
  @csrf
  <div class="row">
   
 <!-- --> 
    <div class="col-sm-1" style="text-align:center;font-size:20px;margin-top:5px" >
      <label for='title'>Title</label>
    </div>
    <div class="col-sm-11" style="margin-top:5px">
      <input type='text' id='title' name="title" style="width:100%;" value="{{ old('title') }}"/> 
    </div>

    {{-- <div class="col-sm-1" style="font-size:20px;margin-top:5px">
      <label for='date'>Date </label>
    </div>
    <div class="col-sm-3" style="margin-top:5px">
      <input type='date' id='date' name='announcementData' />
    </div> --}}
  </div>
  <div class="row">
    <div class="col-sm-12" style="font-size:20px;margin-left:20px;">
      <label>Content</label>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12" style="margin-left:20px;">
      <textarea style=" width:98%;height:100px;" name='content' >{{ old('content')}}</textarea>
    </div>
  </div>

  <div class="input-group control-group increment" style="margin-top:10px;" >
    <input type="file" name="filename[]" multiple class="form-control">
    <div class="input-group-btn"> 
      {{-- <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button> --}}
    </div>
  </div>

<!-- HIDDEN CLONE -->

 {{-- <div class="clone hide">
  <div class="control-group input-group" style="margin-top:10px">
    <input type="file" name="filename[]" class="form-control">
    <div class="input-group-btn"> 
      <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
    </div>
  </div>
</div>  --}}

<!-- -->

  <div class="row">
    <div class="col-sm-12" style="text-align: center;margin-top:20px;">
      <button type='submit' class='btn-dark' style="width:100%; cursor: pointer;">Submit</button>
    </div>
  </div>

</form>
  
</div>
<!-- DISPLAY ANNOUNCEMENTS -->
<div class="announcements">
  <table>
    
    @foreach ($anc as $a)
        @php
            $image =  explode('|',$a->file);
        @endphp
    {{-- <img src="{{ URL::to($anc)}}" /> --}}
      <tr>
        <tr>
          @foreach ($image as $item)
              
         
          <th rowspan=5 style="width:50%"><img src="{{'/'.$item}}" alt="Image" style="display:block;" width="100%" height="100%" /></th>
          @endforeach
          <td><b>Title :</b>{{ $a->title }}</td>
        </tr>
  
        <tr>
          <td style="font-size:20px"><b>Content : </b>{{ $a->content }}</td>
        </tr>
        <tr>
          <td>Date</td>
        </tr>
        <tr>
          <div class="btn-group btn-group-justified">
            <td>
              <a class='btn btn-primary' id='edit-annc' href={{ url("/admin/editannouncement/".$a['id']) }}>Edit</a>
              <button class='btn btn-danger' action={{ "/admin/deleteAnnouncement/".$a['id'] }} onclick="destroyData(this)">Delete</button>
       
            </td>
         </div>
        </tr>
     
       </tr>
   
       @endforeach
    </table>

</div>

@endsection