<?php
// phpinfo(); die();
session_start();
require_once('conexao.php');

$redirect = 'novo_preco_item.php';
$msg = "Nada aconteceu";
$id_item_get = '';

if (!isset($_SESSION['logado'])) {
    $redirect = 'login.php';
    $msg = "É necessário realizar o login para utilizar o sistema.";
} else if (isset($_POST['sel_id_item']) && isset($_POST['sel_id_fornecedor']) && isset($_POST['txt_preco_item'])) {
    $sel_id_item = $_POST['sel_id_item'];
    $sel_id_fornecedor = $_POST['sel_id_fornecedor'];
    $txt_preco_item = $_POST['txt_preco_item'];
    $preco_item = str_replace(".", "", $txt_preco_item);
    $preco_item = str_replace(",", ".", $preco_item);
    $id_item_get = '&id_item=' . htmlspecialchars($_POST['sel_id_item']);

    try {
        $str_sql_adicionar_preco_item = "insert into `tbl_precos_itens` (`id_item`,`id_fornecedor`,`preco`) values ($sel_id_item, $sel_id_fornecedor, $preco_item);";
        if ($conexao->query($str_sql_adicionar_preco_item) === TRUE) {
            $last_id = $conexao->insert_id;
            $msg = "Preço R$ $txt_preco_item de Item [ID $last_id] adicionado com sucesso!";
        }
    } catch (\Exception $e) {
        $msg = "Não foi possível adicionar o Preço de Item";
    }
}

header('Location: ' . $redirect . '?msg=' . htmlspecialchars($msg) . $id_item_get);
?>