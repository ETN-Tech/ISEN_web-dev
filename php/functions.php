<?php

function formatDate($date) {
    $time = strtotime($date);

    return ucfirst(strftime('%A %e %B %Y', $time))." - ".strftime('%Hh%M', $time);
}
