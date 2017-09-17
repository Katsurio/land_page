<?php include "db.php"; ?>
<?php


function encryptPassword($pass)
{
//    $hashFormat = "$2y$10$";                  // This
//    $salt = "iusedsomecrazystrings23";        // is
//    $hashF_and_salt = $hashFormat . $salt;    // deprecated
//    return crypt($pass, $hashF_and_salt);     // as of PHP 7
    return $pass = password_hash($pass, PASSWORD_DEFAULT);
}

function UpdateRow()
{
    if (isset($_POST['submit'])) {
        global $conn;
        $username = $_POST['username'];
        $password = $_POST['password'];
        $id = $_POST['id'];

        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        $password = encryptPassword($password);

        $query = "UPDATE users SET ";
        $query .= "username = '$username', ";
        $query .= "password = '$password' ";
        $query .= "WHERE id = $id ";

        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query FAILED" . mysqli_error($conn));
        } else {
            echo "Record updated.";
        }
        mysqli_close($conn);
    }
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

function ReadData()
{
    global $conn;
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query FAILED' . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $username = $row['username'];
        $password = $row['password'];

        echo "<tr>
                <td>$id</td>
                <td>$username</td>
                <td>$password</td>
             </tr>";
    }
    mysqli_close($conn);
}


function ShowALLData()
{
    global $conn;
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('Query FAILED' . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        echo "<option value='$id'>$id</option>";
    }
    mysqli_close($conn);
}


function DeleteRow()
{
    if (isset($_POST['submit'])) {
        global $conn;
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        $id = $_POST['id'];

        $query = "DELETE FROM users ";
        $query .= "WHERE id = $id ";

        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query FAILED" . mysqli_error($conn));
        } else {
            echo "Record deleted . ";
        }
        mysqli_close($conn);
    }
}

?>