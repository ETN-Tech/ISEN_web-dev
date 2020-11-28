<div class="content">
    <h3 id="last-scores" class="mb-3">Quizz leaderboard</h3>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Quizz</th>
            <th scope="col">Score</th>
            <th scope="col">Username</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($date_score as $date => $score) {
            $quizz = Quizz::getQuizzByAccountAnswerDate($date);
            $account = Account::getAccountByAccountAnswerDate($date);
            ?>
            <tr>
                <th scope="row"></th>
                <td><a href="/quizz/questions/<?php echo $quizz->getName(); ?>" class="text-info"><?php echo $quizz->getTitle(); ?></a></td>
                <td><a href="/quizz/score/<?php echo $date; ?>" class="text-<?php echo Quizz::getScoreType($score); ?>"><?php echo $score; ?></a></td>
                <td><?php echo $account->getUsername(); ?></td>
                <td><?php echo formatDate($date); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>