<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Ops! Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_orcamento_editar_cliente_id_orcamento']) && isset($_POST['hdn_editar_orcamento_editar_cliente_id_cliente'])) {
    $hdn_editar_orcamento_editar_cliente_id_orcamento = $_POST['hdn_editar_orcamento_editar_cliente_id_orcamento'];
    $hdn_editar_orcamento_editar_cliente_id_cliente = $_POST['hdn_editar_orcamento_editar_cliente_id_cliente'];

    try {
        $str_sql_editar_cliente_orcamento = "update `tbl_orcamentos` set `id_cliente` = $hdn_editar_orcamento_editar_cliente_id_cliente where `id` = $hdn_editar_orcamento_editar_cliente_id_orcamento;";
        $sql_editar_cliente_orcamento = mysqli_query($conexao, $str_sql_editar_cliente_orcamento);
        $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Cliente alterado com sucesso!';
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível alterar o cliente!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>