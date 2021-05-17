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
                <h2 class="display-4 titulo">Listar Coleção</h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->Dados['botao']['cad_col']) {
                    echo "<a href='" . URLADM . "cadastrar-colecao/cad-colecao' class='btn btn-outline-success btn-sm'>Cadastrar</a> ";
                }
                ?>                
            </div>

        </div>
        <?php
        
        if (empty($this->Dados['listCol'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum colecao encontrado!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        foreach ($this->Dados['qtCol'] as $qt) {
            extract($qt);
            echo 'Foram encontrados ' . $num_result . ' registros.';
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
                        <th class="d-none d-sm-table-cell">Descrição</th>
                        <th class="d-none d-sm-table-cell">Flag</th>
                        <th class="d-none d-sm-table-cell">Retorno</th>
                        <th class="d-none d-sm-table-cell">Taxa/dia (Atraso) (₵)</th>
                        <th class="d-none d-sm-table-cell">Logo</th>
                        <th class="d-none d-sm-table-cell">Contagem</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listCol'] as $mat) {
                        extract($mat);
                        ?>
                        <tr>
                            <th><?php echo $col_id; ?></th>
                            <td><?php echo $descricao; ?></td>
                            <td><?php echo $flag; ?></td>
                            <td><?php echo $dias_retorno . ' dias'; ?></td>
                            <td><?php echo '₵ ' . $taxa_diaria_atraso . ' / dia'; ?></td>
                            <td><?php
                                if (!empty($logo_imagem)) {
                                    echo "<img src='" . URLADM . "app/bib/assets/imagens/colecao/" . $col_id . "/" . $logo_imagem . "' witdh='30' height='30'>";
                                } else {
                                    echo "<img src='" . URLADM . "app/bib/assets/imagens/colecao/preview_img.png' witdh='30' height='30'>";
                                }
                                ?></td>
                            <td class="text-center"><?php
                                $i = 0;
                                while ($i <= $num_result) {
                                    if ($this->Dados['contCol'][$i][col_id] == $col_id) {
                                        print_r($this->Dados['contCol'][$i][cont]);
                                    }
                                    $i++;
                                }
                                ?></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['vis_col']) {
                                        echo "<a href='" . URLADM . "ver-colecao/ver-colecao/$col_id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['edit_col']) {
                                        echo "<a href='" . URLADM . "editar-colecao/edit-colecao/$col_id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_col']) {
                                        echo "<a href='" . URLADM . "apagar-colecao/apagar-colecao/$col_id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['vis_col']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "ver-colecao/ver-colecao/$col_id'>Visualizar</a>";
                                        }
                                        if ($this->Dados['botao']['edit_col']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-colecao/edit-colecao/$col_id'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_col']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-colecao/apagar-colecao/$col_id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
