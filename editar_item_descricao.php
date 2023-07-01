<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Ops! Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_item_descricao_id_item']) && isset($_POST['hdn_editar_item_descricao'])) {
    $hdn_editar_item_descricao_id_item = $_POST['hdn_editar_item_descricao_id_item'];
    $hdn_editar_item_descricao = $_POST['hdn_editar_item_descricao'];

    try {
        $str_sql_editar_descricao_item = "update `tbl_itens` set `descricao` = '$hdn_editar_item_descricao' where `id` = $hdn_editar_item_descricao_id_item;";
        $sql_editar_descricao_item = mysqli_query($conexao, $str_sql_editar_descricao_item);
        $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Descrição alterada com sucesso!';
    } catch (\Exception $e) {
        $data['message'] = "Não foi possível alterar a Descrição!";
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>