<?php
session_start();
require_once('Controllers/boardController.php');
try {
    $main = new boardController();
    $main->run();
} catch (Exception $e) {
    echo $e->getMessage();
    exit(-1);
}
// aa
?>