<?php
include_once "header.php"
?>

<div class="main-div">
    <form action="includes/signup.inc.php" method="post">
        <label for="name">Name</label>
        <input name="name" type="text" class="input">
        
        <label for="username">Username</label>
        <input name="username" type="text" class="input">
        
        <label for="password">Password</label>
        <input name="password" type="password" class="input">
        
        <label for="repassword">Re-enter Password</label>
        <input name="passwordRepeat" type="password" class="input">
        
        <button name="submit" type="submit">Sign up</button>
    </form>    
</div>


</body>
</html>