<div class="card border-0 bg-dark text-white text-center">
    <img src="<?php echo $quizz->getImgUrl(); ?>" alt="Quizz <?php echo $quizz->getName() ?>" class="img-fluid quizz-full-img">
    <div class="card-img-overlay align-middle quizz-header-overlay">
        <h1 class="card-title">Quizz <?php echo $quizz->getTitle() ?></h1>

        <h5 class="card-text"><?php echo $quizz->getDescription(); ?></h5>
    </div>
</div>

<div class="content">

    <form method="post" action="/quizz/correction" class="needs-validation" novalidate>

        <fieldset>

            <?php
            foreach($questions as $question) {
                $answers = $question->getAnswers();
                // if user already answered quizz, shuffle answers
                if (isset($already_answered)) {
                    shuffle($answers);
                }
                $i++;
                ?>

            <div class="form-group pb-4">

                <label class="d-block" for="<?php echo $question->getId(); ?>"><?php echo $i .'. '. $question->getQuestion(); ?></label>

                <?php
                if ($question->getType() == 'input') {
                    // get first answer for input
                    $answer = $answers[0];
                    ?>
                    <input class="form-control" type="text" id="<?php echo $question->getId(); ?>" name="<?php echo $answer->getName(); ?>" value="<?php echo $answer->getValue(); ?>" <?php echo $answer->getRequired(); ?>>

                <?php } else if ($question->getType() == 'select') { ?>

                    <select class="custom-select" id="<?php echo $question->getId(); ?>" name="<?php echo $question->getId(); ?>" required>
                        <?php foreach($answers as $answer) { ?>
                        <option value="<?php echo $answer->getValue(); ?>"><?php echo $answer->getAnswer(); ?></option>
                        <?php } ?>
                    </select>

                <?php
                } else {
                    foreach($answers as $answer) {
                    ?>
                    <div class="custom-control custom-<?php echo $question->getType(); ?> custom-control-inline">
                        <input class="custom-control-input" type="<?php echo $question->getType(); ?>" id="<?php echo $answer->getFormId(); ?>" name="<?php echo $answer->getName(); ?>" value="<?php echo $answer->getValue(); ?>" <?php echo $answer->getRequired(); ?>>
                        <label class="custom-control-label" for="<?php echo $answer->getFormId(); ?>"><?php echo $answer->getAnswer(); ?></label>
                    </div>

                <?php
                    }
                }
                ?>

                <div class="invalid-feedback">Please answer the question.</div>

            </div>

            <?php } ?>

        </fieldset>

        <input type="hidden" name="quizz-name" value="<?php echo $quizz->getName(); ?>">

        <input class="btn btn-info" type="submit" name="form-quizz" value="Send answers">
    </form>
</div>

<script type="application/javascript" src="js/form-validate.js"></script>
