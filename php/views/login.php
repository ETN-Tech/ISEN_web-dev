<div class="content">
    <h2>Account login</h2>

    <?php if(isset($error)){ echo '<p class="alert alert-danger">'. $error .'</p>'; } ?>

    <form action="" method="post" class="col-4">
        <div class="form-group">
            <label for="username">Username</label><br>
            <input class="form-control" type="text" name="username" id="username" autofocus autocomplete="off">
        </div>
        <div class="form-group">
            <label for="password">Password</label><br>
            <input class="form-control" type="password" name="password" id="password">
        </div>
        <input type="submit" class="btn btn-info" name="form-login" value="Login">
    </form>
</div>
