<?php
include_once "header.php"
?>

<div class="main-div">
    <form action="includes/login.inc.php" method="post">
        <label for="name">Name</label>
        <input name="username" type="text" id="name" class="input">
        <br>
        <label for="password">Password</label>
        <input name="password" type="password" id="password" class="input">
        <br>
        <button type="reset">clear all</button>
        <br>
        <button type="submit" name="submit">Log In</button>
    </form>    
</div>


</body>
</html>