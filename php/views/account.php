<div class="content">
    <h2>Account details</h2>
    <br>
    <div class="row">
        <div class="col-6">
            <div class="card border-light mb-3">
                <div class="card-header">Informations</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $account->getFullname(); ?></h5>
                    <p class="card-text"><b>Username :</b> <?php echo $account->username; ?><br><b>Email :</b> <?php echo $account->email; ?><br><b>Last connexion :</b> <?php echo formatDate($account->last_connexion); ?></p>

                    <a href="?url=logout" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <h3>Quizz scores</h3>
    <br>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Quizz</th>
                <th>Score</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($account_answer_dates as $date) {
                $quizz = Quizz::getQuizzByAccountAnswerDate($date);
                $score = $quizz->calculateScore($date);
                $i++;
                ?>
            <tr>
                <th><?php echo $i; ?></th>
                <td><a href="?url=quizz-questions&quizz=<?php echo $quizz->name; ?>" class="text-info"><?php echo $quizz->title; ?></a></td>
                <td class="text-<?php echo Quizz::getScoreType($score); ?>"><?php echo $score; ?></td>
                <td><?php echo formatDate($date); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
