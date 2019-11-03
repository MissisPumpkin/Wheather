<?php
include_once "config.php";
include_once "functions.php";
//define("GOOGLE_API", 'https://maps.googleapis.com/maps/api/geocode/json?address='.$new.'&key=AIzaSyAx9GeZs8eRi3uWzPXajCTR7r32kYxVqB0');
//define("LINK",'https://api.darksky.net/forecast/a465da47c747a94787858c2e3abe6283/'.$coordinates);

//$locationData=json_decode(file_get_contents(GOOGLE_API));
//$coordinates = $locationData->results[0]->geometry->location;
//$coordinates = $coordinates->lat.','.$coordinates->lng;
//var_dump($coordinates);
//define("GOOGLE_API", 'https://maps.googleapis.com/maps/api/geocode/json?address='.$new.'&key=AIzaSyAx9GeZs8eRi3uWzPXajCTR7r32kYxVqB0');

$new=htmlspecialchars($_GET['city']);

if (empty($new)){
    $new ='Odessa';
    $coordinates = '46.4774700,30.7326200';
    var_dump($coordinates);
    $currentWeather=json_decode(file_get_contents('https://api.darksky.net/forecast/a465da47c747a94787858c2e3abe6283/'.$coordinates));
    print_arr($currentWeather);
}elseif (!empty($new)){
    $new = str_replace(' ','+', $new);
    $currentWeather=getNewLink($new);
    print_arr($currentWeather);
}
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
              integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <style type="text/css">
            html {
                background: url(constPartOfCode/background/background6.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            body{
                background: none;
            }
            .container{
                text-align: left;
                margin-top: 40px;
            }
        </style>
        <title>Hello, world!</title>
    </head>

    <body>

        <!-- HEAD PART OF THE SITE INCLUDE IN THE NEXT LINE -->
        <?php include_once "constPartOfCode/header.php" ?>

            <div class="shadow-lg rounded" style="margin: 0 auto; max-width: 320px; background: none; text-align: center">
                <h2>Current weather</h2>
                <h3 class="display-2"><?=round($currentWeather->currently->temperature)?>&deg;</h3>

                <h3 class="lead">Humidity:<?= $currentWeather->currently->humidity*100?>%</h3>

                <p class="lead"><?= $currentWeather->currently->summary?></p>

                <p class="lead"><?= $currentWeather->currently->windSpeed?><abbr title ="miles per hour">MPH</abbr></p>
            </div>

        <div style="text-align: center; margin: 20px;">
            <h4> Weather for nearest 12 hours:</h4>
        </div>

        <?php $i = 0?>
        <?php  foreach($currentWeather->hourly->data as $hour):?>
            <div class="col-12 col-md-3"  style="display: inline-block; border: 2px black; text-align: center; margin-left: 70px; margin-top: 30px;">
                <div class="shadow p-3 mb-4 rounded" style="background; text-align: center; background: transparent;" >
                            <h5><?echo date("g a",$hour->time)?></h5>
                            <p class="lead m-0"><?= round(($hour->temperature-32)/1.8)?>&deg</p>
                            <p class="lead m-0"><?= $hour->icon?></p>
                            <h3 class="lead m-0">
                                <span class="sr-only">Humidity:</span>
                                <?= $hour->humidity*100?>%
                                <abbr title ="Humidity">HMD</abbr></h3>
                            <p class="lead m-0"><?= $hour->windSpeed?><abbr title ="miles per hour">MPH</abbr></p>
                     </div>
                </div>

            <?php $i++?>
            <?php if ($i==12)break;?>
        <?php endforeach;?>

            <!-- For 5 days -->
          <?php include_once "corousel5D.php";?>

        <!--КОНЕЦ ТАБЛИЦЫ-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    </body>

</html>
