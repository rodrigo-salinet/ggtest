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
} else if (isset($_POST['hdn_aprovar_orcamentos_preco_item_id_orcamento']) && isset($_POST['hdn_aprovar_orcamentos_preco_id_item']) && isset($_POST['hdn_aprovar_orcamentos_preco_id_preco'])) {
    $hdn_aprovar_orcamentos_preco_item_id_orcamento = $_POST['hdn_aprovar_orcamentos_preco_item_id_orcamento'];
    $hdn_aprovar_orcamentos_preco_id_item = $_POST['hdn_aprovar_orcamentos_preco_id_item'];
    $hdn_aprovar_orcamentos_preco_id_preco = $_POST['hdn_aprovar_orcamentos_preco_id_preco'];

    try {
        $str_sql_alterar_status_orcamento = "update `tbl_itens_orcamentos` set `id_preco` = $hdn_aprovar_orcamentos_preco_id_preco where `id_orcamento` = $hdn_aprovar_orcamentos_preco_item_id_orcamento and `id_item` = $hdn_aprovar_orcamentos_preco_id_item;";
        $sql_alterar_status_orcamento = mysqli_query($conexao, $str_sql_alterar_status_orcamento);

        $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Preço alterado com sucesso!';
    } catch (\Exception $e) {
        $data['message'] = "Não foi possível alterar o Preço!";
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>