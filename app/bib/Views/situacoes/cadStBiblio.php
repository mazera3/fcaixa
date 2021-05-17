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
                <h2 class="display-4 titulo">Cadastrar Situação Biblio</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_sits']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'situacoes/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
        <form method="POST" action="" enctype="multipart/form-data"> 
            <div class="form-group col-md-6">
                <!-- nome -->
                <label><span class="text-danger">*</span> Nome</label>
                <input name="nome" type="text" class="form-control" placeholder="Nome" value="<?php
                if (isset($valorForm['nome'])) {
                    echo $valorForm['nome'];
                }
                ?>">
            </div>
            <div class="form-group col-md-6">
                <!-- situação -->
                <label><span class="text-danger">*</span> Cor</label>
                <select name="adms_cor_id" id="adms_cor_id" class="form-control">
                    <option value="">Selecione</option>
                    <?php
                    foreach ($this->Dados['select']['cor'] as $c) {
                        extract($c);
                        if ($valorForm['adms_cor_id'] == $cor_id) {
                            echo "<option value='$cor_id' selected>$nome_cor ($cor_cor)</option>";
                        } else {
                            echo "<option value='$cor_id'>$nome_cor ($cor_cor)</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadStBiblio" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
