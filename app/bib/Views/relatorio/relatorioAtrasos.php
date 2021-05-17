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
                <h2 class="display-4 titulo">Relatório de Cópias Atrasadas</h2>
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
        if (empty($this->Dados['listAtrasos'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum atrazo encontrado!
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
                        <th class="d-none d-sm-table-cell">Codigo</th>
                        <th class="d-none d-sm-table-cell">Titulo</th>
                        <th class="d-none d-sm-table-cell">Autor</th>
                        <th class="d-none d-sm-table-cell">Leitor</th>
                        <th class="d-none d-sm-table-cell">Previsão de Devolução</th>
                        <th class="d-none d-sm-table-cell">Dias em Atraso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listAtrasos'] as $z) {
                        extract($z);
                        ?>
                        <tr>
                            <th><?php echo $cop_id; ?></th>
                            <td><?php echo $cod_bar; ?></td>
                            <td><?php echo $titulo; ?></td>
                            <td><?php echo $autor; ?></td>
                            <td><?php echo $primeiro_nome.' '.$ultimo_nome; ?></td>
                            <td><?php echo date('d/M/Y', strtotime($data_dev)); ?></td>
                            <td class="text-danger text-center"><?php echo abs($dias); ?></td>
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