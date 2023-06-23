    <nav class="nav navbar navbar-expand-md navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container-fluid">
            <span class="navbar-brand" title="Sistema de Orçamento de Informática">S.O.I.</span>
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
                            <li><a class="dropdown-item" href="javascript:verSecao('sec_novo_item')">Novo Item</a></li>
                            <li><a class="dropdown-item" href="javascript:verSecao('sec_editar_item')">Editar Item</a></li>
                            <?php if (@$_SESSION['tipo_usuario'] == 2) { ?>
                            <li><a class="dropdown-item" href="javascript:verSecao('sec_excluir_item')">Excluir Item</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Clientes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:verSecao('sec_novo_cliente')">Novo Cliente</a></li>
                            <li><a class="dropdown-item" href="javascript:verSecao('sec_editar_cliente')">Editar Cliente</a></li>
                            <?php if (@$_SESSION['tipo_usuario'] == 2) { ?>
                            <li><a class="dropdown-item" href="javascript:verSecao('sec_excluir_cliente')">Excluir Cliente</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Orçamentos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:verSecao('sec_novo_orcamento')">Novo Orçamento</a></li>
                            <li><a class="dropdown-item" href="javascript:verSecao('sec_editar_orcamento')">Editar Orçamento</a></li>
                            <li><a class="dropdown-item" href="javascript:verSecao('sec_excluir_orcamento')">Excluir Orçamento</a></li>
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
                            <li><a class="dropdown-item" href="javascript:verSecao('sec_novo_usuario')">Novo Usuário</a></li>
                            <li><a class="dropdown-item" href="javascript:verSecao('sec_editar_usuario')">Editar Usuário</a></li>
                            <li><a class="dropdown-item" href="javascript:verSecao('sec_excluir_usuario')">Excluir Usuário</a></li>
                            <?php } ?>
                            <li><a class="dropdown-item" href="javascript:verSecao('sec_meu_cadastro')">Meu cadastro</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="./sair.php"><i class="fa fa-remove text-danger"></i> Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="d-flex" role="search">
                <select id="sel_orcamentos" class="form-select">
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
