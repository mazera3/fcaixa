<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto">
                <h2 class="titulo">Histórico de Retiradas</h2>
            </div>
            <div class="btn-group dropleft">
                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-print" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></span>
                </button>                    
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <?php
                    if ($this->Dados['botao']['xls']) {
                        echo "<li><a href='" . URLADM . "relatorio-historico/listar/?xls=1'>Baixar Relatório XLS</a></li> ";
                    }
                    if ($this->Dados['botao']['pdf']) {
                        echo "<li><a href='" . URLADM . "relatorio-historico/listar/?pdf=1'>Baixar Relatório PDF</a></li> ";
                    }
                    ?>  
                </ul>
            </div>
        </div>
        <?php
        if (empty($this->Dados['listHistorico'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum histórico encontrado!
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
                        <th>Retirada</th>
                        <th class="d-none d-sm-table-cell">Leitor</th>
                        <th class="d-none d-sm-table-cell">Codigo</th>
                        <th class="d-none d-sm-table-cell">Titulo</th>
                        <th class="d-none d-sm-table-cell">Autor</th>
                        <th class="d-none d-sm-table-cell">Editora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listHistorico'] as $h) {
                        extract($h);
                        ?>
                        <tr>
                            <td><?php echo date('d/M/Y H:i', strtotime($criado)); ?></td>
                            <td><?php echo $primeiro_nome . ' ' . $ultimo_nome; ?></td>
                            <td><?php echo $cod_bar; ?></td>
                            <td><?php echo $titulo; ?></td>
                            <td><?php echo $autor; ?></td>
                            <td><?php echo $editora; ?></td>
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