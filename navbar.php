    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container-fluid">
            <span href="index.php" class="navbar-brand" title="Sistema de Orçamento de Informática">S.O.I.</span>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-align-justify"></i>
            </button>
            <div class="navbar-collapse collapse" id="navbarNav">
                <ul class="nav-underline navbar-nav me-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Itens
                        </a>
                        <ul class="dropdown-menu">
                            <?php if (@$_SESSION['tipo_usuario'] == 1) { ?>
                            <li><a class="dropdown-item" href="adicionar_itens.php">Adicionar Itens a um orçamento</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <?php } ?>
                            <li><a class="dropdown-item" href="novo_item.php">Novo Item</a></li>
                            <li><a class="dropdown-item" href="editar_item.php">Editar/Excluir Item</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Clientes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="novo_cliente.php">Novo Cliente</a></li>
                            <li><a class="dropdown-item" href="editar_cliente.php">Editar/Excluir Cliente</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Orçamentos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="novo_orcamento.php">Novo Orçamento</a></li>
                            <li><a class="dropdown-item" href="editar_orcamento.php">Editar/Excluir Orçamento</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-gear"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="meu_cadastro.php">Meu cadastro</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="./sair.php"><i class="fa fa-remove text-danger"></i> Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php
                $arquivo_atual = explode('?', $_SERVER['REQUEST_URI'])[0];
                if ($arquivo_atual == '/adicionar_itens.php') {
            ?>
            <div class="d-flex" role="search">
                <select id="sel_orcamentos" class="form-select" onchange="selecionarOrcamento(this)">
                    <option value="0" selected>Selecione aqui um orçamento</option>
                    <?php
                        $str_sql_orcamentos = "select * from `tbl_orcamentos` where `id_usuario` = $id_usuario;";
                        $sql_orcamentos = mysqli_query($conexao, $str_sql_orcamentos);
                        $qtd_orcamentos = mysqli_num_rows($sql_orcamentos);
                        for ($o = 0; $o < $qtd_orcamentos; $o++) {
                            $orcamento = mysqli_fetch_array($sql_orcamentos);
                            $id_orcamento = $orcamento['id'];
                            $id_cliente = $orcamento['id_cliente'];
                            $str_sql_cliente = "select * from tbl_clientes where id = $id_cliente;";
                            $sql_cliente = mysqli_query($conexao, $str_sql_cliente);
                            $qtd_cliente = mysqli_num_rows($sql_cliente);
                            for ($c = 0; $c < $qtd_cliente; $c++) {
                                $cliente = mysqli_fetch_array($sql_cliente);
                                $nome_cliente = $cliente['nome'];
                            }
                            $selecionado = "";
                            if (isset($_GET['id_orcamento'])) {
                                $id_orcamento_get = $_GET['id_orcamento'];
                                if ($id_orcamento_get == $id_orcamento) {
                                    $selecionado = "selected";
                                }
                            }
                    ?>
                    <option value="<?php echo $id_orcamento; ?>" id="opt_orcamento<?php echo $id_orcamento; ?>" <?php echo $selecionado; ?>>
                        O: <?php echo $id_orcamento; ?> 
                        | C: <?php echo $nome_cliente; ?>
                    </option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <?php } ?>
        </div>
    </nav>

    <header class="content mb-4 mt-4">
        <div class="container collapse show" id="sec_header">
            <div class="row">
                <div class="col-md-4">
                    &nbsp;
                </div>
            </div>
        </div>
    </header>

    <?php if (isset($_GET['msg'])) { ?>
    <section class="content" id="sec_msg">
        <div class="container-fluid">
            <div class="row">
                <div class="col mb-4">
                    <h5 class="h5 text-center"><i class="fa fa-bullhorn text-danger"></i> <<< <i><?php echo $_GET['msg']; ?></i></h5>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
