<?php
// written by spencerm
if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] != "" && $_POST['password'] != "") {

    $mysqli = mysqli_connect("cosc304.ok.ubc.ca", "mjoseph", "15057136", "db_mjoseph");

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $sql = "SELECT * FROM admin_user WHERE username = '" . $username . "' AND password = '" . $password . "'";
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    if (mysqli_num_rows($result) == 1) {
            header("Location: importCSV.php");
    }else {
      echo mysqli_num_rows($result);
    }

} else {
    header("Location: userlogin.php");
}
