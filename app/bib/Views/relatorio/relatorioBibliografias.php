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
                <h2 class="display-4 titulo">Relatório de Bibliografias</h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->Dados['botao']['imprimir']) {
                    echo "<a href='" . URLADM . "imprimir/imprimir/1' class='btn btn-outline-dark btn-sm'>Imprimir</a> ";
                }
                ?>                
            </div>

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
                        <th class="d-none d-sm-table-cell">Chamada</th>
                        <th class="d-none d-sm-table-cell">isbn</th>
                        <th class="d-none d-sm-table-cell">Titulo / subtitulo</th>
                        <th class="d-none d-sm-table-cell">Autor / Editora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listBiblio'] as $b) {
                        extract($b);
                        ?>
                        <tr>
                            <td><?php echo $bib_id; ?></td>
                            <td><?php echo $chamada; ?></td>
                            <td><?php echo $isbn; ?></td>
                            <td><?php echo $titulo . ' - ' . $sub_titulo; ?></td>
                            <td class="d-none d-sm-table-cell">
                                <?php echo '<b>Autor:</b> ' . $autor . ' - <b>Editora:</b> ' . $editora . ' (' . $uf . ')'; ?>  </td>
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
