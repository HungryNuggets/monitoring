<?php

$info="";

// UPDATE OF THE ISSUE STATUS
if (isset($_GET['update']) && ctype_digit($_GET['update'])) {

    $issueToUpdate = $_GET['update'];

    // UPDATE
    $updateIssue = $issueManager->updateIssue($_SESSION['id_admin'],$issueToUpdate);

    if ($updateIssue) {
        header('Location: ?issue');
    } else {
        $info = 'La mise à jour n\'a pas pu se faire';
    }
}

// TWIG RENDER
echo $twig->render("admin/issue.html.twig",
    [
        "admin"=>$admin,
        "issueNotification"=>$issuesNotification ,
        "adminNotification"=>$adminNotification ,
        "session"=>$_SESSION,
        "allIssue"=>$issueManager->selectAllIssue(),
        "info"=>$info
    ]);