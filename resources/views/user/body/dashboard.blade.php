@extends('user.index')

@section('content')
    

<div class="header">
    Announcements
  </div>
  
  <div class="row">

    
    <div class="leftcolumn">
      @foreach ($anc as $a)
          
      
      <div class="card">
        <h2>{{ $a->title }} </h2>
        <h5>Title description, Dec 7, 2017</h5>
        <div class="slideshow-container">
          @php
          $image =  explode('|',$a->file);
          @endphp
           @foreach ($image as $item)
            
              
              <img class="display"  src="{{ URL::to($item)}}" >
              
         
            @endforeach
            {{-- <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            <div style="text-align:center">
              <span class="dot" onclick="currentSlide(1)"></span>
              <span class="dot" onclick="currentSlide(2)"></span>
             
            </div> --}}
        </div>
        
        <p>{{ $a->content }}</p>
       </div>
      @endforeach
      
    </div>
</div> 
  
  
  
@endsection