<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('views/bootstrap-head.view.php'); ?>
    <link rel="stylesheet" href="/main.css">
    <title>Quizz</title>
</head>

<body>
    <main>        
        <?php include('views/header.view.php'); ?>
        
        <div class="content">
            <h2>Quizz <?php echo $bdd_quizz['label'] ?></h2>
            
            <form method="post" action="#">
                
                <div class="form-group">
                   
                    <?php foreach($questions as $question) { ?>
                    
                    <label for="<?php echo $question['form_id']; ?>"><?php echo $question['question']; ?></label>
                    
                    <?php if (in_array($question['type'], ['radio', 'checkbox'])) { ?>
                    
                    <div class="form-check">
                       
                        <?php foreach($question['propositions'] as $proposition) { ?>
                        
                        <input class="form-check-input" type="<?php echo $question['type']; ?>" name="<?php echo $question['name']; ?>" value="<?php echo $question['value']; ?>" id="<?php echo $proposition['form_id']; ?>">
                        <label class="form-check-label" for="<?php echo $proposition['form_id']; ?>">Default checkbox</label>
                        
                        <?php } ?>
                        
                    </div>
                    
                    <?php } else if ($question['type'] == 'input') { ?>
                    
                    <input type="text" class="form-control" id="<?php echo $question['form_id']; ?>" name="<?php echo $question['form_id']; ?>" aria-describedby="<?php echo $question['form_id']; ?>">
                    
                    <?php } if (!empty($question['tips'])) { ?>
                    
                    <small id="<?php echo $question['form_id']; ?>" class="form-text text-muted"><?php echo $question['tips']; ?></small>
                    
                    <?php } } ?>
                    
                </div>
                
                <input class="btn btn-info" type="submit" name="form-quizz" value="Send">
            </form>
            
        </div>
    </main>
    
    <?php include('views/bootstrap-scripts.view.php'); ?>
</body>

</html>
