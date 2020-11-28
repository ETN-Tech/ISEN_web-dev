<div class="card border-0 bg-dark text-white text-center">
    <img src="<?php echo $quizz->img_url; ?>" alt="Quizz <?php echo $quizz->name ?>" class="img-fluid quizz-full-img">
    <div class="card-img-overlay align-middle quizz-header-overlay">
        <h1 class="card-title">Quizz <?php echo $quizz->title ?></h1>

        <h5 class="card-text"><?php echo $quizz->description; ?></h5>
    </div>
</div>

<div class="content">

    <div class="alert alert-<?php echo Quizz::getScoreType($score); ?> mb-4" role="alert">
        <h4><?php echo Quizz::getScoreMessage($score); ?></h4>
        <p>Score : <?php echo $score; ?>/10</p>
        <a href="/quizz/questions/<?php echo $quizz->name; ?>" type="button" class="btn btn-outline-<?php echo Quizz::getScoreType($score); ?>">Try again</a>
        <a href="/account#my-scores" type="button" class="btn btn-<?php echo Quizz::getScoreType($score); ?>">My scores</a>
        <a href="/quizz/score/delete/<?php echo $date; ?>" type="button" class="btn btn-danger float-right">Delete this result</a>
    </div>
</div>