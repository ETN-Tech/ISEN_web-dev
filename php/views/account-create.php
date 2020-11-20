<div class="content">
    <h2 class="mb-4">New account</h2>

    <?php
    if (isset($error_msg)) { echo '<p class="alert alert-danger">'. $error_msg .'</p>'; }

    if (isset($succes)) {
        echo '<p class="alert alert-success">Account successfully created !<br><b>Username :</b> '. $username .'</p>';
    } else { ?>

        <form action="" method="post" class="needs-validation col-8" novalidate>
            <div class="form-group row">
                <div class="col">
                    <label class="d-block" for="username">Username</label>
                    <input class="form-control" type="text" name="username" id="username" value="<?php echo $username; ?>" autofocus autocomplete="off" required>
                    <div class="invalid-feedback">Username is required.</div>
                </div>

                <div class="col">
                    <label class="d-block" for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password" required>
                    <div class="invalid-feedback">Password is required.</div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label class="d-block" for="surname">Surname</label>
                    <input class="form-control" type="text" name="surname" id="surname" value="<?php echo $surname; ?>" required>
                    <div class="invalid-feedback">Surname is required.</div>
                </div>

                <div class="col">
                    <label class="d-block" for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name" value="<?php echo $name; ?>" required>
                    <div class="invalid-feedback">Name is required.</div>
                </div>
            </div>
            <div class="form-group mb-4">
                <label class="d-block" for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email" value="<?php echo $email; ?>" required>
                <div class="invalid-feedback">Email is required.</div>
            </div>
            <input type="submit" class="btn btn-info" name="form-account-create" value="Create account">
            <a href="?page=account" class="btn btn-">Cancel</a>
        </form>

    <?php } ?>
</div>

<script type="application/javascript" src="js/form-validate.js"></script>
