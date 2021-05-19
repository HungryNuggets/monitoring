<?php

$warningSignIn = "";
$warningSignUp = "";

// SIGN IN
if (isset($_POST['signin'])) {

    $adminInstance = new Admin($_POST);

    $verifyRights = $adminManager->signInRightVerification($adminInstance);

    if ($verifyRights === ''){
        if($adminManager->signIn($adminInstance)) {
            header("Location: ?customer");
            exit();
        }
    } else {
        $warningSignIn = $verifyRights;
    }
}


// SIGN UP
if (isset($_POST['signup'])) {

    // IF ONE OF THE FIELDS ARE EMPTY
    if (empty($_POST['nickname_admin']) || empty($_POST['mail_admin']) || empty($_POST['pwd_admin']) || empty($_POST['pwd_verify'])) {

        // WARNING
        $warningSignUp = "Remplissez tous les champs pour vous inscrire.";

        // IF THE TWO PASSWORD DO NOT MATCH
    } else if ($_POST['pwd_admin'] !== $_POST['pwd_verify']) {

        // WARNING
        $warningSignUp = "Les deux mots de passe doivent être identiques.";

    } else {

        // CHECK IF THE NICKNAME OR EMAIL ARE ALREADY USED
        $verifyExistence = $adminManager->verifyExistence($_POST['nickname_admin'], $_POST['mail_admin']);

        // IF ALREADY USED
        if ($verifyExistence >= 1){
            // WARNING TO DISPLAY IN HOME_PAGE.HTML.TWIG
            $warningSignUp = "Ce pseudo ou cette adresse e-mail sont déjà utilisé !";

            // IF NOT USED
        } else if ($verifyExistence === 0){

            // NEW USER
            $userInstance = new Admin($_POST);

            // IF SIGN UP SUCCESSFUL
            if ($adminManager->signUp($userInstance)){

                // MAIL DATAS
                $userMail = $adminManager->selectSignUp($_POST['mail_admin']);

                // MAIL FOR CONFIRMATION
                $mailSignUp = new Swift_Mailer($transport);
                $messageSignUp = (new Swift_Message('Confirmer votre compte || Monitoring Hungry Nuggets'))
                    ->setFrom([MAIL_ADDRESS => 'Hungry Nuggets'])
                    ->setTo([$_POST['mail_admin'] => $userMail['nickname_admin']]);

                // IMAGES
                $imageMain = $messageSignUp->embed(Swift_Image::fromPath('img/mails/entete-mail.jpg'));
                $imageFooter = $messageSignUp->embed(Swift_Image::fromPath('img/mails/bottom-mail.png'));

                // SET MAIL BODY
                $messageSignUp->setBody(
                    MailManager::mailVerification(["user"=>$userMail,"imgTop"=>$imageMain,"imgBottom"=>$imageFooter]),
                    'text/html'
                );

                if ($mailSignUp->send($messageSignUp)){

                    // WARNING
                    $warningSignUp = "Hello ".$_POST['nickname_admin']." ! Tu vas recevoir un mail :)";

                } else {

                    // WARNING
                    $warningSignUp = "Désolé ".$_POST['nickname_admin'].", mais nous avons eu un soucis";

                }
            }
        }
    }
}

// EMAIL CONFIRMATION
    if (isset($_GET['registration'])) {

        // UPDATE OF THE REGISTRATION STATUS
        $registration = $adminManager->updateAdminValidationStatus($_GET['user'], $_GET['key']);

        if ($registration){

            $admins = $adminManager->selectValidatedAdmins();
            $adminList= [];
            foreach ($admins as $admin) {
                $adminList[] = $admin['mail_admin'];
            }

            // MAIL FOR CONFIRMATION
            $mailRegistration = new Swift_Mailer($transport);
            $messageRegistration = (new Swift_Message('Nouveau compte en attente de validation'))
                ->setFrom([MAIL_ADDRESS => 'Hungry Nuggets'])
                ->setTo($adminList);

            // IMAGES
            $imageMain = $messageRegistration->embed(Swift_Image::fromPath('img/mails/entete-mail.jpg'));
            $imageFooter = $messageRegistration->embed(Swift_Image::fromPath('img/mails/bottom-mail.png'));

            // SET MAIL BODY
            $messageRegistration->setBody(
                MailManager::mailValidation(["user"=>$_GET['user'],"imgTop"=>$imageMain,"imgBottom"=>$imageFooter]),
                'text/html'
            );

            if ($mailRegistration->send($messageRegistration)){

                // WARNING
                $warningSignIn = "Hello " . $_GET['user'] . " ! Tu as bien validé ton adresse e-mail, un administrateur va étudier ta demande !";

            } else {

                // WARNING
                $warningSignUp = "Désolé " . $_GET['user'] . ", mais nous avons eu un soucis";

            }

        } else {

            // WARNING
            $warningSignIn = "Hello ".$_GET['user'].", pourrais-tu réessayer ?";

        }
    }

// TWIG RENDER
    echo $twig->render("public/connection.html.twig", ["warningSignUp" => $warningSignUp, "warningSignIn" => $warningSignIn, "admin" => $admin]);