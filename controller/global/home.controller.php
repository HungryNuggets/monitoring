<?php

// LIST FOR RENDER
$fullCustomerList = [];

// SIMPLE LIST OF ALL CUSTOMERS
$allCustomer = $customerManager->selectAllCustomers();

for ($i = 0; $i < count($allCustomer); $i++){
    $fullCustomerList[$i] = $allCustomer[$i];
    array_push($fullCustomerList[$i], ['test'=>'yes']);
}