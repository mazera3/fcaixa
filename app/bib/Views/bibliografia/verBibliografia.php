<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
foreach ($this->Dados['qtBiblio'] as $qt) {
    extract($qt);
}
if (!empty($this->Dados['dados_biblio'][0])) {
    extract($this->Dados['dados_biblio'][0]);
    ?>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <?php $idd = $bib_id; ?>
                    <h2 class="display-4 titulo">Bibliografia: <?php echo $bib_id; ?></h2>
                </div>
            </div>
            <hr>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered table-sm">
                    <thead>
                        <tr class="bg-secondary">
                            <th class="d-none d-sm-table-cell text-center">Capa</th>
                            <th class="d-none d-sm-table-cell">Dados Bibliogáficos</th>
                            <th class="d-none d-sm-table-cell">Situação</th>
                            <th class="text-center"><?php
                        if ($this->Dados['botao']['list_bibliografia']) {
                            echo "<a href='" . URLADM . "bibliografias/listar' class='btn btn-primary btn-sm'>Listar Bibliografias</a> ";
                        }
                        ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><?php
                                if (!empty($capa_imagem)) {
                                    echo "<img src='" . URLADM . "app/bib/assets/imagens/bibliografia/" . $bib_id . "/" . $capa_imagem . "' witdh='60' height='80'>";
                                } else {
                                    echo "<img src='" . URLADM . "app/bib/assets/imagens/bibliografia/icone_bibliografia.jpg' witdh='60' height='80'>";
                                }
                                ?></td>
                            <td class="d-none d-sm-table-cell">
                                <?php echo '<b>Título:</b> ' . $titulo . ' - ' . $sub_titulo . '<br/><b>Autor:</b> ' . $autor . ' - <b>Editora:</b> ' . $editora . ' (' . $uf . ')'; ?><br/>
                                <?php echo '<b>ISBN:</b> ' . $isbn . ' - <b>Chamada:</b> ' . $chamada; ?><br/>
                                <?php echo '<b>Inserido: </b>' . date('d/m/Y H:i:s', strtotime($created)); ?><br/> <?php
                                if (!empty($modified)) {
                                    echo '<b>Alterado: </b>' . date('d/m/Y H:i:s', strtotime($modified));
                                }
                                ?></td>
                            <td class="d-none d-sm-table-cell text-center">
                                <span class="badge badge-<?php echo $cor_cr; ?>"><?php echo $nome_sit; ?></span><br/>
                                <?php
                                $i = 0;
                                while ($i <= $num_result) {
                                    if ($this->Dados['contCopia'][$i]['bib_id'] == $idd) {
                                        echo ($this->Dados['contCopia'][$i]['cont']) . '<br/>cópias';
                                    }
                                    $i++;
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['edit_bibliografia']) {
                                        echo "<a href='" . URLADM . "editar-bibliografia/edit-bibliografia/$bib_id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_bibliografia']) {
                                        echo "<a href='" . URLADM . "apagar-bibliografia/apagar-bibliografia/$bib_id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a";
                                    }
                                    ?>
                                </span>
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['cad_copia']) {
                                        echo "<a href='" . URLADM . "cadastrar-copia/cad-copia?bib_id=$bib_id' class='btn btn-outline-success btn-sm'>Incluir nova cópia</a> ";
                                    }
                                    ?>
                                </span>
                                
                                
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
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
                    } else {
                        $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Bibliografia não foi encontrada!</div>";
                        $UrlDestino = URLADM . 'bibliografias/listar';
                        header("Location: $UrlDestino");
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <table class="table table-striped table-hover table-bordered table-sm">
            <thead>
                <tr class="bg-secondary">
                    <th>ID da Cópia</th>
                    <th class="d-none d-sm-table-cell">Descrição</th>
                    <th class="d-none d-sm-table-cell">Código de Barras da Cópia</th>
                    <th class="d-none d-sm-table-cell">Situação da Cópia</th>
                    <th class="text-center"><?php if ($this->Dados['botao']['list_copia']) {
                                        echo "<a href='" . URLADM . "copias/listar' class='btn btn-primary btn-sm'>Listar Cópias</a> ";
                                    } ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($this->Dados['verCopia'] as $copia) {
                    extract($copia);
                    if ($cop_bib_id == $idd) {
                        ?>
                        <tr>
                            <td><?php echo $cop_id; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo 'Descrição: ' . $descricao; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo 'Etiqueta: ' . $cod_bar; ?></td>
                            <td class="d-none d-sm-table-cell">
                                <span class="badge badge-<?php echo $cor_cr; ?>"><?php echo $nome_stc; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
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
                                        if ($this->Dados['botao']['list_copia']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "copias/listar'>Listar</a>";
                                        }
                                        if ($this->Dados['botao']['edit_copia']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-copia/edit-copia/$cop_id'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_copia']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-copia/apagar-copia/$cop_id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
    </div>
</div>
