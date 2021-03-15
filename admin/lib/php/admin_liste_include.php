<?php
if(file_exists('./lib/php/pg_connect.php') && file_exists('./lib/php/autoload.php')){
    require'./lib/php/pg_connect.php';
    require './lib/php/autoload.php';
}else if(file_exists('./lib/php/pg_connect.php')&& file_exists('./lib/php/autoload.php')){
    require'./admin/lib/php/pg_connect.php';
    require './admin/lib/php/autoload.php';
}

