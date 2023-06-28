<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_fornecedor_excluir_id_fornecedor'])) {
    $hdn_editar_fornecedor_excluir_id_fornecedor = $_POST['hdn_editar_fornecedor_excluir_id_fornecedor'];

    try {
        $str_sql_excluir_fornecedor = "delete from `tbl_fornecedores` where `id` = $hdn_editar_fornecedor_excluir_id_fornecedor;";
        $sql_excluir_fornecedor = mysqli_query($conexao, $str_sql_excluir_fornecedor);
        $data['message'] = '<div class="col text-center"><i class="fa fa-check-circle-o text-success"></i> Fornecedor ' . $hdn_editar_fornecedor_excluir_id_fornecedor . ' excluído com sucesso! </div>';
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível excluir o Fornecedor ' . $hdn_editar_fornecedor_excluir_id_fornecedor . '!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>