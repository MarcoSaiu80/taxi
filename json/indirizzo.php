<?php
require_once '../phpclass/Indirizzo.php';
require_once '../phpclass/Utils.php';


echo Utils::getJsonFromSql("select * from indirizzo");