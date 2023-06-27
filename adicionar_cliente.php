<?php
session_start();
require_once('conexao.php');

$redirect = 'novo_cliente.php';
$msg = "Nada aconteceu";

if (!isset($_SESSION['logado'])) {
    $redirect = 'login.php';
    $msg = "É necessário realizar o login para utilizar o sistema.";
} else if (isset($_POST['txt_nome_cliente'])) {
    $txt_nome_cliente = $_POST['txt_nome_cliente'];
    $id_usuario = $_SESSION['id_usuario'];

    try {
        $str_sql_adicionar_cliente = "insert into `tbl_clientes` (`nome`) values ('$txt_nome_cliente');";
        $sql_adicionar_cliente = mysqli_query($conexao, $str_sql_adicionar_cliente);
        $msg = 'Cliente adicionado com sucesso!';
    } catch (\Exception $e) {
        $msg = "Ocorreu o erro: ." . str_replace(array("\r", "\n"), '', $e);
    }
}

header('Location: ' . $redirect . '?msg=' . htmlspecialchars($msg));
?>