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
                <h2 class="display-4 titulo">Localizar Copias</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_copia']) {
                ?>
                <a href="<?php echo URLADM . 'copias/listar'; ?>">
                    <div class="p-2">
                        <button class="btn btn-outline-info btn-sm">
                            Listar Cópias
                        </button>
                    </div>
                </a>
                <?php
            }
            ?>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mb-2" id="cor_orm_pesquisa">
                    <form class="form" method="POST" name="pesq_copia" id="form_pesquisa" action="">
                        <input name="PesqCopia" type="submit" class="btn btn-primary btn-sm mt-2" value="Pesquisar">
                        <a href="<?php echo URLADM . 'pesquisar-copias/listar'; ?>" class="btn btn-outline-danger btn-sm mt-2" onclick="limpaForm()" role="button">Limpar</a>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class = "form-group form-control-sm">
                                    <div class = "form-group">
                                        <label>Procurar por Etiqueta</label>
                                        <input name="cod_bar" type="text" id="cod_bar" class="form-control" placeholder="Código de Barras" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class = "form-group form-control-sm">
                                    <label>Titulo da obra</label>
                                    <input name="titulo" type="text" id="titulo" class="form-control" placeholder="Titulo" value=""">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class = "form-group">
                                    <label>Autor da obra</label>
                                    <input name="autor" type="text" id="autor" class="form-control" placeholder="Autor" value="">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class = "form-group">
                                    <label>Subtitulo</label>
                                    <input name="sub_titulo" type="text" id="subtitulo" class="form-control" placeholder="Subtítulo" value="">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class = "form-group">
                                    <label>Nº de Chamada</label>
                                    <input name="chamada" type="text" id="chamada" class="form-control" placeholder="Chamada" value="">

                                </div>
                            </div>
                            <div class="col-sm">
                                <div class = "form-group">
                                    <label>Palavra Chave</label>
                                    <input name="chave" type="text" id="chave" class="form-control" placeholder="Palavra Chave" value="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- fim do formulario -->
        <script>
            function limpaForm() {
                document.getElementById("form_pesquisa").reset();
            }
        </script>
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
        <form method="POST" action="">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center"><i class="fas fa-barcode"></i></th>
                            <th>ID</th>
                            <th class="d-none d-sm-table-cell">Titulo</th>
                            <th class="d-none d-sm-table-cell">Subtitulo</th>
                            <th class="d-none d-sm-table-cell">Autor</th>
                            <th class="d-none d-sm-table-cell">Editora</th>
                            <th class="d-none d-sm-table-cell">Código de Barras</th>
                            <th class="d-none d-sm-table-cell">Chamada</th>
                            <th class="d-none d-lg-table-cell">Situação</th>
                            <th class="text-center" width="20%">
                                <?php
                                if ($this->Dados['botao']['cod_bar']) {
                                    echo "<input type='submit' name='CodBarCopia' value='Gerar Código' class='btn btn-outline-success btn-sm'>";
                                }
                                ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //var_dump($this->Dados['listCopia']);
                        if (!empty($this->Dados['listCopia'])) {
                            foreach ($this->Dados['listCopia'] as $copia) {
                                extract($copia);
                                ?>
                                <tr>
                                    <th><?php echo "<input type='checkbox' name='codebar[$cop_id]' value=''"; ?></th>
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
                                            if ($this->Dados['botao']['vis_copia']) {
                                                echo "<a href='" . URLADM . "ver-copia/ver-copia/$cop_id' class='btn btn-outline-primary btn-sm'>Ver</a> ";
                                            }
                                            if ($this->Dados['botao']['edit_copia']) {
                                                echo "<a href='" . URLADM . "editar-copia/edit-copia/$cop_id' class='btn btn-outline-warning btn-sm'>Edit</a> ";
                                            }
                                            if ($this->Dados['botao']['del_copia']) {
                                                echo "<a href='" . URLADM . "apagar-copia/apagar-copia/$cop_id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Del</a> ";
                                            }
                                            ?>
                                        </span>
                                        <div class="dropdown d-block d-md-none">
                                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Ações
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                                <?php
                                                if ($this->Dados['botao']['vis_copia']) {
                                                    echo "<a class='dropdown-item' href='" . URLADM . "ver-copia/ver-copia/$cop_id'>Visualizar</a>";
                                                }
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
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                echo $this->Dados['paginacao'];
                ?>
            </div>
        </form>
    </div>
    <?php
    echo '<span class="text-info">Termo procurado: </span>';
    if (isset($_SESSION['pesqBiblioCodBar'])) {
        echo $_SESSION['pesqBiblioCodBar'];
        unset($_SESSION['pesqBiblioCodBar']);
    }if (isset($_SESSION['pesqBiblioTitulo'])) {
        echo $_SESSION['pesqBiblioTitulo'];
        unset($_SESSION['pesqBiblioTitulo']);
    }if (isset($_SESSION['pesqBiblioAutor'])) {
        echo $_SESSION['pesqBiblioAutor'];
        unset($_SESSION['pesqBiblioAutor']);
    }if (isset($_SESSION['pesqBiblioSubtitulo'])) {
        echo $_SESSION['pesqBiblioSubtitulo'];
        unset($_SESSION['pesqBiblioSubtitulo']);
    }if (isset($_SESSION['pesqBiblioChamada'])) {
        echo $_SESSION['pesqBiblioChamada'];
        unset($_SESSION['pesqBiblioChamada']);
    }if (isset($_SESSION['pesqBiblioChave'])) {
        echo $_SESSION['pesqBiblioChave'];
        unset($_SESSION['pesqBiblioChave']);
    }
    ?>
</div>
