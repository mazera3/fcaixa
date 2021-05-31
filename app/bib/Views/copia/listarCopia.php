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
                <h2 class="display-4 titulo">Listar Cópias</h2>
            </div>
            <?php
            if ($this->Dados['botao']['pesq_copia']) {
                ?>
                <a href="<?php echo URLADM . 'pesquisar-copias/listar'; ?>">
                    <div class="p-2">
                        <button class="btn btn-outline-info btn-sm">
                            Pesquisar Cópias
                        </button>
                    </div>
                </a>
                <?php
            }
            ?>
            <div class="btn-group dropleft">
                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-print" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></span>
                </button>                    
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <?php
                    if ($this->Dados['botao']['xls']) {
                        echo "<li><a href='" . URLADM . "copias/listar/?xls=1'>Baixar Relatório XLS</a></li> ";
                    }
                    if ($this->Dados['botao']['pdf']) {
                        echo "<li><a href='" . URLADM . "copias/listar/?pdf=1'>Baixar Relatório PDF</a></li> ";
                    }
                    ?>  
                </ul>
            </div>
        </div>
        <?php
        if (empty($this->Dados['listCopia'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma cópia encontrada!
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
                        <th width="1%">ID</th>
                        <th class="d-none d-sm-table-cell">Titulo</th>
                        <th class="d-none d-sm-table-cell">Subtitulo</th>
                        <th class="d-none d-sm-table-cell">Autor</th>
                        <th class="d-none d-sm-table-cell">Editora</th>
                        <th class="d-none d-sm-table-cell">Código de Barras</th>
                        <th class="d-none d-sm-table-cell">Chamada</th>
                        <th class="d-none d-lg-table-cell">Situação</th>
                        <th class="text-center" width="20%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listCopia'] as $copia) {
                        extract($copia);
                        ?>
                        <tr>
                            <th><?php echo $cop_id; ?></th>
                            <td class="d-none d-sm-table-cell"><?php echo $titulo; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $sub_titulo; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $autor; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $editora; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $cod_bar; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $chamada; ?></td>
                            <td class="d-none d-lg-table-cell">
                                <span class="badge badge-<?php echo $cor_cr; ?>"><?php echo $nome_stc; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['ver_copia']) {
                                        echo "<a href='" . URLADM . "ver-copia/ver-copia/$cop_id' class='btn btn-outline-info btn-sm'>Ver</a> ";
                                    }
                                    if ($this->Dados['botao']['edit_copia']) {
                                        echo "<a href='" . URLADM . "editar-copia/edit-copia/$cop_id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_copia']) {
                                        echo "<a href='" . URLADM . "apagar-copia/apagar-copia/$cop_id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['edit_copia']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-copia/edit-copia/$cop_id'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_copia']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-copia/apagar-copia/$cop_id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
