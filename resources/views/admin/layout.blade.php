<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>PIM</title>
</head>
<body>

    <div class="container-fluid">
     <div class="row topnav justify-content-center" style="display: none">
      <ul class="nav justify-content-center">
        <li class="nav-item">
          <a class="nav-link" > <i class="fas fa-tachometer-alt tabActive home"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" ><i class="fas fa-database dataTab"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" ><i class="fas fa-cog setting"></i></a>
        </li>
      </ul>
     </div>
        <div class="row xx">
            <div class="col-1 d-flex justify-content-start pr-0 text-center side" style=" height:100vh">
                <nav class="nav flex-column justify-content-center">
                    <a class="nav-link" > <i class="fas fa-tachometer-alt tabActive home"></i></a>
                    <a class="nav-link" ><i class="fas fa-database dataTab"></i></a>
                    <a class="nav-link" ><i class="fas fa-cog setting"></i></a>
                   
                  </nav>
            </div>
            <div class="col-10 pt-5 fatherDiv" style="height:100vh">
               
              @include('admin.home')
            </div>
      </div>
      <div class="spinner-grow text-primary loading" role="status">
        <span class="sr-only">Loading...</span>
      </div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>