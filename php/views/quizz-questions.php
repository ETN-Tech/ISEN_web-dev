<div class="card border-0 bg-dark text-white text-center">
    <img src="<?php echo $bdd_quizz->img_url; ?>" alt="Quizz <?php echo $bdd_quizz->name ?>" class="img-fluid quizz-full-img">
    <div class="card-img-overlay align-middle quizz-header-overlay">
        <h1 class="card-title">Quizz <?php echo $bdd_quizz->title ?></h1>

        <h5 class="card-text"><?php echo $bdd_quizz->description; ?></h5>
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

        <?php
        foreach($questions as $question) {
            $answers = $question->getAnswers();
            ?>

        <div class="form-group">

            <label for="<?php echo $question->id; ?>"><?php echo $question->id .'. '. $question->question; ?></label><br>

            <?php
            if ($question->type == 'input') {
                // get first answer for input
                $answer = $answers[0];
                ?>
                <input class="form-control" type="text" id="<?php echo $question->id; ?>" name="<?php echo $answer->name; ?>" value="<?php echo $answer->value; ?>"  <?php echo $answer->checked; ?> <?php echo $answer->required; ?>>

            <?php } else if ($question->type == 'select') { ?>

                <select class="custom-select" id="<?php echo $question->id; ?>" name="<?php echo $question->id; ?>" required>
                    <?php foreach($answers as $answer) { ?>
                    <option value="<?php echo $answer->value; ?>"><?php echo $answer->answer; ?></option>
                    <?php } ?>
                </select>

            <?php
            } else {
                foreach($answers as $answer) {
                ?>
                <div class="custom-control custom-<?php echo $question->type; ?> custom-control-inline">
                    <input class="custom-control-input" type="<?php echo $question->type; ?>" id="<?php echo $answer->form_id; ?>" name="<?php echo $answer->name; ?>" value="<?php echo $answer->value; ?>" <?php echo $answer->checked; ?> <?php echo $answer->required; ?>>
                    <label class="custom-control-label" for="<?php echo $answer->form_id; ?>"><?php echo $answer->answer; ?></label>
                </div>

            <?php
                }
            }
            ?>

            <div class="invalid-feedback">Please answer the question.</div>

        </div><br>

        <?php } ?>

        <input class="btn btn-info" type="submit" name="form-quizz" value="Send">
    </form>
</div>

<script type="application/javascript" src="js/quizz-validate.js"></script>
