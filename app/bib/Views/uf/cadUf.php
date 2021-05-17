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
                <h2 class="display-4 titulo">Cadastrar Estado</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_uf']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'uf/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
            <div class="form-row">
                <div class="col-md-6">
                    <label><span class="text-danger">*</span> Estado (nome)</label>
                    <input name="nome" type="text" class="form-control" placeholder="Nome do Esdado" value="<?php
                    if (isset($valorForm['nome'])) {
                        echo $valorForm['nome'];
                    }
                    ?>">

                    <label><span class="text-danger">*</span> Sigla</label>
                    <input name="uf" type="text" class="form-control" placeholder="Sigla do Esdado" value="<?php
                    if (isset($valorForm['uf'])) {
                        echo $valorForm['uf'];
                    }
                    ?>">
                    <small id="UfHelpBlock" class="form-text text-muted">
                        Acre - AC; Alagoas - AL; Amapá - AP; Amazonas - AM; Bahia - BA; Ceará - CE; Distrito Federal - DF; Espírito Santo - ES; Goiás - GO; Maranhão - MA; Mato Grosso - MT; Mato Grosso do Sul - MS; Minas Gerais - MG; Pará - PA; Paraíba - PB; Paraná - PR; Pernambuco - PE; Piauí - PI; Roraima - RR; Rondônia - RO; Rio de Janeiro - RJ; Rio Grande do Norte - RN; Rio Grande do Sul - RS; Santa Catarina - SC; São Paulo - SP; Sergipe - SE; Tocantins - TO.
                    </small>
                    <!-- Pais -->
                    <label><span class="text-danger">*</span> Pais</label>
                    <select name="id_pais" id="id_pais" class="form-control">
                        <option value="1">Selecione</option>
                        <?php
                        foreach ($this->Dados['select']['pais'] as $pais) {
                            extract($pais);
                            if ($valorForm['id_pais'] == $pais_id) {
                                echo "<option value='$pais_id' selected>$nome_pais</option>";
                            } else {
                                echo "<option value='$pais_id'>$nome_pais</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <!-- Logo -->
                    <div class="form-group">
                        <label><span class="text-danger"></span> Logo (270x180)</label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group">
                        <?php
                        $imagem_antiga = URLADM . 'app/bib/assets/imagens/uf/preview_img.png';
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Bandeira" id="preview-user" class="img-thumbnail" style="width: 270px; height: 180px;">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadUf" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
