<?php
set_include_path(get_include_path() .':/var/www/html/');
require_once 'Usefull/usefull.php';
/**
 * Este é um Código da Fábrica de Software
 * 
 * Coordenador: Elymar Pereira Cabral
 * 
 * @date 01/12/2014
 * 
 * Descrição de BancoDeDadosPdo:
 * Esta classe cuida da camada de persistência do banco de dados e será extendida 
 * diretamente pela classe AdoPdoAbstract02 ou instanciada pela AdoPdoAbstract. 
 * 
 * Todos os métodos a serem execudados diretamente pela classe PDO devem ser 
 * implementados nesta.
 * 
 * Esta classe extende a classe PDO.
 * 
 * @author Elymar Pereira Cabral <elymar.cabral@ifg.edu.br>
 * @author Flayson Potenciano e Silva, Elymar Pereira Cabral e Markley da Silva Mendes
 */
class BancoDeDadosPdo extends PDO {

    private $host = NULL;
    private $usuario = NULL;
    private $senha = NULL;
    private $bdNome = NULL;
    private $mensagem = NULL;
    private $confUTF8 = "charset=utf8";
    private $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    private $statusDoConstrutor = TRUE;
    private $pdoStatment = NULL;
    //a conexão e os atributosBd serão utilizados nas transações envolvento mais
    //de um objeto.
    private $conexaoParaTransacoesMultiobjetos = NULL;
    private $atributosBd = null;

    /**
     * Este é o método construtor da classe BancoDeDadosPdo. Nele é feita a conexão com o 
     * banco de dados usando os dados da classe AtributosBd que deve ser recebida via parâmetro.
     * @param type $atributosBd Classe com os dados para conexão e seleção do banco de dados.
     * @return type
     */
    function __construct() {
        //atributosBd será utilizado quando se precisar de uma transação 
        //envolvendo mais de um objeto.

        $this->usuario = "root";
        $this->senha = "root";
        $this->bdNome = "academicoweb";
        try {
            parent::__construct("mysql:host=localhost;dbname={$this->bdNome};{$this->confUTF8}", $this->usuario, $this->senha, $this->options);
            $this->configuraUTF8();
        } catch (PDOException $e) {
            die("N&atildeo foi poss&iacute;vel conectar ao SGBD. Contate o analista respons&aacute;vel pela FSW. Erro: " . $e->getMessage());
            $this->setMensagem("N&atildeo foi poss&iacute;vel conectar ao SGBD. Erro: " . $this->getBdError(1));
            //$this->setMensagem($e->getMessage());
            $this->setStatusDoConstrutor(FALSE);
            return;
        }
    }

    /**
     * Este é o método que vai destruir o construtor, vai encerrar a conexão.
     */
    function __destruct() {
        $this->conexaoParaTransacoesMultiobjetos = NULL;
    }

    function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    function getMensagem() {
        return $this->mensagem;
    }

    /**
     * Este método retornará erros do SGBD.
     * @return array
     */

    /**
     * 
     * @param inteiro $tipo Identifica se o erro foi de uma execução num objeto 
     *                      do tipo statment (0) ou diretamente no BD (1).
     * @return String Mensagem do erro
     */
    function getBdError($tipo = 0) {
        $erro = null;
        if ($tipo === 0) {
            $erro = $this->pdoStatment->errorInfo();
        } else {
            $erro = parent::errorInfo();
        }

        return $erro[2];
    }

    /**
     * Este método mostrará os status do construtor.
     * @return String
     */
    public function getStatusDoConstrutor() {
        return $this->statusDoConstrutor;
    }

    /**
     * Este método será montado o status do construtor
     * @param type $statusDoConstrutor
     */
    public function setStatusDoConstrutor($statusDoConstrutor) {
        $this->statusDoConstrutor = $statusDoConstrutor;
    }

