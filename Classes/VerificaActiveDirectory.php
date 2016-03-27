<?php

/**
 * Este é um Código da Fábrica de Software
 * 
 * Coordenador: Elymar Pereira Cabral
 * 
 * Data: 06/03/2015
 *
 * Descrição de ActiveDirectory:
 * 
 * Esta classe implementa métodos para a conexão e outras funcionalidades com o 
 * Active Directory. 
 * 
 * @author Gabriel Heming <gabriel_heming@hotmail.com>
 *  
 * @autor Elymar Pereira Cabral
 */
class VerificaActiveDirectory {

    private $ldap            = false; //conexão básica do AD
    private $ldapBind        = null; //conexão avançada do AD 
    private $serverAD        = 'ldap://200.17.56.128'; //IP do servidor LDAP
    private $userAD          = null; //usuario para acesso geral do AD. Este é o sufixo que tem que ser concatenado com o prefixo (usuário ou login informado)
    private $domain          = '@ifg.br';
    private $ldapRDN         = null;
    private $passwordAD      = 'senha'; //senha para acesso geral do AD
    private $dnAD            = 'dc=ifg,dc=br'; //Especifique o caminho CN (Common Name), OU(Organizational Unit), DC(Domain Component). Lembrando que é ao contrário LOL
    private $protocolVersion = 3;
    private $mensagem        = null; //mensagens de erro e outros tipos

    public function __construct() {
        $ldap = ldap_connect($this->serverAD); // or die('não foi possível conectar');
        if (!$ldap) {
            return false;
        }
        $this->ldap = $ldap;

        $this->ldapBind = false;
    }

    private function connect($usuario, $senha) {
        if ($this->ldapBind) {
            return true; // se já está conectado, não precisa fazer nada.
        }

        if (ldap_set_option($this->ldap, LDAP_OPT_PROTOCOL_VERSION, $this->protocolVersion)) {
            //se ok, continua.
        } else {
            $this->setMensagem('Falha em definir protocolo na vers&atilde;o ' . $this->protocolVersion);
            return false;
        }

        ldap_set_option($this->ldap, LDAP_OPT_REFERRALS, 0);

        $this->ldapBind = ldap_bind($this->ldap); //Checa conexão com o servidor.
        if (ldap_errno($this->ldap) === 0) { // Conexão sem erro no AD
            //Conexão ok. Continua.
        } else { // Erro na conexão
            $this->setMensagem('N&atilde;o foi poss&iacute;vel conectar no servidor');
            return false;
        }

        $this->userAD     = $usuario;
        $this->passwordAD = $senha;

        $this->ldapRDN = $this->userAD . $this->domain;

        $this->ldapBind = ldap_bind($this->ldap, $this->ldapRDN, $this->passwordAD); //Checa conexão do usuário com o servidor.
        if (ldap_errno($this->ldap) === 0) {
            //Conexão do usuário ok. Continua.
        } else { // Erro na conexão do usuário.
            $this->setMensagem("Usu&aacute;rio sem permissão de acesso.");
            return false;
        }

        return true;
    }

    public function isUser($usuario, $senha) {
        if ($this->connect($usuario, $senha)) {
            $searchResults = ldap_search($this->ldap, $this->dnAD, '(|(samaccountname=' . $usuario . '))');
            if (count(ldap_get_entries($this->ldap, $searchResults)) > 1) {
                return true;
            }
        }
        return false;
    }

    public function getUser($usuario, $senha) {
        if ($this->connect($usuario, $senha)) {
            $searchResults = ldap_search($this->ldap, $this->dnAD, '(|(samaccountname=' . $usuario . '))');
            if (count(ldap_get_entries($this->ldap, $searchResults)) > 1) {
                $object  = ldap_get_entries($this->ldap, $searchResults);
                $usuario = $object[0];
                return $usuario;
            }
        }
        return false;
    }

    function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    function getMensagem() {
        return $this->mensagem;
    }

}
