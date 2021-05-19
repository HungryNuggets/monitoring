<?php

$warning = "";

// INPUT VALUES
if (isset($_GET['delete']) && ctype_digit($_GET['delete'])){
    // CUSTOMER TO DELETE AND DISPLAY
    $customerToChange = $_GET['delete'];

    $customerDisplay = $customerManager->selectOneCustomer($customerToChange);

} else {
    $warning .= "Un problème est survenu";
}

// IF THE ADMIN REALLY WANT TO DELETE
if (isset($_GET['admin']) && $_GET['admin'] == "ok") {

    $delete = $customerManager->deleteCustomer($customerToChange);
    if ($delete) {
        header('Location: ?customer');
        exit();
    } else {
        $warning .= "La suppression n'a pas fonctionné";
    }
}

// TWIG RENDER
echo $twig->render("admin/crud/delete_customer.html.twig",
    [
        "admin" => $admin,
        "session" => $_SESSION,
        "warning" => $warning,
        "customer"=>$customerDisplay
    ]);