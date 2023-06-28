<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Nada aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_fornecedor_id_fornecedor']) && isset($_POST['hdn_editar_fornecedor_txt_fornecedor'])) {
    $hdn_editar_fornecedor_id_fornecedor = $_POST['hdn_editar_fornecedor_id_fornecedor'];
    $hdn_editar_fornecedor_txt_fornecedor = $_POST['hdn_editar_fornecedor_txt_fornecedor'];

    try {
        $str_sql_alterar_nome_fornecedor = "update `tbl_fornecedores` set `nome` = '$hdn_editar_fornecedor_txt_fornecedor' where `id` = $hdn_editar_fornecedor_id_fornecedor;";
        $sql_alterar_nome_fornecedor = mysqli_query($conexao, $str_sql_alterar_nome_fornecedor);

        $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Nome do Fornecedor alterado com sucesso!';
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível alterar o Nome do Fornecedor!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>