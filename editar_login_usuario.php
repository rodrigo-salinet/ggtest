<?php
session_start();
require_once('conexao.php');

$data['success'] = 1;
$data['message'] = 'Nada ainda aconteceu.';
$data['errors'] = null;

if (!isset($_SESSION['logado'])) {
    $data['success'] = 0;
    $data['errors'] = "Usuário não logado.";
} else if (isset($_POST['hdn_editar_usuario_login_id_usuario']) && isset($_POST['hdn_editar_usuario_login_usuario'])) {
    $hdn_editar_usuario_login_id_usuario = $_POST['hdn_editar_usuario_login_id_usuario'];
    $hdn_editar_usuario_login_usuario = $_POST['hdn_editar_usuario_login_usuario'];

    $str_sql_usuarios = "select * from `tbl_usuarios` where `login` = '$hdn_editar_usuario_login_usuario';";
    $data['message'] = $str_sql_usuarios;
    $sql_usuarios = mysqli_query($conexao, $str_sql_usuarios);
    $qtd_usuarios = mysqli_num_rows($sql_usuarios);
    if ($qtd_usuarios > 0) {
        $data['message'] = '<i class="fa fa-ban text-danger"></i> Ops! O novo login digitado já existe e não pode ser utilizado. Digite outro.';
    } else {
        try {
            $str_sql_editar_login_usuario = "update `tbl_usuarios` set `login` = '$hdn_editar_usuario_login_usuario' where `id` = $hdn_editar_usuario_login_id_usuario;";
            $sql_editar_login_usuario = mysqli_query($conexao, $str_sql_editar_login_usuario);
            $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Login alterado com sucesso!';
        } catch (\Exception $e) {
            $data['message'] = 'Não foi possível alterar o login!';
            $data['errors'] = "$e";
        }
    }
}

echo json_encode($data);
?>