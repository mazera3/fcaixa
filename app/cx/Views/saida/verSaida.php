<?php
namespace App\cx\Views;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
use function base64_encode;
use Picqer\Barcode\BarcodeGeneratorPNG;

if (!empty($this->Dados['dados_sai'][0])) {
    extract($this->Dados['dados_sai'][0]);
    ?>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Ver Saidas</h2>
                </div>
                <div class="p-2">
                    <span class="d-none d-md-block">
                        <?php
                        if ($this->Dados['botao']['list_sai']) {
                            echo "<a href='" . URLADM . "saida/listar' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->Dados['botao']['edit_sai']) {
                            echo "<a href='" . URLADM . "editar-saida/edit-saida/$id_sai' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                        }
                        if ($this->Dados['botao']['del_sai']) {
                            echo "<a href='" . URLADM . "apagar-saida/apagar-saida/$id_sai' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                        }
                        ?>
                    </span>
                    <div class="dropdown d-block d-md-none">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar"> 
                            <?php
                            if ($this->Dados['botao']['list_sai']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "saida/listar'>Listar</a>";
                            }
                            if ($this->Dados['botao']['edit_sai']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "editar-saida/edit-saida/$id_sai'>Editar</a>";
                            }
                            if ($this->Dados['botao']['del_sai']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "apagar-saida/apagar-saida/$id_sai' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div><hr>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <dl class="row" style="background-color: #fcfccc;">
            

                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $id_sai; ?></dd>

                <dt class="col-sm-3">Descrição</dt>
                <dd class="col-sm-9"><?php echo $descricao; ?></dd>

                <dt class="col-sm-3">Categoria</dt>
                <dd class="col-sm-9"><?php echo $categoria; ?></dd>

                <dt class="col-sm-3">Valor</dt>
                <dd class="col-sm-9"><?php echo $valor; ?></dd>

                <dt class="col-sm-3">Vencimento</dt>
                <dd class="col-sm-9"><?php if (!empty($vencimento)) {
                        echo date('d/M/Y', strtotime($vencimento));
                    } ?></dd>

                <dt class="col-sm-3">Mês</dt>
                <dd class="col-sm-9"><?php echo $mes .'/'. $ano; ?></dd>

                <dt class="col-sm-3">Código</dt>
                <dd class="col-sm-9"><?php 
                $generator = new BarcodeGeneratorPNG();
                if(!empty($codigo)){
                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($codigo, $generator::TYPE_INTERLEAVED_2_5)) . '">';
                echo '<br/>' . $codigo;
                }else{echo "****************";};
                ?></dd>

                <dt class="col-sm-3">Situação</dt>
                <dd class="col-sm-9"><?php
                if($situacao == 1){echo "<span class='text-primary'>PAGO </span>";}else{echo "<span class='text-danger'>À PAGAR</span>";}
                ?></dd>

                <dt class="col-sm-3">Observações</dt>
                <dd class="col-sm-9"><?php echo $observacao; ?></dd>

                <dt class="col-sm-3">Inserido</dt>
                <dd class="col-sm-9"><?php echo date('d/m/Y H:i:s', strtotime($created)); ?></dd>

                <dt class="col-sm-3">Alterado</dt>
                <dd class="col-sm-9"><?php
                    if (!empty($modified)) {
                        echo date('d/m/Y H:i:s', strtotime($modified));
                    }
                    ?>
                </dd>
            </dl>


        </div>
    </div>
    <?php
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Saida não encontrada!</div>";
    $UrlDestino = URLADM . 'saida/listar';
    header("Location: $UrlDestino");
}
    