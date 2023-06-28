<?php
session_start();
require_once('conexao.php');

$redirect = 'novo_status_orcamento.php';
$msg = "Nada aconteceu";

if (!isset($_SESSION['logado'])) {
    $redirect = 'login.php';
    $msg = "É necessário realizar o login para utilizar o sistema.";
} else if (isset($_POST['txt_status_orcamento'])) {
    $txt_status_orcamento = $_POST['txt_status_orcamento'];

    try {
        $str_sql_adicionar_status_orcamento = "insert into `tbl_status_orcamento` (`status`) values ('$txt_status_orcamento');";
        $sql_adicionar_status_orcamento = mysqli_query($conexao, $str_sql_adicionar_status_orcamento);
        $msg = 'Status de orçamento adicionado com sucesso!';
    } catch (\Exception $e) {
        $msg = "Não foi possível adicionar o status de orçamento.";
    }
}

header('Location: ' . $redirect . '?msg=' . htmlspecialchars($msg));
?>