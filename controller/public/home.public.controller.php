<?php

// REFRESH
header("Refresh:300");

// FOR ONE CUSTOMER INFOS AND STATUS
if (isset($_GET['customerDetail']) && ctype_digit($_GET['customerDetail'])) {

    require ROOT . "/controller/public/customer.home.controller.php";

    exit();
}

// LIST FOR RENDER
$fullCustomerList = [];

// SIMPLE LIST OF ALL CUSTOMERS
$allCustomer = $customerManager->selectAllCustomers();

for ($i = 0; $i < count($allCustomer); $i++){
    $fullCustomerList[$i] = $allCustomer[$i];
    // DNS
    $fullCustomerList[$i]['DNS'] =  $customerManager->dnsStatus($ovh, $allCustomer[$i]['domain_customer'],$allCustomer[$i]['id_customer'], $issueManager);
    // SERVER
    $fullCustomerList[$i]['server'] =  $customerManager->serverStatus($ovh, $allCustomer[$i]['hosting_customer'],$allCustomer[$i]['id_customer'], $issueManager);
    // DOMAIN
    $fullCustomerList[$i]['domain'] =  $customerManager->domainStatus($ovh, $allCustomer[$i]['domain_customer'],$allCustomer[$i]['id_customer'], $issueManager);
}

// TWIG RENDER
echo $twig->render("public/home.html.twig",[
    "admin"=>$admin,
    "issueNotification"=>$issuesNotification,
    "adminNotification"=>$adminNotification,
    "allCustomer"=>$fullCustomerList
]);