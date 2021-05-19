<?php

// CREATE CUSTOMER
if (isset($_GET['create'])){

    require ROOT . "/controller/admin/crud/crud.create.customer.controller.php";

    exit();
}

// UPDATE CUSTOMER
if (isset($_GET['update']) && ctype_digit($_GET['update'])){

    require ROOT . "/controller/admin/crud/crud.update.customer.controller.php";

    exit();
}

// UPDATE CUSTOMER
if (isset($_GET['delete']) && ctype_digit($_GET['delete'])){

    require ROOT . "/controller/admin/crud/crud.delete.customer.controller.php";

    exit();
}

// TWIG RENDER
echo $twig->render("admin/customer.html.twig",
    [
        "admin"=>$admin,
        "session"=>$_SESSION,
        "allCustomer"=>$customerManager->selectAllCustomers()
    ]);