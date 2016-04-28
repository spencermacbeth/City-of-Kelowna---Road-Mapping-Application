<?php
/**
 * connects to db, queries data provided by City
 * @author spencerm nicky jamesr
 * @return array of id/lat/lon/time/plowInfo data for selected time range
 */

/**
 * holds the value for the time range query.
 * @var [int]
 */
$range = $_POST['value'];

$mysqli = connect('cosc304.ok.ubc.ca', 'mjoseph', '15057136', 'db_mjoseph');

function connect($host, $user, $pw, $db_name)
{
    return mysqli_connect($host, $user, $pw, $db_name);
}

#get range of times to query on db based on current time of day then format
date_default_timezone_set('PST8PDT');
$tsNow = mktime(date('H'), date('i'), date('s'), 12, 27, 2015);
$timeBefore = date('Y-m-d H:i:s', $tsNow - (60 * $range));
$timeNow = date('Y-m-d H:i:s', $tsNow);
#create array to store points in and set of query
$pointarr = '';
$sql = "select id, lon, lat, curtime, comment from Data where curtime > '$timeBefore' and curtime < '$timeNow';";
$res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

#fill array with points
if ($res) {
    while ($data = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $pointarr = $pointarr.$data['id'].', '.$data['lat'].', '.$data['lon'].', '.$data['curtime'].', '.$data['comment']."\n";
    }
    echo $pointarr;
} else {
    echo 'Could not retrieve records';
}
