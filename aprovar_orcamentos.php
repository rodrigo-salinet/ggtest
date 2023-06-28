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
    <title>Aprovar Orçamentos -> S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <?php require_once('navbar.php'); ?>

    <section class="content" id="sec_aprovar_orcamentos">
        <div class="container-fluid">
            <div class="row">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-money text-warning"></i>
                        Aprovar Orçamentos
                    </h5>
                </div>
            </div>
            <?php if (!isset($_GET['id_usuario'])) { ?>
            <div class="row">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-ban text-danger"></i>
                        Selecione um usuário no canto superior <i class="fa fa-arrow-up text-success"></i> direito <i class="fa fa-arrow-right text-success"></i> para continuar
                    </h5>
                </div>
            </div>
            <?php } else { ?>
            <?php
                $id_usuario_orcamento = $_GET['id_usuario'];
                $str_sql_orcamentos = "select * from `tbl_orcamentos` where `id_usuario` = $id_usuario_orcamento;";
                $sql_orcamentos = mysqli_query($conexao, $str_sql_orcamentos);
                $qtd_orcamentos = mysqli_num_rows($sql_orcamentos);

                for ($o = 0; $o < $qtd_orcamentos; $o++) {
                    $orcamentos = mysqli_fetch_array($sql_orcamentos);
                    $id_orcamento = $orcamentos['id'];
                    $id_cliente_orcamento = $orcamentos['id_cliente'];
                    $id_status_orcamento = $orcamentos['id_status_orcamento'];
            ?>
            <div class="row border-top border-5 border-dark mb-3 item3">
                <div class="col mt-3 text-center">
                    Orçamento
                </div>
            </div>
            <div class="row mb-3" id="div_row_id_orcamento<?php echo $id_orcamento; ?>">
                <div class="col text-center">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="txt_editar_id_orcamento<?php echo $id_orcamento; ?>" value="<?php echo $id_orcamento; ?>" disabled />
                        <label for="txt_editar_id_orcamento<?php echo $id_orcamento; ?>">ID</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3" id="div_row_nome_orcamento<?php echo $id_orcamento; ?>">
                <div class="col text-center">
                    <?php
                        $str_sql_clientes = "select * from `tbl_clientes` where `id` = $id_cliente_orcamento;";
                        $sql_clientes = mysqli_query($conexao, $str_sql_clientes);
                        $qtd_clientes = mysqli_num_rows($sql_clientes);

                        for ($c = 0; $c < $qtd_clientes; $c++) {
                            $clientes = mysqli_fetch_array($sql_clientes);
                            $nome_cliente = $clientes['nome'];
                        }
                    ?>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="txt_editar_orcamento<?php echo $id_orcamento; ?>_cliente<?php echo $id_cliente_orcamento; ?>" value="<?php echo $nome_cliente; ?>" disabled />
                        <label for="txt_editar_orcamento<?php echo $id_orcamento; ?>_cliente<?php echo $id_cliente_orcamento; ?>">Cliente</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3" id="div_row_itens_orcamento<?php echo $id_orcamento; ?>">
                <div class="col text-center">
                    <?php
                        $str_sql_itens_orcamentos = "select * from `tbl_itens_orcamentos` where `id_orcamento` = $id_orcamento;";
                        $sql_itens_orcamentos = mysqli_query($conexao, $str_sql_itens_orcamentos);
                        $qtd_itens_orcamentos = mysqli_num_rows($sql_itens_orcamentos);

                        for ($c = 0; $c < $qtd_itens_orcamentos; $c++) {
                            $itens_orcamentos = mysqli_fetch_array($sql_itens_orcamentos);
                            $id_item_orcamento = $itens_orcamentos['id_item'];
                            $quantidade_item = $itens_orcamentos['quantidade'];

                            $str_sql_item = "select * from `tbl_itens` where `id` = $id_item_orcamento;";
                            $sql_item = mysqli_query($conexao, $str_sql_item);
                            $qtd_item = mysqli_num_rows($sql_item);

                            for ($i = 0; $i < $qtd_item; $i++) {
                                $item = mysqli_fetch_array($sql_item);
                                $nome_item = $item['nome'];
                            }
                    ?>
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="txt_editar_orcamento<?php echo $id_orcamento; ?>_id_item<?php echo $id_item_orcamento; ?>" value="<?php echo $nome_item; ?>" title="[ID <?php echo $id_item_orcamento; ?>]" disabled>
                            <label for="txt_editar_orcamento<?php echo $id_orcamento; ?>_id_item<?php echo $id_item_orcamento; ?>">Item</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="txt_editar_orcamento<?php echo $id_orcamento; ?>_quantidade_item<?php echo $id_item_orcamento; ?>" value="<?php echo $quantidade_item; ?>" disabled>
                            <label for="txt_editar_orcamento<?php echo $id_orcamento; ?>_quantidade_item<?php echo $id_item_orcamento; ?>">Quantidade</label>
                        </div>
                        <div class="form-floating">
                            <select class="form-select" id="sel_editar_orcamento<?php echo $id_orcamento; ?>_precos<?php echo $id_item; ?>" onchange="alterarPreco(this)" data-orcamento="<?php echo $id_orcamento; ?>" data-item="<?php echo $id_item; ?>">
                                <option selected disable>Clique aqui para selecionar o preço do fornecedor</option>
                                <?php
                                    $str_sql_precos_item = "select * from `tbl_precos_itens` where `id_item` = '$id_item' order by `preco` asc;";
                                    $sql_precos_item = mysqli_query($conexao, $str_sql_precos_item);
                                    $qtd_precos_item = mysqli_num_rows($sql_precos_item);
                                    if ($qtd_precos_item > 3) { $qtd_precos_item = 3; }
                                    for ($p = 0; $p < $qtd_precos_item; $p++) {
                                        $precos_item = mysqli_fetch_array($sql_precos_item);
                                        $id_preco = $precos_item['id'];
                                        $id_fornecedor = $precos_item['id_fornecedor'];
                                        $preco_item = $precos_item['preco'];
                                        $str_sql_fornecedor = "select * from `tbl_fornecedores` where `id` = $id_fornecedor;";
                                        $sql_fornecedor = mysqli_query($conexao, $str_sql_fornecedor);
                                        $qtd_fornecedor = mysqli_num_rows($sql_fornecedor);
                                        for ($f = 0; $f < $qtd_fornecedor; $f++) {
                                            $fornecedor = mysqli_fetch_array($sql_fornecedor);
                                            $fornecedor_nome = $fornecedor['nome'];
                                        }
                                        $destaque = "";
                                        $txt_destaque = "";
                                        if ($p == 0) {
                                            $destaque = 'class="fw-bold"';
                                            $txt_destaque = " -> Melhor preço!";
                                        }
                                ?>
                                <option value="<?php echo $id_preco; ?>" <?php echo $destaque; ?>>R$<?php echo number_format($preco_item, 2, ',', '.'); ?> -> <?php echo $fornecedor_nome; ?><?php echo $txt_destaque; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <label for="sel_editar_orcamento<?php echo $id_orcamento; ?>_precos<?php echo $id_item; ?>">Preço</label>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row mb-3" id="div_row_aprovar_orcamento<?php echo $id_orcamento; ?>">
                <div class="col text-center">
                    <div class="form-floating">
                        <select class="form-select" data-orcamento="<?php echo $id_orcamento; ?>" id="sel_aprovar_orcamento_status<?php echo $id_orcamento; ?>" onchange="alterarStatus(this)" />
                        <?php
                            $str_sql_status_orcamento = "select * from `tbl_status_orcamento`;";
                            $sql_status_orcamento = mysqli_query($conexao, $str_sql_status_orcamento);
                            $qtd_status_orcamento = mysqli_num_rows($sql_status_orcamento);

                            for ($s = 0; $s < $qtd_status_orcamento; $s++) {
                                $status_orcamento = mysqli_fetch_array($sql_status_orcamento);
                                $id_status = $status_orcamento['id'];
                                $status = $status_orcamento['status'];
                                $selecionado = '';
                                if ($id_status == $id_status_orcamento) {
                                    $selecionado = 'selected';
                                }
                        ?>
                            <option value="<?php echo $id_status; ?>" <?php echo $selecionado; ?>><?php echo $status;?></option>
                        <?php } ?>
                        </select>
                        <label for="sel_aprovar_orcamento_status<?php echo $id_orcamento; ?>">Status</label>
                    </div>
                    <div class="container collapse" id="div_sucesso_aprovar_orcamentos_id_orcamento<?php echo $id_orcamento; ?>"></div>
                </div>
            </div>
            <?php } ?>
            <?php } ?>
            <form id="frm_aprovar_orcamentos_preco" name="frm_aprovar_orcamentos_preco">
                <input type="hidden" name="hdn_aprovar_orcamentos_preco_item_id_orcamento" id="hdn_aprovar_orcamentos_preco_item_id_orcamento" />
                <input type="hidden" name="hdn_aprovar_orcamentos_preco_id_preco" id="hdn_aprovar_orcamentos_preco_id_preco" />
            </form>
            <form id="frm_aprovar_orcamentos_status" name="frm_aprovar_orcamentos_status">
                <input type="hidden" name="hdn_aprovar_orcamentos_status_item_id_orcamento" id="hdn_aprovar_orcamentos_status_item_id_orcamento" />
                <input type="hidden" name="hdn_aprovar_orcamentos_status_id_status" id="hdn_aprovar_orcamentos_status_id_status" />
            </form>
        </div>
    </section>

    <?php require_once('scripts_js_rodape.php'); ?>

    <script type="text/javascript" src="aprovar_orcamentos.js"></script>

</body>
</html>
