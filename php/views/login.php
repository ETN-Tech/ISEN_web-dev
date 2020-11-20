<div class="content">
    <h2 class="mb-4">Account login</h2>

    <?php if(isset($error)){ echo '<p class="alert alert-danger">'. $error .'</p>'; } ?>

    <form action="" method="post" class="col-4">
        <div class="form-group">
            <label class="d-block" for="username">Username</label>
            <input class="form-control" type="text" name="username" id="username" autofocus autocomplete="off">
        </div>
        <div class="form-group">
            <label class="d-block" for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>
        <input type="submit" class="btn btn-info" name="form-login" value="Login">
    </form>
</div>
