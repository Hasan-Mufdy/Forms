<?php

function emptyInputSignup($name, $username, $password, $passwordRepeat){
    $result;
    if(empty($name) || empty($username) || empty($password) || empty($passwordRepeat)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function invalidUserName($username){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/" , $username)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function passwordMatch($password, $passwordRepeat){
    $result;
    if($password !== $passwordRepeat){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function usernameExists($conn, $username){
    $sql = "SELECT * FROM users WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);   //s --> string // if 2 --> "ss" and so on
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){  //if i get data:   result = true
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);

}

function createUser($conn, $name, $username, $password){
    $sql = "INSERT INTO users (usersName, usersUid, usersPwd) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $username, $username, $hashedpassword);   
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../signup.php?error=none");
    exit();

}

/////////////////////////////////////////////////////  log in page
function emptyInputLogin($username, $password){
    $result;
    if(empty($username) || empty($password)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $password){
    $usernameExists = usernameExists($conn, $username);
    if($usernameExists === false){
        header("location: ../login.php?error=wrongcredentials");
        exit();
    }

    $hashedpasswordDB = $usernameExists["usersPwd"];  // usersPwd column from the db
    $checkpassword = password_verify($password, $hashedpasswordDB);

    if($checkpassword === false){
        header("location: ../login.php?error=wrongcredentials");
        exit();
    }
    else if($checkpassword === true){
        session_start();
        $_SESSION["userid"] = $usernameExist["usersID"];
        $_SESSION["useruid"] = $usernameExist["usersUid"];
        header("location: ../index.php");
        exit();
        
    }

    
}