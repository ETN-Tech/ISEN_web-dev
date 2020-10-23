
<div class="container quizz-header-img" id="quizz">
    <div class="row">
        <img src="<?php echo $bdd_quizz['img_url']; ?>" alt="Quizz <?php echo $bdd_quizz['name'] ?>" class="img-fluid quizz-full-img">
    </div>

    <div class="quizz-header-texte">
        <h1 class="quizz-header-titre">Quizz <?php echo $bdd_quizz['label'] ?></h1>

        <h5 class="quizz-header-desc"><?php echo $bdd_quizz['description']; ?></h5>
    </div>
</div>

<div class="card bg-dark text-white">
    <img src="<?php echo $bdd_quizz['img_url']; ?>" alt="Quizz <?php echo $bdd_quizz['name'] ?>" class="img-fluid quizz-full-img">
    <div class="card-img-overlay">
        <h1 class="card-title">Quizz <?php echo $bdd_quizz['label'] ?></h1>

        <h5 class="card-text"><?php echo $bdd_quizz['description']; ?></h5>
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

        <?php foreach($questions as $question) { ?>

            <div class="form-group">

                <label for="<?php echo $question['id']; ?>"><?php echo $question['id'] .'. '. $question['question']; ?></label><br>

                <?php
                if (in_array($question['type'], ['radio', 'checkbox'])) {
                    foreach($question['propositions'] as $proposition) {
                        ?>
                            <div class="custom-control custom-<?php echo $question['type']; ?> custom-control-inline">
                                <input class="custom-control-input" type="<?php echo $question['type']; ?>" name="<?php echo $proposition['name']; ?>" value="<?php echo $proposition['value']; ?>" id="<?php echo $proposition['id']; ?>" <?php echo $proposition['checked']; ?> <?php echo $proposition['required']; ?>>
                                <label class="custom-control-label" for="<?php echo $proposition['id']; ?>"><?php echo $proposition['proposition']; ?></label>
                            </div>
                        <?php
                    }
                } else if ($question['type'] == 'input') {
                ?>
                    <input type="text" class="form-control" id="<?php echo $question['id']; ?>" name="<?php echo $question['id']; ?>" value="<?php echo $question['value']; ?>" aria-describedby="<?php echo $question['id']; ?>" required>
                    <div class="invalid-feedback">Please answer the question.</div>
                    <?php
                }
                if (!empty($question['tips'])) {
                ?>
                    <small id="<?php echo $question['id']; ?>" class="form-text text-muted"><?php echo $question['tips']; ?></small>
                <?php } ?>

            </div><br>

        <?php } ?>

        <input class="btn btn-info" type="submit" name="form-quizz" value="Send">
    </form>

</div>
