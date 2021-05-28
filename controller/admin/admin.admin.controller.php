<?php

$info = "";

// UPDATE CUSTOMER
if (isset($_GET['update']) && ctype_digit($_GET['update'])){

    $adminToUpdate = $_GET['update'];

    // UPDATE
    $updateAdmin = $adminManager->updateAdminStatus($adminToUpdate);

    if ($updateAdmin) {

        // ADMIN TO CONTACT
        $adminUpdated = $adminManager->selectOneAdmin($adminToUpdate);

        // MAIL FOR CONFIRMATION
        $mailUpdateAdmin = new Swift_Mailer($transport);
        $messageUpdateAdmin = (new Swift_Message('Votre compte a été validé || Monitoring Hungry Nuggets'))
            ->setFrom([MAIL_ADDRESS => 'Hungry Nuggets'])
            ->setTo([$adminUpdated['mail_admin']=>$adminUpdated['nickname_admin']]);

        // IMAGES
        $imageMain = $messageUpdateAdmin->embed(Swift_Image::fromPath('img/mails/entete-mail.jpg'));
        $imageText = $messageUpdateAdmin->embed(Swift_Image::fromPath('img/mails/update-admin.png'));
        $imageFooter = $messageUpdateAdmin->embed(Swift_Image::fromPath('img/mails/bottom-mail.png'));

        // SET MAIL BODY
        $messageUpdateAdmin->setBody(
            MailManager::mailGeneric(["user"=>$_GET['user'],"imgTop"=>$imageMain,"imgText"=>$imageText,"imgBottom"=>$imageFooter]),
            'text/html'
        );

        $mailUpdateAdmin->send($messageUpdateAdmin);
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