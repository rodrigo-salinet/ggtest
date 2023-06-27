<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Ops! Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_orcamento_excluir_orcamento_id_orcamento'])) {
    $hdn_editar_orcamento_excluir_orcamento_id_orcamento = $_POST['hdn_editar_orcamento_excluir_orcamento_id_orcamento'];

    try {
        $str_sql_excluir_orcamento = "delete from `tbl_orcamentos` where `id` = $hdn_editar_orcamento_excluir_orcamento_id_orcamento;";
        $sql_excluir_orcamento = mysqli_query($conexao, $str_sql_excluir_orcamento);
        $data['message'] = '<div class="col text-center"><i class="fa fa-check-circle-o text-success"></i> Orçamento ' . $hdn_editar_orcamento_excluir_orcamento_id_orcamento . ' excluído com sucesso! </div>';
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível excluir o orçamento ' . $hdn_editar_orcamento_excluir_orcamento_id_orcamento . '!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>