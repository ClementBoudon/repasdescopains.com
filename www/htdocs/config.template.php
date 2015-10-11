<?php

$mysql_host = (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV']=='test') ? 'localhost' : ((isset($_ENV['APP_ENV']) && $_ENV['APP_ENV']=='dev') ? 'localhost' : 'localhost');
$mysql_user = isset($_ENV['MYSQL_USER']) ? $_ENV['MYSQL_USER'] : '';
$mysql_pass = isset($_ENV['MYSQL_PASSWORD']) ? $_ENV['MYSQL_PASSWORD'] : '';
$mysql_database = (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV']=='test') ? 'repasdesodsql' : 'repasdesodsql';

$mailjet_apiKey = '';
$mailjet_secretKey = '';
