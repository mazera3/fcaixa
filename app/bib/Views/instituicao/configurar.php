<?php
if (isset($this->Dados['form'])) {
    $valorForm = $this->Dados['form'];
}
if (isset($this->Dados['form'][0])) {
    $valorForm = $this->Dados['form'][0];
}
//var_dump($this->Dados['select']);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Configurar Biblioteca</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_biblioteca']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'listar-biblioteca/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
                </div>
                <?php
            }
            ?>
        </div><hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="" enctype="multipart/form-data"> 
                    <div class="form-row">
                        <label>Biblioteca </label>
                        <select name="id_site" id="id_site" class="form-control">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['site'] as $d) {
                                extract($d);
                                if ($valorForm['id_site'] == $id_biblioteca) {
                                    echo "<option value='$id_biblioteca' selected>$nome_bib</option>";
                                } else {
                                    echo "<option value='$id_biblioteca'>$nome_bib</option>";
                                }
                            }
                            ?>
                        </select>

                    </div>
                    <input name="Configurar" type="submit" class="btn btn-info" value="Salvar">
                </form>
            </div>
            <div class="col-md-6">
                <h3>Biblioteca Ativa</h3>
                <?php
                foreach ($this->Dados['list_bib'] as $b) {
                    extract($b);
                    echo '<h4 class="text-info">' . $nome_bib . ' ('.$id_site . ')</h4>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
