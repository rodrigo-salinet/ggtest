<?php
session_start();
require_once('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <?php require_once('scripts_header.php'); ?>
    <title>Cadastrar Usuário -> Sistema de Orçamentos de Informática</title>
</head>

<body>
    <h1>Formulário de cadastro de usuário</h1>
    <h3 class="text-danger"><?php echo @$_GET['msg']; ?></h3>
    <form id="frm_cadastro" action="criar_usuario.php" method="post">
        <?php
            $str_sql_tipos_usuarios = "select * from `tbl_tipos_usuarios`;";
            try {
                $sql_tipos_usuarios = mysqli_query($conexao, $str_sql_tipos_usuarios);
                for ($i = 0; $i < mysqli_num_rows($sql_tipos_usuarios); $i++) {
                    $rdg_nome = "rdg_tipos_usuarios";
                    $rdg_id = $rdg_nome . $i;
                    $tipos_usuarios = mysqli_fetch_array($sql_tipos_usuarios);
                    $id_tipo = $tipos_usuarios['id'];
                    $tipo = $tipos_usuarios['tipo'];
                    $checado = "";
                    if (@$_SESSION['rdg_tipos_usuarios']) {
                        $checado = " checked";
                    }
        ?>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="<?php echo $rdg_nome; ?>" id="<?php echo $rdg_id; ?>" value="<?php echo $id_tipo; ?>" <?php echo $checado; ?>>
            <label class="form-check-label" for="<?php echo $rdg_id; ?>">
                <?php echo $tipo; ?>
            </label>
        </div>
        <?php
                }
            } catch (PDOException $e) {
        ?>
        <div class="mb-3">
            <h3>Não foi possível carregar os tipos de usuários (Falha: <?php echo $e; ?> ).</h3>
        </div>
        <?php
            }
        ?>
        <div class="mb-3">
            <label for="nome" class="form-label">nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo @$_SESSION['nome']; ?>" placeholder="Digite aqui seu nome">
        </div>
        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" class="form-control" id="login" name="login" aria-describedby="loginHelp" value="<?php echo @$_SESSION['login']; ?>" placeholder="Digite aqui seu login">
            <div id="loginHelp" class="form-text">Este login não será compartilhado com ninguém e não pode conter espaços.</div>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" value="<?php echo @$_SESSION['senha']; ?>" placeholder="Digite aqui sua senha">
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

    <script type="text/javascript" src="cadastrar_usuario.js"></script>

</body>
</html>