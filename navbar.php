    <nav class="nav navbar navbar-expand-md navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container-fluid">
            <span href="index.php" class="navbar-brand" title="Sistema de Orçamento de Informática">S.O.I.</span>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-align-justify"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav nav-underline navbar-nav me-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Itens
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="adicionar_itens.php">Adicionar Itens a um orçamento</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="novo_item.php">Novo Item</a></li>
                            <li><a class="dropdown-item" href="editar_item.php">Editar Item</a></li>
                            <?php if (@$_SESSION['tipo_usuario'] == 2) { ?>
                            <li><a class="dropdown-item" href="excluir_item.php">Excluir Item</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Clientes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="novo_cliente.php">Novo Cliente</a></li>
                            <li><a class="dropdown-item" href="editar_cliente.php">Editar Cliente</a></li>
                            <?php if (@$_SESSION['tipo_usuario'] == 2) { ?>
                            <li><a class="dropdown-item" href="excluir_cliente.php">Excluir Cliente</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Orçamentos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="novo_orcamento.php">Novo Orçamento</a></li>
                            <li><a class="dropdown-item" href="editar_orcamento.php">Editar Orçamento</a></li>
                            <li><a class="dropdown-item" href="excluir_orcamento.php">Excluir Orçamento</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-gear"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php if (@$_SESSION['tipo_usuario'] == 2) { ?>
                            <li><a class="dropdown-item" href="novo_usuario.php">Novo Usuário</a></li>
                            <li><a class="dropdown-item" href="editar_usuario.php">Editar Usuário</a></li>
                            <li><a class="dropdown-item" href="excluir_usuario.php">Excluir Usuário</a></li>
                            <?php } ?>
                            <li><a class="dropdown-item" href="meu_cadastro.php">Meu cadastro</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="./sair.php"><i class="fa fa-remove text-danger"></i> Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="d-flex" role="search">
            <?php
                $arquivo_atual = explode('?', $_SERVER['REQUEST_URI'])[0];
                if ($arquivo_atual == '/adicionar_itens.php') {
            ?>
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
                    ?>
                    <option value="<?php echo $id_orcamento; ?>" id="opt_orcamento<?php echo $id_orcamento; ?>">
                        O: <?php echo $id_orcamento; ?> 
                        | C: <?php echo $nome_cliente; ?>
                    </option>
                    <?php
                        }
                    ?>
                </select>
            <?php } ?>
            </div>
        </div>
    </nav>

    <header class="content">
        <div class="container collapse show" id="sec_cabecalho">
            <div class="row">
                <div class="col-md-4 mb-4 mt-4">
                    &nbsp;
                </div>
            </div>
        </div>
    </header>
