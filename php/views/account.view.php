<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('../php/views/bootstrap-head.view.php'); ?>
    <link rel="stylesheet" href="css/main.css">
    <title>Account</title>
</head>

<body>
    <main>        
        <?php include('../php/views/header.view.php'); ?>

        <div class="container">
            <div class="content">
                <h2>Account details</h2>
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="card border-light mb-3">
                            <div class="card-header">Informations</div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $full_name; ?></h5>
                                <p class="card-text"><b>Username :</b> <?php echo $account['username']; ?><br><b>Email :</b> <?php echo $account['email']; ?><br><b>Last connexion :</b> <?php echo $last_connexion; ?></p>

                                <a href="account.php?logout" class="btn btn-danger">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    
    <?php include('../php/views/bootstrap-scripts.view.php'); ?>
</body>

</html>
