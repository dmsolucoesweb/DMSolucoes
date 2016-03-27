<?php

// Recuperamos os valores dos campos através do método POST
$nome = $_POST['nome'];
$senha = md5(preg_replace('/[^[:alnum:]_]/', '', $_POST['senha']));
// Verifica se o nome foi preenchido
if (empty($nome)) {
    echo "O campo de usuário deve ser preenchido!";
}
// Verifica se a mensagem foi digitada
elseif ($senha == md5("")) {
    echo "O campo de senha deve ser preenchido!";
}
// Verifica se a mensagem nao ultrapassa o limite de caracteres
// Se não houver nenhum erro
else {
    // Se inserido com sucesso
    if ($nome == "eduardo" and $senha == md5("123456") or $nome == "cesar" and $senha == md5("park") or $nome == "flavio" and $senha == md5("teste")) {
        echo false;
    }
    // Se houver algum erro ao inserir
    else {
        echo "Usuário ou senha incorretos.";
    }
}
?>