<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */

use App\ChangeDirectory;
require_once "change_directory.php";
$app = new ChangeDirectory('m/d/s');
$app->cd('');
echo $app->currentPath;



