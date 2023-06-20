<?php
session_start();
session_destroy();
header('Location: login.php?msg=' . htmlspecialchars("Desconectado com sucesso! É necessário digitar novamente o login e senha para retornar ao sistema."));
?>