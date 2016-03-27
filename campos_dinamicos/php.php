<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Pega dados do Campo Dinamico</title>
    </head>

    <?php
    require_once '../../Ados/BancoDeDados.php';
    $bd = new BancoDeDados();
    $gravar = null;
    if (isset($_POST["palavra"])) {

        // varre o array de campos.... não consigo buscar todos os campos 
        $dados = $_POST['palavra'];
        $x = implode(";", $dados);

        $resultado = $bd->executaQuery($query) or die(mysql_error());
        if ($resultado) {
            return true;
        } else {
            return false;
        }
    } else {
        echo "Erro!";
    }
    ?>

</html>
