<?php
include('./application/bootstrap.php');
$boostrap = new Bootstrap();
$boostrap->run();
echo"Sistema do candidato:Tiago Dizaro Santos";
Bootstrap::$frontController->dispatch();
?>

