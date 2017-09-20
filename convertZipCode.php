<?php include "db.php"; ?>
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

function getLatLngCoords($zcode){
    $url = "http://maps.googleapis.com/maps/api/geocode/json?address=
".urlencode($zcode)."&sensor=false";
    $result_string = file_get_contents($url);
    $result = json_decode($result_string, true);
    $result1[]=$result['results'][0];
    $result2[]=$result1[0]['geometry'];
    $result3[]=$result2[0]['location'];
    return $result3[0];
}

$latlng = getLatLngCoords($zcode);
$lat = $latlng['lat'];
$lng = $latlng['lng'];

    $query = "INSERT INTO users(fname, lname, email, lat, lng) "; // TODO: Add lat and lng after
    $query .= "VALUES ('$fname', '$lname', '$email', '$lat', '$lng')";

    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('Query FAILED: ' . mysqli_error($conn));
    } else {
        echo "Record created.";
    }
    mysqli_close($conn);

?>