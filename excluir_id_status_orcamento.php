<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_status_orcamento_excluir_id_status_orcamento'])) {
    $hdn_editar_status_orcamento_excluir_id_status_orcamento = $_POST['hdn_editar_status_orcamento_excluir_id_status_orcamento'];

    try {
        $str_sql_excluir_status_orcamento = "delete from `tbl_status_orcamento` where `id` = $hdn_editar_status_orcamento_excluir_id_status_orcamento;";
        $sql_excluir_status_orcamento = mysqli_query($conexao, $str_sql_excluir_status_orcamento);
        $data['message'] = '<div class="col text-center"><i class="fa fa-check-circle-o text-success"></i> Status de Orcamento ' . $hdn_editar_status_orcamento_excluir_id_status_orcamento . ' excluído com sucesso! </div>';
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível excluir o Status de Orcamento ' . $hdn_editar_status_orcamento_excluir_id_status_orcamento . '!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>