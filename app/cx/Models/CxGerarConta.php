<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxGerarConta
 *
 * @copyright (c) year, Édio Mazera
 */
class CxGerarConta
{

    private $Resultado;
    private $DadosId;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function gerarConta($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;

        $listarConta = new \App\adms\Models\helper\AdmsRead();
        $listarConta->fullRead("SELECT con.* FROM cx_contas con
        WHERE id_con=:id_con LIMIT :limit", "limit=1&id_con={$this->DadosId}");
        $this->Dados = $this->Resultado = $listarConta->getResultado();
        if ($this->Resultado) {
            $this->criarBase();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Conta não encontrada!</div>";
            $this->Resultado = false;
        }
    }

    private function criarBase()
    {
        $conta = strtolower($this->Dados[0]['conta']);
        $prefixo = substr($conta, 0, 3);
        $conn = mysqli_connect(HOST, USER, PASS, DBNAME);
        // Estrutura para tabela cx_conta_$conta
        $query = "CREATE TABLE IF NOT EXISTS " . "cx_conta_" . $conta . " 
        (id_{$prefixo} int NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        created datetime NOT NULL, modified datetime DEFAULT NULL,
        valor varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
        mes_id int DEFAULT NULL, ano int DEFAULT NULL,
        codigo varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
        observacao varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
        vencimento varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
        situacao int NOT NULL DEFAULT '0') 
        ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            //$_SESSION['msg'] = "<div class='alert alert-success'>Conta criada com sucesso!</div>";
            // Listar
            $this->inserirCategoria();
            $this->inserirDescricao();
            $this->inserirPaginaController();
            $this->criarMenuController();
            $this->criarArquivoModel();
            $this->criarArquivoController();
            $this->criarArquivoWiewsListar();
            // Apagar
            $this->criarControllerApagar();
            $this->inserirControllerApagar();
            $this->criarMenuControllerApagar();
            $this->criarModelApagar();
            // Cdastrar
            $this->criarControllerCadastrar();
            $this->inserirControllerCadastrar();
            $this->criarMenuControllerCadastrar();
            $this->criarModelCadastrar();
            $this->criarArquivoWiewsCadastrar();
            // Editar
            $this->criarControllerEditar();
            $this->inserirControllerEditar();
            $this->criarMenuControllerEditar();
            $this->criarModelEditar();
            $this->criarArquivoWiewsEditar();
            // Vizualizar
            $this->criarControllerVizualizar();
            $this->inserirControllerVizualizar();
            $this->criarMenuControllerVizualizar();
            $this->criarModelVizualizar();
            $this->criarArquivoWiewsVizualizar();
        }
    }

