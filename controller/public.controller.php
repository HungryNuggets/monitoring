<?php

// ISSUES NOTIFICATION
$issuesNotification = $issueManager->selectOngoingIssue();
// USER WAITING FOR VALIDATION NOTIFICATION
$adminNotification  = $adminManager->selectHalfValidatedAdmins();

if (isset($_GET['connection'])) {

    require ROOT."/controller/public/connexion.public.controller.php";

    exit();
}

require  ROOT."/controller/public/home.public.controller.php";