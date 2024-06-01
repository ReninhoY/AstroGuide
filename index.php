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

if ($_POST) {
    $parametros = $_POST['data'];
    $parametrosDivididos = explode("#", $parametros);
    $nome = $parametrosDivididos[0];
    $email = $parametrosDivididos[1];
    $senha = $parametrosDivididos[2];
    echo "var nome $nome e var email $email e var senha $senha";
    $sql1 = "INSERT INTO Astro VALUES(1,'Marte')";
    $sql2 = "INSERT INTO Usuario(Id_Usuario,Nome_Usuario,Email_Responsavel,Senha,Dt_Nascimento,
    Ft_Perfil,Total_Pontuacao,Dt_Cadastro,Id_Astro) VALUES
    (1,'$nome','$email','$senha','2000-05-05',1,100,'2024-05-31',1)";
    $query = mysqli_query($conectar,$sql1);
    if ($query) {
        echo "inserido1";
    }
    else {
        echo "naoInserido1";
    }
$query2 = mysqli_query($conectar,$sql2);
    if ($query2) {
        echo "inserido2";
    }
    else {
        echo "naoInserido2";
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
