<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('../php/views/bootstrap-head.view.php'); ?>
    <link rel="stylesheet" href="/main.css">
    <title>Account</title>
</head>

<body>
    <main>        
        <?php include('../php/views/header.view.php'); ?>

        <div class="container">
            <div class="content">
                <h2>Account login</h2>

                <?php if(isset($error)){ echo '<p class="alert alert-danger">'. $error .'</p>'; } ?>

                <form action="" method="post">
                    <label for="username">Username</label><br>
                    <input type="text" name="username" id="username" autofocus autocomplete="off">
                    <br><br>
                    <label for="password">Password</label><br>
                    <input type="password" name="password" id="password">
                    <br><br>
                    <input type="submit" class="btn btn-info" name="form-login" value="Login">
                </form>
            </div>
        </div>
    </main>
    
    <?php include('../php/views/bootstrap-scripts.view.php'); ?>
</body>

</html>
