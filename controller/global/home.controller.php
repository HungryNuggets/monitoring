<?php

// REFRESH
header("Refresh:60");

// LIST FOR RENDER
$fullCustomerList = [];

// SIMPLE LIST OF ALL CUSTOMERS
$allCustomer = $customerManager->selectAllCustomers();

for ($i = 0; $i < count($allCustomer); $i++){
    $fullCustomerList[$i] = $allCustomer[$i];
    $fullCustomerList[$i]['test'] = 'yes, this is the test';
}