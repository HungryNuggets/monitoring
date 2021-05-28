<?php

// REFRESH
header("Refresh:60");

// CUSTOMER ARRAY
$customer = [];

$retrieveCustomer = $customerManager->selectOneCustomer($_GET['customerDetail']);

if (empty($retrieveCustomer)){

    header('Location: ./');
    exit();
}

$customer['itself'] = $retrieveCustomer;

$customer['domain'] = $customerManager->domainFullStatus($ovh,$retrieveCustomer['domain_customer']);

$customer['server'] = $customerManager->serverFullStatus($ovh,$retrieveCustomer['domain_customer'], $retrieveCustomer['hosting_customer']);

$customer['serverSpe'] = $customerManager->serverSpeFullStatus($ovh,$retrieveCustomer['hosting_customer']);

// TWIG RENDER
echo $twig->render("public/customer_detail.html.twig",
    [
        "admin"=>$admin,
        "customer"=>$customer
    ]);