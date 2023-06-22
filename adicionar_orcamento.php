<?php
session_start();
require_once('conexao.php');

$redirect = 'index.php';
$msg = "Nada aconteceu";

if (!isset($_SESSION['logado'])) {
    $redirect = 'login.php';
    $msg = "É necessário realizar o login para utilizar o sistema.";
} else if (isset($_POST['sel_clientes'])) {
    $sel_clientes = $_POST['sel_clientes'];
    $id_usuario = $_SESSION['id_usuario'];

    try {
        $str_sql_adicionar_orcamento = "insert into `tbl_orcamentos` (`id_usuario`,`id_cliente`,`dia`,`mes`,`ano`,`hora`,`minuto`,`segundo`) values ($id_usuario, $sel_clientes, $dia, $mes, $ano, $hora, $minuto, $segundo);";
        $sql_adicionar_item = mysqli_query($conexao, $str_sql_adicionar_orcamento);
        $msg = 'Orçamento adicionado com sucesso!';
    } catch (\Exception $e) {
        $msg = "Ocorreu o erro: $e.";
    }
}

return header('Location: ' . $redirect . '?msg=' . htmlspecialchars($msg));

?>