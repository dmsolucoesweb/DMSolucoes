<?php

/**
 * Este é um Código da Fábrica de Software
 * 
 * Coordenador: Elymar Pereira Cabral
 * 
 * Data: 07/09/2013
 *
 * Descrição de redefinesenhacontroller
 * Controller do módulo de recuperação de senha.
 *
 * @autor Ernesto Fonseca Veiga
 */
class RedefineSenhaController extends Controller {

    private $redefineSenhaView = NULL;
    private $usloEmail = NULL;
    private $novaSenha = NULL;

    public function __construct($moduCodigo) {
        Sessao::encerraSessao(); //só por garantia

        $this->recuperaSenhaView = new RedefineSenhaView();

        $acao = $this->recuperaSenhaView->getAcao();


        switch ($acao) {
            case FALSE :
                $this->recuperaSenhaView->setMensagem("Atenção! Sua senha será alterada e uma nova senha será enviada para o e-mail informado.", "Atencao");

                break;
            case "Recuperar" :
                // Gera uma nova senha para o usuário
                $this->geraNovaSenha();

                if (isset($this->novaSenha)) {

                    // Cria um objeto para utilizar os métodos da ADO (de forma transparente)
                    $usuarioLoginModel = new UsuarioLoginModel();

                    $this->usloEmail = $this->recuperaSenhaView->recebeEntradaDeDados();

                    $usuarioLoginModel->setUsloEmail1($this->usloEmail);
                    $usuarioLoginModel->setUsloSenha1($this->novaSenha);

                    if ($usuarioLoginModel->alteraSenha()) {
                        if ($this->enviaEmail()) {
                            $this->recuperaSenhaView->setMensagem("Senha alterada com sucesso! Acesse o e-mail informado para verificar sua nova senha.", "Informacao");
                        } else {
                            $this->recuperaSenhaView->setMensagem("Erro ao tentar enviar a nova senha para o e-mail informado.", "Erro");
                        }
                    } else {
                        $this->recuperaSenhaView->setMensagem("Não foi possível alterar sua senha. Verifique se o e-mail informado &eacute; o mesmo que foi cadastrado.", "Erro");
                    }
                }

                break;
        }

        $this->recuperaSenhaView->displayInterface($this->usloEmail);
    }

    private function geraNovaSenha() {

        $maiusculas = "ABCDEFGHIJKLMNOPQRSTUWXYZ";
        $minusculas = "abcdefghijklmnopqrstuwxyz";
        $numeros = "0123456789";
        //$codigos = '!@#$%&*()-+.,;?{[}]^><:|';
        $codigos = null;

        $base = $maiusculas . $minusculas . $numeros . $codigos;

        srand((float) microtime() * 10000000); // Semeia o processo randômico
        $senha = '';
        for ($i = 0; $i < 8; $i++) {
            $senha .= substr($base, rand(0, strlen($base) - 1), 1);
        }

        $this->novaSenha = $senha;
        ;
    }

    private function enviaEmail() {
        $email = new Emails();

        $endereco['eMail'] = $this->usloEmail;
        $endereco['nome'] = "";
        $enderecos [] = $endereco;

        $assunto = "Nova senha";
        $corpo = "A sua nova senha é:  " . $this->novaSenha;

        return $email->enviaEmails($enderecos, $assunto, $corpo);
    }

    public function checaRelacionamentos() {
        
    }

}

?>
