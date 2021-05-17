<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Listar Escola</h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->Dados['botao']['cad_escola']) {
                    echo "<a href='" . URLADM . "cadastrar-escola/cad-escola' class='btn btn-outline-success btn-sm'>Cadastrar</a> ";
                }
                ?>                
            </div>

        </div>
        <?php
        if (empty($this->Dados['dadosEscola'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma escola encontrada!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered table-sm">
                <thead>
                    <tr>
                        <th width="2%">ID</th>
                        <th class="d-none d-sm-table-cell" width="30%">Escola</th>
                        <th class="d-none d-sm-table-cell" width="30%">Horário</th>
                        <th class="d-none d-sm-table-cell">Logo</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['contEscola'] as $ct) {
                        extract($ct);
                    }
                    foreach ($this->Dados['dadosEscola'] as $es) {
                        extract($es);
                        ?>
                        <tr>
                            <td><?php echo $id_escola; ?></td>
                            <td><?php echo '<b class="text-info">' . $nome_escola . ' - ' . $sigla_escola . ' </b>- <b>INEP:</b> ' . $inep?></td>
                            <td><?php echo '<b>Horário:</b> ' . $horario_escola; ?></td>
                            <td><?php
                                if (!empty($logo_escola)) {
                                    echo "<img src='" . URLADM . "app/bib/assets/imagens/escola/" . $id_escola . "/" . $logo_escola . "' witdh='120' height='120'>";
                                } else {
                                    echo "<img src='" . URLADM . "app/bib/assets/imagens/escola/logo_escola.png' witdh='120' height='120'>";
                                }
                                ?></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['vis_escola']) {
                                        echo "<a href='" . URLADM . "ver-escola/ver-escola/$id_escola' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['edit_escola']) {
                                        echo "<a href='" . URLADM . "editar-escola/edit-escola/$id_escola' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($num_escola > 1) {
                                        if ($this->Dados['botao']['del_escola']) {
                                            echo "<a href='" . URLADM . "apagar-escola/apagar-escola/$id_escola' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                        }
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['vis_escola']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "ver-escola/ver-escola/$id_escola'>Visualizar</a>";
                                        }
                                        if ($this->Dados['botao']['edit_escola']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-escola/edit-escola/$id_escola'>Editar</a>";
                                        }
                                        if ($num_escola > 1) {
                                            if ($this->Dados['botao']['del_escola']) {
                                                echo "<a class='dropdown-item' href='" . URLADM . "apagar-escola/apagar-escola/$id_escola' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
                                            }
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
            <?php
            echo $this->Dados['paginacao'];
            ?>
        </div>
    </div>
</div>
