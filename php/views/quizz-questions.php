<div class="card border-0 bg-dark text-white text-center">
    <img src="<?php echo $BddQuizz['img_url']; ?>" alt="Quizz <?php echo $BddQuizz['name'] ?>" class="img-fluid quizz-full-img">
    <div class="card-img-overlay align-middle quizz-header-overlay">
        <h1 class="card-title">Quizz <?php echo $BddQuizz['label'] ?></h1>

        <h5 class="card-text"><?php echo $BddQuizz['description']; ?></h5>
    </div>
</div>

<div class="content">

    <?php
    if (isset($quizz_error)) {
        if (!empty($quizz_error)) {
            ?>
            <div class="alert alert-danger" role="alert">Incorrect fields (question(s) <?php echo join(", ", $quizz_error) ?>). Answer all questions and try again.</div>
            <br>
        <?php } else { ?>
        <div class="alert alert-<?php echo $quizz_result_type; ?>" role="alert">
            <h4><?php echo $quizz_result_title; ?></h4>
            <p>Score : <?php echo $quizz_score .'/'. $quizz_max_score; ?></p>
            <a href="" type="button" class="btn btn-sm btn-outline-<?php echo $quizz_result_type; ?>">Try again</a>
        </div>
        <br>
    <?php } } ?>

    <form method="post" action="#quizz" class="needs-validation" novalidate>

        <?php foreach($Questionss as $Questions) { ?>

            <div class="form-group">

                <label for="<?php echo $Questions['id']; ?>"><?php echo $Questions['id'] .'. '. $Questions['question']; ?></label><br>

                <?php
                if (in_array($Questions['type'], ['radio', 'checkbox', 'select'])) {
                    foreach($Questions['propositions'] as $proposition) {
                        ?>
                            <div class="custom-control custom-<?php echo $Questions['type']; ?> custom-control-inline">
                                <input class="custom-control-input" type="<?php echo $Questions['type']; ?>" name="<?php echo $proposition['name']; ?>" value="<?php echo $proposition['value']; ?>" id="<?php echo $proposition['id']; ?>" <?php echo $proposition['checked']; ?> <?php echo $proposition['required']; ?>>
                                <label class="custom-control-label" for="<?php echo $proposition['id']; ?>"><?php echo $proposition['proposition']; ?></label>
                            </div>
                        <?php
                    }
                } else if ($Questions['type'] == 'input') {
                ?>
                    <input type="text" class="form-control" id="<?php echo $Questions['id']; ?>" name="<?php echo $Questions['id']; ?>" value="<?php echo $Questions['value']; ?>" aria-describedby="<?php echo $Questions['id']; ?>" required>
                    <div class="invalid-feedback">Please answer the question.</div>
                    <?php
                }
                if (!empty($Questions['tips'])) {
                ?>
                    <small id="<?php echo $Questions['id']; ?>" class="form-text text-muted"><?php echo $Questions['tips']; ?></small>
                <?php } ?>

            </div><br>

        <?php } ?>

        <input class="btn btn-info" type="submit" name="form-quizz" value="Send">
    </form>
</div>

<script type="application/javascript" src="js/quizz-validate.js"></script>
