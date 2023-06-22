<?php
session_start();
require_once('conexao.php');

$login = trim(@$_POST['login']);
$senha = trim(@$_POST['senha']);

$str_sql_verificar_usuario = "select * from `tbl_usuarios` where `login` = '$login' and senha = md5('$senha');";
$sql_verificar_usuario = mysqli_query($conexao, $str_sql_verificar_usuario);
$qtd_verificar_usuario = mysqli_num_rows($sql_verificar_usuario);

if ($qtd_verificar_usuario == 1) {
    for ($i = 0; $i < $qtd_verificar_usuario; $i++) {
        $verificar_usuario = mysqli_fetch_array($sql_verificar_usuario);
        $tipo_usuario = $verificar_usuario['id_tipo'];
        $id_usuario = $verificar_usuario['id'];
    }
    $_SESSION['logado'] = true;
    $_SESSION['tipo_usuario'] = $tipo_usuario;
    $_SESSION['id_usuario'] = $id_usuario;
    return header('Location: index.php?msg=' . htmlspecialchars("Login realizado com sucesso."));
}

unset($_SESSION['logado']);

return header('Location: login.php?msg=' . htmlspecialchars("Login ou senha inválidos! Por favor verifique sua digitação e tente novamente."));
?>