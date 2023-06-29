<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Ops! Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_item_excluir_imagem'])) {
    $hdn_editar_item_excluir_imagem = $_POST['hdn_editar_item_excluir_imagem'];

    try {
        $str_sql_excluir_imagem_item = "update `tbl_itens` set `imagem` = '' where `id` = $hdn_editar_item_excluir_imagem;";
        $sql_excluir__imagemitem = mysqli_query($conexao, $str_sql_excluir_imagem_item);
        $data['message'] = '<div class="col text-center"><i class="fa fa-check-circle-o text-success"></i> Imagem excluída com sucesso! </div>';
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível excluir a imagem!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>