    private function inserirCategoria()
    {
        $Conta = $this->Dados[0]['conta'];

        $listarCategoria = new \App\adms\Models\helper\AdmsRead();
        $listarCategoria->fullRead("SELECT max(cod_cat) as cod FROM cx_categoria
        LIMIT :limit", "limit=1");
        $this->ResultadoCod = $listarCategoria->getResultado();
        foreach ($this->ResultadoCod as $c) {
            extract($c);
        }

        $listarCategoria = new \App\adms\Models\helper\AdmsRead();
        $listarCategoria->fullRead("SELECT categoria FROM cx_categoria
        WHERE categoria =:categoria
        LIMIT :limit", "limit=1&categoria=$Conta");
        $this->ResultadoC = $listarCategoria->getResultado();

        if (!$this->ResultadoC) {
            $this->DadosCat['created'] = date("Y-m-d H:i:s");
            $this->DadosCat['categoria'] = $Conta;
            $this->DadosCat['cod_cat'] = $cod + 1;
            $cadCategoria = new \App\adms\Models\helper\AdmsCreate;
            $cadCategoria->exeCreate("cx_categoria", $this->DadosCat);
        }
    }

    private function inserirDescricao()
    {
        $Conta = $this->Dados[0]['conta'];

        $listarCategoria = new \App\adms\Models\helper\AdmsRead();
        $listarCategoria->fullRead("SELECT categoria, id_cat FROM cx_categoria
        WHERE categoria =:categoria
        LIMIT :limit", "limit=1&categoria=$Conta");
        $this->ResultadoCat = $listarCategoria->getResultado();
        foreach ($this->ResultadoCat as $c) {
            extract($c);
        }

        $listarDescricao = new \App\adms\Models\helper\AdmsRead();
        $listarDescricao->fullRead("SELECT descricao FROM cx_descricao
        WHERE descricao =:descricao
        LIMIT :limit", "limit=1&descricao=$Conta");
        $this->ResultadoDes = $listarDescricao->getResultado();

        if (!$this->ResultadoDes and isset($id_cat)) {
            $this->DadosDes['created'] = date("Y-m-d H:i:s");
            $this->DadosDes['descricao'] = $Conta;
            $this->DadosDes['categoria_id'] = $id_cat;
            $cadDescricao = new \App\adms\Models\helper\AdmsCreate;
            $cadDescricao->exeCreate("cx_descricao", $this->DadosDes);
        }
    }

    private function inserirPaginaController()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']);
        $this->DadosPg['created'] = date("Y-m-d H:i:s");
        $this->DadosPg['nome_pagina'] = "Conta " . $Conta;
        $this->DadosPg['controller'] = "Conta" . $Conta;
        $this->DadosPg['menu_controller'] = "conta-$conta";
        $this->DadosPg['metodo'] = "listar";
        $this->DadosPg['menu_metodo'] = "listar";
        $this->DadosPg['obs'] = "Página para Listar Conta " . $Conta;;
        $this->DadosPg['lib_pub'] = 2;
        $this->DadosPg['adms_grps_pg_id'] = 1; // listar=1; Cadastrar=2; Editar=3; Apagar=4; Visualizar=5
        $this->DadosPg['adms_tps_pg_id'] = 5; // adms=1; cx=5
        $this->DadosPg['adms_sits_pg_id'] = 1; // Ativo=1; Inativo=2; Analise=3
        $this->DadosPg['icone'] = "fas fa-at"; // arroba (@)

        $listarNivAc = new \App\adms\Models\helper\AdmsRead();
        $listarNivAc->fullRead("SELECT * FROM adms_paginas
        WHERE controller =:controller
        LIMIT :limit", "limit=1&controller=Conta{$Conta}");
        $this->Resultado = $listarNivAc->getResultado();
        if (!$this->Resultado) {
            $cadNivAc = new \App\adms\Models\helper\AdmsCreate;
            $cadNivAc->exeCreate("adms_paginas", $this->DadosPg);
        }
    }

    private function criarMenuController()
    {
        $Conta = $this->Dados[0]['conta'];

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT id FROM adms_paginas
        WHERE controller =:controller
        LIMIT :limit", "limit=1&controller=Conta{$Conta}");
        $this->ResultadoAP = $listar->getResultado();
        foreach ($this->ResultadoAP as $p) {
            extract($p);
        }
        //var_dump($this->ResultadoAP);

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT max(ordem) as max_ordem FROM adms_nivacs_pgs
        LIMIT :limit", "limit=1");
        $this->Resultado = $listar->getResultado();
        foreach ($this->Resultado as $pg) {
            extract($pg);
        }

        $this->DadosMenu['created'] = date("Y-m-d H:i:s");
        $this->DadosMenu['permissao'] = 1;
        $this->DadosMenu['adms_niveis_acesso_id'] = 1;
        $this->DadosMenu['ordem'] = $max_ordem + 1;
        $this->DadosMenu['dropdown'] = 1;
        $this->DadosMenu['lib_menu'] = 1;
        $this->DadosMenu['adms_menu_id'] = 11;
        $this->DadosMenu['adms_pagina_id'] = $id;

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT adms_pagina_id FROM adms_nivacs_pgs
        WHERE adms_pagina_id =:adms_pagina_id
        LIMIT :limit", "limit=1&adms_pagina_id=$id");
        $this->Resultado = $listar->getResultado();

        if (!$this->Resultado) {
            $criarMenu = new \App\adms\Models\helper\AdmsCreate;
            $criarMenu->exeCreate("adms_nivacs_pgs", $this->DadosMenu);
        }
    }

    private function criarArquivoModel()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']);
        $prefixo = substr($conta, 0, 3);

        $listarDescricao = new \App\adms\Models\helper\AdmsRead();
        $listarDescricao->fullRead("SELECT id_des FROM cx_descricao
        WHERE descricao =:descricao
        LIMIT :limit", "limit=1&descricao=$Conta");
        $this->Resultado = $listarDescricao->getResultado();
        foreach ($this->Resultado as $des) {
            extract($des);
        }

        $conteudo = "<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header('Location: /');
    exit();
}
/**
 * Description of CxListarConta$Conta
 *
 * @copyright (c) year, Édio Mazera
 */
class CxListarConta$Conta
{

    private \$Resultado;
    private \$PageId;
    private \$LimiteResultado = 100;
    private \$ResultadoPg;

    function getResultadoPg()
    {
        return \$this->ResultadoPg;
    }

    public function listarConta$Conta(\$PageId = null, \$DadosAno = null, \$DadosMes = null)
    {
        \$this->PageId = (int) \$PageId;
        \$this->DadosAno = (int) \$DadosAno;
        \$this->DadosMes = (int) \$DadosMes;

        \$paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'conta-$conta/listar');
        \$paginacao->condicao(\$this->PageId, \$this->LimiteResultado);
        \$paginacao->paginacao(\"SELECT COUNT(id_$prefixo) AS num_result FROM cx_conta_$conta $prefixo
        INNER JOIN cx_mes m ON m.id_mes=$prefixo.mes_id\");
        \$this->ResultadoPg = \$paginacao->getResultado();

        \$listarConta = new \App\adms\Models\helper\AdmsRead();
        \$listarConta->fullRead(\"SELECT $prefixo.*, m.* FROM cx_conta_$conta $prefixo
        INNER JOIN cx_mes m ON m.id_mes=$prefixo.mes_id
        WHERE id_mes=:id_mes AND ano=:ano
        ORDER BY id_$prefixo ASC LIMIT :limit OFFSET :offset\", \"ano={\$this->DadosAno}&id_mes={\$this->DadosMes}&limit={\$this->LimiteResultado}&offset={\$paginacao->getOffset()}\");
        \$this->Resultado = \$listarConta->getResultado();
        return \$this->Resultado;
    }

    public function listarConta{$Conta}Full(\$PageId = null)
    {
        \$this->PageId = (int) \$PageId;

        \$paginacao = new \App\cx\Models\helper\CxPaginacao(URLADM . 'conta-$conta/listar');
        \$paginacao->condicao(\$this->PageId, \$this->LimiteResultado);
        \$paginacao->paginacao(\"SELECT COUNT(id_$prefixo) AS num_result FROM cx_conta_$conta $prefixo
        INNER JOIN cx_mes m ON m.id_mes=$prefixo.mes_id\");
        \$this->ResultadoPg = \$paginacao->getResultado();

        \$listarConta = new \App\adms\Models\helper\AdmsRead();
        \$listarConta->fullRead(\"SELECT $prefixo.*, m.* FROM cx_conta_$conta $prefixo
        INNER JOIN cx_mes m ON m.id_mes=$prefixo.mes_id
        ORDER BY id_$prefixo ASC LIMIT :limit OFFSET :offset\", \"limit={\$this->LimiteResultado}&offset={\$paginacao->getOffset()}\");
        \$this->Resultado = \$listarConta->getResultado();
        return \$this->Resultado;
    }

    public function pagar(\$DadosId = null, \$Pagar = null)
    {
        \$this->DadosId = (int) \$DadosId;
        \$this->Pagar = (int) \$Pagar;
        if (\$this->Pagar == 1) {
            \$this->Dados['modified'] = date('Y-m-d H:i:s');
            \$this->Dados['situacao'] = 1;
            \$upPagar = new \App\adms\Models\helper\AdmsUpdate();
            \$upPagar->exeUpdate(\"cx_conta_$conta\", \$this->Dados, \"WHERE id_$prefixo=:id_$prefixo\", \"id_$prefixo=\" . \$this->DadosId);
        }
        if (\$this->Pagar == 0) {
            \$this->Dados['modified'] = date('Y-m-d H:i:s');
            \$this->Dados['situacao'] = 0;
            \$upPagar = new \App\adms\Models\helper\AdmsUpdate();
            \$upPagar->exeUpdate(\"cx_conta_$conta\", \$this->Dados, \"WHERE id_$prefixo=:id_$prefixo\", \"id_$prefixo=\" . \$this->DadosId);
        }
    }

    public function atualizar(\$Valor = null, \$DadosAno = null, \$DadosMes = null)
    {
        \$this->Valor = (string) \$Valor;
        \$this->DadosMes = (string) \$DadosMes;
        \$this->DadosAno = (string) \$DadosAno;

        \$verConta = new \App\adms\Models\helper\AdmsRead();
        \$verConta->fullRead(\"SELECT * FROM cx_saida sai
        INNER JOIN cx_descricao dc ON dc.id_des=sai.descricao_id
        WHERE dc.descricao LIKE '%' :$prefixo '%' AND ano=:ano AND mes_id=:mes_id\", \"mes_id={\$this->DadosMes}&ano={\$this->DadosAno}&$prefixo=$Conta\");
        \$this->Resultado = \$verConta->getResultado();
        if (\$this->Resultado) {
            \$this->Dados['modified'] = date('Y-m-d H:i:s');
            \$this->Dados['valor'] = \$this->Valor;
            \$this->Dados['situacao'] = 1;
            \$id = \$this->Resultado[0]['id_sai'];
            \$upAtualizar = new \App\adms\Models\helper\AdmsUpdate();
            \$upAtualizar->exeUpdate(\"cx_saida\", \$this->Dados, \"WHERE id_sai=:id_sai\", \"id_sai={\$id}\");
        } else {
            \$this->Dados['created'] = date('Y-m-d H:i:s');
            \$this->Dados['ano'] = \$this->DadosAno;
            \$this->Dados['mes_id'] = \$this->DadosMes;
            \$this->Dados['valor'] = \$this->Valor;
            \$this->Dados['vencimento'] = \$this->DadosAno .'-' . \$this->DadosMes .'-01';
            \$this->Dados['situacao'] = 1;
            \$this->Dados['descricao_id'] = $id_des;
            \$this->Dados['codigo'] = '****';
            \$this->Dados['observacao'] = 'IMPORTADO DE CONTA $Conta';

            \$cadEntrada = new \App\adms\Models\helper\AdmsCreate;
            \$cadEntrada->exeCreate(\"cx_saida\", \$this->Dados);
        }
        //var_dump(\$this->Dados);
    }

    public function listarCadastrar()
    {
        \$listar = new \App\adms\Models\helper\AdmsRead();

        \$listar->fullRead(\"SELECT id_mes, mes FROM cx_mes ORDER BY id_mes ASC\");
        \$registro['mes'] = \$listar->getResultado();

        \$this->Resultado = [
            'mes' => \$registro['mes']
        ];

        return \$this->Resultado;
    }
}
";
        $arquivo = "CxListarConta" . $Conta . ".php";
        $file = "app/cx/Models/$arquivo";
        if (!file_exists($file)) {
            $fp = fopen($file, "w+");
            fwrite($fp, "$conteudo");
            fclose($fp);
            chmod($file, 0777);
        }
    }

    private function criarArquivoController()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']); // conta
        $prefixo = substr($conta, 0, 3); // con
        $Prefixo = substr($Conta, 0, 3); // Con
        $conteudo = "<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header(\"Location: /\");
    exit();
}

/**
 * Description of Conta$Conta
 *
 * @copyright (c) year, Édio Mazera
 */
class Conta$Conta
{

    private \$Dados;
    private \$PageId;

    public function listar(\$PageId = null)
    {
        \$this->PageId = (int) \$PageId ? \$PageId : 1;

        \$listarSelect = new \App\cx\Models\CxListarConta$Conta();
        \$this->Dados['select'] = \$listarSelect->listarCadastrar();

        \$botao = [
            'cad_$prefixo' => ['menu_controller' => 'cadastrar-conta-$conta', 'menu_metodo' => 'cad-conta'],
            'vis_$prefixo' => ['menu_controller' => 'ver-conta-$conta', 'menu_metodo' => 'ver-conta'],
            'edit_$prefixo' => ['menu_controller' => 'editar-conta-$conta', 'menu_metodo' => 'edit-conta'],
            'del_$prefixo' => ['menu_controller' => 'apagar-conta-$conta', 'menu_metodo' => 'apagar-conta']
        ];
        \$listarBotao = new \App\adms\Models\AdmsBotao();
        \$this->Dados['botao'] = \$listarBotao->valBotao(\$botao);

        \$listarMenu = new \App\adms\Models\AdmsMenu();
        \$this->Dados['menu'] = \$listarMenu->itemMenu();

        \$this->DadosMes = filter_input(INPUT_GET, \"mes\", FILTER_SANITIZE_NUMBER_INT);
        \$this->DadosAno = filter_input(INPUT_GET, \"ano\", FILTER_SANITIZE_NUMBER_INT);
        \$this->DadosAll = filter_input(INPUT_GET, \"all\", FILTER_SANITIZE_NUMBER_INT);
        if (!empty(\$this->DadosMes)) {
            \$listarConta = new \App\cx\Models\CxListarConta$Conta();
            \$this->Dados['list$Prefixo'] = \$listarConta->listarConta$Conta(\$this->PageId, \$this->DadosAno, \$this->DadosMes);
            \$this->Dados['paginacao'] = \$listarConta->getResultadoPg();
        } elseif (!empty(\$this->DadosAll)) {
            \$listarConta = new \App\cx\Models\CxListarConta$Conta();
            \$this->Dados['list$Prefixo'] = \$listarConta->listarConta{$Conta}Full(\$this->PageId);
            \$this->Dados['paginacao'] = \$listarConta->getResultadoPg();
        } else {
            \$listarConta = new \App\cx\Models\CxListarConta$Conta();
            \$this->Dados['list$Prefixo'] = \$listarConta->listarConta{$Conta}Full(\$this->PageId);
            \$this->Dados['paginacao'] = \$listarConta->getResultadoPg();
        }

        \$this->DadosId = filter_input(INPUT_GET, \"id\", FILTER_SANITIZE_NUMBER_INT);
        \$this->Pagar = filter_input(INPUT_GET, \"pg\", FILTER_SANITIZE_NUMBER_INT);
        if (isset(\$this->Pagar)) {
            \$Pagar = new \App\cx\Models\CxListarConta$Conta();
            \$Pagar->pagar(\$this->DadosId, \$this->Pagar);
            \$UrlDestino = URLADM . \"conta-$conta/listar?mes={\$this->DadosMes}\";
            header(\"Location: \$UrlDestino\");
        }

        \$this->Valor = filter_input(INPUT_GET, \"$prefixo\", FILTER_SANITIZE_STRING);
        \$this->DadosMes = filter_input(INPUT_GET, \"ms\", FILTER_SANITIZE_STRING);
        \$this->DadosAno = filter_input(INPUT_GET, \"an\", FILTER_SANITIZE_NUMBER_INT);
        if (isset(\$this->Valor)) {
            \$Atualizar = new \App\cx\Models\CxListarConta$Conta();
            \$this->Dados['value'] = \$Atualizar->atualizar(\$this->Valor, \$this->DadosAno, \$this->DadosMes);
            //\$UrlDestino = URLADM . \"conta-$conta/listar\";
            //header(\"Location: \$UrlDestino\");
        }

        \$carregarView = new \App\cx\core\ConfigView(\"cx/Views/extras/listarConta$Conta\", \$this->Dados);
        \$carregarView->renderizar();
    }
}
";
        $arquivo = "Conta" . $Conta . ".php";
        $file = "app/cx/Controllers/$arquivo";
        if (!file_exists($file)) {
            $fp = fopen($file, "w+");
            fwrite($fp, "$conteudo");
            fclose($fp);
            chmod($file, 0777);
        }
    }

    private function criarArquivoWiewsListar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']); // conta
        $prefixo = substr($conta, 0, 3);
        $Prefixo = substr($Conta, 0, 3);
        $conteudo = "<?php
if (!defined('URL')) {
    header(\"Location: /\");
    exit();
}
foreach (\$this->Dados['list$Prefixo'] as \$c) {
    extract(\$c);
}
?>
<div class=\"content p-1\">
    <div class=\"list-group-item\">
        <div class=\"d-flex\">
            <div class=\"mr-auto p-2\">
                <h2 class=\"display-4 titulo\">Conta $Conta</h2>
            </div>
            <div class=\"mr-auto p-2\">
                <form method=\"GET\" action=\"\">
                    <label>Ano</label>
                    <?php \$a = date('Y') - 1; ?>
                    <?php \$b = date('Y') ?>
                    <?php \$c = date('Y') + 1; ?>
                    <?php \$d = date('Y') + 2; ?>
                    <?php \$e = date('Y') + 3; ?>
                    <select name=\"ano\" id=\"ano\">
                        <?php
                        echo \"<option value='\$a'>\$a</option>\";
                        echo \"<option value='\$b' selected>\$b</option>\";
                        echo \"<option value='\$c'>\$c</option>\";
                        echo \"<option value='\$d'>\$d</option>\";
                        echo \"<option value='\$e'>\$e</option>\";
                        ?>
                    </select>
                    <label>Mês</label>
                    <select name=\"mes\" id=\"mes\">
                        <option>Selecione</option>
                        <?php
                        foreach (\$this->Dados['select']['mes'] as \$m) {
                            extract(\$m);
                            if (\$mes_id == \$id_mes) {
                                echo \"<option value='\$id_mes' selected>\$mes</option>\";
                            } else {
                                echo \"<option value='\$id_mes'>\$mes</option>\";
                            }
                        }
                        ?>
                    </select>
                    <input type=\"submit\" class=\"btn btn-warning btn-sm\" value=\"Enviar\">
                </form>
            </div>
            <div class=\"p-2\">
                <?php
                \$total_$conta = 0;
                foreach (\$this->Dados['list$Prefixo'] as \$c) {
                    extract(\$c);
                    if (\$situacao == 1) {
                        \$total_$conta += \$valor;
                    }
                }
                if (isset(\$ano)) {
                    echo \"<a href='\" . URLADM . \"conta-$conta/listar?ms=\$mes_id&an=\$ano&$prefixo=\$total_$conta' class='btn btn-outline-danger btn-sm'>Atualizar Conta $Conta</a> \";
                }
                ?>
            </div>
            <div class=\"p-2\">
                <?php
                echo \"<a href='\" . URLADM . \"conta-$conta/listar?all=1' class='btn btn-outline-primary btn-sm'>Listar Todos</a> \";
                ?>
            </div>
            <div class=\"p-2\">
                <?php
                if (\$this->Dados['botao']['cad_$prefixo']) {
                    echo \"<a href='\" . URLADM . \"cadastrar-conta-$conta/cad-conta' class='btn btn-outline-success btn-sm'>Cadastrar</a> \";
                }
                ?>
            </div>

        </div>
        <?php

        if (empty(\$this->Dados['list$Prefixo'])) {
        ?>
            <div class=\"alert alert-danger\" role=\"alert\">
                Nenhum Valor encontrado!
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>
        <?php
        }
        if (isset(\$_SESSION['msg'])) {
            echo \$_SESSION['msg'];
            unset(\$_SESSION['msg']);
        }
        ?>

        <div class=\"table-responsive\">
            <table class=\"table table-striped table-hover table-bordered table-sm\">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class=\"d-none d-sm-table-cell\">Valor</th>
                        <th class=\"d-none d-sm-table-cell\">Data</th>
                        <th class=\"d-none d-sm-table-cell\">Vencimento</th>
                        <th class=\"d-none d-sm-table-cell\" width=\"40%\">Observação</th>
                        <th class=\"d-none d-sm-table-cell text-center\">Situação</th>
                        <th class=\"text-center\">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach (\$this->Dados['list$Prefixo'] as \$c) {
                        extract(\$c);
                    ?>
                        <tr>
                            <th><?php echo \$id_$prefixo; ?></th>
                            <td><?php echo \$valor; ?></td>
                            <td><?php echo \$mes . '/' . \$ano; ?></td>
                            <td><?php echo date('d/M/Y', strtotime(\$vencimento)); ?></td>
                            <td><?php echo \$observacao; ?></td>
                            <td class=\"text-center\">
                                <?php
                                if (\$situacao == 1) {
                                    echo \"<a href='\" . URLADM . \"conta-$conta/listar?id=\$id_$prefixo&pg=0'><span class='badge badge-pill badge-success'>Pago</span></a>\";
                                } else {
                                    echo \"<a href='\" . URLADM . \"conta-$conta/listar?id=\$id_$prefixo&pg=1'><span class='badge badge-pill badge-danger'>A Pagar</span></a>\";
                                }
                                ?>
                            </td>
                            <td class=\"text-center\">
                                <span class=\"d-none d-md-block\">
                                    <?php
                                    if (\$this->Dados['botao']['vis_$prefixo']) {
                                        echo \"<a href='\" . URLADM . \"ver-conta-$conta/ver-conta/\$id_$prefixo' class='btn btn-outline-primary btn-sm'>Visualizar</a> \";
                                    }
                                    if (\$this->Dados['botao']['edit_$prefixo']) {
                                        echo \"<a href='\" . URLADM . \"editar-conta-$conta/edit-conta/\$id_$prefixo' class='btn btn-outline-warning btn-sm'>Editar</a> \";
                                    }
                                    if (\$this->Dados['botao']['del_$prefixo']) {
                                        echo \"<a href='\" . URLADM . \"apagar-conta-$conta/apagar-conta/\$id_$prefixo' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> \";
                                    }
                                    ?>
                                </span>
                                <div class=\"dropdown d-block d-md-none\">
                                    <button class=\"btn btn-primary dropdown-toggle btn-sm\" type=\"button\" id=\"acoesListar\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                        Ações
                                    </button>
                                    <div class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"acoesListar\">
                                        <?php
                                        if (\$this->Dados['botao']['vis_$prefixo']) {
                                            echo \"<a class='dropdown-item' href='\" . URLADM . \"ver-conta-$conta/ver-conta/\$id_$prefixo'>Visualizar</a>\";
                                        }
                                        if (\$this->Dados['botao']['edit_$prefixo']) {
                                            echo \"<a class='dropdown-item' href='\" . URLADM . \"editar-conta-$conta/edit-conta/\$id_$prefixo'>Editar</a>\";
                                        }
                                        if (\$this->Dados['botao']['del_$prefixo']) {
                                            echo \"<a class='dropdown-item' href='\" . URLADM . \"apagar-conta-$conta/apagar-conta/\$id_$prefixo' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>\";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <h3><?php if(isset(\$extenso)){echo 'Total: R$ ' . number_format(\$total_$conta, 2, ',', '.') .' (' . \$extenso . ')';} ?></h3>
            <?php
            echo \$this->Dados['paginacao'];
            ?>
        </div>
    </div>
</div>
";
        $arquivo = "listarConta" . $Conta . ".php";
        $file = "app/cx/Views/extras/$arquivo";
        if (!file_exists($file)) {
            $fp = fopen($file, "w+");
            fwrite($fp, "$conteudo");
            fclose($fp);
            chmod($file, 0777);
        }
    }

    private function criarControllerApagar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']); // conta
        $prefixo = substr($conta, 0, 3); // con
        $Prefixo = substr($Conta, 0, 3); // Con        
        $conteudo = "<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header(\"Location: /\");
    exit();
}

/**
 * Description of ApagarConta$Conta
 *
 * @copyright (c) year, Édio Mazera
 */
class ApagarConta$Conta
{

    private \$DadosId;

    public function apagarConta(\$DadosId = null)
    {
        \$this->DadosId = (int) \$DadosId;
        if (!empty(\$this->DadosId)) {
           \$apagarConta = new \App\cx\Models\CxApagarConta$Conta();
           \$apagarConta->apagarConta(\$this->DadosId);
        } else {
            \$_SESSION['msg'] = \"<div class='alert alert-danger'>Erro: Necessário selecionar um tipo de Conta!</div>\";
        }
        \$UrlDestino = URLADM . 'conta-$conta/listar';
        header(\"Location: \$UrlDestino\");
    }

}
";
        $arquivo = "ApagarConta" . $Conta . ".php";
        $file = "app/cx/Controllers/$arquivo";
        if (!file_exists($file)) {
            $fp = fopen($file, "w+");
            fwrite($fp, "$conteudo");
            fclose($fp);
            chmod($file, 0777);
        }
    }

    private function inserirControllerApagar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']);
        $this->DadosPg['created'] = date("Y-m-d H:i:s");
        $this->DadosPg['nome_pagina'] = "Apagar Conta " . $Conta;
        $this->DadosPg['controller'] = "ApagarConta" . $Conta;
        $this->DadosPg['menu_controller'] = "apagar-conta-$conta";
        $this->DadosPg['metodo'] = "apagarConta";
        $this->DadosPg['menu_metodo'] = "apagar-conta";
        $this->DadosPg['obs'] = "Página para Apagar Conta " . $Conta;;
        $this->DadosPg['lib_pub'] = 2;
        $this->DadosPg['adms_grps_pg_id'] = 4; // listar=1; Cadastrar=2; Editar=3; Apagar=4; Visualizar=5
        $this->DadosPg['adms_tps_pg_id'] = 5; // adms=1; cx=5
        $this->DadosPg['adms_sits_pg_id'] = 1; // Ativo=1; Inativo=2; Analise=3
        $this->DadosPg['icone'] = NULL; // arroba (@)

        $listarNivAc = new \App\adms\Models\helper\AdmsRead();
        $listarNivAc->fullRead("SELECT * FROM adms_paginas
        WHERE controller =:controller
        LIMIT :limit", "limit=1&controller=ApagarConta{$Conta}");
        $this->Resultado = $listarNivAc->getResultado();
        if (!$this->Resultado) {
            $cadNivAc = new \App\adms\Models\helper\AdmsCreate;
            $cadNivAc->exeCreate("adms_paginas", $this->DadosPg);
        }
    }

    private function criarMenuControllerApagar()
    {
        $Conta = $this->Dados[0]['conta'];

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT id FROM adms_paginas
        WHERE controller =:controller
        LIMIT :limit", "limit=1&controller=ApagarConta{$Conta}");
        $this->ResultadoAP = $listar->getResultado();
        foreach ($this->ResultadoAP as $p) {
            extract($p);
        }
        //var_dump($this->ResultadoAP);

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT max(ordem) as max_ordem FROM adms_nivacs_pgs
        LIMIT :limit", "limit=1");
        $this->Resultado = $listar->getResultado();
        foreach ($this->Resultado as $pg) {
            extract($pg);
        }

        $this->DadosMenu['created'] = date("Y-m-d H:i:s");
        $this->DadosMenu['permissao'] = 1;
        $this->DadosMenu['adms_niveis_acesso_id'] = 1;
        $this->DadosMenu['ordem'] = $max_ordem + 1;
        $this->DadosMenu['dropdown'] = 2;
        $this->DadosMenu['lib_menu'] = 2;
        $this->DadosMenu['adms_menu_id'] = 11;
        $this->DadosMenu['adms_pagina_id'] = $id;

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT adms_pagina_id FROM adms_nivacs_pgs
        WHERE adms_pagina_id =:adms_pagina_id
        LIMIT :limit", "limit=1&adms_pagina_id=$id");
        $this->Resultado = $listar->getResultado();

        if (!$this->Resultado) {
            $criarMenu = new \App\adms\Models\helper\AdmsCreate;
            $criarMenu->exeCreate("adms_nivacs_pgs", $this->DadosMenu);
        }
    }

    private function criarModelApagar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']);
        $prefixo = substr($conta, 0, 3);

        $conteudo = "<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header(\"Location: /\");
    exit();
}

/**
 * Description of CxApagarConta$Conta
 *
 * @copyright (c) year, Édio Mazera
 */
class CxApagarConta$Conta
{

    private \$DadosId;
    private \$Resultado;

    function getResultado()
    {
        return \$this->Resultado;
    }

    public function apagarConta(\$DadosId = null)
    {
        \$this->DadosId = (int) \$DadosId;

        \$apagarConta = new \App\adms\Models\helper\AdmsDelete();
        \$apagarConta->exeDelete(\"cx_conta_$conta\", \"WHERE id_$prefixo =:id_$prefixo\", \"id_$prefixo={\$this->DadosId}\");
        if (\$apagarConta->getResultado()) {
            \$_SESSION['msg'] = \"<div class='alert alert-success'>Conta apagada com sucesso!</div>\";
            \$this->Resultado = true;
        } else {
            \$_SESSION['msg'] = \"<div class='alert alert-danger'>Erro: Conta não foi apagada!!</div>\";
            \$this->Resultado = false;
        }
    }
}
";
        $arquivo = "CxApagarConta" . $Conta . ".php";
        $file = "app/cx/Models/$arquivo";
        if (!file_exists($file)) {
            $fp = fopen($file, "w+");
            fwrite($fp, "$conteudo");
            fclose($fp);
            chmod($file, 0777);
        }
    }
    // Cadastrar
    private function criarControllerCadastrar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']); // conta
        $prefixo = substr($conta, 0, 3); // con
        $Prefixo = substr($Conta, 0, 3); // Con        
        $conteudo = "<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header(\"Location: /\");
    exit();
}

/**
 * Description of CadastrarConta$Conta
 *
 * @copyright (c) year, Édio Mazera
 */
class CadastrarConta$Conta
{

    private \$Dados;

    public function cadConta()
    {
        \$this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty(\$this->Dados['Cad$Prefixo'])) {
            unset(\$this->Dados['Cad$Prefixo']);

            \$cadEnt = new \App\cx\Models\CxCadastrarConta$Conta();
            \$cadEnt->cadConta(\$this->Dados);
            if (\$cadEnt->getResultado()) {
                \$UrlDestino = URLADM . 'conta-$conta/listar';
                header(\"Location: \$UrlDestino\");
            } else {
                \$this->Dados['form'] = \$this->Dados;
                \$this->cad{$Prefixo}ViewPriv();
            }
        } else {
            \$this->cad{$Prefixo}ViewPriv();
        }
    }

    private function cad{$Prefixo}ViewPriv()
    {
        \$listarSelect = new \App\cx\Models\CxCadastrarConta$Conta();
        \$this->Dados['select'] = \$listarSelect->listarCadastrar();

        \$botao = ['list_$prefixo' => ['menu_controller' => 'conta-$conta', 'menu_metodo' => 'listar']];
        \$listarBotao = new \App\adms\Models\AdmsBotao();
        \$this->Dados['botao'] = \$listarBotao->valBotao(\$botao);

        \$listarMenu = new \App\adms\Models\AdmsMenu();
        \$this->Dados['menu'] = \$listarMenu->itemMenu();

        \$carregarView = new \App\cx\core\ConfigView(\"cx/Views/extras/cadConta$Conta\", \$this->Dados);
        \$carregarView->renderizar();
    }
}
";
        $arquivo = "CadastrarConta" . $Conta . ".php";
        $file = "app/cx/Controllers/$arquivo";
        if (!file_exists($file)) {
            $fp = fopen($file, "w+");
            fwrite($fp, "$conteudo");
            fclose($fp);
            chmod($file, 0777);
        }
    }

    private function inserirControllerCadastrar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']);
        $this->DadosPg['created'] = date("Y-m-d H:i:s");
        $this->DadosPg['nome_pagina'] = "Cadastrar Conta " . $Conta;
        $this->DadosPg['controller'] = "CadastrarConta" . $Conta;
        $this->DadosPg['menu_controller'] = "cadastrar-conta-$conta";
        $this->DadosPg['metodo'] = "cadConta";
        $this->DadosPg['menu_metodo'] = "cad-conta";
        $this->DadosPg['obs'] = "Página para Cadastrar Conta " . $Conta;;
        $this->DadosPg['lib_pub'] = 2;
        $this->DadosPg['adms_grps_pg_id'] = 2; // listar=1; Cadastrar=2; Editar=3; Apagar=4; Visualizar=5
        $this->DadosPg['adms_tps_pg_id'] = 5; // adms=1; cx=5
        $this->DadosPg['adms_sits_pg_id'] = 1; // Ativo=1; Inativo=2; Analise=3
        $this->DadosPg['icone'] = NULL; // arroba (@)

        $listarNivAc = new \App\adms\Models\helper\AdmsRead();
        $listarNivAc->fullRead("SELECT * FROM adms_paginas
        WHERE controller =:controller
        LIMIT :limit", "limit=1&controller=CadastrarConta{$Conta}");
        $this->Resultado = $listarNivAc->getResultado();
        if (!$this->Resultado) {
            $cadNivAc = new \App\adms\Models\helper\AdmsCreate;
            $cadNivAc->exeCreate("adms_paginas", $this->DadosPg);
        }
    }

    private function criarMenuControllerCadastrar()
    {
        $Conta = $this->Dados[0]['conta'];

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT id FROM adms_paginas
        WHERE controller =:controller
        LIMIT :limit", "limit=1&controller=CadastrarConta{$Conta}");
        $this->ResultadoAP = $listar->getResultado();
        foreach ($this->ResultadoAP as $p) {
            extract($p);
        }
        //var_dump($this->ResultadoAP);

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT max(ordem) as max_ordem FROM adms_nivacs_pgs
        LIMIT :limit", "limit=1");
        $this->Resultado = $listar->getResultado();
        foreach ($this->Resultado as $pg) {
            extract($pg);
        }

        $this->DadosMenu['created'] = date("Y-m-d H:i:s");
        $this->DadosMenu['permissao'] = 1;
        $this->DadosMenu['adms_niveis_acesso_id'] = 1;
        $this->DadosMenu['ordem'] = $max_ordem + 1;
        $this->DadosMenu['dropdown'] = 2;
        $this->DadosMenu['lib_menu'] = 2;
        $this->DadosMenu['adms_menu_id'] = 11;
        $this->DadosMenu['adms_pagina_id'] = $id;

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT adms_pagina_id FROM adms_nivacs_pgs
        WHERE adms_pagina_id =:adms_pagina_id
        LIMIT :limit", "limit=1&adms_pagina_id=$id");
        $this->Resultado = $listar->getResultado();

        if (!$this->Resultado) {
            $criarMenu = new \App\adms\Models\helper\AdmsCreate;
            $criarMenu->exeCreate("adms_nivacs_pgs", $this->DadosMenu);
        }
    }

    private function criarModelCadastrar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']);
        $prefixo = substr($conta, 0, 3);
        $conteudo = "<?php

        namespace App\cx\Models;
        
        if (!defined('URL')) {
            header(\"Location: /\");
            exit();
        }
        
        /**
         * Description of CxCadastrarConta$Conta
         *
         * @copyright (c) year, Édio Mazera
         */
        class CxCadastrarConta$Conta
        {
        
            private \$Resultado;
            private \$Dados;
            private \$VazioVencimento;
            private \$VazioCodigo;
            private \$VazioObs;
        
            function getResultado()
            {
                return \$this->Resultado;
            }
        
            public function cadConta(array \$Dados)
            {
                \$this->Dados = \$Dados;
        
                
                \$this->VazioCodigo = \$this->Dados['codigo'];
                unset(\$this->Dados['codigo']);
                \$this->VazioVencimento = \$this->Dados['vencimento'];
                unset(\$this->Dados['vencimento']);
                \$this->VazioObs = \$this->Dados['observacao'];
                unset(\$this->Dados['observacao']);
        
                \$valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
                \$valCampoVazio->validarDados(\$this->Dados);
        
                if (\$valCampoVazio->getResultado()) {
                    \$this->inserirConta();
                } else {
                    \$this->Resultado = false;
                }
            }
        
            private function inserirConta()
            {
                \$this->Dados['created'] = date(\"Y-m-d H:i:s\");
                \$this->Dados['ano'] = date(\"Y\");
                \$this->Dados['codigo'] = \$this->VazioCodigo;
                \$this->Dados['vencimento'] = \$this->VazioVencimento;
                \$this->Dados['observacao'] = \$this->VazioObs;
        
                \$cadConta = new \App\adms\Models\helper\AdmsCreate;
                \$cadConta->exeCreate(\"cx_conta_$conta\", \$this->Dados);
        
                if (\$cadConta->getResultado()) {
                    \$_SESSION['msg'] = \"<div class='alert alert-success'>Conta cadastrada com sucesso!</div>\";
                    \$this->Resultado = true;
                } else {
                    \$_SESSION['msg'] = \"<div class='alert alert-danger'>Erro: A Conta não foi cadastrada!!</div>\";
                    \$this->Resultado = false;
                }
            }
        
            public function listarCadastrar()
            {
                \$listar = new \App\adms\Models\helper\AdmsRead();
        
                \$listar->fullRead(\"SELECT id_mes, mes FROM cx_mes ORDER BY id_mes ASC\");
                \$registro['mes'] = \$listar->getResultado();
        
                \$this->Resultado = [
                    'mes' => \$registro['mes']
                ];
        
                return \$this->Resultado;
            }
        }
        ";
        $arquivo = "CxCadastrarConta" . $Conta . ".php";
        $file = "app/cx/Models/$arquivo";
        if (!file_exists($file)) {
            $fp = fopen($file, "w+");
            fwrite($fp, "$conteudo");
            fclose($fp);
            chmod($file, 0777);
        }
    }

    private function criarArquivoWiewsCadastrar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']); // conta
        $prefixo = substr($conta, 0, 3);
        $Prefixo = substr($Conta, 0, 3);
        $conteudo = "<?php
if (isset(\$this->Dados['form'])) {
    \$valorForm = \$this->Dados['form'];
}
if (isset(\$this->Dados['form'][0])) {
    \$valorForm = \$this->Dados['form'][0];
}
?>
<div class=\"content p-1\">
    <div class=\"list-group-item\">
        <div class=\"d-flex\">
            <div class=\"mr-auto p-2\">
                <h2 class=\"display-4 titulo\">Cadastrar Conta $Conta</h2>
            </div>
            <?php
            if (\$this->Dados['botao']['list_$prefixo']) {
            ?>
                <div class=\"p-2\">
                    <a href=\"<?php echo URLADM . 'conta-$conta/listar'; ?>\" class=\"btn btn-outline-info btn-sm\">Listar</a>
                </div>
            <?php
            }
            ?>
        </div>
        <hr>
        <?php
        if (isset(\$_SESSION['msg'])) {
            echo \$_SESSION['msg'];
            unset(\$_SESSION['msg']);
        }
        ?>
        <form method=\"POST\" action=\"\" enctype=\"multipart/form-data\">
            <div class=\"row\" style=\"background-color: #cfcfaf;\">
                <div class=\"col-md-4\">
                    <!-- Valor -->
                    <div class=\"form-group\">
                        <label><span class=\"text-danger\">*</span> Valor (R\$)</label>
                        <input name=\"valor\" type=\"number\" min=\"0\" step=\".01\" class=\"form-control\" value=\"<?php if (isset(\$valorForm['valor'])) {
                                                                                                                echo \$valorForm['valor'];
                                                                                                            } ?>\">
                    </div>
                </div>
                <div class=\"col-md-2\">
                    <!-- Mes -->
                    <div class=\"form-group\">
                        <label><span class=\"text-danger\">*</span> Mês</label>
                        <select name=\"mes_id\" id=\"mes\" class=\"form-control\">
                            <option>Selecione</option>
                            <?php
                            foreach (\$this->Dados['select']['mes'] as \$m) {
                                extract(\$m);
                                if (\$valorForm['mes_id'] == \$id_mes) {
                                    echo \"<option value='\$id_mes' selected>\$id_mes - \$mes</option>\";
                                } else {
                                    echo \"<option value='\$id_mes'>\$id_mes - \$mes</option>\";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class=\"col-md-2\">
                    <!-- Situação -->
                    <div class=\"form-group\">
                        <label>Situação</label>
                        <select name=\"situacao\" class=\"form-control\">
                            <option value=\"0\">0</option>
                            <option value=\"1\" selected>1</option>
                        </select>
                    </div>
                </div>
                <div class=\"col-md-4\">
                    <!-- Observações -->
                    <div class=\"form-group\">
                        <label>Observações</label>
                        <textarea name=\"observacao\" class=\"form-control\" rows=\"2\"><?php if (isset(\$valorForm['observacao'])) {
                                                                                        echo \$valorForm['observacao'];
                                                                                    } ?></textarea>
                    </div>
                </div>
            </div>
            <div class=\"row\" style=\"background-color: #afcfaf;\">
                <div class=\"col-md-4\">
                    <!-- Vencimento -->
                    <div class=\"form-group\">
                        <label>Vencimento</label>
                        <input name=\"vencimento\" type=\"date\" class=\"form-control\" value=\"<?php if (isset(\$valorForm['vencimento'])) {
                                                                                                echo \$valorForm['vencimento'];
                                                                                            } ?>\">
                    </div>
                </div>
                <div class=\"col-md-8\">
                    <!-- Codigo de Barras -->
                    <div class=\"form-group\">
                        <label>Código de Barras</label>
                        <input name=\"codigo\" type=\"text\" class=\"form-control\" placeholder=\"Código de barras\" value=\"<?php if (isset(\$valorForm['codigo'])) {
                                                                                                                        echo \$valorForm['codigo'];
                                                                                                                    } ?>\">
                    </div>
                </div>
            </div>
            <p>
                <span class=\"text-danger\">* </span>Campo obrigatório
            </p>
            <input name=\"Cad$Prefixo\" type=\"submit\" class=\"btn btn-warning\" value=\"Cadastrar\">
        </form>
    </div>
</div>
";
        $arquivo = "cadConta" . $Conta . ".php";
        $file = "app/cx/Views/extras/$arquivo";
        if (!file_exists($file)) {
            $fp = fopen($file, "w+");
            fwrite($fp, "$conteudo");
            fclose($fp);
            chmod($file, 0777);
        }
    }
    // Editar
    private function criarControllerEditar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']); // conta
        $prefixo = substr($conta, 0, 3); // con
        $Prefixo = substr($Conta, 0, 3); // Con        
        $conteudo = "<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header(\"Location: /\");
    exit();
}

/**
 * Description of EditarConta$Conta
 *
 * @copyright (c) year, Édio Mazera
 */
class EditarConta$Conta
{

    private \$Dados;
    private \$DadosId;

    public function editConta(\$DadosId = null)
    {
        \$this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        \$this->DadosId = (int) \$DadosId;
        if (!empty(\$this->DadosId)) {
            \$this->editContaPriv();
        } else {
            \$_SESSION['msg'] = \"<div class='alert alert-danger'>Erro: Conta não encontrada!</div>\";
            \$UrlDestino = URLADM . 'conta-$conta/listar';
            header(\"Location: \$UrlDestino\");
        }
    }

    private function editContaPriv()
    {
        if (!empty(\$this->Dados['Edit$Prefixo'])) {
            unset(\$this->Dados['Edit$Prefixo']);

            \$editarConta = new \App\cx\Models\CxEditarConta$Conta();
            \$editarConta->altConta(\$this->Dados);
            if (\$editarConta->getResultado()) {
                \$_SESSION['msg'] = \"<div class='alert alert-success'>Conta editada com sucesso!</div>\";
                \$UrlDestino = URLADM . 'ver-conta-$conta/ver-conta/' . \$this->Dados['id_$prefixo'];
                header(\"Location: \$UrlDestino\");
            } else {
                \$this->Dados['form'] = \$this->Dados;
                \$this->editContaViewPriv();
            }
        } else {
            \$verConta = new \App\cx\Models\CxEditarConta$Conta();
            \$this->Dados['form'] = \$verConta->verConta(\$this->DadosId);
            \$this->editContaViewPriv();
        }
    }

    private function editContaViewPriv()
    {
        if (\$this->Dados['form']) {

            \$listarSelect = new \App\cx\Models\CxCadastrarConta$Conta();
            \$this->Dados['select'] = \$listarSelect->listarCadastrar();

            \$botao = ['vis_$prefixo' => ['menu_controller' => 'ver-conta-$conta', 'menu_metodo' => 'ver-conta']];
            \$listarBotao = new \App\adms\Models\AdmsBotao();
            \$this->Dados['botao'] = \$listarBotao->valBotao(\$botao);

            \$listarMenu = new \App\adms\Models\AdmsMenu();
            \$this->Dados['menu'] = \$listarMenu->itemMenu();

            \$carregarView = new \App\cx\core\ConfigView(\"cx/Views/extras/editarConta$Conta\", \$this->Dados);
            \$carregarView->renderizar();
        } else {
            \$_SESSION['msg'] = \"<div class='alert alert-danger'>Erro: Conta não encontrada!</div>\";
            \$UrlDestino = URLADM . 'conta-$conta/listar';
            header(\"Location: \$UrlDestino\");
        }
    }
}
";
        $arquivo = "EditarConta" . $Conta . ".php";
        $file = "app/cx/Controllers/$arquivo";
        if (!file_exists($file)) {
            $fp = fopen($file, "w+");
            fwrite($fp, "$conteudo");
            fclose($fp);
            chmod($file, 0777);
        }
    }

    private function inserirControllerEditar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']);
        $this->DadosPg['created'] = date("Y-m-d H:i:s");
        $this->DadosPg['nome_pagina'] = "Editar Conta " . $Conta;
        $this->DadosPg['controller'] = "EditarConta" . $Conta;
        $this->DadosPg['menu_controller'] = "editar-conta-$conta";
        $this->DadosPg['metodo'] = "editConta";
        $this->DadosPg['menu_metodo'] = "edit-conta";
        $this->DadosPg['obs'] = "Página para Editar Conta " . $Conta;;
        $this->DadosPg['lib_pub'] = 2;
        $this->DadosPg['adms_grps_pg_id'] = 3; // listar=1; Cadastrar=2; Editar=3; Apagar=4; Visualizar=5
        $this->DadosPg['adms_tps_pg_id'] = 5; // adms=1; cx=5
        $this->DadosPg['adms_sits_pg_id'] = 1; // Ativo=1; Inativo=2; Analise=3
        $this->DadosPg['icone'] = NULL; // arroba (@)

        $listarNivAc = new \App\adms\Models\helper\AdmsRead();
        $listarNivAc->fullRead("SELECT * FROM adms_paginas
        WHERE controller =:controller
        LIMIT :limit", "limit=1&controller=EditarConta{$Conta}");
        $this->Resultado = $listarNivAc->getResultado();
        if (!$this->Resultado) {
            $cadNivAc = new \App\adms\Models\helper\AdmsCreate;
            $cadNivAc->exeCreate("adms_paginas", $this->DadosPg);
        }
    }

    private function criarMenuControllerEditar()
    {
        $Conta = $this->Dados[0]['conta'];

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT id FROM adms_paginas
        WHERE controller =:controller
        LIMIT :limit", "limit=1&controller=EditarConta{$Conta}");
        $this->ResultadoAP = $listar->getResultado();
        foreach ($this->ResultadoAP as $p) {
            extract($p);
        }
        //var_dump($this->ResultadoAP);

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT max(ordem) as max_ordem FROM adms_nivacs_pgs
        LIMIT :limit", "limit=1");
        $this->Resultado = $listar->getResultado();
        foreach ($this->Resultado as $pg) {
            extract($pg);
        }

        $this->DadosMenu['created'] = date("Y-m-d H:i:s");
        $this->DadosMenu['permissao'] = 1;
        $this->DadosMenu['adms_niveis_acesso_id'] = 1;
        $this->DadosMenu['ordem'] = $max_ordem + 1;
        $this->DadosMenu['dropdown'] = 2;
        $this->DadosMenu['lib_menu'] = 2;
        $this->DadosMenu['adms_menu_id'] = 11;
        $this->DadosMenu['adms_pagina_id'] = $id;

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT adms_pagina_id FROM adms_nivacs_pgs
        WHERE adms_pagina_id =:adms_pagina_id
        LIMIT :limit", "limit=1&adms_pagina_id=$id");
        $this->Resultado = $listar->getResultado();

        if (!$this->Resultado) {
            $criarMenu = new \App\adms\Models\helper\AdmsCreate;
            $criarMenu->exeCreate("adms_nivacs_pgs", $this->DadosMenu);
        }
    }

    private function criarModelEditar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']);
        $prefixo = substr($conta, 0, 3);
        $conteudo = "<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header(\"Location: /\");
    exit();
}

/**
 * Description of CxEditarConta$Conta
 *
 * @copyright (c) year, Édio Mazera
 */
class CxEditarConta$Conta
{

    private \$Resultado;
    private \$Dados;
    private \$DadosId;
    private \$VazioVencimento;
    private \$VazioCodigo;
    private \$VazioObs;

    function getResultado()
    {
        return \$this->Resultado;
    }

    public function verConta(\$DadosId)
    {
        \$this->DadosId = (int) \$DadosId;
        \$verConta = new \App\adms\Models\helper\AdmsRead();
        \$verConta->fullRead(\"SELECT * FROM cx_conta_$conta
                WHERE id_$prefixo =:id_$prefixo LIMIT :limit\", \"id_$prefixo=\" . \$this->DadosId . \"&limit=1\");
        \$this->Resultado = \$verConta->getResultado();
        return \$this->Resultado;
    }

    public function altConta(array \$Dados)
    {
        \$this->Dados = \$Dados;

        \$this->VazioCodigo = \$this->Dados['codigo'];
        unset(\$this->Dados['codigo']);
        \$this->VazioVencimento = \$this->Dados['vencimento'];
        unset(\$this->Dados['vencimento']);
        \$this->VazioObs = \$this->Dados['observacao'];
        unset(\$this->Dados['observacao']);

        \$valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        \$valCampoVazio->validarDados(\$this->Dados);

        if (\$valCampoVazio->getResultado()) {
            \$this->updateEditConta();
        } else {
            \$this->Resultado = false;
        }
    }

    private function updateEditConta()
    {
        \$this->Dados['modified'] = date(\"Y-m-d H:i:s\");
        \$this->Dados['ano'] = date(\"Y\");
        \$this->Dados['codigo'] = \$this->VazioCodigo;
        \$this->Dados['vencimento'] = \$this->VazioVencimento;
        \$this->Dados['observacao'] = \$this->VazioObs;

        \$upAltConta = new \App\adms\Models\helper\AdmsUpdate();
        \$upAltConta->exeUpdate(\"cx_conta_$conta\", \$this->Dados, \"WHERE id_$prefixo =:id_$prefixo\", \"id_$prefixo=\" . \$this->Dados['id_$prefixo']);
        if (\$upAltConta->getResultado()) {
            \$_SESSION['msg'] = \"<div class='alert alert-success'>Conta atualizada com sucesso!</div>\";
            \$this->Resultado = true;
        } else {
            \$_SESSION['msg'] = \"<div class='alert alert-danger'>Erro: A Conta não foi atualizada!</div>\";
            \$this->Resultado = false;
        }
    }

    public function listarCadastrar()
    {
        \$listar = new \App\adms\Models\helper\AdmsRead();

        \$listar->fullRead(\"SELECT id_mes, mes FROM cx_mes ORDER BY id_mes ASC\");
        \$registro['mes'] = \$listar->getResultado();

        \$this->Resultado = [
            'mes' => \$registro['mes']
        ];

        return \$this->Resultado;
    }
}
";
        $arquivo = "CxEditarConta" . $Conta . ".php";
        $file = "app/cx/Models/$arquivo";
        if (!file_exists($file)) {
            $fp = fopen($file, "w+");
            fwrite($fp, "$conteudo");
            fclose($fp);
            chmod($file, 0777);
        }
    }

    private function criarArquivoWiewsEditar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']); // conta
        $prefixo = substr($conta, 0, 3);
        $Prefixo = substr($Conta, 0, 3);
        $conteudo = "<?php
if (isset(\$this->Dados['form'])) {
    \$valorForm = \$this->Dados['form'];
}
if (isset(\$this->Dados['form'][0])) {
    \$valorForm = \$this->Dados['form'][0];
}
?>
<div class=\"content p-1\">
    <div class=\"list-group-item\">
        <div class=\"d-flex\">
            <div class=\"mr-auto p-2\">
                <h2 class=\"display-4 titulo\">Editar Conta $Conta</h2>
            </div>

            <?php
            if (\$this->Dados['botao']['vis_$prefixo']) {
            ?>
                <div class=\"p-2\">
                    <a href=\"<?php echo URLADM . 'ver-conta-$conta/ver-conta/' . \$valorForm['id_$prefixo']; ?>\" class=\"btn btn-outline-primary btn-sm\">Visualizar</a>
                </div>
            <?php
            }
            ?>

        </div>
        <hr>
        <?php
        if (isset(\$_SESSION['msg'])) {
            echo \$_SESSION['msg'];
            unset(\$_SESSION['msg']);
        }
        ?>
        <form method=\"POST\" action=\"\" enctype=\"multipart/form-data\">
            <input name=\"id_$prefixo\" type=\"hidden\" value=\"<?php
                                                        if (isset(\$valorForm['id_$prefixo'])) {
                                                            echo \$valorForm['id_$prefixo'];
                                                        }
                                                        ?>\">
            <div class=\"row\" style=\"background-color: #cccccc;\">
                <div class=\"col-md-4\">
                    <!-- Valor -->
                    <div class=\"form-group\">
                        <label><span class=\"text-danger\">*</span> Valor (R\$)</label>
                        <input name=\"valor\" type=\"number\" min=\"0\" step=\".01\" class=\"form-control\" value=\"<?php if (isset(\$valorForm['valor'])) {
                                                                                                                echo \$valorForm['valor'];
                                                                                                            } ?>\">
                    </div>
                </div>
                <div class=\"col-md-2\">
                    <!-- Mês -->
                    <div class=\"form-group\">
                        <label><span class=\"text-danger\">*</span> Mês</label>
                        <select name=\"mes_id\" id=\"mes\" class=\"form-control\">
                            <option>Selecione</option>
                            <?php
                            foreach (\$this->Dados['select']['mes'] as \$m) {
                                extract(\$m);
                                if (\$valorForm['mes_id'] == \$id_mes) {
                                    echo \"<option value='\$id_mes' selected>\$id_mes - \$mes</option>\";
                                } else {
                                    echo \"<option value='\$id_mes'>\$id_mes - \$mes</option>\";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class=\"col-md-2\">
                    <!-- Situação -->
                    <div class=\"form-group\">
                        <label>Situação</label>
                        <select name=\"situacao\" class=\"form-control\">
                            <option value=\"0\">0</option>
                            <option value=\"1\" selected>1</option>
                        </select>
                    </div>
                </div>
                <div class=\"col-md-4\">
                    <!-- Observações -->
                    <div class=\"form-group\">
                        <label>Observações</label>
                        <textarea name=\"observacao\" class=\"form-control\" rows=\"2\"><?php if (isset(\$valorForm['observacao'])) {
                                                                                        echo \$valorForm['observacao'];
                                                                                    } ?></textarea>
                    </div>
                </div>
            </div>
            <div class=\"row\" style=\"background-color: #accccc;\">
                <div class=\"col-md-4\">
                    <!-- Vencimento -->
                    <div class=\"form-group\">
                        <label>Vencimento</label>
                        <input name=\"vencimento\" type=\"date\" class=\"form-control\" value=\"<?php if (isset(\$valorForm['vencimento'])) {
                                                                                                echo \$valorForm['vencimento'];
                                                                                            } ?>\">
                    </div>
                </div>
                <div class=\"col-md-8\">
                    <!-- Codigo de Barras -->
                    <div class=\"form-group\">
                        <label>Código de Barras</label>
                        <input name=\"codigo\" type=\"text\" class=\"form-control\" placeholder=\"Código de baras\" value=\"<?php if (isset(\$valorForm['codigo'])) {
                                                                                                                        echo \$valorForm['codigo'];
                                                                                                                    } ?>\">
                    </div>
                </div>
            </div>
            <p>
                <span class=\"text-danger\">* </span>Campo obrigatório
            </p>
            <input name=\"Edit$Prefixo\" type=\"submit\" class=\"btn btn-warning\" value=\"Atualizar\">
        </form>
    </div>
</div>
";
        $arquivo = "editarConta" . $Conta . ".php";
        $file = "app/cx/Views/extras/$arquivo";
        if (!file_exists($file)) {
            $fp = fopen($file, "w+");
            fwrite($fp, "$conteudo");
            fclose($fp);
            chmod($file, 0777);
        }
    }
    // Vizualizar
    private function criarControllerVizualizar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']); // conta
        $prefixo = substr($conta, 0, 3); // con
        $Prefixo = substr($Conta, 0, 3); // Con        
        $conteudo = "<?php

namespace App\cx\Controllers;

if (!defined('URL')) {
    header(\"Location: /\");
    exit();
}

/**
 * Description of VerConta$Conta
 *
 * @copyright (c) year, Édio Mazera
 */
class VerConta$Conta
{

    private \$Dados;
    private \$DadosId;

    public function verConta(\$DadosId = null)
    {

        \$this->DadosId = (int) \$DadosId;
        
        if (!empty(\$this->DadosId)) {
            \$verConta = new \App\cx\Models\CxVerConta$Conta();
            \$this->Dados['dados_$prefixo'] = \$verConta->verConta(\$this->DadosId);

            \$botao = [
                'list_$prefixo' => ['menu_controller' => 'conta-$conta', 'menu_metodo' => 'listar'],
                'edit_$prefixo' => ['menu_controller' => 'editar-conta-$conta', 'menu_metodo' => 'edit-conta'],
                'del_$prefixo' => ['menu_controller' => 'apagar-conta-$conta', 'menu_metodo' => 'apagar-conta']
            ];
            \$listarBotao = new \App\adms\Models\AdmsBotao();
            \$this->Dados['botao'] = \$listarBotao->valBotao(\$botao);

            \$listarMenu = new \App\adms\Models\AdmsMenu();
            \$this->Dados['menu'] = \$listarMenu->itemMenu();

            \$carregarView = new \App\cx\core\ConfigView(\"cx/Views/extras/verConta$Conta\", \$this->Dados);
            \$carregarView->renderizar();
        } else {
            \$_SESSION['msg'] = \"<div class='alert alert-danger'>Erro: Conta$Conta não encontrada!</div>\";
            \$UrlDestino = URLADM . 'conta-$conta/listar';
            header(\"Location: \$UrlDestino\");
        }
    }
}
";
        $arquivo = "VerConta" . $Conta . ".php";
        $file = "app/cx/Controllers/$arquivo";
        if (!file_exists($file)) {
            $fp = fopen($file, "w+");
            fwrite($fp, "$conteudo");
            fclose($fp);
            chmod($file, 0777);
        }
    }

    private function inserirControllerVizualizar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']);
        $this->DadosPg['created'] = date("Y-m-d H:i:s");
        $this->DadosPg['nome_pagina'] = "Ver Conta " . $Conta;
        $this->DadosPg['controller'] = "VerConta" . $Conta;
        $this->DadosPg['menu_controller'] = "ver-conta-$conta";
        $this->DadosPg['metodo'] = "verConta";
        $this->DadosPg['menu_metodo'] = "ver-conta";
        $this->DadosPg['obs'] = "Página para Vizualizar Conta " . $Conta;;
        $this->DadosPg['lib_pub'] = 2;
        $this->DadosPg['adms_grps_pg_id'] = 5; // listar=1; Cadastrar=2; Editar=3; Apagar=4; Visualizar=5
        $this->DadosPg['adms_tps_pg_id'] = 5; // adms=1; cx=5
        $this->DadosPg['adms_sits_pg_id'] = 1; // Ativo=1; Inativo=2; Analise=3
        $this->DadosPg['icone'] = NULL; // arroba (@)

        $listarNivAc = new \App\adms\Models\helper\AdmsRead();
        $listarNivAc->fullRead("SELECT * FROM adms_paginas
        WHERE controller =:controller
        LIMIT :limit", "limit=1&controller=VerConta{$Conta}");
        $this->Resultado = $listarNivAc->getResultado();
        if (!$this->Resultado) {
            $cadNivAc = new \App\adms\Models\helper\AdmsCreate;
            $cadNivAc->exeCreate("adms_paginas", $this->DadosPg);
        }
    }

    private function criarMenuControllerVizualizar()
    {
        $Conta = $this->Dados[0]['conta'];

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT id FROM adms_paginas
        WHERE controller =:controller
        LIMIT :limit", "limit=1&controller=VerConta{$Conta}");
        $this->ResultadoAP = $listar->getResultado();
        foreach ($this->ResultadoAP as $p) {
            extract($p);
        }
        //var_dump($this->ResultadoAP);

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT max(ordem) as max_ordem FROM adms_nivacs_pgs
        LIMIT :limit", "limit=1");
        $this->Resultado = $listar->getResultado();
        foreach ($this->Resultado as $pg) {
            extract($pg);
        }

        $this->DadosMenu['created'] = date("Y-m-d H:i:s");
        $this->DadosMenu['permissao'] = 1;
        $this->DadosMenu['adms_niveis_acesso_id'] = 1;
        $this->DadosMenu['ordem'] = $max_ordem + 1;
        $this->DadosMenu['dropdown'] = 2;
        $this->DadosMenu['lib_menu'] = 2;
        $this->DadosMenu['adms_menu_id'] = 11;
        $this->DadosMenu['adms_pagina_id'] = $id;

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT adms_pagina_id FROM adms_nivacs_pgs
        WHERE adms_pagina_id =:adms_pagina_id
        LIMIT :limit", "limit=1&adms_pagina_id=$id");
        $this->Resultado = $listar->getResultado();

        if (!$this->Resultado) {
            $criarMenu = new \App\adms\Models\helper\AdmsCreate;
            $criarMenu->exeCreate("adms_nivacs_pgs", $this->DadosMenu);
        }
    }

    private function criarModelVizualizar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']);
        $prefixo = substr($conta, 0, 3);
        $conteudo = "<?php

namespace App\cx\Models;

if (!defined('URL')) {
    header(\"Location: /\");
    exit();
}

/**
 * Description of CxVerConta$Conta
 *
 * @copyright (c) year, Édio Mazera
 */
class CxVerConta$Conta
{

    private \$Resultado;
    private \$DadosId;

    public function verConta(\$DadosId)
    {
        \$this->DadosId = (int) \$DadosId;
        \$verConta = new \App\adms\Models\helper\AdmsRead();
        \$verConta->fullRead(\"SELECT $prefixo.*, m.mes, m.id_mes FROM cx_conta_$conta $prefixo
        INNER JOIN cx_mes m ON m.id_mes=$prefixo.mes_id
        WHERE id_$prefixo =:id_$prefixo LIMIT :limit\", \"id_$prefixo=\" . \$this->DadosId . \"&limit=1\");
        \$this->Resultado = \$verConta->getResultado();
        return \$this->Resultado;
    }
}
";
        $arquivo = "CxVerConta" . $Conta . ".php";
        $file = "app/cx/Models/$arquivo";
        if (!file_exists($file)) {
            $fp = fopen($file, "w+");
            fwrite($fp, "$conteudo");
            fclose($fp);
            chmod($file, 0777);
        }
    }

    private function criarArquivoWiewsVizualizar()
    {
        $Conta = $this->Dados[0]['conta'];
        $conta = strtolower($this->Dados[0]['conta']); // conta
        $prefixo = substr($conta, 0, 3);
        $Prefixo = substr($Conta, 0, 3);
        $conteudo = "<?php
if (!defined('URL')) {
    header(\"Location: /\");
    exit();
}

if (!empty(\$this->Dados['dados_$prefixo'][0])) {
    extract(\$this->Dados['dados_$prefixo'][0]);
    ?>
    <div class=\"content p-1\">
        <div class=\"list-group-item\">
            <div class=\"d-flex\">
                <div class=\"mr-auto p-2\">
                    <h2 class=\"display-4 titulo\">Conta $Conta</h2>
                </div>
                <div class=\"p-2\">
                    <span class=\"d-none d-md-block\">
                        <?php
                        if (\$this->Dados['botao']['list_$prefixo']) {
                            echo \"<a href='\" . URLADM . \"conta-$conta/listar' class='btn btn-outline-info btn-sm'>Listar</a> \";
                        }
                        if (\$this->Dados['botao']['edit_$prefixo']) {
                            echo \"<a href='\" . URLADM . \"editar-conta-$conta/edit-conta/\$id_$prefixo' class='btn btn-outline-warning btn-sm'>Editar</a> \";
                        }
                        if (\$this->Dados['botao']['del_$prefixo']) {
                            echo \"<a href='\" . URLADM . \"apagar-conta-$conta/apagar-conta/\$id_$prefixo' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> \";
                        }
                        ?>
                    </span>
                    <div class=\"dropdown d-block d-md-none\">
                        <button class=\"btn btn-primary dropdown-toggle btn-sm\" type=\"button\" id=\"acoesListar\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                            Ações
                        </button>
                        <div class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"acoesListar\"> 
                            <?php
                            if (\$this->Dados['botao']['list_$prefixo']) {
                                echo \"<a class='dropdown-item' href='\" . URLADM . \"conta-$conta/listar'>Listar</a>\";
                            }
                            if (\$this->Dados['botao']['edit_$prefixo']) {
                                echo \"<a class='dropdown-item' href='\" . URLADM . \"editar-conta-$conta/edit-conta/\$id_$prefixo'>Editar</a>\";
                            }
                            if (\$this->Dados['botao']['del_$prefixo']) {
                                echo \"<a class='dropdown-item' href='\" . URLADM . \"apagar-conta-$conta/apagar-conta/\$id_$prefixo' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>\";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div><hr>
            <?php
            if (isset(\$_SESSION['msg'])) {
                echo \$_SESSION['msg'];
                unset(\$_SESSION['msg']);
            }
            ?>
            <dl class=\"row\" style=\"background-color: #fcfccc;\">

                <dt class=\"col-sm-3\">ID</dt>
                <dd class=\"col-sm-9\"><?php echo \$id_$prefixo; ?></dd>

                <dt class=\"col-sm-3\">Observações</dt>
                <dd class=\"col-sm-9\"><?php echo \$observacao; ?></dd>

                <dt class=\"col-sm-3\">Valor</dt>
                <dd class=\"col-sm-9\"><?php echo \$valor; ?></dd>

                <dt class=\"col-sm-3\">Vencimento</dt>
                <dd class=\"col-sm-9\"><?php echo date('d/M/Y', strtotime(\$vencimento)); ?></dd>

                <dt class=\"col-sm-3\">Mês</dt>
                <dd class=\"col-sm-9\"><?php echo \$mes .'/'. \$ano; ?></dd>

                <dt class=\"col-sm-3\">Código</dt>
                <dd class=\"col-sm-9\"><?php 
                if(!empty(\$codigo)){echo \$codigo;}else{echo \"****************\";};
                ?></dd>

                <dt class=\"col-sm-3\">Situação</dt>
                <dd class=\"col-sm-9\"><?php
                if(\$situacao == 1){echo \"<span class='text-primary'>PAGO </span>\";}else{echo \"<span class='text-danger'>À PAGAR</span>\";}
                ?></dd>

                <dt class=\"col-sm-3\">Inserido</dt>
                <dd class=\"col-sm-9\"><?php echo date('d/m/Y H:i:s', strtotime(\$created)); ?></dd>

                <dt class=\"col-sm-3\">Alterado</dt>
                <dd class=\"col-sm-9\"><?php
                    if (!empty(\$modified)) {
                        echo date('d/m/Y H:i:s', strtotime(\$modified));
                    }
                    ?>
                </dd>
            </dl>


        </div>
    </div>
    <?php
} else {
    \$_SESSION['msg'] = \"<div class='alert alert-danger'>Erro: Conta não encontrada!</div>\";
    \$UrlDestino = URLADM . 'conta-$conta/listar';
    header(\"Location: \$UrlDestino\");
}
";
        $arquivo = "verConta" . $Conta . ".php";
        $file = "app/cx/Views/extras/$arquivo";
        if (!file_exists($file)) {
            $fp = fopen($file, "w+");
            fwrite($fp, "$conteudo");
            fclose($fp);
            chmod($file, 0777);
        }
    }
}
