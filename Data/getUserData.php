<?php
include 'getDataCurl.php'; // get the needed data using Curl
include 'config.php'; // include app data

session_start();

$session_data = $_SESSION;
$user_id = $session_data['user_info']['data']['id'];
$access_token = $session_data['access_token'];

$method = 0; // method = 1, because we want GET method

$url = "https://api.instagram.com/v1/users/$user_id/media/recent/?access_token=$access_token";

$header = 0; // header = 0, because we do not have header

$data = 0; // because we want GET method


$json = 0; // json = 1, because we want JSON response

$json_data = getDataUsingCurl($method, $url, $header, $data, $json);

$get_recent_media = json_decode($json_data);
