<?php

// Exibir erros da api
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Importações necessárias para a validação de email
require_once ('PHPMailer-master/src/PHPMailer.php');
require_once ('PHPMailer-master/src/SMTP.php');
require_once ('PHPMailer-master/src/Exception.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Variáveis de acesso
$host = "roundhouse.proxy.rlwy.net";
$user = "root";
$pass = "lYsmqQEDuzaIiBMdOSFOniKtKzSpIIHd";
$bd = "railway";
$porta = "58673";

// Executar conexão
$conectar = @mysqli_connect($host,$user,$pass,$bd,$porta);

// Verificar se a conexão foi bem sucedida
if (!$conectar) {
    die ("erro ".mysqli_connect_error());
}

// Tratando requisição de cadastro
if (isset($_POST['cadastro'])) {
    // Armazenando os dados contidos na requisição
    $parametros = $_POST['cadastro'];

    // Dividindo os valores em variáveis diferentes
    $parametrosDivididos = explode("#|#", $parametros);
    $nome = $parametrosDivididos[0];
    $email = $parametrosDivididos[1];
    $senha = $parametrosDivididos[2];
    $dataNasc = $parametrosDivididos[3];
    $dataAtual = $parametrosDivididos[4];
    $imgPerfil = $parametrosDivididos[5];

    // Verificar se o email inserido já existe na base de dados
    $sqlVerificarDuplicacaoEmail = "SELECT * FROM Usuario WHERE Email_Responsavel = ?";
    
    // Previnindo a variável de consulta contra SQL Injection
    $verificarInjection = $conectar->prepare($sqlVerificarDuplicacaoEmail);
    
    if ($verificarInjection) {
        // Substituir a interrogação pelo email inserido
        $verificarInjection->bind_param("s", $email);
        // Executar a consulta
        $verificarInjection->execute();
        $resultadoEmail = $verificarInjection->get_result();
     
        // Caso haja mais de um registro com o mesmo email
        if ($resultadoEmail->num_rows >= 1) {
            echo "email duplicado";
        }
        else {
            $sql = "INSERT INTO Usuario(Nome_Usuario,Email_Responsavel,Senha,Dt_Nascimento,Dt_Cadastro,Ft_Perfil,Total_Pontuacao,Id_Astro) VALUES ('$nome','$email','$senha','$dataNasc','$dataAtual','$imgPerfil',0,1)";
            $verificarInjection = $conectar->prepare($sql);

            if ($verificarInjection) {
                $verificarInjection->execute();
                $resultadoCadastro = $verificarInjection->get_result();

                if ($resultadoCadastro) {
                    echo "inserido";
                }
                else {
                    echo "naoInserido";
                }
                $verificarInjection->close();

            }

        }
        $verificarInjection->close();
    } else {
        echo "erro para verificar injecao";
    }
    
}


if (isset($_POST['login'])) {
    $parametros = $_POST['login'];
    $parametrosDivididos = explode("#|#", $parametros);
    $email = $parametrosDivididos[0];
    $senha = $parametrosDivididos[1];

    $sql = "SELECT * FROM Usuario WHERE Email_Responsavel = ? AND Senha = ?";
    $verificarInjection = $conectar->prepare($sql);
    if ($verificarInjection) {
        $verificarInjection->bind_param("ss", $email, $senha);
        $verificarInjection->execute();
        $resultado = $verificarInjection->get_result();
        if ($resultado->num_rows > 0) {
            $linha = $resultado->fetch_assoc();
            $nomeUsuario = $linha['Nome_Usuario'];
            $imgUsuario = $linha['Ft_Perfil'];
            $senha = $linha['Senha'];
            $dtNascimento = $linha['Dt_Nascimento'];
            $pontuacao = $linha['Total_Pontuacao'];
            $dtCadastro = $linha['Dt_Cadastro'];
            $astroAtual = $linha['Id_Astro'];
            echo "logado####$nomeUsuario####$imgUsuario####$senha####$dtNascimento####$pontuacao####$dtCadastro####$astroAtual";
        } else {
            echo "senha invalida";
        }
        $verificarInjection->close();
    } else {
        echo "erro para verificar injecao";
    }
}


if (isset($_POST['verificarExistenciaEmail'])) {
    $email = $_POST['verificarExistenciaEmail'];
    $sql = "SELECT * FROM Usuario WHERE Email_Responsavel = ?";
    $verificarInjection = $conectar->prepare($sql);
    if ($verificarInjection) {
        $verificarInjection->bind_param("s", $email);
        $verificarInjection->execute();
        $resultado = $verificarInjection->get_result();
        if ($resultado->num_rows > 0) {
            echo "existe";
        } else {
            echo "inexistente";
        }
}
}

if (isset($_POST['alterarSenha'])) {
    $parametros = $_POST['alterarSenha'];
    $parametrosDivididos = explode("#|#", $parametros);
    $email = $parametrosDivididos[0];
    $senha = $parametrosDivididos[1];
    $sql = "UPDATE Usuario SET Senha = ? WHERE Email_Responsavel = ?";
    $verificarInjection = $conectar->prepare($sql);
    if ($verificarInjection) {
        $verificarInjection->bind_param("ss",$senha,$email);
        
        if ($verificarInjection->execute()) {
            if ($verificarInjection->affected_rows > 0) {
                echo "alterado";
            }
            else {
                echo "inalterado";
            }
        }
     
    $verificarInjection->close();

    }
}

function enviarEmailBoasVindas($nickname,$email,$n1,$n2,$n3,$n4) {
    
}

if (isset($_POST['verificarEmail'])) {
    $parametros = $_POST['verificarEmail'];
    $parametrosDivididos = explode("#|#", $parametros);
    $nomeUsuario = $parametrosDivididos[0];
    $email = $parametrosDivididos[1];
    $cod1 = $parametrosDivididos[2];
    $cod2 = $parametrosDivididos[3];
    $cod3 = $parametrosDivididos[4];
    $cod4 = $parametrosDivididos[5];

    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'astroguidegroup@gmail.com'; 
        $mail->Password = 'farkppzhndyknioc'; 
        $mail->Port = 587;
    
        $mail->setFrom('astroguidegroup@gmail.com');
        $mail->addAddress($email);
    
        $mail->isHTML(true);
        $mail->Subject = 'Bem-vindo ao AstroGuide';
        $mail->Body = "<html><body>";
        $mail->Body .= "<style> * { padding: 0; margin: 0; font-family: Verdana, Geneva, Tahoma, sans-serif; } header { width: 100%; height: 30vw; background-color: #1f1f1f; color: #fff; display: flex; justify-content: center; align-items: center; } h2,b,p { color: #000; text-align: center; font-size: 2em; } body { display: flex; justify-content: center; align-items: center; flex-direction: column; gap: 5vw; } </style>";
        $mail->Body .= "<header><h1>$nomeUsuario, bem vindo ao AstroGuide!</h1></header>";
        $mail->Body .= "<main><h2>Seu código de verificação é:</h2>";
        $mail->Body .= "<p><b>$cod1 $cod2 $cod3 $cod4</b></p>";
        $mail->Body .= "</main></body></html>";
    
        if ($mail->send()){
            echo "Enviado com sucesso";
        }
        else {
            echo "Email não enviado";
        }
    }
    catch (Exception $e){
        echo "Mensagem não enviada: {$mail->ErrorInfo}";
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
