<?php

    $weather = '';
    $error = '';
    $var = @$_GET['city'];
    if(isset($_GET['city'])){

        $city = str_replace(' ','',$var);

        $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
        if($file_headers[0] == 'HTTP/1.1 404 Not Found'){
          $error = "The city could not be found";
        }else{
        
        $forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
        $pageArray = explode(' (1&ndash;3 days):</div><p class="location-summary__text"><span class="phrase">',$forecastPage);
        if(sizeof($pageArray) > 1){
        $secondPageArray = explode('</span></p></div><div class="location-summary__item location-summary__item--js is-truncated"><div class="location-summary__heading-with-ext"><h2 class="location-summary__heading">',$pageArray[1]);
        if(sizeof($secondPageArray) > 1){
        $weather = $secondPageArray[0];
        }else{
          $error = "The city could not be found";
        }
        }else{
          $error = "The city could not be found";
        }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

      <title>Weather Scrapper</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      
      <script type="text/javascript" src="http://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=ApNhHKMH1xh6G-kShfEtMCbCHanuL4hJv9rXTZ12xp9Ekt89-wWR_UcMv6ln2a7OWB4ZtIc7nf-9CVhDVKvr6_XbA1ns6H5zrsASD5HrdHM" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="http://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cDovL2NvbXBsZXRld2ViZGV2ZWxvcGVyY291cnNlLmNvbS9jb250ZW50LzYtcGhwLzcuMTMucGhw"/><style type="text/css">
      
      @import url('https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap');

      html { 
          background: url(bg-img.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          }
        
          body {
              color:white;
              background: none;
              font-family: 'Josefin Sans', sans-serif;
          }
          
          .container {
              
              text-align: center;
              margin-top: 100px;
              width: 450px;
              
          }
          
          input {
              
              margin: 20px 0;
              
          }
          
          #weather {
              
              margin-top:15px;
              
          }
         
      </style>
      
  </head>
  <body>
    
      <div class="container">
      
          <h1>What's The Weather?</h1>
          
          
          
          <form>
  <fieldset class="form-group">
    <label for="city">Enter the name of a city.</label>
    <input type="text" class="form-control" name="city" id="city" placeholder="Eg: Delhi, Chennai.." value = "<?php echo @$_GET['city']; ?>">
  </fieldset>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      
          <div id="weather">
          <?php
          if(@$weather){
            echo '<div class="alert alert-success" role="alert">'.$_GET['city'].' - Today\'s Weather Report <br/>'.$weather.'</div>';

          }else if(@$error){
            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';

          }
          ?>
          </div>
      </div>

    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>