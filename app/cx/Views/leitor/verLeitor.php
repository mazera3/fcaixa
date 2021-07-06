<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->Dados['listCopia'][0])) {
    extract($this->Dados['listCopia'][0]);
}
if (!empty($this->Dados['dados_leitor'][0])) {
    extract($this->Dados['dados_leitor'][0]);
    ?>
    <div class="content p-1">
        <div class="list-group-item">
            <hr>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            //var_dump($this->Dados['listHist']);
            ?>

            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered table-sm">
                    <thead>
                        <tr class="bg-secondary">
                            <th class="d-none d-sm-table-cell text-center">Leitor: <?php echo $leitor_id; ?></th>
                            <th class="d-none d-sm-table-cell">Dados do Leitor</th>
                            <th class="text-center"><?php
                                if ($this->Dados['botao']['list_leitor']) {
                                    echo "<a href='" . URLADM . "leitores/listar' class='btn btn-primary btn-sm btn-block'>Listar</a> ";
                                }
                                ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <?php
                                if (!empty($foto_leitor)) {
                                    echo "<img src='" . URLADM . "app/cx/assets/imagens/leitor/" . $leitor_id . "/" . $foto_leitor . "' witdh='100' height='100'>";
                                } else {
                                    echo "<img src='" . URLADM . "app/cx/assets/imagens/leitor/icone_leitor.png' witdh='100' height='100'>";
                                }
                                ?>
                            </td>
                            <td class="d-none d-sm-table-cell small">
                                <?php echo '<b>Nome Completo:</b> ' . $primeiro_nome . ' ' . $ultimo_nome . '<br/><b>Matricula:</b> ' . $cod_barras_leitor . ' - <b>Classificação:</b> ' . $classificacao . '<br/><b>Endereço: </b>' . $endereco . ', ' . $bairro . ', ' . $municipio; ?><br/>
                                <?php echo '<b>Contatos: </b>Fone: ' . $fone . ' - Celular: ' . $celular . '</br> <b>E-Mail: </b>' . $email . '<b> - Cadastrado em: </b>' . date('d/m/Y', strtotime($created)); ?>
                                <?php
                                if (!empty($modified)) {
                                    echo '<b>Alterado: </b>' . date('d/m/Y H:i:s', strtotime($modified));
                                }
                                ?>
                                <span class="badge badge-<?php echo $cor_cr; ?>"><?php echo $nome_stl; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['qrcode_leitor']) {
                                        echo "<a href='" . URLADM . "ver-leitor/ver-leitor/$leitor_id?qr=$leitor_id' class='btn btn-outline-success btn-sm' title='Imprimir Carteira'><i class='fas fa-qrcode'></i></a> ";
                                    }
                                    if ($this->Dados['botao']['edit_leitor']) {
                                        echo "<a href='" . URLADM . "editar-leitor/edit-leitor/$leitor_id' class='btn btn-outline-warning btn-sm' title='Editar'><i class='fas fa-edit'></i></a> ";
                                    }
                                    if ($this->Dados['botao']['del_leitor']) {
                                        echo "<a href='" . URLADM . "apagar-leitor/apagar-leitor/$leitor_id' class='btn btn-outline-danger btn-sm' title='Excluir' data-confirm='Tem certeza de que deseja excluir o item selecionado?'><i class='fas fa-trash-alt'></i></a";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['edit_leitor']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-leitor/edit-leitor/$leitor_id'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_leitor']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-leitor/apagar-leitor/$leitor_id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered table-sm">
                </table>
            </div> 
            <?php
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: leitor não encontrado!</div>";
            $UrlDestino = URLADM . 'leitores/listar';
            header("Location: $UrlDestino");
        }
        ?>
        <!-- listar emprestimos -->
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered table-sm">
                    <thead>
                        <tr class="bg-light">
                            <th width="5%">ID</th>
                            <th class="d-none d-sm-table-cell" width="25%">Código de Barras</th>
                            <th class="d-none d-sm-table-cell" width="30%">Título</th>
                            <th class="d-none d-sm-table-cell" width="15%">Descrição</th>
                            <th class="d-none d-lg-table-cell" width="10%">Situação</th>
                            <th class="text-center" width="15%">
                                <?php
                                if ($this->Dados['botao']['list_emp']) {
                                    echo "<a href='" . URLADM . "ver-leitor/ver-leitor/$leitor_id?lt=$leitor_id' class='btn btn-outline-info btn-sm'>Ver Empréstimos</a> ";
                                }
                                ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($this->Dados['verEmp'])) {
                        foreach ($this->Dados['verEmp'] as $emp) {
                            extract($emp);
                            ?>
                            <tr>
                                <th><?php echo $cop_id; ?></th>
                                <td class="d-none d-sm-table-cell"><?php echo $cod_bar; ?></td>
                                <td class="d-none d-sm-table-cell"><?php echo $titulo; ?></td>
                                <td class="d-none d-sm-table-cell"><?php echo $descricao; ?></td>
                                <td class="d-none d-lg-table-cell">
                                    <span class="badge badge-<?php echo $cor_cr; ?>"><?php echo $nome_stc; ?>
                                    </span><?php
                                        if ($data_dev >= date("Y-m-d")) {
                                            echo '<span class="small">Até: ' . date('d/m/Y', strtotime($data_dev)) . '</span><span class="text-danger">';
                                        } elseif ($data_dev == null) {
                                            echo 'Reservado!';
                                        } elseif ($data_dev < date("Y-m-d")) {
                                            echo '<span class="text-danger small">' . date('d/m/Y', strtotime($data_dev)) . ' (Vencido)</span>';
                                        }
                                        ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="d-none d-md-block">
                                        <?php
                                        if ($sit_copia == 1 AND $sit_res == 1) {
                                            if ($this->Dados['botao']['ret_copia']) {
                                                echo "<a href='" . URLADM . "retirar-copia/retirar-copia/?cp=$cop_id&lt=$leitor_id&cl=$leitor_id' class='btn btn-success btn-sm'>Retirar</a> ";
                                            }
                                        } elseif ($sit_copia == 1 AND $sit_res == 2 AND $id_res == $leitor_id ) {
                                            if ($this->Dados['botao']['ret_copia']) {
                                                echo "<a href='" . URLADM . "retirar-copia/retirar-copia/?cp=$cop_id&lt=$leitor_id&cl=$leitor_id' class='btn btn-success btn-sm'>Retirar</a> ";
                                            }
                                        }elseif ($sit_copia == 2 AND $id_leitor == $leitor_id) {
                                            if ($this->Dados['botao']['ret_copia']) {
                                                echo "<a href='" . URLADM . "retirar-copia/retirar-copia/?cp=$cop_id&lt=$leitor_id&cl=$leitor_id' class='btn btn-warning btn-sm'>Devolver</a> ";
                                            } elseif ($sit_copia > 2) {
                                                echo '<span class="text-danger">Indisponível</span>';
                                            }
                                            // Reserva e cancelamento
                                        } if ($sits_leitor_id == 1 AND $sit_copia == 1 AND $sit_res == 1 AND $id_res == null) {
                                            if ($this->Dados['botao']['res_copia']) {
                                                echo "<a href='" . URLADM . "reservar-copia/reservar-copia/?cp=$cop_id&lt=$leitor_id&cl=$leitor_id' class='btn btn-info btn-sm'>Reservar</a> ";
                                            }
                                        } elseif ($sit_res == 2 AND $id_res == $leitor_id) {
                                            if ($this->Dados['botao']['res_copia']) {
                                                echo "<a href='" . URLADM . "reservar-copia/reservar-copia/?cp=$cop_id&lt=$leitor_id&cl=$leitor_id' class='btn btn-dark btn-sm'>Liberar</a><br/><i class=text-danger small>Reservado</i>";
                                            }
                                        } elseif ($sit_res == 2 AND $id_leitor <> $leitor_id) {
                                            echo '<span class="text-danger">Reservado</span>';
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <?php
                        }
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                if (empty($this->Dados['verEmp'])) {
                    ?>
                    <div class="alert alert-warning" role="alert">
                        Não formam encontrados emprestimos para este leitor!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        
        <!-- Pesquisar -->
        <div class="row">
            <div class="col-sm-12 mb-2" id="cor_orm_pesquisa">
                <form class="form" method="POST" name="pesq_copia" id="form_pesquisa" action="">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class = "form-group form-control-sm">
                                <div class = "form-group">
                                    <input name="cod_bar" type="text" id="cod_bar" class="form-control" placeholder="Código de Barras" value="<?php
                if (isset($_SESSION['pesqBiblioCodBar'])) {
                    echo $_SESSION['pesqBiblioCodBar'];
                }
                ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <input name="PesqCopia" type="submit" class="btn btn-outline-primary btn-sm mt-2" value="Pesquisar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- fim do formulario -->
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered table-sm">
                    <thead>
                        <tr class="bg-light">
                            <th width="5%">ID</th>
                            <th class="d-none d-sm-table-cell" width="25%">Código de Barras</th>
                            <th class="d-none d-sm-table-cell" width="30%">Título</th>
                            <th class="d-none d-lg-table-cell" width="15%">Descrição</th>
                            <th class="d-none d-lg-table-cell" width="10%">Situação</th>
                            <th class="text-center" width="15%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($this->Dados['listCopia'])) {
                        foreach ($this->Dados['listCopia'] as $cp) {
                            extract($cp);
                            ?>
                            <tr>
                                <th><?php echo $cop_id; ?></th>
                                <td class="d-none d-sm-table-cell"><?php echo $cod_bar; ?></td>
                                <td class="d-none d-sm-table-cell"><?php echo $titulo; ?> </td>
                                <td class="d-none d-sm-table-cell"><?php echo $descricao; ?></td>
                                <td class="d-none d-lg-table-cell">
                                    <span class="badge badge-<?php echo $cor_cr; ?>"><?php echo $nome_stc; ?></span>
                                    <?php
                                    if ($sit_copia == 2 AND $id_leitor <> $leitor_id) {
                                        if ($data_dev >= date("Y-m-d")) {
                                            echo '<span class="small">Até ' . date('d/m/Y', strtotime($data_dev)) . '</span>';
                                        } elseif ($data_dev < date("Y-m-d")) {
                                            echo date('d/m/Y', strtotime($data_dev)) . '<span class="text-danger"> (Vencido)</span>';
                                        }
                                    }
                                    ?>

                                </td>
                                <td class="text-center">
                                    <span class="d-none d-md-block">
                                        <?php
                                        if ($sits_leitor_id == 1 AND $sit_copia == 1 AND $sit_res == 1) {
                                            if ($this->Dados['botao']['ret_copia']) {
                                                echo "<a href='" . URLADM . "retirar-copia/retirar-copia/?cp=$cop_id&lt=$leitor_id&cl=$dias_retorno' class='btn btn-success btn-sm'>Retirar</a> ";
                                            }
                                        } elseif ($sit_copia == 2 AND $id_leitor == $leitor_id) {
                                            if ($this->Dados['botao']['ret_copia']) {
                                                echo "<a href='" . URLADM . "retirar-copia/retirar-copia/?cp=$cop_id&lt=$leitor_id&cl=$dias_retorno' class='btn btn-warning btn-sm'>Devolver</a> ";
                                            }
                                        } elseif ($sit_copia == 1 AND $sit_res == 2) {
                                            echo '<span class="text-danger">Reservado</span>';
                                        }elseif ($sit_copia > 2) {
                                            echo '<span class="text-danger">Indisponível</span>';
                                            // Reserva e cancelamento
                                        } if ($sits_leitor_id == 1 AND $sit_copia == 2 AND $sit_res == 1 AND $id_res == null AND $leitor_id != $id_leitor) {
                                            if ($this->Dados['botao']['res_copia']) {
                                                echo "<a href='" . URLADM . "reservar-copia/reservar-copia/?cp=$cop_id&lt=$leitor_id&cl=$leitor_id' class='btn btn-info btn-sm'>Reservar</a> ";
                                            }
                                        } elseif ($sit_res == 2 AND $id_res == $leitor_id) {
                                            if ($this->Dados['botao']['res_copia']) {
                                                echo "<a href='" . URLADM . "reservar-copia/reservar-copia/?cp=$cop_id&lt=$leitor_id&cl=$leitor_id' class='btn btn-dark btn-sm'>Liberar-Reserva</a> ";
                                            }
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <?php
                        }
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                //echo $this->Dados['paginacao'];
                if (empty($this->Dados['listCopia'])) {
                    ?>
                    <div class="alert alert-warning" role="alert">
                        Entre com um <b>código de barras</b> válido para localizar uma cópia.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        
          <!-- listar histórico -->
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered table-sm">
                    <thead>
                        <tr class="bg-secondary">
                            <th width="5%">ID</th>
                            <th class="d-none d-sm-table-cell" width="5%">Cópia</th>
                            <th class="d-none d-sm-table-cell" width="5%">Código</th>
                            <th class="d-none d-sm-table-cell" width="25%">Titulo</th>
                            <th class="text-center" width="15%">
                                <?php
                                if ($this->Dados['botao']['list_his']) {
                                    echo "<a href='" . URLADM . "ver-leitor/ver-leitor/$leitor_id?leitor=$leitor_id' class='btn btn-outline-light btn-sm'>Histórico</a> ";
                                }
                                ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($this->Dados['listHist'])) {
                        foreach ($this->Dados['listHist'] as $his) {
                            extract($his);
                            ?>
                            <tr>
                                <th><?php echo $id_hist; ?></th>
                                <td class="d-none d-sm-table-cell"><?php echo $cp_id; ?></td>
                                <td class="d-none d-sm-table-cell"><?php echo $cod_bar; ?></td>
                                <td class="d-none d-sm-table-cell"><?php echo $titulo; ?></td>
                                <td class="d-none d-sm-table-cell"><?php echo date('d/M/Y', strtotime($created)); ?></td>
                            </tr>
                            <?php
                        }
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                if (empty($this->Dados['listHist'])) {
                    ?>
                    <div class="alert alert-warning" role="alert">
                        Não formam encontrados histórico para este leitor!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
          
    </div>
</div>