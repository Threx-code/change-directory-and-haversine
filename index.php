<?php

use App\ChangeDirectory;
require_once "change_directory.php";
$app = new ChangeDirectory('m/d/s');
$app->cd('');
echo $app->currentPath;



