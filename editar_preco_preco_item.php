<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_preco_item_preco_id_preco_item']) && isset($_POST['hdn_editar_preco_item_preco'])) {
    $hdn_editar_preco_item_preco_id_preco_item = $_POST['hdn_editar_preco_item_preco_id_preco_item'];
    $hdn_editar_preco_item_preco = $_POST['hdn_editar_preco_item_preco'];
    $preco_item = str_replace(".", "", $hdn_editar_preco_item_preco);
    $preco_item = str_replace(",", ".", $preco_item);

    $str_sql_editar_preco_preco_item = "update `tbl_precos_itens` set `preco` = '$preco_item' where `id` = $hdn_editar_preco_item_preco_id_preco_item;";
    try {
        $sql_editar_preco_preco_item = mysqli_query($conexao, $str_sql_editar_preco_preco_item);
        $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Preço alterado com sucesso!';
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível alterar o Preço!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>