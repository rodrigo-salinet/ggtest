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
        $str_sql_adicionar_item = "insert into `tbl_itens_orcamentos` (`id_usuario`,`id_orcamento`,`id_item`,`quantidade`) values ($hdn_id_usuario, $hdn_id_orcamento, $hdn_id_item, $hdn_quantidade);";
        $sql_adicionar_item = mysqli_query($conexao, $str_sql_adicionar_item);
        $data['message'] = '<i class="fa fa-check"></i> Item adicionado com sucesso!';
    } catch (PDOException $e) {
        $data['message'] = 'Não foi possível adicionar o item!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>