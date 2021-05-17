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
                <h2 class="display-4 titulo">Listar Todas as Situações</h2>
            </div>
        </div>
        <?php
        if (empty($this->Dados['listStBiblio']) AND empty($this->Dados['listStCopia']) AND empty($this->Dados['listStLeitor'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma situação encontrada!
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
            <!-- Situação das bibliografias -->
            <table class="table table-striped table-hover table-bordered table-sm">
                <thead>
                    <tr class="bg-secondary">
                        <th width = 5%;>ID</th>
                        <th class="d-none d-sm-table-cell" width = 50%;>Situação da Bibliografia</th>
                        <th class="d-none d-sm-table-cell">Cor (id)</th>
                        <th class="text-center"><?php
                            if ($this->Dados['botao']['cad_sits_biblio']) {
                                echo "<a href='" . URLADM . "cadastrar-st-biblio/cad-st-biblio' class='btn btn-success btn-sm'>Cadastrar</a> ";
                            }
                            ?> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listStBiblio'] as $stb) {
                        extract($stb);
                        ?>
                        <tr>
                            <th><?php echo $id_stb; ?></th>
                            <td><?php echo $nome_stb; ?></td>
                            <td><span class="badge badge-<?php echo $cor_cr; ?>"><?php echo $cor_cr . ' (' . $stb_cor . ')'; ?></span></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['edit_sits_biblio']) {
                                        echo "<a href='" . URLADM . "editar-st-biblio/edit-st-biblio/$id_stb' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_sits_biblio']) {
                                        echo "<a href='" . URLADM . "apagar-st-biblio/apagar-st-biblio/$id_stb' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['edit_sits_biblio']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-st-biblio/edit-st-biblio/$id_stb'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_sits_biblio']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-st-biblio/apagar-st-biblio/$id_stb' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
            <!-- ituação das copias -->
            <table class="table table-striped table-hover table-bordered table-sm">
                <thead>
                    <tr class="bg-secondary">
                        <th width = 5%;>ID</th>
                        <th class="d-none d-sm-table-cell" width = 50%;>Situação da Cópia</th>
                        <th class="d-none d-sm-table-cell">Cor (id)</th>
                        <th class="text-center"><?php
                            if ($this->Dados['botao']['cad_sits_copia']) {
                                echo "<a href='" . URLADM . "cadastrar-st-copia/cad-st-copia' class='btn btn-success btn-sm'>Cadastrar</a> ";
                            }
                            ?> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listStCopia'] as $stc) {
                        extract($stc);
                        ?>
                        <tr>
                            <th><?php echo $id_stc; ?></th>
                            <td><?php echo $nome_stc; ?></td>
                            <td><span class="badge badge-<?php echo $stc_cor_cr; ?>"><?php echo $stc_cor_cr . ' (' . $stc_cor . ')'; ?></span></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['edit_sits_copia']) {
                                        echo "<a href='" . URLADM . "editar-st-copia/edit-st-copia/$id_stc' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_sits_copia']) {
                                        echo "<a href='" . URLADM . "apagar-st-copia/apagar-st-copia/$id_stc' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['edit_sits_copia']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-st-copia/edit-st-copia/$id_stc'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_sits_copia']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-st-copia/apagar-st-copia/$id_stc' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
            
            <!-- ituação dos leitores -->
            <table class="table table-striped table-hover table-bordered table-sm">
                <thead>
                    <tr class="bg-secondary">
                        <th width = 5%;>ID</th>
                        <th class="d-none d-sm-table-cell" width = 50%;>Situação do Leitor</th>
                        <th class="d-none d-sm-table-cell">Cor (id)</th>
                        <th class="text-center"><?php
                            if ($this->Dados['botao']['cad_sits_leitor']) {
                                echo "<a href='" . URLADM . "cadastrar-st-leitor/cad-st-leitor' class='btn btn-success btn-sm'>Cadastrar</a> ";
                            }
                            ?> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listStLeitor'] as $stl) {
                        extract($stl);
                        ?>
                        <tr>
                            <th><?php echo $id_stl; ?></th>
                            <td><?php echo $nome_stl; ?></td>
                            <td><span class="badge badge-<?php echo $stl_cor_cr; ?>"><?php echo $stl_cor_cr . ' (' . $stl_cor . ')'; ?></span></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['edit_sits_leitor']) {
                                        echo "<a href='" . URLADM . "editar-st-leitor/edit-st-leitor/$id_stl' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_sits_leitor']) {
                                        echo "<a href='" . URLADM . "apagar-st-leitor/apagar-st-leitor/$id_stl' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['edit_sits_leitor']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-st-leitor/edit-st-leitor/$id_stl'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_sits_leitor']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-st-leitor/apagar-st-leitor/$id_stl' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
            //echo $this->Dados['paginacao'];
            ?>
        </div>
    </div>
</div>
