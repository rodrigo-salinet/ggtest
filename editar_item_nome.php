<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Ops! Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_item_nome_id_item']) && isset($_POST['hdn_editar_item_nome'])) {
    $hdn_editar_item_nome_id_item = $_POST['hdn_editar_item_nome_id_item'];
    $hdn_editar_item_nome = $_POST['hdn_editar_item_nome'];

    try {
        $str_sql_editar_nome_item = "update `tbl_itens` set `nome` = '$hdn_editar_item_nome' where `id` = $hdn_editar_item_nome_id_item;";
        $sql_editar_nome_item = mysqli_query($conexao, $str_sql_editar_nome_item);
        $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Nome alterado com sucesso!';
    } catch (\Exception $e) {
        $data['message'] = "Não foi possível alterar o Nome!";
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>