    /**
     * Este é o método que vai encerrar a conexão com banco de dados.
     */
    /**
     * EPC - 08/02/2016
     * EU COMENTEI OS MÉTODOS ABAIXO PQ ESTA CLASSE HERDA DA PDO DIRETAMENTE E A
     * CONEXAO É FEITA VIA CHAMADA AO CONSTRUTOR DIRETAMENTE, OU SEJA, NÃO 
     * INSTACIA O OBJETO PDO NUMA VARIÁRE HANDLE. SENDO ASSIM, NADA ESTAVA SENDO
     * GUARDADA EM HANDLE E CONSEQUENTEMENE OS MÉTODOS desconectaDoBD(), 
     * setConexao() E getConexao() NÃO ESTAVAM REALIZANDO O QUE DEVERIAM 
     * REALIZAR.
     */
//    function desconectaDoBD() {
//        if ($this->handle) {
//            $this->handle = NULL;
//        }
//    }
//
//    function setConexao($handle) {
//        $this->handle = $handle;
//    }
//
//    function getConexao() {
//        return $this->handle;
//    }

    /**
     * Este é o método aonde será feito uma preparação de uma query, 
     * e logo em seguida seŕa executado pela pdoStatment, 
     * e essa execução ser retornado.
     * @param type $query
     * @return type
     */
    function executaQuery($query) {
        $this->pdoStatment = parent::prepare($query);
        return $this->pdoStatment->execute();
    }

    /**
     * Método para execução da query via PDO Prepared Statement
     * passando os valores por parametros em array, separados da query
     * @param String $query Instrução SQL parametrizada com ?.
     * @param array $arrayDeValores Valores a serem substituídos nos ? da instrução.
     * @return boolean true ou false dependendo do resultado de execute()
     */
    function executaPs($query, $arrayDeValores) {
        $this->pdoStatment = parent::prepare($query);

        return $this->pdoStatment->execute(array_values($arrayDeValores));
    }

    /**
     * Este método será retornado o número de linhas afetadas em uma consulta sql.
     * OBS: Segundo o php.net o comportamento do rowCount de retornar o número de
     *      linhas, não será garantido para todos bancos de dados.
     * @param type $resultado
     * @return rowCount
     */
    function qtdeLinhas() {
        return $this->pdoStatment->rowCount();
    }

    /**
     * Este método irá retorna a quantidade de linhas afetadas por Updates, Deletes...
     * @return rowCount
     */
    function linhasAfetadas() {
        return $this->pdoStatment->rowCount();
    }

    public function getAtributoArquivo($linha, $nomeDoAtributo) {
        return $linha[$nomeDoAtributo];
    }

    /**
     * Este método lê o resultado de um select. Retorna uma tupla no formato de
     * array indexado pelo nome da coluna ou um objeto stdClas, de acoro com o 
     * parâmetro de entrada (2 ou 5 respectivamente).
     * @param type $estilo 2 == FETCH_ASSOC, 5 == FETCH_OBJ;
     * @return type
     */
    function leTabelaBD($estilo = 2) {
        return $this->pdoStatment->fetch($estilo);
    }

    /**
     * Este método configura o tipo dos caracteres para UTF-8
     */
    function configuraUTF8() {
        parent::exec("SET NAMES utf8");
        parent::exec("SET character_set='utf8'");
        parent::exec("SET collation_connection='utf8_general_ci'");
        parent::exec("SET character_set_connection=utf8");
        parent::exec("SET character_set_client=utf8");
        parent::exec("SET character_set_results=utf8");
    }

    /**
     * Recupera o último id inserido numa tabela.
     * @return boolean retorna o id da última tupla inserida ou false se ocorrer erro
     */
    function recuperaId($tabela = null) {
        if (is_null($tabela)) {
            return parent::lastInsertId();
        } else {
            return parent::lastInsertId($tabela);
        }
    }

