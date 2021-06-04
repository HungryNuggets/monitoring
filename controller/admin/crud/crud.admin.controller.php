<?php

$warningInfo = "";
$warningPwd = "";
$thisAdmin = $adminManager->selectOneAdmin($_GET['profil']);

// IF THE PROFIL ISN'T THE LOGGED ADMIN
if ($_SESSION['id_admin'] !== $_GET['profil']) {

    header('Location: ?admin');
    exit();

}

// ADMIN INFOS CHANGES
if(isset($_POST['adminInfoUpdate'])){

    if (empty($_POST['nickname_admin']) || empty($_POST['id_admin']) || empty($_POST['mail_admin'])) {
        $warningInfo .= "Tout les champs doivent être rempli";
    } else {

        // VERIFY EXISTENCE
        $inputVerify = $adminManager->verifyExistence($_POST['nickname_admin'],$_POST['mail_admin']);

        // IF LOGIN OR MAIL ALREADY USED
        if($inputVerify > 1) {

            $warningInfo = "Ce pseudo ou cette adresse mail sont déjà utilisé";

        // IF NOT ALREADY USED
        } else {

            // UPDATE
            $admin = new Admin($_POST);
            $update = $adminManager->updateAdminInfos($admin);
            if($update){
                $thisAdmin = $adminManager->selectOneAdmin($_GET['profil']);
                $warningInfo .= "Les changements ont bien été pris en compte";
            } else {
                $warningInfo = "On a eu un petit soucis, réessaye !";
            }
        }
    }
}

// PWD UPDATE
if (isset($_POST['adminPwdUpdate'])) {

    // IF IT'S NOT THE RIGHT PWD FOR THIS ADMIN
    if (!($adminManager->adminPwdVerify($_POST['id_admin'],$_POST['oldPwd']))) {

        $warningPwd .= "Le mot de passe donné est erroné";

    // IF THE TWO NEW PASSWORDS AREN'T THE SAME
    } else if ($_POST['pwd_admin'] !== $_POST['checkupNewPwd']) {

        $warningPwd .= "Le nouveau mot de passe et sa répétition doivent être identique";

    } else {

        // UPDATE
        $admin = new Admin($_POST);
        $update = $adminManager->updateAdminPassword($admin);
        if($update){
            $warningPwd .= "Le changement de mot de passe a bien été pris en compte";
        } else {
            $warningPwd = "On a eu un petit soucis, réessaye !";
        }

    }
}

// TWIG RENDER
echo $twig->render("admin/profil_admin.html.twig",
    [
        "admin"=>$admin,
        "issueNotification"=>$issuesNotification ,
        "adminNotification"=>$adminNotification ,
        "session"=>$_SESSION,
        "thisAdmin"=>$thisAdmin,
        "warningInfo"=>$warningInfo,
        "warningPwd"=>$warningPwd
    ]);