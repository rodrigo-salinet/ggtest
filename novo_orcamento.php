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
    <title>Novo Orçamento -> S.O.I. -> Sistema de Orçamentos de Informática</title>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
    <?php require_once('navbar.php'); ?>

    <section class="content" id="sec_novo_orcamento">
        <div class="container-fluid">
            <div class="row align-items-center mb-3">
                <div class="col text-center">
                    <h5 class="h5 text-center">
                        <i class="fa fa-money text-warning"></i>
                        Novo Orçamento
                    </h5>
                </div>
            </div>
            <form action="adicionar_orcamento.php" method="post" id="frm_novo_orcamento" name="frm_novo_orcamento">
                <div class="row align-items-center mb-3">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="form-floating">
                                <select class="form-select" name="sel_clientes" id="sel_clientes">
                                    <option value="0" selected disabled></option>
                                    <?php
                                        $str_sql_clientes = "select * from `tbl_clientes`;";
                                        $sql_clientes = mysqli_query($conexao, $str_sql_clientes);
                                        $qtd_clientes = mysqli_num_rows($sql_clientes);

                                        for ($c = 0; $c < $qtd_clientes; $c++) {
                                            $clientes = mysqli_fetch_array($sql_clientes);
                                            $id_cliente = $clientes['id'];
                                            $nome_cliente = $clientes['nome'];

                                            $selecionado = '';
                                            if (isset($_GET['id_cliente'])) {
                                                $id_cliente_get = $_GET['id_cliente'];
                                                if ($id_cliente_get == $id_cliente) {
                                                    $selecionado = 'selected';
                                                }
                                            }
                                    ?>
                                    <option value="<?php echo $id_cliente; ?>" <?php echo $selecionado; ?>><?php echo $nome_cliente; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <label for="sel_clientes">Selecione um cliente</label>
                            </div>
                            <input type="submit" class="btn btn-outline-success" value="Criar Orçamento">
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="chk_redirect" id="chk_redirect" checked />
                            <label class="form-check-label" for="chk_redirect">Depois disso cadastrar itens</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php require_once('scripts_js_rodape.php'); ?>

    <script type="text/javascript" src="novo_orcamento.js"></script>

</body>
</html>
