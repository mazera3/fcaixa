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
        $conta = strtolower(trim($this->Dados[0]['conta']));
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
            //$this->Resultado = true;
            $this->inserirCatDes();
            $this->inserirPaginaControllers();
            $this->criarArquivoModel();
            $this->criarArquivoController();
            $this->criarArquivoWiews();
        }
    }

    private function inserirCatDes()
    {
        $Conta = ucwords(trim($this->Dados[0]['conta']));
        $this->DadosCat['created'] = date("Y-m-d H:i:s");
        $this->DadosCat['categoria'] = $Conta;
        $cadCategoria = new \App\adms\Models\helper\AdmsCreate;
        $cadCategoria->exeCreate("cx_categoria", $this->DadosCat);

        $listarCategoria = new \App\adms\Models\helper\AdmsRead();
        $listarCategoria->fullRead("SELECT id_cat FROM cx_categoria
        WHERE categoria LIKE '%' :categoria '%'
        LIMIT :limit", "limit=1&categoria=$Conta");
        $this->Resultado = $listarCategoria->getResultado();
        foreach ($this->Resultado as $cat) {
            extract($cat);
        }

        $this->DadosDes['created'] = date("Y-m-d H:i:s");
        $this->DadosDes['descricao'] = $Conta;
        $this->DadosDes['categoria_id'] = $id_cat;
        $cadDescricao = new \App\adms\Models\helper\AdmsCreate;
        $cadDescricao->exeCreate("cx_descricao", $this->DadosDes);
    }

    private function inserirPaginaControllers()
    {
        $Conta = ucwords(trim($this->Dados[0]['conta']));
        $conta = strtolower(trim($this->Dados[0]['conta']));
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

        $cadNivAc = new \App\adms\Models\helper\AdmsCreate;
        $cadNivAc->exeCreate("adms_paginas", $this->DadosPg);

        $this->criarMenuController();
    }

    private function criarMenuController()
    {
        $Conta = ucwords(trim($this->Dados[0]['conta']));

        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT max(adms_pagina_id) as pg_id FROM adms_nivacs_pgs
        LIMIT :limit", "limit=1");
        $this->Resultado = $listar->getResultado();
        foreach ($this->Resultado as $pg) {
            extract($pg);
        }
        //var_dump($this->Resultado);
        $this->DadosMenu['modified'] = date("Y-m-d H:i:s");
        $this->DadosMenu['dropdown'] = 1;
        $this->DadosMenu['lib_menu'] = 1;
        $this->DadosMenu['adms_menu_id'] = 11;

        $upMenu = new \App\adms\Models\helper\AdmsUpdate();
        $upMenu->exeUpdate("adms_nivacs_pgs", $this->DadosMenu, "WHERE adms_pagina_id =:adms_pagina_id", "adms_pagina_id=" . $pg_id);
    }

    private function criarArquivoModel()
    {
        $Conta = ucwords(trim($this->Dados[0]['conta'])); // Conta
        $conta = strtolower(trim($this->Dados[0]['conta'])); // conta
        $prefixo = substr($conta, 0, 3);

        $listarDescricao = new \App\adms\Models\helper\AdmsRead();
        $listarDescricao->fullRead("SELECT id_des FROM cx_descricao
        WHERE descricao LIKE '%' :descricao '%'
        LIMIT :limit", "limit=1&descricao=$Conta");
        $this->Resultado = $listarDescricao->getResultado();
        foreach ($this->Resultado as $des) {
            extract($des);
            $id_descricao = $id_des;
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
        WHERE dc.descricao LIKE '%' :$prefixo '%' AND ano=:ano AND mes_id=:mes_id\", \"mes_id={\$this->DadosMes}&ano={\$this->DadosAno}&$prefixo=$conta\");
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
            \$this->Dados['descricao_id'] = $id_descricao;
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
        $fp = fopen($file, "w+");
        fwrite($fp, "$conteudo");
        fclose($fp);
        chmod($file, 0777);
    }

    private function criarArquivoController()
    {
        $Conta = ucwords(trim($this->Dados[0]['conta'])); // Conta
        $conta = strtolower(trim($this->Dados[0]['conta'])); // conta
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
        $fp = fopen($file, "w+");
        fwrite($fp, "$conteudo");
        fclose($fp);
        chmod($file, 0777);
    }

    private function criarArquivoWiews()
    {
        $Conta = ucwords(trim($this->Dados[0]['conta'])); // Conta
        $conta = strtolower(trim($this->Dados[0]['conta'])); // conta
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
                    echo \"<a href='\" . URLADM . \"conta-$conta/listar?ms=\$mes_id&an=\$ano&$prefixo=\$total_$conta' class='btn btn-outline-danger btn-sm'>Atualizar Conta Mercado</a> \";
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
                Nenhuma Saida encontrada!
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
        $fp = fopen($file, "w+");
        fwrite($fp, "$conteudo");
        fclose($fp);
        chmod($file, 0777);
    }
}
