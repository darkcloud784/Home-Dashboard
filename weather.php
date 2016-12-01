<?php

include ('config.php');
include('forecast.io.php');
$errors = [];

function weather() {
    global $cfg_array;
    global $errors;
    $api_key = $cfg_array['weather_key'];
    $latitude = $cfg_array['latitude'];
    $longitude = $cfg_array['longitude'];
    $units = 'auto';
    $lang = 'en';
    $forecast = new ForecastIO($api_key, $units, $lang);
    $condition = $forecast->getCurrentConditions($latitude, $longitude);
    if ($condition) {
        return array($condition->getSummary(), $condition->getIcon(), $condition->getTemperature(), $condition->getApparentTemperature());
    }
    array_push($errors, "Error fetching weather. " . error_get_last()['message']);
    return array("Error fecthing weather", "rain", "0", "0");
}
