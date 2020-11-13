<div class="card border-0 bg-dark text-white text-center">
    <img src="<?php echo $quizz->img_url; ?>" alt="Quizz <?php echo $quizz->name ?>" class="img-fluid quizz-full-img">
    <div class="card-img-overlay align-middle quizz-header-overlay">
        <h1 class="card-title">Quizz <?php echo $quizz->title ?></h1>

        <h5 class="card-text"><?php echo $quizz->description; ?></h5>
    </div>
</div>

<div class="content">

    <form method="post" action="?url=quizz-correction" class="needs-validation" novalidate>

        <fieldset>

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
                    <input class="form-control" type="text" id="<?php echo $question->id; ?>" name="<?php echo $answer->name; ?>" value="<?php echo $answer->value; ?>" <?php echo $answer->required; ?>>

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
                        <input class="custom-control-input" type="<?php echo $question->type; ?>" id="<?php echo $answer->form_id; ?>" name="<?php echo $answer->name; ?>" value="<?php echo $answer->value; ?>" <?php echo $answer->required; ?>>
                        <label class="custom-control-label" for="<?php echo $answer->form_id; ?>"><?php echo $answer->answer; ?></label>
                    </div>

                <?php
                    }
                }
                ?>

                <div class="invalid-feedback">Please answer the question.</div>

            </div><br>

            <?php } ?>

        </fieldset>

        <input type="hidden" name="quizz-name" value="<?php echo $quizz->name; ?>">

        <input class="btn btn-info" type="submit" name="form-quizz" value="Send">
    </form>
</div>

<script type="application/javascript" src="js/quizz-validate.js"></script>
