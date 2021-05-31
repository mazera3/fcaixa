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
                <h2 class="display-4 titulo">Gerar Backup da base de dados</h2>
            </div>
        </div>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="alert alert-info" role="alert">
            Exportar a base de dados para o diretório backup do servidor
        </div>
        <form method="POST" action="">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <?php echo "<img src='" . URLADM . "app/bib/assets/imagens/database.png' witdh='50%' height='50%'>"; ?><br/>
                    <input name="Backup" type="submit" class="btn btn-warning" value="Exportar">
                </div>
                <div class="col-md-8 mb-3" style="background-color: #F0F0F0;">
                    <?php
                    if ($this->Dados['botao']['del_backup']) {
                        //$path = SITE_ROOT . "/app/bib/assets/backup/";
                        $path = SITE_ROOT . "/backup/";
                        $diretorio = dir($path);
                        echo "<span tabindex='0' data-toggle='tooltip' data-placement='right' title='Diretório: $path'><i class='fas fa-question-circle'></i></span>";
                        echo "<h3>Lista de Arquivos de Backup</h3>";
                        while ($arquivo = $diretorio->read()) {
                            // AND pathinfo($arquivo, PATHINFO_EXTENSION) == '.sql'
                            if (is_file($path . $arquivo ) AND pathinfo($arquivo, PATHINFO_EXTENSION) == 'sql') {
                                echo '<table class="table table-striped table-hover table-bordered table-sm"><tr>';
                                echo '<td>';
                            // echo "<a href='" . URLADM . "app/bib/assets/backup/" . $arquivo . "'>" . $arquivo . "</a><br />";
                                echo "<a href='" . URLADM . "backup/" . $arquivo ."'>" . $arquivo . "</a><br />";
                                echo '</td>';
                                echo '<td>';
                                echo "<a href='" . URLADM . "backup/backup?bk=$path$arquivo' class='badge badge-danger' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                echo '</td>';
                                echo '</tr></table>';
                            }
                        }
                        $diretorio->close();
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Gerar Backup dos arquivos de imagens</h2>
            </div>
        </div>
        <div class="alert alert-warning" role="alert">
            Fazer backup dos arquivos
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <form method="POST" action="">
                    <input name="BkArquivos" type="submit" class="btn btn-info" value="BkArquivos">
                </form>
            </div>
            <div class="col-md-8 mb-3" style="background-color: #F0F0F0;">
                <?php
                if ($this->Dados['botao']['del_backup']) {
                    $path = SITE_ROOT . "/backup/";
                    $diretorio = dir($path);
                    echo "<span tabindex='0' data-toggle='tooltip' data-placement='right' title='Diretório: $path'><i class='fas fa-question-circle'></i></span>";
                    echo "<h3>Lista de Arquivos de Backup</h3>";
                    while ($arquivo = $diretorio->read()) {
                        if (is_file($path . $arquivo) AND pathinfo($arquivo, PATHINFO_EXTENSION) == 'zip') {
                            echo '<table class="table table-striped table-hover table-bordered table-sm"><tr>';
                            echo '<td>';
                            echo "<a href='" . URLADM . "backup/" . $arquivo . "'>" . $arquivo . "</a><br />";
                            echo '</td>';
                            echo '<td>';
                            echo "<a href='" . URLADM . "backup/backup?bk=$path$arquivo' class='badge badge-danger' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                            echo '</td>';
                            echo '</tr></table>';
                        }
                    }
                    $diretorio->close();
                }
                ?>
            </div>
        </div>
    </div>
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Recupera um Backup da Base de dados</h2>
            </div>
        </div>
        <div class="alert alert-danger" role="alert">
            Restaurar a base de dados para o servidor
        </div>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-row">
                <label>Arquivo SQL</label>
                <input type="file" name="file"><br><br>
                <input name="Restaurar" type="submit" class="btn btn-danger" value="Importar">
            </div>
        </form>
    </div>
</div>
