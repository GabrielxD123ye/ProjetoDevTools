<?php
session_start();
require('conecta.php');
if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];
}

$senha_atual = $_POST['senha_atual'];
$senha_nova = $_POST['nova_senha'];
$confirmar_senha_nova = $_POST['confirmar_senha'];
if($senha_nova == $confirmar_senha_nova) {
    $ok = true;
}else {
    $ok = false;
    echo "<script>
                alert('Alguma das senhas não coincidem!');
                window.location.href = 'trocar_senha.php';
                </script>";
}
if (strlen($senha_atual) < 8 && strlen($senha_nova)< 8 && strlen($confirmar_senha_nova)) {
    $ok = false;
    echo "<script>
                alert('Mínimo de 8 caracteres!');
                window.location.href = 'trocar_senha.php';
                </script>";
}else {
    
}
if($ok) {
$sql = "SELECT * from usuario WHERE id_usuario=$id_usuario and senha_usuario='".md5($senha_atual)."'";
$resultado = $conecta->query($sql);
if ($resultado->num_rows > 0) {
    $sql2 = "UPDATE usuario SET senha_usuario='".md5($senha_nova)."' WHERE id_usuario = $id_usuario";
    $resultado = $conecta->query($sql2);
    echo "<script> 
        alert('Senha trocada com sucesso');
                window.location.href = 'pagina_usuario.php';
            </script>";
}else {
    echo "<script>
                alert('Alguma das senhas não coincidem!');
                window.location.href = 'trocar_senha.php';
                </script>";
}
}

