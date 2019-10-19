<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'config.php';
require 'bootstrap.php';

ob_start();

$app = new fish_bowl();



$html = ob_get_clean();

// Specify configuration
$tidy = tidy_html5($html);

// Output
echo $tidy;