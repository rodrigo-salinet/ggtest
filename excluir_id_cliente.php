<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_cliente_excluir_id_cliente'])) {
    $hdn_editar_cliente_excluir_id_cliente = $_POST['hdn_editar_cliente_excluir_id_cliente'];

    try {
        $str_sql_excluir_cliente = "delete from `tbl_clientes` where `id` = $hdn_editar_cliente_excluir_id_cliente;";
        $sql_excluir_cliente = mysqli_query($conexao, $str_sql_excluir_cliente);
        $data['message'] = '<div class="col text-center"><i class="fa fa-check-circle-o text-success"></i> Cliente ' . $hdn_editar_cliente_excluir_id_cliente . ' excluído com sucesso! </div>';
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível excluir o cliente ' . $hdn_editar_cliente_excluir_id_cliente . '!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>