<?php
session_start();
require_once('conexao.php');

$redirect = 'novo_fornecedor.php';
$msg = "Nada aconteceu";

if (!isset($_SESSION['logado'])) {
    $redirect = 'login.php';
    $msg = "É necessário realizar o login para utilizar o sistema.";
} else if (isset($_POST['txt_nome_fornecedor'])) {
    $txt_nome_fornecedor = $_POST['txt_nome_fornecedor'];

    try {
        $str_sql_adicionar_fornecedor = "insert into `tbl_fornecedores` (`nome`) values ('$txt_nome_fornecedor');";
        if ($conexao->query($str_sql_adicionar_fornecedor) === TRUE) {
            $last_id = $conexao->insert_id;
            $msg = "Fornecedor $txt_nome_fornecedor [ID $last_id] adicionado com sucesso!";
        }
    } catch (\Exception $e) {
        $msg = "Ocorreu o erro: ." . str_replace(array("\r", "\n"), '', $e);
    }
}

header('Location: ' . $redirect . '?msg=' . htmlspecialchars($msg));
?>