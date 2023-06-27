<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_usuario_nome_id_usuario']) && isset($_POST['hdn_editar_usuario_nome_usuario'])) {
    $hdn_editar_usuario_nome_id_usuario = $_POST['hdn_editar_usuario_nome_id_usuario'];
    $hdn_editar_usuario_nome_usuario = $_POST['hdn_editar_usuario_nome_usuario'];

    try {
        $str_sql_editar_nome_usuario = "update `tbl_usuarios` set `nome` = '$hdn_editar_usuario_nome_usuario' where `id` = $hdn_editar_usuario_nome_id_usuario;";
        $sql_editar_nome_usuario = mysqli_query($conexao, $str_sql_editar_nome_usuario);
        $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Nome alterado com sucesso!';
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível alterar o nome!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>