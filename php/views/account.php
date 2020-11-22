<div class="content">
    <h2>Accounts</h2>
    <div class="row py-2 mb-5">
        <div class="col-6">
            <div class="card">
                <div class="card-header">My account</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $account->getFullname(); ?></h5>
                    <p class="card-text">
                        <span class="d-block"><b>Username :</b> <?php echo $account->username; ?></span>
                        <span class="d-block"><b>Email :</b> <?php echo $account->email; ?></span>
                        <span class="d-block"><b>Last connexion :</b> <?php echo formatDate($account->last_connexion); ?></span>
                    </p>
                    <a href="?page=logout" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">Manage accounts</div>
                <div class="card-body">
                    <a href="?page=account-create" class="btn btn-info">Create account</a>
                </div>
            </div>
        </div>
    </div>

    <h3 id="last-scores" class="mb-3">My quizz scores</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Quizz</th>
                <th>Score</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($account_answer_dates as $date) {
                $quizz = Quizz::getQuizzByAccountAnswerDate($date);
                $score = $quizz->calculateScore($date);
                ?>
            <tr>
                <td><a href="?page=quizz-questions&quizz=<?php echo $quizz->name; ?>" class="text-info"><?php echo $quizz->title; ?></a></td>
                <td><a href="?page=quizz-score&date=<?php echo $date; ?>" class="text-<?php echo Quizz::getScoreType($score); ?>"><?php echo $score; ?></a></td>
                <td><?php echo formatDate($date); ?></td>
                <td><a href="?page=quizz-score-delete&date=<?php echo $date; ?>" class="btn btn-outline-danger">Delete</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
