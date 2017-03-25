<p class="text-danger"><?php echo $loginErr;?> 
</p>
<form id="login" action="index.php" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control" type="text" id="username" name="username" />
    </div>
    <div class="form-group">
        <label for="username">Password</label>
        <input class="form-control" type="password" id="password" name="password" />
    </div>
    <br>
    <input class="btn btn-default" type="submit" name="login" value="Login" />
    <input class="btn btn-default" type="submit" name="register" value="Register" />
</form>