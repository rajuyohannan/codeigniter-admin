<?php

require_once dirname(__FILE__) . '/../application/vendor/autoload.php';

$app = new \Slim\Slim();

$app->config('debug', true);


$app->get('/', function () {
    echo "If you see this page, it means that the API has been setup correctly on your server";
});


$app->run();