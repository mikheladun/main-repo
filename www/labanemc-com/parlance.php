<?php
    //echo phpinfo();

    define('PARLANCE_VERSION',  '0.5.0');
    define("PARLANCE_PATH", $_SERVER["DOCUMENT_ROOT"] . "/.parlance");

    require_once(PARLANCE_PATH . "/core/context.php");
    $context = ApplicationContext::instance();

    $_REQUEST['context'] = $context;

    require_once(PARLANCE_PATH . "/core/router.php");
    Router::instance()->dispatch($_REQUEST);

?>