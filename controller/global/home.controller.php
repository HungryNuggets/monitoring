<?php

// REFRESH
header("Refresh:60");

// LIST FOR RENDER
$fullCustomerList = [];

// SIMPLE LIST OF ALL CUSTOMERS
$allCustomer = $customerManager->selectAllCustomers();

for ($i = 0; $i < count($allCustomer); $i++){
    $fullCustomerList[$i] = $allCustomer[$i];
    $fullCustomerList[$i]['DNS'] =  $customerManager->dnsStatus($ovh, $allCustomer[$i]['domain_customer'],$allCustomer[$i]['id_customer'], $issueManager);
    $fullCustomerList[$i]['server'] =  $customerManager->serverStatus($ovh, $allCustomer[$i]['domain_customer'],$allCustomer[$i]['id_customer'], $issueManager);
    $fullCustomerList[$i]['domain'] =  $customerManager->domainStatus($ovh, $allCustomer[$i]['domain_customer'],$allCustomer[$i]['id_customer'], $issueManager);
}