<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_preco_item_id_preco_item']) && isset($_POST['hdn_editar_preco_item_id_item'])) {
    $hdn_editar_preco_item_id_preco_item = $_POST['hdn_editar_preco_item_id_preco_item'];
    $hdn_editar_preco_item_id_item = $_POST['hdn_editar_preco_item_id_item'];

    $str_sql_editar_id_item_preco_item = "update `tbl_precos_itens` set `id_item` = '$hdn_editar_preco_item_id_item' where `id` = $hdn_editar_preco_item_id_preco_item;";
    try {
        $sql_editar_id_item_preco_item = mysqli_query($conexao, $str_sql_editar_id_item_preco_item);
        $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Item alterado com sucesso!';
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível alterar o Item!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>