<?php
include 'Data/getDataCurl.php'; // get the needed data using Curl
include 'Data/config.php'; // include app data

session_start();

if (isset($_SESSION['user_info']) or !isset($_SESSION['login'])) { // if user is logged in
    header("location: index.php"); // redirect user to index page
    return false;
}

$code = $_GET['code'];

/* Get User Access Token */

$method = 1; // method = 1, because we want POST method

$url = "https://api.instagram.com/oauth/access_token";

$header = 0; // header = 0, because we do not have header

$data = array(
    "client_id" => $client_id,
    "client_secret" => $client_secret,
    "redirect_uri" => $redirect_uri,
    "grant_type" => "authorization_code",
    "code" => $code
);

$json = 1; // json = 1, because we want JSON response

$get_access_token = getDataUsingCurl($method, $url, $header, $data, $json);

$access_token = $get_access_token['access_token'];

$get = file_get_contents("https://api.instagram.com/v1/users/self/?access_token=$access_token");

$json = json_decode($get, true);

$_SESSION['user_info'] = $json; // save user info in session
$_SESSION['access_token'] = $access_token;
header("location: index.php"); // redirect user to index page

?>