<div class="content">
    <div class="mb-5">
        <h2>Welcome to That Quizz</h2>

        <p>Find awesome quizz !</p>
    </div>

    <?php if(isset($account)) { ?>

        <div class="mb-5">
            <h3>Start learning</h3>

            <p>Take a quizz and start learning new things.</p>

            <a href="/quizz" class="btn btn-info">Find a quizz</a>
        </div>

        <div class="row py-2 mt-2">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">Account connected</div>
                    <div class="card-body text-secondary">
                        <h5 class="card-title"><?php echo $full_name; ?></h5>
                        <p class="card-text"><?php echo $bdd_account->email; ?></p>
                        <a href="/account" class="btn btn-outline-secondary">My account</a>
                    </div>
                </div>
            </div>
        </div>

    <?php } else { ?>

        <div class="row pt-2">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">Account</div>
                    <div class="card-body text-secondary">
                        <p class="card-text">Connect to your account to access all pages.</p>
                        <a href="/login?²next=home" class="btn btn-outline-secondary">Login</a></div>
                </div>
            </div>
        </div>

    <?php } ?>
</div>
