<?php

require_once('../php/models/quizz.php');

$meta_title = "Quizz";

$quizzes = get_quizzes()->fetchAll();

// view page to choose a quizz
require_once('../php/views/quizz.php');
