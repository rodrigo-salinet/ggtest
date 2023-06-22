<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Ops! Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_id_orcamento']) && isset($_POST['hdn_id_usuario']) && isset($_POST['hdn_id_item']) && isset($_POST['hdn_quantidade'])) {
    $hdn_id_orcamento = $_POST['hdn_id_orcamento'];
    $hdn_id_usuario = $_POST['hdn_id_usuario'];
    $hdn_id_item = $_POST['hdn_id_item'];
    $hdn_quantidade = $_POST['hdn_quantidade'];

    try {
        $str_sql_itens_oracamentos = "select * from `tbl_itens_orcamentos` where `id_item` = $hdn_id_item and `id_orcamento` = $hdn_id_orcamento;";
        $sql_itens_orcamentos = mysqli_query($conexao, $str_sql_itens_oracamentos);
        $qtd_itens_orcamentos = mysqli_num_rows($sql_itens_orcamentos);

        if ($qtd_itens_orcamentos > 0) {
            $data['message'] = '<i class="fa fa-ban text-danger"></i> Este item já foi adicionado! Escolha outro.';
        } else {
            $str_sql_adicionar_item = "insert into `tbl_itens_orcamentos` (`id_usuario`,`id_orcamento`,`id_item`,`quantidade`) values ($hdn_id_usuario, $hdn_id_orcamento, $hdn_id_item, $hdn_quantidade);";
            $sql_adicionar_item = mysqli_query($conexao, $str_sql_adicionar_item);
            $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Item adicionado com sucesso!';
        }
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível adicionar o item!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>