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
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        $password = encryptPassword($password);

        $query = "INSERT INTO users(username, password) ";
        $query .= "VALUES ('$username', '$password')";

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