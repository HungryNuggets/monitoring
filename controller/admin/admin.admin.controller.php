<?php

$info = "";

// UPDATE CUSTOMER
if (isset($_GET['update']) && ctype_digit($_GET['update'])){

    $adminToUpdate = $_GET['update'];

    // UPDATE
    $updateAdmin = $adminManager->updateAdminStatus($adminToUpdate);

    if ($updateAdmin) {
        header('Location: ?admin');
    } else {
        $info = 'La mise à jour n\'a pas pu se faire';
    }
}

// IF THE ADMIN WANT TO SEE HIS PROFIL
if (isset($_GET['profil']) && ctype_digit($_GET['profil'])) {

    require ROOT . "/controller/admin/crud/crud.admin.controller.php";

    exit();
}

// TWIG RENDER
echo $twig->render("admin/admin.html.twig",
    [
        "admin"=>$admin,
        "issueNotification"=>$issuesNotification ,
        "adminNotification"=>$adminNotification ,
        "session"=>$_SESSION,
        "allAdmin"=>$adminManager->selectAllAdmin(),
        "info"=>$info
    ]);