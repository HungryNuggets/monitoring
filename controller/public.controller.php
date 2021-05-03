<?php

if (isset($_GET['connection'])) {

    require ROOT."/controller/public/connexion.public.controller.php";

    exit();
}

require  ROOT."/controller/public/home.public.controller.php";