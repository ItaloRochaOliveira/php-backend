<?php
    require_once('../Repository/Configuration.php');

    $newEntity = Configuration::connect();
    $products = $newEntity->findAll();

    var_dump($products);