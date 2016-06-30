<?php

Abstract Class MinhaInterface
{

    private $cabecalho = null;
    private $rodape = null;
    protected $titulo = null;
    protected $meio = null;
    protected $boasVindas = null;
    private $mensagem = null;
    private $menu = null;

    final function __construct()
    {
        $this->montaTitulo();
        $this->montaCabecalho();
        $this->montaMenu();
        $this->montaRodape();
    }

    public function montaArrayDeBotoes()
    {
        $arrayDeBotoes = array(
            "con" => "<button type='submit' name ='bt' class='btn-con' value='con'>Consultar</button>",
            "novo" => "<button type='submit' name ='bt' class='btn-padrao' value='novo'>Novo</button>",
            "inc" => "<button type='submit' name ='bt' class='btn-inc' value='inc'>Incluir</button>",
            "alt" => "<button type='submit' name ='bt'  class='btn-padrao' value='alt'>Alterar</button>",
            "exc" => "<button type='submit' name ='bt' class='btn-exc' value='exc'>Excluir</button>"
        );
        return $arrayDeBotoes;
    }

    final private function montaMenu()
    {
        $this->menu = "<div id='menu' > 
                        
                        <ul>
                            <li><a href='http://localhost/academicoWeb/Modulos/estudante.php'>Alunos</a></li> 
                            <li><a href='http://localhost/academicoWeb/Modulos/professor.php'>Professores</a></li> 
                            <li><a href='http://localhost/academicoWeb/Modulos/disciplina.php'>Disciplinas</a></li>
                            <li><a href='http://localhost/academicoWeb/Modulos/curso.php'>Cursos</a></li>
                            <li><a href='http://localhost/academicoWeb/Modulos/matrizCurso.php'>Matrizes</a></li>
                            <li><a href='http://localhost/academicoWeb/Modulos/responsavel.php'>Responsavel</a></li>
                            <li><a href='http://localhost/academicoWeb/Modulos/matriculaCurso.php'>Matriculas por Curso</a></li>
                            <li><a href='http://localhost/academicoWeb/Modulos/matriculaDisciplina.php'>Matriculas por disciplina</a></li>
                            
                        </ul>

                         </div>";
    }

    private function montaBoasVindas()
    {
        $this->boasVindas = "<div id='boasVindas'>"
            . "         <h4><p>Seja bem vindo ao nosso sistema. "
            . "Através deste sistema você pode: "
            . "<p>Cadastrar um aluno;</p>"
            . "<p>Cadastrar um professor;</p>"
            . "<p>Cadastrar uma disciplina;</p>"
            . "<p>Cadastrar um curso e vinculá-los um ao outro.</p>"
            . "<p>Agradecemos a utilização do nosso sistema.</p></h4>"
            . "</div>";
    }

    final private function montaCabecalho()
    {
        $this->cabecalho = "
            <html>
            <head>
            <title>{$this->titulo}</title>
            <meta charset='utf-8'>
                 <link rel='stylesheet' type='text/css' href='../CSS/EvCSS.css'

            </head>
            <body>
                <div id='cabecalho'>
                  <img src='../IMG/ifg.jpg' width='80%' height='120px'>
                  <h1 id='topo'><center>Academico Web</center></h1>
                </div>";
    }

    final private function montaRodape()
    {
        $this->rodape = "
                <div id='rodape'>
                   <p>Avenida Universitária, Sem número, quadra única, Vale das Goiabeiras. CEP 75400-000. Inhumas - GO 62 35149501</p>
                </div>	 
                </body>
                </html>";
    }

    final public function displayInterface($objetoModel)
    {
        echo $this->cabecalho;
        $this->montaMeio($objetoModel);
        echo "<div id='wrapper'>";
        echo $this->menu;
        echo "<div id='wrapper-page'>";
        echo $this->mensagem;
        echo $this->meio;
        echo "</div>";
        echo "</div>";
        echo $this->rodape;
    }

    function getCabeçalho()
    {
        return $this->cabecalho;
    }

    function getRodape()
    {
        return $this->rodape;
    }

    function getTitulo()
    {
        return $this->titulo;
    }

    public function getAcao()
    {
        if (isset($_POST['bt'])) {
            return $_POST['bt'];
        } else {
            return false;
        }
    }

    function getMensagem()
    {
        return $this->mensagem;
    }

    function setMensagem($mensagem)
    {
        $this->mensagem = "<p>" . $mensagem . "</p>";
    }

    public function adicionaMensagem($mensagem)
    {
        $this->mensagem .= "<p>" . $mensagem . "</p>";
    }

    public function adicionaMsgErro($mensagem)
    {
        $this->mensagem .= "<p class='mensagem erro'>" . $mensagem . "</p>";
    }

    public function adicionaMsgSucesso($mensagem)
    {
        $this->mensagem .= "<p class='mensagem sucesso'>" . $mensagem . "</p>";
    }

    abstract public function montaTitulo();

    abstract public function montaMeio($objetoModel);

    abstract public function getDados();
}

?>