    /**
     * Executa uma ou mais querys dentro de uma transação finalizando com commit
     * se executou todas com sucesso ou rollback se houve algum problema.
     * 
     * @param type $arrayQuerys Matriz onde cada linha deve conter na primeira 
     *                          coluna (de nome query) uma query e na segunda 
     *                          coluna (de nome alteraTupla) deve conter True 
     *                          para querys do tipo Update, Delete e Insert, ou 
     *                          False para querys do tipo Select, Set, etc.
     * @return boolean True se executou todos as querys, False se ocorreu algum 
     *                 erro ou 0 se não executou uma tupla.
     */
    function executaArrayDeQuerysComTransacao(Array $arrayQuerys) {
        $this->iniciaTransacaoComApenasUmObjeto();

        foreach ($arrayQuerys as $query) {
            $executouQuery = $this->executaQuery($query["query"]);
            if ($executouQuery) {
                //continua
            } else {
                $this->setMensagem("Erro na query: " . $query["query"]);
                $this->descartaTransacaoComApenasUmObjeto();
                return false;
            }
            if ($query["alteraTupla"]) {
                if ($this->linhasAfetadas() == 0) {
                    $this->setMensagem("Query sem efeito: " . $query["query"]);
                    $this->descartaTransacaoComApenasUmObjeto();
                    //EPC - 19/01/2016 - TROQUEI FALSE POR 0 PARA INDICAR 0 LINHAS AFETADAS.
                    return 0;
                }
            }
        }

        $this->validaTransacaoComApenasUmObjeto();
        return true;
    }

    /**
     * Funciona de forma análoga ao método executaArrayDeQuerysComTransacao, ou 
     * seja, executa uma ou mais querys dentro de uma transação finalizando com 
     * commit se executou todas com sucesso ou rollback se houve algum problema.
     * A única diferença é que neste não se checa as linhas afetadas para as 
     * querys executadas. 
     * 
     * @param type $arrayQuerys Vetor onde cada posição deve conter uma query.
     * @return boolean True se executou todos as querys e False se ocorreu algum 
     *                 erro ou não executou uma tupla.
     */
    function executaArrayDeQuerysComTransacaoSimplificado(Array $arrayQuerys) {
        $this->iniciaTransacaoComApenasUmObjeto();

        foreach ($arrayQuerys as $query) {
            $executouQuery = $this->executaQuery($query);
            if ($executouQuery) {
                //continua
            } else {
                $this->setMensagem("Erro na query: " . $query . "<br>Erro: " . $this->getBdError());
                $this->descartaTransacaoComApenasUmObjeto();
                return false;
            }
        }

        $this->validaTransacaoComApenasUmObjeto();
        return true;
    }

    /**
     * Similar ao método executaArrayDeQuerysComTransacao porém executa o método
     * executaPs desta classe que precisa receber as querys parametrizadas (?)
     * e os parâmetros.
     * 
     * @param type $arrayPsEParametros Vetor onde cada posição deve conter um 
     * array com uma query na primeira posição e um array com os parâmetros na 
     * segunda posição.
     * Exemplo: Array (String $query, Array $arrayDeParametros)
     * @return boolean True se executou todos as querys e False se ocorreu algum 
     *                 erro ou não executou alguma tupla.
     */
    function executaArrayDePsComTransacaoSimplificado(Array $arrayPsEParametros) {
        $this->iniciaTransacaoComApenasUmObjeto();

        foreach ($arrayPsEParametros as $psEParametros) {
            $executouQuery = $this->executaPs($psEParametros[0], $psEParametros[1]);
            if ($executouQuery) {
                //continua
            } else {
                $this->setMensagem("Erro na query: " . $psEParametros[0] . "<br>Erro: " . $this->getBdError());
                $this->descartaTransacaoComApenasUmObjeto();
                return false;
            }
        }

        $this->validaTransacaoComApenasUmObjeto();
        return true;
    }

    /**
     * EPC - 24/06/2015
     * ATENÇÃO!!!
     * 
     * EU TRANSFORMEI OS MÉTODOS iniciaTransacaoComApenasUmObjeto(), commit() e rollback() PARA 
     * PRIVATE PORQUE O ROLLBACK NÃO ESTÁ FUNCIONANDO QUANDO SE IMPLEMENTA A 
     * ROTINA DE DENTTRO DA CONTROLLER. ACREDITO QUE SEJA ALGUMA COISA 
     * RELACIONADA COM TODAS AS TRANSAÇÕES DEVEM USAR O MESMO HANDLE. PRECISO 
     * INVESTIGAR MELHOR. 
     * 
     * ATÉ RESOLVER ESSE PROBLEMA O MAIS PRUDENTE É USAR EXCLUSIVAMENTE O MÉTODO
     * executaArrayDeQuerysComTransacao().
     */
    //EPC - 19/01/2016 - PASSEI DE PRIVATE PARA PROTECTED QUE ACREDITO TER O MESMO EFEITO.

