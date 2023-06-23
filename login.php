<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <?php require_once('scripts_header.php'); ?>
    <title>Login -> Sistema de Orçamentos de Informática</title>
</head>

<body>
    <h1>Formulário de login</h1>
    <h3><?php echo @$_GET['msg']; ?></h3>
    <form id="frm_login" action="validar_usuario.php" method="post">
        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" class="form-control" id="login" name="login" aria-describedby="emailHelp" placeholder="Digite aqui seu login">
            <div id="emailHelp" class="form-text">Este login não será compartilhado com ninguém.</div>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite aqui sua senha">
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>

    <h5>Não tem cadastro?</h5>
    <h6><a href="cadastrar_usuario.php">Cadastre-se aqui</a></h6>

    <script type="text/javascript" src="login.js"></script>

</body>
</html>