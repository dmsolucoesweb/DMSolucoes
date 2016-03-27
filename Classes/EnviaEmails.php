<?php

/**
 * Este é um Código da Fábrica de Software
 *
 * Coordenador: Elymar Pereira Cabral
 *
 * @date 11/09/2015
 *
 * Descrição de EMails:
 * Esta classe tem por objetivo atender genericamente todas as necessidades relacionadas
 * a emails como, por exemplo, enviar um email para determinada pessoa.
 * 
 * Nem todas as funcionalidades estarão implementadas desde o início, a intenção
 * é complementá-las a medida que se necessitar.
 * 
 * Deve-se pensar no uso dos métodos sem necessidade de instancear a classe.
 * 
 *
 * @author Cayo Eduardo <cayoesn@gmail.com>
 */

class EnviaEmails extends PHPMailer {

    function __construct() {
        $this->SMTPSecure = 'ssl';
        $this->CharSet = "iso-8859-1"; // Define a Codificação
        $this->IsSMTP(); // Define que será enviado por SMTP
        $this->Host = "smtp.gmail.com"; // Servidor SMTP
        $this->Port = 465;
        $this->SMTPAuth = true; // Caso o servidor SMTP precise de autenticação
        $this->Username = "fsw.artefato@gmail.com"; // Usuário ou E-mail para autenticação no SMTP
        $this->Password = "f@bric@fsw"; // Senha do E-mail
        $this->IsHTML(false); // Enviar como HTML
        $this->From = "fsw.artefato@gmail.com"; // Define o Remetente
        $this->FromName = "FSW"; // Nome do Remetente
    }

    function enviaEmails(Array $enderecos, $assunto, $corpo) {

        foreach ($enderecos as $endereco) {
            parent::AddAddress($endereco['eMail'], $endereco['nome']);
        }

        $this->Subject = $assunto; // Define o Assunto
        $this->Body = $corpo;

        return parent::Send();
    }

}
