<?php

require_once('php/session-locale.php');

require_once('modeles/quizz.php');


// verify if quizz page requested
if (isset($_GET['q']) && !empty($_GET['q'])) {
    
    $quizz_name = htmlspecialchars($_GET['q']);
    
    $bdd_quizz = get_quizz($quizz_name)->fetch();
    
    // verify if the quizz exists
    if ($bdd_quizz) {
        $questions = get_quizz_questions($bdd_quizz['id'])->fetchAll();
        
        // format questions
        foreach($questions as $key => $question) {
            
            // check if it's input type
            if ($question['type'] == 'input') {
                
                // get the answer for that question
                $answer = get_question_input($question['id'])->fetch();
                
                $questions[$key]['answer'] = $answer;
                // add a form_id
                $questions[$key]['form_id'] = 'input'. $question['id'];
            }
            
            // check if it's radio/checkbox type
            else if (in_array($question['type'], ['radio', 'checkbox'])) {
                
                // get all propositions (choices) for that question
                $propositions = get_question_radio_checkbox($question['id'])->fetchAll();
                
                // format fields for quizz form
                foreach ($propositions as $key => $proposition) {
                    
                    // add a form_id
                    $propositions[$key]['form_id'] = $question['type'].$proposition['id'];
                    
                    // add a name field
                    $propositions[$key]['name'] = ($question['type'] == 'radio') ? 'radio'.$question['id'] : $question['type'].$proposition['id'];
                    
                    // add a value field
                    $propositions[$key]['value'] = ($question['type'] == 'radio') ? 'radio'.$proposition['id'] : '';
                }
                
                $questions[$key]['propositions'] = $propositions;
            }
            
            // add a form_id
            $question['form_id'] = 'question'. $question['id'];
        }
    }
    else {
        header('Location: quizz.php');
        die();
    }
    
    // view quizz questions page
    require_once('views/quizz-questions.view.php');
}
else {
    
    $quizzes = get_quizzes()->fetchAll();
    
    // view page to choose a quizz
    require_once('views/quizz.view.php');
}
