<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "roundhouse.proxy.rlwy.net";
$user = "root";
$pass = "lYsmqQEDuzaIiBMdOSFOniKtKzSpIIHd";
$bd = "railway";
$porta = "58673";
$conectar = @mysqli_connect($host,$user,$pass,$bd,$porta);

if (!$conectar) {
    die ("erro ".mysqli_connect_error());
}
    /*
else {
    echo "FOI";
}
*/

if (isset($_POST['cadastro'])) {
    $parametros = $_POST['cadastro'];
    $parametrosDivididos = explode("#|#", $parametros);
    $nome = $parametrosDivididos[0];
    $email = $parametrosDivididos[1];
    $senha = $parametrosDivididos[2];
    $dataNasc = $parametrosDivididos[3];
    $dataAtual = $parametrosDivididos[4];
    $imgPerfil = $parametrosDivididos[5];
    
    $sql = "INSERT INTO Usuario(Nome_Usuario,Email_Responsavel,Senha,Dt_Nascimento,Dt_Cadastro,Ft_Perfil,Total_Pontuacao,Id_Astro) VALUES ('$nome','$email','$senha','$dataNasc','$dataAtual','$imgPerfil',0,1)";
    $query = mysqli_query($conectar,$sql);
    if ($query2) {
        echo "inserido";
    }
    else {
        echo "naoInserido";
    }
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
