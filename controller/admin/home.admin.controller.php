<?php

// HOME CONTROLLER GLOBAL CALL
require ROOT . '/controller/global/home.controller.php';

// TWIG RENDER
echo $twig->render("public/home.html.twig",["admin"=>'yes']);