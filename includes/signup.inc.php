<?php

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordRepeat"];

    require_once 'databasehandler.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($name, $username, $password, $passwordRepeat) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if(invalidUserName($username) !== false){
        header("location: ../signup.php?error=invalidusername");
        exit();
    }
    if(passwordMatch($password, $passwordRepeat) !== false){
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if(usernameExists($conn, $username) !== false){      // conn --> we need to make a connection
                                                // to the database to check the usernames
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $username, $password);
                                  
}
else{
    header("location: ../signup.php");
    exit();
}