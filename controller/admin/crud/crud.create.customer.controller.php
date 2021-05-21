<?php

$warning = "";

// ON FORM SUBMISSION
if (isset($_POST['createCustomer'])) {

    if (empty($_POST['name_customer']) || empty($_POST['domain_customer']) || empty($_POST['hosting_customer']) || empty($_POST['contact_person_customer']) || empty($_POST['mail_customer']) || empty($_POST['phone_customer'])) {
        $warning .= "Remplissez tout les champs pour créer un nouveau client";
    } else {
        // INSERTION
        $customerInstance = new Customer($_POST);
        $insert = $customerManager->newCustomer($customerInstance);
        if ($insert) {
            header("Location: ?customer");
            exit();
        } else {
            $warning = "On a eu un petit soucis, réessaye !";
        }
    }
}

// TWIG RENDER
echo $twig->render("admin/crud/create_customer.html.twig",
    [
        "admin" => $admin,
        "issueNotification"=>$issuesNotification ,
        "adminNotification"=>$adminNotification ,
        "session" => $_SESSION,
        "warning" => $warning
    ]);