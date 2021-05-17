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
                <h2 class="display-4 titulo">Acervo Bibliográfico</h2>
            </div>
            <?php
            if ($this->Dados['botao']['pesq_copia']) {
                ?>
                <a href="<?php echo URLADM . 'pesquisar-copias/listar'; ?>">
                    <div class="p-2">
                        <button class="btn btn-outline-info btn-sm">
                            Pesquisar
                        </button>
                    </div>
                </a>
                <?php
            }
            if ($this->Dados['botao']['cad_bibliografia']) {
                ?>
                <a href="<?php echo URLADM . 'cadastrar-bibliografia/cad-bibliografia'; ?>">
                    <div class="p-2">
                        <button class="btn btn-outline-success btn-sm">
                            Cadastrar
                        </button>
                    </div>
                </a>
                <?php
            }
            if ($this->Dados['botao']['imp_biblio']) {
                ?>
                <a href="<?php echo URLADM . 'importar-bibliografia/importar'; ?>">
                    <div class="p-2">
                        <button class="btn btn-outline-success btn-sm">
                            Carregar XML/CSV
                        </button>
                    </div>
                </a>
                <?php
            }
            ?>
            
        </div>
        <?php
        if (empty($this->Dados['listBiblio'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma bibliografia encontrada!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        foreach ($this->Dados['qtBiblio'] as $qt) {
            extract($qt);
            echo 'Foram encontrados ' . $num_result . ' registros.';
        }
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered table-sm small">
                <thead>
                    <tr class="bg-info">
                        <th>ID</th>
                        <th class="text-center">Nº</th>
                        <th class="d-none d-sm-table-cell text-center">Capa</th>
                        <th class="d-none d-sm-table-cell">Dados Bibliogáficos</th>
                        <th class="d-none d-sm-table-cell">Situação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listBiblio'] as $b) {
                        extract($b);
                        ?>
                        <tr>
                            <th><?php echo $bib_id; ?></th>
                            <td class="text-center"><?php
                                $i = 0;
                                while ($i <= $num_result) {
                                    if ($this->Dados['contCopia'][$i]['bib_id'] == $bib_id) {
                                        echo ($this->Dados['contCopia'][$i]['cont']) . '<br/>cópias';
                                    }
                                    $i++;
                                }
                                ?></td>
                            <td class="text-center"><?php
                                if (!empty($capa_imagem)) {
                                    echo "<img src='" . URLADM . "app/bib/assets/imagens/bibliografia/" . $bib_id . "/" . $capa_imagem . "' witdh='60' height='80'>";
                                } else {
                                    echo "<img src='" . URLADM . "app/bib/assets/imagens/bibliografia/icone_bibliografia.jpg' witdh='60' height='80'>";
                                }
                                ?></td>
                            <td class="d-none d-sm-table-cell">
                                <?php echo '<b>Título:</b> ' . $titulo . ' - ' . $sub_titulo . '<br/><b>Autor:</b> ' . $autor . ' - <b>Editora:</b> ' . $editora . ' (' . $uf . ')'; ?><br/>
                                <?php echo '<b>ISBN:</b> ' . $isbn . ' - <b>Chamada:</b> ' . $chamada; ?></td>

                            <td class="d-none d-sm-table-cell">
                                <span class="badge badge-<?php echo $cor_cr; ?>"><?php echo $nome_sit; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['vis_bibliografia']) {
                                        echo "<a href='" . URLADM . "ver-bibliografia/ver-bibliografia/$bib_id' class='btn btn-outline-primary btn-sm'>Vizualizar</a>";
                                    }
                                    if ($this->Dados['botao']['edit_bibliografia']) {
                                        echo "<a href='" . URLADM . "editar-bibliografia/edit-bibliografia/$bib_id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_bibliografia']) {
                                        echo "<a href='" . URLADM . "apagar-bibliografia/apagar-bibliografia/$bib_id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a";
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
                    ?>
                </tbody>
            </table>
            <?php
            echo $this->Dados['paginacao'];
            //var_dump($this->Dados['listBiblio']);
            ?>
        </div>
    </div>
</div>
