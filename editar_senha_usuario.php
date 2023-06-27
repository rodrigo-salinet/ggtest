<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_usuario_senha_id_usuario']) && isset($_POST['hdn_editar_usuario_senha_usuario'])) {
    $hdn_editar_usuario_senha_id_usuario = $_POST['hdn_editar_usuario_senha_id_usuario'];
    $hdn_editar_usuario_senha_usuario = $_POST['hdn_editar_usuario_senha_usuario'];

    $str_sql_editar_senha_usuario = "update `tbl_usuarios` set `senha` = md5('$hdn_editar_usuario_senha_usuario') where `id` = $hdn_editar_usuario_senha_id_usuario;";
    try {
        $sql_editar_senha_usuario = mysqli_query($conexao, $str_sql_editar_senha_usuario);
        $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Senha alterada com sucesso!';
    } catch (\Exception $e) {
        $data['message'] = 'Não foi possível alterar a senha!';
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>