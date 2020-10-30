<?php

/*try{
    $pdo = new PDO('oci:dbname=RAMAIS;host=sja-hsdb04.grupocavalcanti.intranet', 'root', 'sj456751862');
    $pdo->exec("set names utf8");
}*/

$tns = " 
(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = sja-hsdb04.grupocavalcanti.intranet)(PORT = 1521))
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = RM.GRUPOCAVALCANTI.INTRANET)
    )
  )
       ";
$db_username = "rm";
$db_password = "rm";

try{
    $pdo = new PDO("oci:dbname=".$tns."; charset=UTF8", $db_username,$db_password);
    $pdo->exec("set names utf8");
}catch(PDOException $e){
    echo ($e->getMessage());
}

?>