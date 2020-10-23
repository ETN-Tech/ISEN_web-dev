<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('../php/views/bootstrap-head.view.php'); ?>
    <link rel="stylesheet" href="css/main.css">
    <title>Home - That Quizz</title>
</head>

<body>
    <main>        
        <?php include('../php/views/header.view.php'); ?>

        <div class="container">
            <div class="content">
                <h2>Welcome to That Quizz</h2>

                <p>Find awesome quizz !</p>

                <br><br>

                <h3>Start learning</h3>

                <p>Take a quizz and start learning new things.</p>

                <a href="/quizz.php" class="btn btn-info">Find a quizz</a>

                <br><br><br><br>

                <?php if($user_connected) { ?>

                <div class="row">
                    <div class="col-6">
                        <div class="card border-light mb-3">
                            <div class="card-header">Account connected</div>
                            <div class="card-body text-secondary">
                                <h5 class="card-title"><?php echo $full_name; ?></h5>
                                <p class="card-text"><?php echo $account['email']; ?></p>
                                <a href="/account.php" class="btn btn-outline-secondary">Manage account</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php } ?>
            </div>
        </div>
    </main>
    
    <?php include('../php/views/bootstrap-scripts.view.php'); ?>
</body>

</html>
