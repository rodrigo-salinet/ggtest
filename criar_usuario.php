<?php
session_start();
require_once('conexao.php');

$nome  = trim($_POST['nome']);
$login = trim($_POST['login']);
$senha = trim($_POST['senha']);
$rdg_tipos_usuarios = trim($_POST['rdg_tipos_usuarios']);

$str_sql_verificar_usuario = "select * from `tbl_usuarios` where `login` = '$login';";
$sql_verificar_usuario = mysqli_query($conexao, $str_sql_verificar_usuario);
$linhas_verificar_usuario = mysqli_num_rows($sql_verificar_usuario);

if ($linhas_verificar_usuario > 0) {
    $_SESSION['nome'] = $nome;
    $_SESSION['login'] = $login;
    $_SESSION['senha'] = $senha;
    $_SESSION['rdg_tipos_usuarios'] = $rdg_tipos_usuarios;
    return header('Location: cadastrar_usuario.php?msg=' . htmlspecialchars("O login $login já está cadastrado! Por favor escolha e digite outro login."));
}

unset($_SESSION['nome']);
unset($_SESSION['login']);
unset($_SESSION['senha']);
unset($_SESSION['rdg_tipos_usuarios']);

try {
    $str_sql_criar_usuario = "insert into `tbl_usuarios` (`nome`, `login`, `senha`, `id_tipo`) values ('$nome', '$login', md5('$senha'), $rdg_tipos_usuarios);";
    $sql_criar_usuario = mysqli_query($conexao, $str_sql_criar_usuario);
    return header('Location: login.php?msg=' . htmlspecialchars("Usuário cadastrado com sucesso! Favor realizar o login."));
} catch (\Exception $e) {
    die("
        Ops! Pelo motivo abaixo não foi possível criar o usuário $login
        <br />
        $e
    ");
}
?>