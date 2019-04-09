<?php 
/*$DB_SERVER = $_SERVER['DB_HOST'];
$DB_USER = $_SERVER['DB_USER'];
$DB_PASSWORD = $_SERVER['DB_PASSWORD'];
$DB = $_SERVER['DB_NAME'];*/

$conn = mysqli_connect($_SERVER['DB_HOST'], $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD' , $_SERVER['DB_NAME']);

function get_timezone_offset($remote_tz, $origin_tz = null) {
    if($origin_tz === null) {
        if(!is_string($origin_tz = date_default_timezone_get())) {
            return false; // A UTC timestamp was returned -- bail out!
        }
    }
    $origin_dtz = new DateTimeZone($origin_tz);
    $remote_dtz = new DateTimeZone($remote_tz);
    $origin_dt = new DateTime("now", $origin_dtz);
    $remote_dt = new DateTime("now", $remote_dtz);
    $offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);
    return $offset;
}
?>
