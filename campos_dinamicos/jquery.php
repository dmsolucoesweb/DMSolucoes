<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title>Form com Campos Dinamicos</title>
    <head>
        <script type='text/javascript'>
            var qtdeCampos = 0;
            function addCampos() {
                var objPai = document.getElementById('campoPai');
                //Criando a DIV;
                var objFilho = document.createElement('div');
                //Definindo atributos ao objFilho:
                objFilho.setAttribute('id', 'filho' + qtdeCampos);

                //Inserindo o elemento no pai:
                objPai.appendChild(objFilho);
                //Escrevendo algo no filho recém-criado:
                document.getElementById("filho" + qtdeCampos).innerHTML = "<div class=\'row\' ><div class=\'form-group col-md-1\'> <label for=\'n_parcela\'>Nº de parcelas</label> <input type=\'text\' class=\'form-control\' id=\'n_parcela\' name=\'n_parcela[]\'> </div> <div class=\'form-group col-md-2\'> <label for=\'period\'>Periodicidade</label> <select class=\'form-control\' id=\'period\' name=\'period[]\'><option value=\'-1\'>Periodicidade</option><option value=\'1\'>Única</option><option value=\'2\'>Mensal</option></select> <div class=\'form-group col-md-3\'> <label for=\'venc_pri\'>Vencimento da 1ª série</label> <input type=\'text\' class=\'form-control\' id=\'venc_pri\' name=\'venc_pri[]\'> </div> <div class=\'form-group col-md-3\'> <label for=\'v_unitario\'>Valor unitário</label> <input type=\'text\' class=\'form-control\' id=\'v_unitario\' name=\'v_unitario[]\'> </div> <div class=\'form-group col-md-3\'> <label for=\'v_total\'>Valor total</label> <input type=\'text\' class=\'form-control\' id=\'v_total\' name=\'v_total[]\'> </div></div><div class=\'row\'> <div class=\'form-group col-md-3\'> <label for=\'atul_mon\'>Atualização Monetária</label> <select class=\'form-control\' id=\'atul_mon\' name=\'atul_mon[]\'><option value=\'-1\'>Atualização</option><option value=\'1\'>Fixa e irreajustável</option><option value=\'2\'>Reajustável</option></select></div> <div class=\'form-group col-md-3\'> <label for=\'form_pag\'>Forma de pagamento</label> <select class=\'form-control\' id=\'form_pag\' name=\'form_pag[]\'><option value=\'-1\'>Forma de pagamento</option><option value=\'1\'>À VISTA</option><option value=\'2\'>BOLETO</option></select></div> <div class=\'form-group col-md-6\'> <label for=\'obs\'>Observações</label> <input type=\'text\' class=\'form-control\' id=\'obs\' name=\'obs[]\'> </div></div><input type='button' onClick='removerCampo(" + qtdeCampos + ")' value='X'>";
                qtdeCampos++;
            }

            function removerCampo(id) {
                var objPai = document.getElementById('campoPai');
                var objFilho = document.getElementById('filho' + id);
                //Removendo o DIV com id específico do nó-pai:
                var removido = objPai.removeChild(objFilho);
            }

        </script>
    </head>

    <body>
        <form name='dados' action='php.php' method='post'>
            <div id='campoPai'></div>
            <input type='button' value='Adicionar Campos' onclick='addCampos()'>
                <br><br><input type='submit' value='Enviar'>
                            </form>
                            </body>
                            </html>
