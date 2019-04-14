<?php 
$DB_SERVER = "wordpressdb.cfkyixhewlor.ap-southeast-2.rds.amazonaws.com";
$DB_USER = "smart_mobile";
$DB_PASSWORD = "&e3|MnuQYXQM";
$DB = "smart_mobile_production";

$conn = mysqli_connect("$DB_SERVER","$DB_USER","$DB_PASSWORD","$DB");

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
