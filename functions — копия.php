<?php
include_once "index.php";
include_once "config.php";
/**
 * @param $city - просто пришедшие данные
 * @return bool|string
 * формирование новой ссылки с учетом того, что у нас именился город
 */
function getNewLink($city){
    $currentCoordinates=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?' .http_build_query(['address='=>$city?$city:'Odessa'.'&key=AIzaSyAx9GeZs8eRi3uWzPXajCTR7r32kYxVqB0']));
    $locationData=json_decode($currentCoordinates);
    var_dump($locationData);
    $coordinates = $locationData->results[0]->geometry->location;
    $coordinates = $coordinates->lat.','.$coordinates->lng;
    var_dump($coordinates);
    $currentCity=json_decode(file_get_contents('https://api.darksky.net/forecast/a465da47c747a94787858c2e3abe6283/'.$coordinates));
    return $currentCity;
}

function print_arr($array){
  echo "<pre>".print_r($array,true)."</pre>";
}



