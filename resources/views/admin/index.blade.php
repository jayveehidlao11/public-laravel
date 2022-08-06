<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Admin</title> 
      <link rel="stylesheet" href="{{ asset('css/admin/adminRegister.css')}}">
      <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
      <link rel='stylesheet' href="{{ asset('css/admin/application.css') }}">
      <link rel="stylesheet" href="{{ asset('css/admin/announcement.css')}}">

      <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="{{asset('js/sidebar.js')}}"></script>
      <script src="{{ asset('js/admin/adminRegister.js')}}"></script>
      <script src="{{ asset('js/admin/application.js')}}"></script>
      <script src="{{ asset('js/admin/announcement.js')}}"></script>
      <link rel='stylesheet' href="{{ asset('css/navbar.css')}}">
   </head>
   <body style="background-color:rgb(210, 210, 210);">

    
        <!-- Lets start making our side navigation menu -->

      <!-- now lets add a hamburger btn -->
      <span class="material-icons-outlined" id="ham">
        menu
        </span>

    <div class="side-nav">

      
        <span class="material-icons-outlined" id="close">
            close
            </span> 
        <header> <a class="navbar-brand" href="{{ url('/admin') }}">Admin</a></header>
        <ul>
            {{-- <a href="#" class="active">
                <li><span class=" material-icons-outlined">
                        home
                    </span> <span class="menu">Home</span> </li>
            </a> --}}
            
            <a href="#">
                <li><span class="material-icons-outlined">
                        dashboard
                    </span><span class="menu">Dashboard</span></li>
            </a>
            <a href="{{ url('/admin/application')}}">
                <li><span class="material-icons-outlined">
                        table_view
                    </span><span class="menu">Application</span></li>
                    
            </a>
            <a href="{{ url('/admin/announcement') }}">
                <li><span class="material-icons-outlined">
                        announcement
                    </span><span class="menu">Announcement</span></li>
            </a>
            <a href="{{ url('/admin/admin-reg')}}">
                <li><span class="material-icons-outlined">
                        manage_accounts
                    </span><span class="menu">User Accounts</span></li>
            </a>
            
        
            <a href="#">
                <li><span class="material-icons-outlined">
                    account_circle
                    </span><span class="menu">Account</span></li>
            </a>
         <a action="{{ url('/logout') }}" onclick="destroyData(this)" style="color:White;cursor: pointer;">
                <li><span class="material-icons-outlined">
                        logout
                    </span><span class="menu">Logout</span></li>
            </a>

        </ul>
        
        
    </div>

    
    @yield('content')
   </body>
</html>