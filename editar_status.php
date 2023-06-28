<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_status_orcamento_id_status_orcamento']) && isset($_POST['hdn_editar_status_orcamento_txt_status_orcamento'])) {
    $hdn_editar_status_orcamento_id_status_orcamento = $_POST['hdn_editar_status_orcamento_id_status_orcamento'];
    $hdn_editar_status_orcamento_txt_status_orcamento = $_POST['hdn_editar_status_orcamento_txt_status_orcamento'];

    $str_sql_editar_status_orcamento = "update `tbl_status_orcamento` set `status` = '$hdn_editar_status_orcamento_txt_status_orcamento' where `id` = $hdn_editar_status_orcamento_id_status_orcamento;";
    try {
        $sql_editar_status_orcamento = mysqli_query($conexao, $str_sql_editar_status_orcamento);
        $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Status de Orçamento alterado com sucesso!';
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível alterar o Status de Orçamento!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>