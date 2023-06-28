<?php
// phpinfo(); die();
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Ops! Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_aprovar_orcamentos_status_item_id_orcamento']) && isset($_POST['hdn_aprovar_orcamentos_status_id_status'])) {
    $hdn_aprovar_orcamentos_status_item_id_orcamento = $_POST['hdn_aprovar_orcamentos_status_item_id_orcamento'];
    $hdn_aprovar_orcamentos_status_id_status = $_POST['hdn_aprovar_orcamentos_status_id_status'];

    try {
        $str_sql_alterar_status_orcamento = "update `tbl_orcamentos` set `id_status_orcamento` = $hdn_aprovar_orcamentos_status_id_status where `id` = $hdn_aprovar_orcamentos_status_item_id_orcamento;";
        $sql_alterar_status_orcamento = mysqli_query($conexao, $str_sql_alterar_status_orcamento);

        $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Status alterado com sucesso!';
    } catch (\Exception $e) {
        $data['message'] = "Não foi possível alterar o status do orçamento";
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>