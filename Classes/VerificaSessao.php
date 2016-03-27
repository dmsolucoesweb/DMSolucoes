<?php

/**
 * Este é um Código da Fábrica de Software
 * 
 * Coordenador: Elymar Pereira Cabral
 * 
 * Data: 22/04/2013
 *
 * Descrição da classe Sessao:
 * 
 * Esta classe permite iniciar, finalizar e consultar uma secao.
 *
 * @autor Elymar Pereira Cabral
 */
class VerificaSessao {

    function __construct($listaVariaveisDeSessao = NULL) {
        if (!estaLogado()) {
            self::iniciaSessao();
        }
        if (!is_null($listaVariaveisDeSessao)) {
            self::setDadosSessao($listaVariaveisDeSessao);
        }
    }

    /**
     * Inicia (cria) uma nova sessão.
     */
    public static function iniciaSessao() {
        session_start();
    }

    /**
     * Ecerra uma sessão.
     */
    public static function encerraSessao() {
        if (!isset($_SESSION['autenticado'])) {
            self::iniciaSessao();
        }
        $_SESSION["autenticado"] = FALSE;
        session_destroy();
    }

    /**
     * Cria uma nova sessão com os dados dessa. Recebe um array com os dados e cada 
     * posição deste deve ter o nome desejado para cada elemento/atributo da sessão.
     * @param $listaVariaveisDeSessao = array com os elementos a serem armazenados 
     *                                 pela sessão. Cada posição é identificada 
     *                                 pelo nome de um elemento/atributo.
     */
    public static function criaSessao(Array $listaVariaveisDeSessao) {
        self::iniciaSessao();
        $listaVariaveisDeSessao["autenticado"] = TRUE;
        self::setDadosSessao($listaVariaveisDeSessao);
    }

    /**
     * Verifica se está aberta uma sessão.
     */
    public static function estaLogado() {
        if (!isset($_SESSION['autenticado'])) {
            self::iniciaSessao();
        }
        if (isset($_SESSION['autenticado'])) {
            if ($_SESSION["autenticado"] === TRUE) {
                return true;
            }
        }
        return false;
    }

    /**
     * Método setDadosSessao()
     * Armazena na sessão os dados recebidos em uma lista onde cada posição é identificada 
     * com o nome do elemento/atributo.
     * @param $listaVariaveisDeSessao = array com os elementos a serem armazenados 
     *                                 pela sessão. Cada posição é identificada 
     *                                 pelo nome de um elemento/atributo.
     */
    public static function setDadosSessao(Array $listaVariaveisDeSessao) {
        foreach ($listaVariaveisDeSessao as $nome => $item) {
            $_SESSION[$nome] = $item;
        }
    }

    /**
     * Recupera os dados armazenados na sessão e retorna um array com esses dados 
     * e cada posição é identificada com o nome do elemento/atributo.
     * 
     * @return array todas as variáveis criadas para a sessão
     */
    public static function getDadosSessao() {
        $listaVariaveisDeSessao = array();
        foreach ($_SESSION as $nome => $item) {
            $listaVariaveisDeSessao[$nome] = $item;
        }
        return $listaVariaveisDeSessao;
    }

    /**
     * Método getUsuarioId()
     * Recupera dentre os dados armazenados na sessão o atributo usloId.
     * 
     * @return mixed identificador do usuário
     */
    public static function getUsuarioId() {
        if (isset($_SESSION['usloId'])) {
            return $_SESSION['usloId'];
        }
        return null;
    }

}

?>
