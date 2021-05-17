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
                <h2 class="display-4 titulo">Listar Leitores</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_leitor']) {
                ?>
                <a href="<?php echo URLADM . 'leitores/listar/?st=1'; ?>">
                    <div class="p-2">
                        <button class="btn btn-outline-dark btn-sm">
                            Somente Ativos
                        </button>
                    </div>
                </a>
                <?php
            }
            if ($this->Dados['botao']['list_leitor']) {
                ?>
                <a href="<?php echo URLADM . 'leitores/listar/?st=5'; ?>">
                    <div class="p-2">
                        <button class="btn btn-outline-dark btn-sm">
                            Listar Todos
                        </button>
                    </div>
                </a>
                <?php
            }
            if ($this->Dados['botao']['pesq_leitor']) {
                ?>
                <a href="<?php echo URLADM . 'pesq-leitor/listar'; ?>">
                    <div class="p-2">
                        <button class="btn btn-info btn-sm">
                            Pesquisar Leitor
                        </button>
                    </div>
                </a>
                <?php
            }
            if ($this->Dados['botao']['cad_leitor']) {
                ?>
                <a href="<?php echo URLADM . 'cadastrar-leitor/cad-leitor'; ?>">
                    <div class="p-2">
                        <button class="btn btn-success btn-sm">
                            Cadastrar Leitor
                        </button>
                    </div>
                </a>
                <?php
            }
            if ($this->Dados['botao']['imp_leitor']) {
                ?>
                <a href="<?php echo URLADM . 'importar-leitor/importar'; ?>">
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
        if (empty($this->Dados['listLeitor'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum leitor encontrado!
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
                        <th class="d-none d-sm-table-cell">Nome Completo</th>
                        <th class="d-none d-sm-table-cell">Código de Barras</th>
                        <th class="d-none d-sm-table-cell">E-mail</th>
                        <th class="d-none d-lg-table-cell">Situação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listLeitor'] as $leitor) {
                        extract($leitor);
                        ?>
                        <tr>
                            <th><?php echo $leitor_id; ?></th>
                            <td class="d-none d-sm-table-cell"><?php echo $primeiro_nome . ' ' . $ultimo_nome; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $cod_barras_leitor; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $email; ?></td>
                            <td class="d-none d-lg-table-cell">
                                <span class="badge badge-<?php echo $cor_cr; ?>"><?php echo $nome_stc; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['vis_leitor']) {
                                        if ($sits_leitor_id == 1) {
                                            echo "<a href='" . URLADM . "ver-leitor/ver-leitor/$leitor_id' class='btn btn-outline-primary btn-sm'>Emprestimo</a> ";
                                        } else {
                                            echo "<a href='" . URLADM . "ver-leitor/ver-leitor/$leitor_id' class='btn btn-outline-dark btn-sm disabled'>Emprestimo</a> ";
                                        }
                                    }
                                    if ($this->Dados['botao']['edit_leitor']) {
                                        echo "<a href='" . URLADM . "editar-leitor/edit-leitor/$leitor_id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_leitor']) {
                                        echo "<a href='" . URLADM . "apagar-leitor/apagar-leitor/$leitor_id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['vis_leitor']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "ver-leitor/ver-leitor/$leitor_id'>Visualizar</a>";
                                        }
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
