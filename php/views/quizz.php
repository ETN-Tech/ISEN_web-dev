<div class="content">
    <a href="/quizz/leaderboard" class="btn btn-warning float-right">See leaderboard</a>

    <h2>Quizz</h2>

    <p>Choose a quizz to start !</p>

    <div class="row py-4">
        <?php foreach($quizzes as $quizz) { ?>
        <div class="col-sm-4">
           <div class="card">
                <img src="<?php echo $quizz->getImgUrl(); ?>" alt="<?php echo $quizz->getTitle(); ?> quizz" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $quizz->getTitle(); ?></h5>
                    <p class="card-text"><?php echo $quizz->getDescription(); ?></p>
                    <a href="/quizz/questions/<?php echo $quizz->getName(); ?>" class="btn btn-info">Take the quizz</a>
                    <a href="/quizz/results/<?php echo $quizz->getName(); ?>" class="btn btn-outline-info">See scores</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
