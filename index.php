<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "roundhouse.proxy.rlwy.net";
$user = "root";
$pass = "lYsmqQEDuzaIiBMdOSFOniKtKzSpIIHd";
$bd = "railway";
$porta = "58673";
echo "bbbbbbbb";
$conectar = @mysqli_connect($host,$user,$pass,$bd,$porta);
echo "aaaaaaa";

if (!$conectar) {
    die ("erro ".mysqli_connect_error());
}
    /*
else {
    echo "FOI";
}
*/

$parametro = $_POST['nome'];

if ($parametro == $_POST['nome']) {
    echo "Rosana";
}
/*
$email = $_POST['email'];
$senha = $_POST['senha'];
$dataNascimento = $_POST['dataNascimento'];
$imgPerfil = $_POST['imgPerfil'];
$pontos = $_POST['pontos'];
$dataCadastro = $_POST['dataCadastro'];
$idAstro = $_POST['idAstro'];

$sql = "INSERT INTO usuario VALUES ('$nome','$email','$senha',
'$dataNascimento',$imgPerfil,$pontos,'$dataCadastro',$idAstro)";

if (mysqli_query($conectar,$sql)) {
    echo "sucesso";
}
else {
    echo "erro";
}
*/
?>
