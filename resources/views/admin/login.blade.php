<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <title>PIM | Login</title>
</head>
<body>
    
    <div class="row contain">
        <div class="col-4 left">
            <img style="width: 70%;" src="{{ asset('img/shield.svg') }}" alt="">
        </div>
        <div class="col-8 col-md-8 col-sm-12 head">
            <div class="row logo">
                <p>PIM</p>
            </div>
            <div class="row alerts">

            </div>
                <div class="row justify-content-center mb-3">
                    <h3 class="font-weight-bold">Welcome back!</h3>
                </div>
                <div class="row form mw-100">
                    <form class="w-50" id="loginForm" enctype="multipart/form-data">
                        @csrf 
                        <div class="form-group">
                          <label for="exampleInputEmail1">Phone Number</label>
                          <input type="text" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                       
                        <button type="submit" class="btn btn-primary w-100 mt-3 mb-3">Login</button>
                       
                      </form>

                </div>
          
           
            
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>