<div class="card border-0 bg-dark text-white text-center">
    <img src="<?php echo $quizz->img_url; ?>" alt="Quizz <?php echo $quizz->name ?>" class="img-fluid quizz-full-img">
    <div class="card-img-overlay align-middle quizz-header-overlay">
        <h1 class="card-title">Quizz <?php echo $quizz->title ?></h1>

        <h5 class="card-text"><?php echo $quizz->description; ?></h5>
    </div>
</div>

<div class="content">

    <div class="alert alert-<?php echo $result_type; ?>" role="alert">
        <h4><?php echo $result_title; ?></h4>
        <p>Score : <?php echo $score .'/10'; ?></p>
        <a href="" type="button" class="btn btn-sm btn-outline-<?php echo $result_type; ?>">Try again</a>
    </div>

</div>