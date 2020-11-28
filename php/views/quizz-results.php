<div class="card border-0 bg-dark text-white text-center">
    <img src="<?php echo $quizz->img_url; ?>" alt="Quizz <?php echo $quizz->name ?>" class="img-fluid quizz-full-img">
    <div class="card-img-overlay align-middle quizz-header-overlay">
        <h1 class="card-title">Quizz <?php echo $quizz->title ?></h1>

        <h5 class="card-text"><?php echo $quizz->description; ?></h5>
    </div>
</div>

<div class="content">

    <h3 id="last-scores" class="mb-3">Last quizz scores</h3>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Username</th>
            <th>Score</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($results_date as $date) {
            $quizz = Quizz::getQuizzByAccountAnswerDate($date);
            $score = $quizz->calculateScore($date);
            $account = Account::getAccountByAccountAnswerDate($date);
            ?>
            <tr>
                <td><?php echo $account->username; ?></td>
                <td><a href="/quizz/score/<?php echo $date; ?>" class="text-<?php echo Quizz::getScoreType($score); ?>"><?php echo $score; ?></a></td>
                <td><?php echo formatDate($date); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>