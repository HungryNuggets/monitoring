<?php

$warning = "";

// INPUT VALUES
if (isset($_GET['update']) && ctype_digit($_GET['update'])){
    // CUSTOMER TO UPDATE AND DISPLAY
    $customerToChange = $_GET['update'];

    $customerDisplay = $customerManager->selectOneCustomer($customerToChange);
} else {
    $warning .= "Un problème est survenu";
}

// ON FORM SUBMISSION
if (isset($_POST['updateCustomer'])) {

    if (empty($_POST['name_customer']) || empty($_POST['domain_customer']) || empty($_POST['hosting_customer']) || empty($_POST['contact_person_customer']) || empty($_POST['mail_customer']) || empty($_POST['phone_customer'])) {
        $warning .= "Remplissez tout les champs pour mettre à jour un client";
    } else {
        // UPDATE
        $customer = new Customer($_POST);
        $update = $customerManager->updateCustomer($customer, $customerToChange);
        if($update){
            header("Location: ?customer");
            exit();
        } else {
            $warning = "On a eu un petit soucis, réessaye !";
        }
    }
}

// TWIG RENDER
echo $twig->render("admin/crud/update_customer.html.twig",
    [
        "admin" => 'yes',
        "session" => $_SESSION,
        "warning" => $warning,
        "customer"=>$customerDisplay
    ]);