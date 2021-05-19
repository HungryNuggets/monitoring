<?php


// TWIG RENDER
echo $twig->render("public/customer_detail.html.twig",
    [
        "admin"=>$admin,
        "session"=>$_SESSION,
        "allCustomer"=>$customerManager->selectAllCustomers()
    ]);