<?php

  if($_GET['city']){
  
    $urlContents= file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=". urlencode($_GET['city']). "&appid=4ac41abc5da06ed796677c885fdf47af");
    
    $weatherArray= json_decode($urlContents,true);
      
    if($weatherArray['cod']== 200){
      
      $weather="The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."' . ";

      $temp=intval($weatherArray['main']['temp'] -273);
 
      $weather .= "<br>The temperature is ".$temp."&deg;c .";
      
      $wind= $weatherArray['wind']['speed'];

      $weather .="<br>Wind speed is ".$wind." km/h .";
    }
    else{
      $error="Invalid City";  
    }
  }

?>

<!doctype html>
<html lang="en">
  <head>   
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style type="text/css">
   
    body{
      background-color:#f7f7f7b3;

    }
    h1{
      
      text-align:center;
      margin-top: 100px;
    }
    .container{
      background:white;
      border-radius:10px;
      box-shadow: 0 4px 4px rgba(0,0,0,.12),0 4px 4px rgba(0,0,0,.24);
      text-align:center;
      margin-top:100px;
      max-width:700px;
      border:0.01px inset gray !important;
    }
     
    .form-group{
      text-align:center;
      width: 95%
    }

    input{
      margin:20px;
    }

  </style>
 
  <title>Weather Scrapper</title>

</head>
<body>
  <div class="container">  

    <h1>What's the weather?</h1>

    <form>
      <div class="form-group">
        <label for="city">What is your city?</label>
        <input type="text" class="form-control" id="city" name="city" placeholder="Eg: London OR Tokyo">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <br><br>
    </form>

    <div id="weather"><?php
      if($weather){
        echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
      }
      if($error){
        echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
      }
    ?>

  </div>  
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>