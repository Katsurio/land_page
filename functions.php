<?php include "db.php"; ?>
<?php

function encryptPassword($pass)
{
    return $pass = password_hash($pass, PASSWORD_DEFAULT);
}


function CreateRow()
{
    if (isset($_POST['submit'])) {
        global $conn;
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $zcode = $_POST['zcode'];

        $fname = mysqli_real_escape_string($conn, $fname);
        $lname = mysqli_real_escape_string($conn, $lname);
        $email = mysqli_real_escape_string($conn, $email);
        $zcode = mysqli_real_escape_string($conn, $zcode);

//        $password = encryptPassword($password);

        $query = "INSERT INTO users(fname, lname, email) "; // TODO: Add lat and lng after
        $query .= "VALUES ('$fname', '$lname', '$email')";

        $result = mysqli_query($conn, $query);
        if (!$result) {
            die('Query FAILED: ' . mysqli_error($conn));
        } else {
            echo "Record created.";
        }
        mysqli_close($conn);
    }
}


?>