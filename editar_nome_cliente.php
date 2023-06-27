<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Nada aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_cliente_id_cliente']) && isset($_POST['hdn_editar_cliente_txt_cliente'])) {
    $hdn_editar_cliente_id_cliente = $_POST['hdn_editar_cliente_id_cliente'];
    $hdn_editar_cliente_txt_cliente = $_POST['hdn_editar_cliente_txt_cliente'];

    try {
        $str_sql_alterar_nome_cliente = "update `tbl_clientes` set `nome` = '$hdn_editar_cliente_txt_cliente' where `id` = $hdn_editar_cliente_id_cliente;";
        $sql_alterar_nome_cliente = mysqli_query($conexao, $str_sql_alterar_nome_cliente);

        $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Nome do Cliente alterado com sucesso!';
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível alterar o nome do cliente!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>