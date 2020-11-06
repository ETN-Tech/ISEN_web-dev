<div class="content">
    <h2>Account details</h2>
    <br>
    <div class="row">
        <div class="col-6">
            <div class="card border-light mb-3">
                <div class="card-header">Informations</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $Account->getFullname(); ?></h5>
                    <p class="card-text"><b>Username :</b> <?php echo $Account->username; ?><br><b>Email :</b> <?php echo $Account->email; ?><br><b>Last connexion :</b> <?php echo $Account->getLastConnexionFormated(); ?></p>

                    <a href="?url=logout" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
