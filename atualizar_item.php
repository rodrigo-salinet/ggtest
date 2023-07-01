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
} else if (isset($_POST['hdn_atualizar_quantidade_id_orcamento']) && isset($_POST['hdn_atualizar_quantidade_id_usuario']) && isset($_POST['hdn_atualizar_quantidade_id_item']) && isset($_POST['hdn_atualizar_quantidade_txt_quantidade'])) {
    $hdn_atualizar_quantidade_id_orcamento = $_POST['hdn_atualizar_quantidade_id_orcamento'];
    $hdn_atualizar_quantidade_id_usuario = $_POST['hdn_atualizar_quantidade_id_usuario'];
    $hdn_atualizar_quantidade_id_item = $_POST['hdn_atualizar_quantidade_id_item'];
    $hdn_atualizar_quantidade_txt_quantidade = $_POST['hdn_atualizar_quantidade_txt_quantidade'];

    try {
        $str_sql_itens_orcamentos = "select * from `tbl_itens_orcamentos` where `id_item` = $hdn_atualizar_quantidade_id_item and `id_orcamento` = $hdn_atualizar_quantidade_id_orcamento;";
        $sql_itens_orcamentos = mysqli_query($conexao, $str_sql_itens_orcamentos);
        $qtd_itens_orcamentos = mysqli_num_rows($sql_itens_orcamentos);

        if ($qtd_itens_orcamentos > 0) {
            if ($hdn_atualizar_quantidade_txt_quantidade == 0) {
                $str_sql_excluir_item_orcamento = "delete from `tbl_itens_orcamentos` where `id_item` = $hdn_atualizar_quantidade_id_item and `id_orcamento` = $hdn_atualizar_quantidade_id_orcamento;";
                $sql_excluir_item_orcamento = mysqli_query($conexao, $str_sql_excluir_item_orcamento);
                $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Item excluído com sucesso!';
            } else {
                $str_sql_atualizar_item_orcamento = "update `tbl_itens_orcamentos` set `quantidade` = $hdn_atualizar_quantidade_txt_quantidade where `id_orcamento` = $hdn_atualizar_quantidade_id_orcamento and `id_item` = $hdn_atualizar_quantidade_id_item;";
                $sql_atualizar_item_orcamento = mysqli_query($conexao, $str_sql_atualizar_item_orcamento);
                $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Item atualizado com sucesso!';
            }
        } else {
            $str_sql_adicionar_item_orcamento = "insert into `tbl_itens_orcamentos` (`id_orcamento`,`id_item`,`quantidade`) values ($hdn_atualizar_quantidade_id_orcamento, $hdn_atualizar_quantidade_id_item, $hdn_atualizar_quantidade_txt_quantidade);";
            if ($conexao->query($str_sql_adicionar_item_orcamento) === TRUE) {
                $last_id = $conexao->insert_id;
                $data['message'] = '<i class="fa fa-check-circle-o text-success"></i> Item [ID ' . hdn_atualizar_quantidade_id_item . '] adicionado com sucesso [ Novo ID vinculado ' . $last_id . ']!';
            }
        }
    } catch (\Exception $e) {
        $data['message'] = "Não foi possível atualizar o item";
        $data['errors'] = "$e";
    }
}

echo json_encode($data);
?>