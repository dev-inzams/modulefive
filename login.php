<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // data File data
    $ids = [];
    $usernames = [];
    $emails = [];
    $roles = [];
    $passwords = [];

    // DATA FILE
    $getdata = fopen("./data.txt","r");

    // all data store
    while ($line = fgets($getdata)) {
        $value = explode(' ', $line);
        $ids []= trim($value[0]);
        $usernames []= trim($value[2]);
        $emails []= trim($value[3]);
        $roles []= trim($value[1]);
        $passwords []= trim($value[4]);
    }
    fclose($getdata);
    
    for($i=0; $i<count($roles); $i++){
        if($emails[$i] == "$email" && $passwords[$i] == "$password"){
            $_SESSION['isUserLogedIn']=true;
            $_SESSION['role'] = $roles[$i];
            $_SESSION['username'] = $usernames[$i];
            $_SESSION['email'] = $emails[$i];
            if($_SESSION['role'] == "admin"){
                header("location: ./role_management.php");
            }else{
                header("location: ./index.php");
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="container">
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input class="form-control" type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input class="form-control" type="password" id="password" name="password" required><br><br>

        <input class="btn btn-info" type="submit" value="Login">
    </form>
    <a class="btn btn-warning mt-2" href="./registration.php">Registration</a>

    <div class="container">
        <div class="row">
            <div class="col-6">
                <h2>User Login info</h2>
                <p>Email: <strong>php@gmail.com</strong></p>
                <p>Password: <strong>1234</strong></p>
            </div>
            <div class="col-6">
                <h2>Admin info</h2>
                <p>Email: <strong>inzams.hp@gmail.com</strong></p>
                <p>Password: <strong>1234</strong></p>
            </div>
        </div>
    </div>
</body>
</html>