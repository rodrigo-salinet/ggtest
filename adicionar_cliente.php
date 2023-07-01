<?php
session_start();
require_once('conexao.php');

$redirect = 'novo_cliente.php';
$msg = "Nada aconteceu";
$get_id_cliente = '';

if (!isset($_SESSION['logado'])) {
    $redirect = 'login.php';
    $msg = "É necessário realizar o login para utilizar o sistema.";
} else if (isset($_POST['txt_nome_cliente'])) {
    $txt_nome_cliente = $_POST['txt_nome_cliente'];
    $id_usuario = $_SESSION['id_usuario'];

    try {
        $str_sql_adicionar_cliente = "insert into `tbl_clientes` (`nome`) values ('$txt_nome_cliente');";
        if ($conexao->query($str_sql_adicionar_cliente) === TRUE) {
            $last_id = $conexao->insert_id;
            $msg = "Cliente $txt_nome_cliente [ID $last_id] adicionado com sucesso!";

            if (isset($_POST['chk_redirect'])) {
                $chk_redirect = $_POST['chk_redirect'];
                if ($chk_redirect == 'on') {
                    $redirect = 'novo_orcamento.php';
                    $get_id_cliente = '&id_cliente=' . htmlspecialchars($last_id);
                }
            }
        }
    } catch (\Exception $e) {
        $msg = "Ocorreu o erro: ." . str_replace(array("\r", "\n"), '', $e);
    }
}

header('Location: ' . $redirect . '?msg=' . htmlspecialchars($msg) . $get_id_cliente);
?>