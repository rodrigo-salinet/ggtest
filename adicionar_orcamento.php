<?php
session_start();
require_once('conexao.php');

$redirect = 'novo_orcamento.php';
$msg = "Nada aconteceu";
$get_id_orcamento = '';

if (!isset($_SESSION['logado'])) {
    $redirect = 'login.php';
    $msg = "É necessário realizar o login para utilizar o sistema.";
} else if (isset($_POST['sel_clientes'])) {
    $sel_clientes = $_POST['sel_clientes'];
    $id_usuario = $_SESSION['id_usuario'];

    try {
        $str_sql_adicionar_orcamento = "insert into `tbl_orcamentos` (`id_usuario`,`id_cliente`,`dia`,`mes`,`ano`,`hora`,`minuto`,`segundo`) values ($id_usuario, $sel_clientes, $dia, $mes, $ano, $hora, $minuto, $segundo);";
        if ($conexao->query($str_sql_adicionar_orcamento) === TRUE) {
            $last_id = $conexao->insert_id;
            $msg = "Orçamento [ID $last_id] adicionado com sucesso!";

            if (isset($_POST['chk_redirect'])) {
                $chk_redirect = $_POST['chk_redirect'];
                if ($chk_redirect == 'on') {
                    $redirect = 'adicionar_itens.php';
                    $get_id_orcamento = '&id_orcamento='. htmlspecialchars($last_id);
                }
            }
        }
    } catch (\Exception $e) {
        $msg = "Ocorreu o erro: ." . str_replace(array("\r", "\n"), '', $e);
    }
}

header('Location: ' . $redirect . '?msg=' . htmlspecialchars($msg) . $get_id_orcamento);
?>