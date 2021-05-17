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
                <h2 class="display-4 titulo">Listar Editoras</h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->Dados['botao']['cad_edi']) {
                    echo "<a href='" . URLADM . "cadastrar-editora/cad-editora' class='btn btn-outline-success btn-sm'>Cadastrar</a> ";
                }
                ?>                
            </div>

        </div>
        <?php
        if (empty($this->Dados['listEd'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma editora encontrada!
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
                        <th class="d-none d-sm-table-cell">Editora</th>
                        <th class="d-none d-sm-table-cell">Endereço</th>
                        <th class="d-none d-sm-table-cell">Logo</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listEd'] as $ed) {
                        extract($ed);
                        ?>
                        <tr>
                            <th><?php echo $ed_id; ?></th>
                            <td><?php echo $editora; ?></td>
                            <td><?php echo $nome_uf . ' (' .$uf .') - '. $nome_pais . ' (' .$sigla . ')'; ?></td>
                            <td><?php
                                if (!empty($logo_imagem)) {
                                    echo "<img src='" . URLADM . "app/bib/assets/imagens/editora/" . $ed_id . "/" . $logo_imagem . "' witdh='30' height='30'>";
                                } else {
                                    echo "<img src='" . URLADM . "app/bib/assets/imagens/editora/logo_editora.png' witdh='30' height='30'>";
                                }
                                ?></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['vis_edi']) {
                                        echo "<a href='" . URLADM . "ver-editora/ver-editora/$ed_id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['edit_edi']) {
                                        echo "<a href='" . URLADM . "editar-editora/edit-editora/$ed_id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_edi']) {
                                        echo "<a href='" . URLADM . "apagar-editora/apagar-editora/$ed_id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['vis_edi']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "ver-editora/ver-editora/$ed_id'>Visualizar</a>";
                                        }
                                        if ($this->Dados['botao']['edit_edi']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-editora/edit-editora/$ed_id'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_edi']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-editora/apagar-editora/$ed_id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
