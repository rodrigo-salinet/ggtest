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

    <section class="content" id="sec_editar_orcamento">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col mb-3 text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-money text-warning"></i>
                        Editar/Excluir Orçamento
                    </h5>
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
                    $id_status_orcamento = $orcamentos['id_status_orcamento'];

                    $str_sql_status_orcamento = "select * from `tbl_status_orcamento` where `id` = $id_status_orcamento;";
                    $sql_status_orcamento = mysqli_query($conexao, $str_sql_status_orcamento);
                    $qtd_status_orcamento = mysqli_num_rows($sql_status_orcamento);

                    for ($s = 0; $s < $qtd_status_orcamento; $s++) {
                        $status_orcamento = mysqli_fetch_array($sql_status_orcamento);
                        $status = $status_orcamento['status'];
                    }
            ?>
            <div class="row align-items-center border-top border-5 border-dark mb-3 item3">
                <div class="col mt-3 text-center">
                    Orçamento
                </div>
            </div>
            <div class="row align-items-center mb-3" id="div_row_orcamento<?php echo $id_orcamento; ?>">
                <div class="col text-center">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="txt_editar_id_orcamento<?php echo $id_orcamento; ?>" value="<?php echo $id_orcamento; ?>" disabled />
                            <label for="txt_editar_id_orcamento<?php echo $id_orcamento; ?>">ID</label>
                        </div>
                        <a href="#stay" onclick="excluirOrcamento(this)" class="input-group-text" data-orcamento="<?php echo $id_orcamento; ?>"><i class="text-danger fa fa-trash" title="Excluir Orçamento"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_orcamento_id_orcamento<?php echo $id_orcamento; ?>"></div>
                </div>
            </div>
            <div class="row align-items-center mb-3" id="div_row_cliente<?php echo $id_orcamento; ?>">
                <div class="col text-center">
                    <div class="form-floating">
                        <select class="form-select" id="sel_editar_id_cliente_orcamento<?php echo $id_orcamento; ?>" data-orcamento="<?php echo $id_orcamento; ?>" onchange="editarIdClienteOrcamento(this)">
                            <option value="0" disabled selected>Selecione aqui um cliente</option>
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
                        <label for="sel_editar_id_cliente_orcamento<?php echo $id_orcamento; ?>">Cliente</label>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_orcamento_id_cliente<?php echo $id_orcamento; ?>"></div>
                </div>
            </div>
            <?php
                    $str_sql_itens_orcamentos = "select * from `tbl_itens_orcamentos` where `id_orcamento` = $id_orcamento;";
                    $sql_itens_orcamentos = mysqli_query($conexao, $str_sql_itens_orcamentos);
                    $qtd_itens_orcamentos = mysqli_num_rows($sql_itens_orcamentos);

                    for ($c = 0; $c < $qtd_itens_orcamentos; $c++) {
                        $itens_orcamentos = mysqli_fetch_array($sql_itens_orcamentos);
                        $id_item_orcamento = $itens_orcamentos['id_item'];
                        $quantidade_item = $itens_orcamentos['quantidade'];
                        $id_preco = $itens_orcamentos['id_preco'];

                        $str_sql_item = "select * from `tbl_itens` where `id` = $id_item_orcamento;";
                        $sql_item = mysqli_query($conexao, $str_sql_item);
                        $qtd_item = mysqli_num_rows($sql_item);
                        if ($qtd_item <= 0) {
                            continue;
                        }

                        $nome_item = '';
                        for ($i = 0; $i < $qtd_item; $i++) {
                            $item = mysqli_fetch_array($sql_item);
                            $nome_item = $item['nome'];
                        }
                        mysqli_free_result($sql_item);
            ?>
            <div class="row align-items-center mb-3" id="div_row_id_orcamento<?php echo $id_orcamento; ?>_id_item<?php echo $id_item_orcamento; ?>">
                <div class="col text-center">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="txt_editar_orcamento<?php echo $id_orcamento; ?>_id_item<?php echo $id_item_orcamento; ?>" value="<?php echo $nome_item; ?>" title="[ID <?php echo $id_item_orcamento; ?>]" disabled>
                            <label for="txt_editar_orcamento<?php echo $id_orcamento; ?>_id_item<?php echo $id_item_orcamento; ?>">Item</label>
                        </div>
                        <a href="#stay" onclick="excluirItemOrcamento(this)" class="input-group-text" data-item="<?php echo $id_item_orcamento; ?>" data-orcamento="<?php echo $id_orcamento; ?>"><i class="text-danger fa fa-trash" title="Excluir este Item"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_orcamento<?php echo $id_orcamento; ?>_id_item<?php echo $id_item_orcamento; ?>"></div>
                </div>
                <div class="col text-center">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="txt_editar_orcamento<?php echo $id_orcamento; ?>_quantidade_item<?php echo $id_item_orcamento; ?>" value="<?php echo $quantidade_item; ?>">
                            <label for="txt_editar_orcamento<?php echo $id_orcamento; ?>_quantidade_item<?php echo $id_item_orcamento; ?>">Quantidade</label>
                        </div>
                        <a href="#stay" onclick="quantidadeItemOrcamento(this)" class="input-group-text" data-item="<?php echo $id_item_orcamento; ?>" data-orcamento="<?php echo $id_orcamento; ?>"><i class="text-warning fa fa-eraser" title="Alterar quantidade deste Item"></i></a>
                    </div>
                    <div class="container collapse" id="div_sucesso_editar_orcamento<?php echo $id_orcamento; ?>_quantidade_item<?php echo $id_item_orcamento; ?>"></div>
                </div>
                <div class="col text-center">
                    <?php
                        if ($id_preco != '') {
                            $str_sql_precos_item = "select * from `tbl_precos_itens` where `id` = $id_preco;";
                            $sql_precos_item = mysqli_query($conexao, $str_sql_precos_item);
                            $qtd_precos_item = mysqli_num_rows($sql_precos_item);
                            for ($p = 0; $p < $qtd_precos_item; $p++) {
                                $precos_item = mysqli_fetch_array($sql_precos_item);
                                $preco_item = 'R$ ' . number_format($precos_item['preco'], 2, ',', '.');
                                $preco_numeral = $precos_item['preco'];
                            }

                            $str_sql_melhor_preco = "select * from `tbl_precos_itens` where `preco` < $preco_numeral and `id_item` = $id_item_orcamento;";
                            $sql_melhor_preco = mysqli_query($conexao, $str_sql_melhor_preco);
                            $qtd_sql_melhor_preco = mysqli_num_rows($sql_melhor_preco);
                            $melhor_preco = '+ barato!';
                            $bg_melhor_preco = 'bg-info';
                            if ($qtd_sql_melhor_preco > 0) {
                                $melhor_preco = '';
                                $bg_melhor_preco = '';
                            }
                            ?>
                    <div class="form-floating">
                        <input class="form-control <?php echo $bg_melhor_preco; ?>" id="txt_editar_orcamento<?php echo $id_orcamento; ?>_id_item<?php echo $id_item_orcamento; ?>_preco" type="text" data-preco="<?php echo $id_preco; ?>" value="<?php echo $preco_item; ?>" disabled />
                        <label for="txt_editar_orcamento<?php echo $id_orcamento; ?>_id_item<?php echo $id_item_orcamento; ?>_preco">Preço <?php echo $melhor_preco; ?></label>
                    </div>
                    <?php //echo $str_sql_melhor_preco; ?>
                    <?php
                        } else {
                    ?>
                        Sem preço
                    <?php
                        }
                    ?>
                </div>
            </div>
            <?php
                    }
                    mysqli_free_result($sql_itens_orcamentos);
            ?>
            <div class="row align-items-center mb-3" id="div_row_status<?php echo $id_orcamento; ?>">
                <div class="col text-center">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="status<?php echo $id_orcamento; ?>" value="<?php echo $status; ?>" disabled />
                        <label for="status<?php echo $id_orcamento; ?>">Status</label>
                    </div>
                </div>
            </div>
            <?php
                }
                mysqli_free_result($sql_orcamentos);
            ?>
            <form id="frm_editar_orcamento_quantidade" name="frm_editar_orcamento_quantidade">
                <input type="hidden" name="hdn_editar_orcamento_quantidade_item_id_orcamento" id="hdn_editar_orcamento_quantidade_item_id_orcamento" />
                <input type="hidden" name="hdn_editar_orcamento_quantidade_item_id_item" id="hdn_editar_orcamento_quantidade_item_id_item" />
                <input type="hidden" name="hdn_editar_orcamento_quantidade_item" id="hdn_editar_orcamento_quantidade_item" />
            </form>
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
