<?php
session_start();
require_once('conexao.php');

if (!isset($_SESSION['logado'])) {
    header('Location: login.php?msg=' . htmlspecialchars("Para entrar no sistema é necessário estar cadastrado e logado."));
}

$id_usuario = $_SESSION['id_usuario'];
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <?php require_once('scripts_header.php'); ?>
    <title>Editar Orçamento -> S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <?php require_once('navbar.php'); ?>

    <section class="content mt-4">
        <div class="container-fluid" id="sec_editar_orcamento">
            <div class="row">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-money text-warning"></i>
                        Editar Orçamento
                    </h5>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col text-center">
                    ID Orçamento
                </div>
                <div class="col text-center">
                    Cliente
                </div>
                <div class="col text-center">
                    Itens
                </div>
                <div class="col text-center">
                    Aprovado
                </div>
            </div>
            <?php
                $str_sql_orcamentos = "select * from `tbl_orcamentos` where `id_usuario` = $id_usuario;";
                $sql_orcamentos = mysqli_query($conexao, $str_sql_orcamentos);
                $qtd_orcamentos = mysqli_num_rows($sql_orcamentos);

                for ($o = 0; $o < $qtd_orcamentos; $o++) {
                    $orcamentos = mysqli_fetch_array($sql_orcamentos);
                    $id_orcamento = $orcamentos['id'];
                    $id_cliente_orcamento = $orcamentos['id_cliente'];
                    $orcamento_aprovado = $orcamentos['aprovado'];
                    if ($orcamento_aprovado == 0) {
                        $orcamento_aprovado = "Não";
                    } else {
                        $orcamento_aprovado = "Sim";
                    }
            ?>
            <div class="row" id="div_row_orcamento<?php echo $id_orcamento; ?>">
                <div class="col text-center">
                    <div class="input-group">
                        <input type="text" class="form-control" id="txt_editar_id_orcamento<?php echo $id_orcamento; ?>" value="<?php echo $id_orcamento; ?>" disabled />
                        <a href="#" onclick="excluirOrcamento(this)" class="input-group-text" data-orcamento="<?php echo $id_orcamento; ?>"><i class="text-danger fa fa-trash" title="Excluir Orçamento"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_orcamento_id_orcamento<?php echo $id_item; ?>"></div>
                </div>
                <div class="col text-center">
                    <select class="form-select" id="sel_editar_id_cliente_orcamento<?php echo $id_orcamento; ?>" data-orcamento="<?php echo $id_orcamento; ?>" onchange="editarIdClienteOrcamento(this)">
                        <?php
                            $str_sql_clientes = "select * from `tbl_clientes`;";
                            $sql_clientes = mysqli_query($conexao, $str_sql_clientes);
                            $qtd_clientes = mysqli_num_rows($sql_clientes);

                            for ($c = 0; $c < $qtd_clientes; $c++) {
                                $clientes = mysqli_fetch_array($sql_clientes);
                                $id_cliente = $clientes['id'];
                                $nome_cliente = $clientes['nome'];
                                $selecionado = "";
                                if ($id_cliente == $id_cliente_orcamento) {
                                    $selecionado = "selected";
                                }
                        ?>
                        <option value="<?php echo $id_cliente; ?>" <?php echo $selecionado; ?>><?php echo $nome_cliente; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <div class="container collapse" id="div_sucesso_editar_orcamento_id_cliente<?php echo $id_orcamento; ?>">
                        .
                    </div>
                </div>
                <div class="col text-center">
                    <?php
                        $str_sql_itens_orcamentos = "select * from `tbl_itens_orcamentos` where `id_orcamento` = $id_orcamento;";
                        $sql_itens_orcamentos = mysqli_query($conexao, $str_sql_itens_orcamentos);
                        $qtd_itens_orcamentos = mysqli_num_rows($sql_itens_orcamentos);

                        for ($c = 0; $c < $qtd_itens_orcamentos; $c++) {
                            $itens_orcamentos = mysqli_fetch_array($sql_itens_orcamentos);
                            $id_item = $itens_orcamentos['id'];

                            $str_sql_item = "select * from `tbl_itens` where `id` = $id_item;";
                            $sql_item = mysqli_query($conexao, $str_sql_item);
                            $qtd_item = mysqli_num_rows($sql_item);

                            for ($i = 0; $i < $qtd_item; $i++) {
                                $item = mysqli_fetch_array($sql_item);
                                $nome_item = $item['nome'];
                            }
                    ?>
                    <div class="input-group">
                        <input type="text" class="form-control" id="txt_editar_orcamento_id_item" value="<?php echo $nome_item; ?>" disable>
                        <a href="#" onclick="excluirItemOrcamento(this)" class="input-group-text" data-item="<?php echo $id_item; ?>" data-orcamento="<?php echo $id_orcamento; ?>"><i class="text-danger fa fa-trash" title="Excluir este Item"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_orcamento_id_item<?php echo $id_item; ?>"></div>
                    <?php
                        }
                    ?>
                </div>
                <div class="col text-center">
                    <input type="text" class="form-control" id="txt_editar_orcamento_aprovado<?php echo $id_orcamento; ?>" value="<?php echo $orcamento_aprovado; ?>" disabled />
                </div>
            </div>
            <?php } ?>
            <form method="post" id="frm_editar_orcamento_id_cliente" name="frm_editar_orcamento_id_cliente">
                <input type="hidden" name="hdn_editar_orcamento_editar_cliente_id_orcamento" id="hdn_editar_orcamento_editar_cliente_id_orcamento" />
                <input type="hidden" name="hdn_editar_orcamento_editar_cliente_id_cliente" id="hdn_editar_orcamento_editar_cliente_id_cliente" />
            </form>
            <form id="frm_editar_orcamento_id_item" name="frm_editar_orcamento_id_item">
                <input type="hidden" name="hdn_editar_orcamento_excluir_item_id_orcamento" id="hdn_editar_orcamento_excluir_item_id_orcamento" />
                <input type="hidden" name="hdn_editar_orcamento_excluir_item_id_item" id="hdn_editar_orcamento_excluir_item_id_item" />
            </form>
            <form id="frm_editar_orcamento_id_orcamento" name="frm_editar_orcamento_id_orcamento">
                <input type="hidden" name="hdn_editar_orcamento_excluir_orcamento_id_orcamento" id="hdn_editar_orcamento_excluir_orcamento_id_orcamento" />
            </form>
        </div>
    </section>

    <?php require_once('scripts_js_rodape.php'); ?>

    <script type="text/javascript" src="editar_orcamento.js"></script>

</body>
</html>
