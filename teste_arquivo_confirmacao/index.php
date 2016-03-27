<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta id="viewport" name="viewport" content="width=device-width, user-scalable=no"  />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
        <title>Prefeitura Municipal de Cabeceiras - GO</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <script src="js/jquery-2.1.4.min.js"></script>
        <script language="javascript" src="js/bootstrap.min.js" ></script>
        <style type="text/css">
            #status {
                padding: 5px 0 15px 0;
                display: none;
                color: #900;
                font-weight: bold;
            }
        </style>
        <!-- Incluimos a biblioteca do jquery -->
        <script type="text/javascript" language="javascript" src="jquery-1.3.2.js"></script>
        <!-- Criamos as funções necessárias para envio do formulário -->
        <script type="text/javascript" language="javascript">
            $(document).ready(function () {
                // Quando o formulário for enviado, essa função é chamada
                $("#formulario").submit(function () {
                    // Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
                    var nome = $("#nome").val();
                    var senha = $("#senha").val();
                    // Exibe mensagem de carregamento
                    $("#status").html("<img src='loader.gif' alt='Enviando' />");
                    // Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
                    $.post('envia.php', {nome: nome, senha: senha}, function (resposta) {
                        // Quando terminada a requisição
                        // Exibe a div status
                        $("#status").slideDown();
                        // Se a resposta é um erro
                        if (resposta != false) {
                            // Exibe o erro na div
                            $("#status").html(resposta);
                        }
                        // Se resposta for false, ou seja, não ocorreu nenhum erro
                        else {
                            // Exibe mensagem de sucesso
                            $("#status").html("Usuário e senha corretos! Aguarde calculando reajustes e realizando atualização dos saldos devedores");
                            $("#principal").submit();
                            // Coloca a mensagem no div de mensagens
                            // Limpando todos os campos
                            $("#nome").val("");
                            $("#senha").val("");
                        }
                    });
                });
            });
        </script>
    </head>

    <body>
        <form id="principal">
            <div class="form-group">
                <label for="nome">Nome<label>
                        <input type="text" name="nome" class="form-control" /></div>
                        <div class="form-group">
                            <label for="sobrenome">Sobrenome<label>
                                    <input type="text" name="sobrenome" class="form-control"/></div>
                                    <a href="#" class="btn btn-info envia" data-toggle="modal" data-target="#verifica_usuario">Enviar</a>

                                    </form>
                                    <div class="modal fade" tabindex="-1" role="dialog" id="verifica_usuario">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title"><i class="glyphicon glyphicon-warning-sign"></i> Aviso de Segurança</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Para continuar você deve verificar a senha!</p>
                                                    <!-- <div id="mensagens"> </div> -->
                                                    <div id="status"> </div>
                                                    <form id="formulario" action="javascript:func()" method="post">
                                                        <div class="form-group">
                                                            <label for="nome">Usuario</label>
                                                            <input name="nome" class="form-control" type="text" id="nome"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="senha">Senha</label>
                                                            <input name="senha" class="form-control" type="password" id="senha"/>
                                                        </div>
                                                        <input type="submit" class="btn btn-info" value="Enviar" />
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Desistir</button>

                                                    </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    </body>
                                    </html>