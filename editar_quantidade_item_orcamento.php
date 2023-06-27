<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Ops! Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_orcamento_quantidade_item_id_orcamento']) && isset($_POST['hdn_editar_orcamento_quantidade_item_id_item']) && isset($_POST['hdn_editar_orcamento_quantidade_item'])) {
    $hdn_editar_orcamento_quantidade_item_id_orcamento = $_POST['hdn_editar_orcamento_quantidade_item_id_orcamento'];
    $hdn_editar_orcamento_quantidade_item_id_item = $_POST['hdn_editar_orcamento_quantidade_item_id_item'];
    $hdn_editar_orcamento_quantidade_item = $_POST['hdn_editar_orcamento_quantidade_item'];

    try {
        $str_sql_quantidade_item_orcamento = "update `tbl_itens_orcamentos` set `quantidade` = $hdn_editar_orcamento_quantidade_item where `id_orcamento` = $hdn_editar_orcamento_quantidade_item_id_orcamento and `id_item` = $hdn_editar_orcamento_quantidade_item_id_item;";
        $sql_quantidade_item_orcamento = mysqli_query($conexao, $str_sql_quantidade_item_orcamento);
        // $data['message'] = $str_sql_quantidade_item_orcamento;
        $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Quantidade do Item alterada com sucesso!';
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível alterar a quantidade do item!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>