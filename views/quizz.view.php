<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('views/bootstrap-head.view.php'); ?>
    <link rel="stylesheet" href="/main.css">
    <title>Quizz</title>
</head>

<body>
    <main>        
        <?php include('views/header.view.php'); ?>
        
        <div class="content">
            <h2>Quizz</h2>
            
            <p>Choose a quizz to start !</p>
            
            <div class="row">
                <?php foreach($quizzes as $quizz) { ?>
                <div class="col-sm-4">
                   <div class="card">
                        <img src="<?php echo $quizz['img_url']; ?>" alt="<?php echo $quizz['label']; ?> quizz" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $quizz['label']; ?></h5>
                            <p class="card-text"><?php echo $quizz['description'] ?></p>
                            <a href="/quizz.php?q=<?php echo $quizz['name']; ?>" class="btn btn-info">Take the quizz</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            
            
        </div>
    </main>
    
    <?php include('views/bootstrap-scripts.view.php'); ?>
</body>

</html>
