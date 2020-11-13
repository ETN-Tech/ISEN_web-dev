    <div class="content">
    <h2>Welcome to That Quizz</h2>

    <p>Find awesome quizz !</p>

    <br><br>

    <h3>Start learning</h3>

    <p>Take a quizz and start learning new things.</p>

    <a href="?url=quizz" class="btn btn-info">Find a quizz</a>

    <br><br><br><br>

    <?php if(isset($account)) { ?>

    <div class="row">
        <div class="col-6">
            <div class="card border-light mb-3">
                <div class="card-header">Account connected</div>
                <div class="card-body text-secondary">
                    <h5 class="card-title"><?php echo $full_name; ?></h5>
                    <p class="card-text"><?php echo $bdd_account->email; ?></p>
                    <a href="?url=account" class="btn btn-outline-secondary">Manage account</a>
                </div>
            </div>
        </div>
    </div>

    <?php } ?>
</div>
