<?php

// ADMIN HOME => CUSTOMER LIST
if (isset($_GET['customer'])){

    require ROOT."/controller/admin/customer.admin.controller.php";

    exit();
}

// ISSUE PAGE => LIST AND CONTACT INFO
if (isset($_GET['issue'])) {

    require ROOT."/controller/admin/issue.admin.controller.php";

    exit();
}

// ADMIN PAGE (LIST)
if (isset($_GET['admin'])) {

    require ROOT."/controller/admin/admin.admin.controller.php";

    exit();
}

// DISCONNECTION
if (isset($_GET['disconnection'])) {

    AdminManager::disconnection();
    header("Location: ./");
    exit();
}

require  ROOT."/controller/admin/home.admin.controller.php";