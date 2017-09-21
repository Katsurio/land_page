<?php include "db.php"; ?>
<?php include "./owasp-php-filters/sanitize.inc.php"; ?>
<?php
global $conn;
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$zcode = $_POST['zcode'];

$fname = mysqli_real_escape_string($conn, $fname);
$lname = mysqli_real_escape_string($conn, $lname);
$email = mysqli_real_escape_string($conn, $email);
$zcode = mysqli_real_escape_string($conn, $zcode);
$zcode = sanitize_int($zcode);
/**
 * @function - Converts zip code into latitude/longitude.
 * @name - getLatLngCoords
 * @param {$number} $zcode - A number/zip code.
 * @return {Number[]} - Returns an associative array of 2 numbers
 *                      that contain the lat and lng coordinates.
 */
function getLatLngCoords($zcode)
{
    $url = "http://maps.googleapis.com/maps/api/geocode/json?address=
" . urlencode($zcode) . "&sensor=false";
    $result_string = file_get_contents($url);
    $result = json_decode($result_string, true);
    $result1[] = $result['results'][0];
    $result2[] = $result1[0]['geometry'];
    $result3[] = $result2[0]['location'];
    return $result3[0];
}

$latlng = getLatLngCoords($zcode);
$lat = $latlng['lat'];
$lng = $latlng['lng'];

$fname = sanitize_paranoid_string($fname);
$lname = sanitize_paranoid_string($lname);
$email = sanitize_html_string($email);
$email = sanitize_sql_string($email);

$lat = sanitize_float($lat);
$lng = sanitize_float($lng);


$query = "INSERT INTO users(fname, lname, email, lat, lng) ";
$query .= "VALUES ('$fname', '$lname', '$email', '$lat', '$lng')";

$result = mysqli_query($conn, $query);
if (!$result) {
    die('Query FAILED: ' . mysqli_error($conn));
} else {
    echo "Record created.";
}
mysqli_close($conn);

?>