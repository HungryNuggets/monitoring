<?php

// CUSTOMER GLOBAL DISPLAY WITH OPTIONS
$customerManager = new CustomerManager($DB);

// TWIG RENDER
echo $twig->render("admin/customer.html.twig",
    [
        "admin"=>'yes',
        "session"=>$_SESSION,
        "allCustomer"=>$customerManager->selectAllCustomers()
    ]);