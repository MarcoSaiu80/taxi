<?php
require_once '../phpclass/Utils.php';
//echo $_REQUEST['sql'];
echo Utils::getJsonFromSql($_REQUEST['sql']);