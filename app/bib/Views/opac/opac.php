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
                <h2 class="display-4 titulo">OPAC - Catálogo Público</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <?php
                    if ($this->Dados['botao']['list_bibliografia']) {
                        echo "<a href='" . URLADM . "bibliografias/listar' class='btn btn-outline-info btn-sm'>Listar</a> ";
                    }
                    if ($this->Dados['botao']['cad_bibliografia']) {
                        echo "<a href='" . URLADM . "cadastrar-bibliografia/cad-bibliografia' class='btn btn-outline-success btn-sm'>Cadastrar Bibliografia</a> ";
                    }
                    ?>
                </span>
                <div class="dropdown d-block d-md-none">
                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar"> 
                        <?php
                        if ($this->Dados['botao']['list_bibliografia']) {
                            echo "<a class='dropdown-item' href='" . URLADM . "bibliografias/listar'>Listar</a>";
                        }
                        if ($this->Dados['botao']['cad_bibliografia']) {
                            echo "<a class='dropdown-item' href='" . URLADM . "cadastrar-bibliografia/cad-bibliografia'>Cadastrar</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <form class="form" method="POST" name="filtro" id="form_pesquisa" action="">
            <input name="PesqBiblio" type="submit" class="btn btn-outline-primary my-2" value="Pesquisar">
            <input type="reset" class="btn btn-outline-danger my-2" onclick="limpaForm()" value="Limpar">
            <div class="row">
                <div class="col-sm">
                    <div class = "form-group form-control-sm">
                        <label>Titulo da obra</label>
                        <input name="titulo" type="text" id="titulo" class="form-control mx-sm-3" placeholder="Titulo da obra" value="">
                    </div>
                </div>
                <div class="col-sm">
                    <div class = "form-group">
                        <label>Autor da obra</label>
                        <input name="autor" type="text" id="autor" class="form-control mx-sm-3" placeholder="Autor da obra" value="">
                    </div>
                </div>
                <div class="col-sm">
                    <div class = "form-group">
                        <label>Subtitulo</label>
                        <input name="sub_titulo" type="text" id="subtitulo" class="form-control mx-sm-3" placeholder="Assunto ..." value="">
                    </div>
                </div>
                <div class="col-sm">
                    <div class = "form-group">
                        <label>Nº de Chamada</label>
                        <input name="chamada" type="text" id="chamada" class="form-control mx-sm-3" placeholder="Código de Barras" value="">

                    </div>
                </div>
                <div class="col-sm">
                    <div class = "form-group">
                        <label>Palavra Chave</label>
                        <input name="chave" type="text" id="chave" class="form-control mx-sm-3" placeholder="palavra chave" value="">
                    </div>
                </div>
            </div>
        </form>
        <!-- fim do formulario -->
        <script>
            function limpaForm() {
                document.getElementById("form_pesquisa").reset();
            }
        </script>
        <?php
        if (empty($this->Dados['listBiblio'])) {
            ?>
            <div class="alert alert-warning" role="alert">
                Nenhuma bibliografia encontrada!
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
                        <th>Titulo</th>
                        <th class="d-none d-sm-table-cell">Autor</th>
                        <th class="d-none d-lg-table-cell">Situação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($this->Dados['listBiblio'])) {
                        foreach ($this->Dados['listBiblio'] as $biblio) {
                            extract($biblio);
                            ?>
                            <tr>
                                <th><?php echo $bib_id; ?></th>
                                <td><?php echo $titulo; ?></td>
                                <td class="d-none d-sm-table-cell"><?php echo $autor; ?></td>
                                <td class="d-none d-lg-table-cell">
                                    <span class="badge badge-<?php echo $cor_cr; ?>"><?php echo $nome_sit; ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="d-none d-md-block">
                                        <?php
                                        if ($this->Dados['botao']['vis_bibliografia']) {
                                            echo "<a href='" . URLADM . "ver-bibliografia/ver-bibliografia/$bib_id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                        }
                                        if ($this->Dados['botao']['edit_bibliografia']) {
                                            echo "<a href='" . URLADM . "editar-bibliografia/edit-bibliografia/$bib_id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                        }
                                        if ($this->Dados['botao']['del_bibliografia']) {
                                            echo "<a href='" . URLADM . "apagar-bibliografia/apagar-bibliografia/$bib_id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                        }
                                        ?>
                                    </span>
                                    <div class="dropdown d-block d-md-none">
                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Ações
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                            <?php
                                            if ($this->Dados['botao']['vis_bibliografia']) {
                                                echo "<a class='dropdown-item' href='" . URLADM . "ver-bibliografia/ver-bibliografia/$bib_id'>Visualizar</a>";
                                            }
                                            if ($this->Dados['botao']['edit_bibliografia']) {
                                                echo "<a class='dropdown-item' href='" . URLADM . "editar-bibliografia/edit-bibliografia/$bib_id'>Editar</a>";
                                            }
                                            if ($this->Dados['botao']['del_bibliografia']) {
                                                echo "<a class='dropdown-item' href='" . URLADM . "apagar-bibliografia/apagar-bibliografia/$bib_id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
    </div>
</div>