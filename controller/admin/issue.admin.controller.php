<?php

// ISSUES GLOBAL DISPLAY WITH OPTIONS
$issueManager = new IssueManager($DB);

// TWIG RENDER
echo $twig->render("admin/issue.html.twig",
    [
        "admin"=>'yes',
        "session"=>$_SESSION,
        "allIssue"=>$issueManager->selectAllIssue()
    ]);