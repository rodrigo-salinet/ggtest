<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Ops! Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_item_excluir_item_id_item'])) {
    $hdn_editar_item_excluir_item_id_item = $_POST['hdn_editar_item_excluir_item_id_item'];

    try {
        $str_sql_excluir_item = "delete from `tbl_itens` where `id` = $hdn_editar_item_excluir_item_id_item;";
        $sql_excluir_item = mysqli_query($conexao, $str_sql_excluir_item);
        $data['message'] = '<div class="col text-center"><i class="fa fa-check-circle-o text-success"></i> Item ' . $hdn_editar_item_excluir_item_id_item . ' excluído com sucesso! </div>';
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível excluir o item ' . $hdn_editar_item_excluir_item_id_item . '!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>