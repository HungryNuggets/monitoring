<?php

$warningSignIn = "";
$warningSignUp = "";

// SIGN IN
if (isset($_POST['signin'])) {
    // SOMETHING
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

    }
}

// EMAIL CONFIRMATION
    if (isset($_GET['registration'])) {

    }

// TWIG RENDER
    echo $twig->render("public/connection.html.twig", ["warningSignUp" => $warningSignUp, "warningSignIn" => $warningSignIn, "admin" => 'no']);