    /**
     * Este métedo é para iniciar a transação com o banco de dados.
     * Este método entra no lugar do iniciaTransação() para ser usado apenas em 
     * transações envolvendo apenas um objeto.
     */
    protected function iniciaTransacaoComApenasUmObjeto() {
        return parent::beginTransaction();
    }

    /**
     * Este método irá executar uma ação, se estiver correta e não sofre alguma alteração.
     * @return boolean
     */
    protected function validaTransacaoComApenasUmObjeto() {
        return parent::commit();
    }

    /**
     * Este método irá voltar ao estado que estava antes de executar uma ação, se ocorrer alguma falha.
     * @return boolean
     */
    protected function descartaTransacaoComApenasUmObjeto() {
        return parent::rollback();
    }

    /**
     * Este métedo é para iniciar a transação com o banco de dados. Entra no 
     * lugar do iniciaTransacaoComApenasUmObjeto().
     * Ele usa a classe TTransaction que permite abrir transações envolvendo 
     * mais de um objeto.
     */
    public function iniciaTransacao() {
        try {
            if (TTransaction::open($this->atributosBd, $_SERVER['DOCUMENT_ROOT'] . "/FabricaDeSoftware/fsw/Default/bd_mysql.ini")) {
                $this->conexaoParaTransacoesMultiobjetos = TTransaction::getConexao();
            }

            return true;
        } catch (Exception $e) {
            $this->setMensagem("Erro ao tentar iniciar a transa&ccedil;&atilde;o. Contate o analista respons&aacute;vel.");
            $this->setMensagem($e->getMessage());
            return false;
        }
    }

    /**
     * Aplica todas as operações realizadas na transação e fecha a conexão com o
     * BD.
     * @return boolean
     */
    protected function validaTransacao() {
        return $this->conexaoParaTransacoesMultiobjetos->commit();
    }

    /**
     * Descarta todas as operações realizadas na transação.
     * @return boolean
     */
    protected function descartaTransacao() {
        return $this->conexaoParaTransacoesMultiobjetos->rollback();
    }

    function getConexaoParaTransacoesMultiobjetos() {
        return $this->conexaoParaTransacoesMultiobjetos;
    }

    function executaPsEmTransacoesMultiobjetos($query, $arrayDeValores) {
        $pdoStatment = $this->conexaoParaTransacoesMultiobjetos->prepare($query);

        return $pdoStatment->execute(array_values($arrayDeValores));
    }

    function recuperaIdEmTransacoesMultiobjetos($tabela = null) {
        if (is_null($tabela)) {
            return $this->conexaoParaTransacoesMultiobjetos->lastInsertId();
        } else {
            return $this->conexaoParaTransacoesMultiobjetos->lastInsertId($tabela);
        }
    }

    /**
     * Similar ao método executaArrayDeQuerysComTransacao porém executa o método
     * executaPs desta classe que precisa receber as querys parametrizadas (?)
     * e os parâmetros. Além disso trabalha com multiplus objetos e, portanto,
     * trabalha com os métodos para transações multilobjetos.
     * 
     * @param type $arrayPsEParametros Vetor onde cada posição deve conter um 
     * array com uma query na primeira posição e um array com os parâmetros na 
     * segunda posição.
     * Exemplo: Array (String $query, Array $arrayDeParametros)
     * @return boolean True se executou todos as querys e False se ocorreu algum 
     *                 erro ou não executou alguma tupla.
     */
    function executaArrayDePsComTransacaoParaMultiobjetos(Array $arrayPsEParametros) {
        $this->iniciaTransacao();

        foreach ($arrayPsEParametros as $psEParametros) {
            $executouQuery = $this->executaPs($psEParametros[0], $psEParametros[1]);
            if ($executouQuery) {
                //continua
            } else {
                $this->setMensagem("Erro na query: " . $psEParametros[0] . "<br>Erro: " . $this->getBdError());

                $this->descartaTransacao();
                return false;
            }
        }

        $this->validaTransacao();
        return true;
    }

}

?>
