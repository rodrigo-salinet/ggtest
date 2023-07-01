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
    <title>Editar Preço de Item -> S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <?php require_once('navbar.php'); ?>

    <section class="content" id="sec_novo_preco_item">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-shopping-cart text-warning"></i>
                        Editar/Excluir Preço de Item
                    </h5>
                </div>
            </div>
            <?php
                $str_sql_precos_itens = "select * from `tbl_precos_itens`";
                $sql_precos_itens = mysqli_query($conexao, $str_sql_precos_itens);
                $qtd_sql_precos_itens = mysqli_num_rows($sql_precos_itens);

                for ($p = 0; $p < $qtd_sql_precos_itens; $p++) {
                    $precos_itens = mysqli_fetch_array($sql_precos_itens);
                    $id_preco_item = $precos_itens['id'];
                    $id_item_preco_item = $precos_itens['id_item'];
                    $id_fornecedor_preco_item = $precos_itens['id_fornecedor'];
                    $preco_item = $precos_itens['preco'];
            ?>
            <div class="row align-items-center border-bottom border-5 border-dark mb-3 item<?php echo $id_item; ?>">
                <div class="col text-center">
                    &nbsp;
                </div>
            </div>
            <div class="row align-items-center" id="div_id_preco_item<?php echo $id_preco_item; ?>">
                <div class="col mb-3 text-center">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="txt_id_preco_item<?php echo $id_preco_item; ?>" data-preco="<?php echo $id_preco_item;?>" value="<?php echo $id_preco_item; ?>" disabled />
                            <label for="txt_id_preco_item<?php echo $id_preco_item; ?>">ID</label>
                        </div>
                        <a class="input-group-text" href="#stay" data-preco="<?php echo $id_preco_item; ?>" onclick="excluirPrecoItem(this)" title="Excluir Preço de Item"><i class="fa fa-trash text-danger"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_excluir_id_preco_item<?php echo $id_preco_item; ?>"></div>
                </div>
            </div>
            <div class="row align-items-center" id="div_id_item<?php echo $id_preco_item; ?>">
                <div class="col mb-3 text-center">
                    <div class="form-floating">
                        <select class="form-select" id="sel_id_item<?php echo $id_preco_item; ?>" data-preco="<?php echo $id_preco_item; ?>" onchange="editarItem(this)">
                            <?php
                                $str_sql_itens = "select * from `tbl_itens`";
                                $sql_itens = mysqli_query($conexao, $str_sql_itens);
                                $qtd_itens = mysqli_num_rows($sql_itens);

                                for ($i = 0; $i < $qtd_itens; $i++) {
                                    $itens = mysqli_fetch_array($sql_itens);
                                    $id_item = $itens['id'];
                                    $nome_item = $itens['nome'];

                                    $selecionado = "";
                                    if ($id_item == $id_item_preco_item) {
                                        $selecionado = "selected";
                                    }
                            ?>
                            <option value="<?php echo $id_item; ?>" <?php echo $selecionado; ?>><?php echo $nome_item; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <label for="sel_id_item<?php echo $id_preco_item; ?>">Itens</label>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_id_item<?php echo $id_preco_item; ?>"></div>
                </div>
            </div>
            <div class="row align-items-center" id="div_id_fornecedor<?php echo $id_preco_item; ?>">
                <div class="col mb-3 text-center">
                    <div class="form-floating">
                        <select class="form-select" id="sel_id_fornecedor<?php echo $id_preco_item; ?>" data-preco="<?php echo $id_preco_item; ?>" onchange="editarFornecedor(this)">
                            <option value="0" selected disabled>Selecione aqui o Fornecedor</option>
                            <?php
                                $str_sql_fornecedores = "select * from `tbl_fornecedores`";
                                $sql_fornecedores = mysqli_query($conexao, $str_sql_fornecedores);
                                $qtd_fornecedores = mysqli_num_rows($sql_fornecedores);

                                for ($i = 0; $i < $qtd_fornecedores; $i++) {
                                    $fornecedores = mysqli_fetch_array($sql_fornecedores);
                                    $id_fornecedor = $fornecedores['id'];
                                    $nome_fornecedor = $fornecedores['nome'];

                                    $selecionado = "";
                                    if ($id_fornecedor == $id_fornecedor_preco_item) {
                                        $selecionado = "selected";
                                    }
                            ?>
                            <option value="<?php echo $id_fornecedor; ?>" <?php echo $selecionado; ?>><?php echo $nome_fornecedor; ?></option>
                            <?php } ?>
                        </select>
                        <label for="sel_id_fornecedor<?php echo $id_preco_item; ?>">Fornecedores</label>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_id_fornecedor<?php echo $id_preco_item; ?>"></div>
                </div>
            </div>
            <div class="row align-items-center" id="div_preco<?php echo $id_preco_item; ?>">
                <div class="col mb-3 text-center">
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="txt_preco_item<?php echo $id_preco_item; ?>" onkeyup="formatarReal(this)" maxlength="10" value="<?php echo number_format($preco_item, 2, ',', '.'); ?>" />
                            <label for="txt_preco_item<?php echo $id_preco_item; ?>">Preço do Item (em Reais max. XXX.XXX,XX)</label>
                        </div>
                        <a class="input-group-text" href="#stay" data-preco="<?php echo $id_preco_item; ?>" data-item="<?php echo $id_item_preco_item; ?>" onclick="editarPreco(this)" title="Editar Preço"><i class="fa fa-eraser text-warning"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_preco<?php echo $id_preco_item; ?>"></div>
                </div>
            </div>
            <?php } ?>
            <form method="post" id="frm_editar_preco_item_excluir_id_preco_item" name="frm_editar_preco_item_excluir_id_preco_item">
                <input type="hidden" name="hdn_editar_preco_item_excluir_id_preco_item" id="hdn_editar_preco_item_excluir_id_preco_item" />
            </form>
            <form method="post" id="frm_editar_preco_item_id_item" name="frm_editar_preco_item_id_item">
                <input type="hidden" name="hdn_editar_preco_item_id_preco_item" id="hdn_editar_preco_item_id_preco_item" />
                <input type="hidden" name="hdn_editar_preco_item_id_item" id="hdn_editar_preco_item_id_item" />
            </form>
            <form method="post" id="frm_editar_preco_item_id_fornecedor" name="frm_editar_preco_item_id_fornecedor">
                <input type="hidden" name="hdn_editar_preco_item_fornecedor_id_preco_item" id="hdn_editar_preco_item_fornecedor_id_preco_item" />
                <input type="hidden" name="hdn_editar_preco_item_fornecedor_id_fornecedor" id="hdn_editar_preco_item_fornecedor_id_fornecedor" />
            </form>
            <form method="post" id="frm_editar_preco_item_preco" name="frm_editar_preco_item_preco">
                <input type="hidden" name="hdn_editar_preco_item_preco_id_preco_item" id="hdn_editar_preco_item_preco_id_preco_item" />
                <input type="hidden" name="hdn_editar_preco_item_preco" id="hdn_editar_preco_item_preco" />
            </form>
        </div>
    </section>

    <?php require_once('scripts_js_rodape.php'); ?>

    <script type="text/javascript" src="editar_preco_item.js"></script>

</body>
</html>
