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
                <h2 class="display-4 titulo">Listar Pais</h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->Dados['botao']['cad_pais']) {
                    echo "<a href='" . URLADM . "cadastrar-pais/cad-pais' class='btn btn-outline-success btn-sm'>Cadastrar</a> ";
                }
                ?>                
            </div>

        </div>
        <?php
        if (empty($this->Dados['listPais'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum pais encontrado!
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
                        <th>ID</th>
                        <th class="d-none d-sm-table-cell">Pais</th>
                        <th class="d-none d-sm-table-cell">Bandeira</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listPais'] as $p) {
                        extract($p);
                        ?>
                        <tr>
                            <th><?php echo $pais_id; ?></th>
                            <td><?php echo $nome_pais . ', ' .$sigla; ?></td>
                            <td><?php
                                if (!empty($bandeira)) {
                                    echo "<img src='" . URLADM . "app/bib/assets/imagens/pais/" . $pais_id . "/" . $bandeira . "' witdh='40' height='30'>";
                                } else {
                                    echo "<img src='" . URLADM . "app/bib/assets/imagens/pais/bandeira.png' witdh='40' height='30'>";
                                }
                                ?></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['vis_pais']) {
                                        echo "<a href='" . URLADM . "ver-pais/ver-pais/$pais_id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['edit_pais']) {
                                        echo "<a href='" . URLADM . "editar-pais/edit-pais/$pais_id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_pais']) {
                                        echo "<a href='" . URLADM . "apagar-pais/apagar-pais/$pais_id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['vis_pais']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "ver-pais/ver-pais/$pais_id'>Visualizar</a>";
                                        }
                                        if ($this->Dados['botao']['edit_pais']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-pais/edit-pais/$pais_id'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_pais']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-pais/apagar-pais/$pais_id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
