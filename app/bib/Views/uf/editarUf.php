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
                <h2 class="display-4 titulo">Editar Estado</h2>
            </div>

            <?php
            if ($this->Dados['botao']['vis_uf']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'ver-uf/ver-uf/' . $valorForm['uf_id']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
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
            <input name="uf_id" type="hidden" value="<?php
            if (isset($valorForm['uf_id'])) {
                echo $valorForm['uf_id'];
            }
            ?>">
            <div class="form-row">
                <!-- Nome do estado -->
                <div class="col-md-6">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label><span class="text-danger">*</span> Estado (nome)</label>
                            <input name="nome" type="text" class="form-control" placeholder="Nome do Estado" value="<?php
                            if (isset($valorForm['nome'])) {
                                echo $valorForm['nome'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <!-- Sigla do estado -->
                            <label><span class="text-danger">*</span> Sigla</label>
                            <input name="uf" type="text" class="form-control" placeholder="Sigla do Estado" value="<?php
                            if (isset($valorForm['uf'])) {
                                echo $valorForm['uf'];
                            }
                            ?>">
                        </div>
                    </div>
                    <!-- Pais -->
                    <label>Pais</label>
                    <select name="id_pais" id="id_pais" class="form-control">
                        <option value="">Selecione</option>
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
                    <div class="form-group">
                        <input name="imagem_antiga" type="hidden" value="<?php
                        if (isset($valorForm['imagem_antiga'])) {
                            echo $valorForm['imagem_antiga'];
                        } elseif (isset($valorForm['logo_imagem'])) {
                            echo $valorForm['logo_imagem'];
                        }
                        ?>">
                        <label>Bandeira (270x180)</label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group">
                        <?php
                        if (isset($valorForm['logo_imagem']) AND!empty($valorForm['logo_imagem'])) {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/uf/' . $valorForm['uf_id'] . '/' . $valorForm['logo_imagem'];
                        } elseif (isset($valorForm['imagem_antiga']) AND!empty($valorForm['imagem_antiga'])) {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/uf/' . $valorForm['uf_id'] . '/' . $valorForm['imagem_antiga'];
                        } else {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/uf/logo_bandeira.jpg';
                        }
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Imagem da bandeira" id="preview-user" class="img-thumbnail" style="width: 270px; height: 180px;">
                    </div>
                </div>
                <small id="UfHelpBlock" class="form-text text-muted">
Exemplos de siglas: Acre - AC; Alagoas - AL; Amapá - AP; Amazonas - AM; Bahia - BA; Ceará - CE; Distrito Federal - DF; Espírito Santo - ES; Goiás - GO; Maranhão - MA; Mato Grosso - MT; Mato Grosso do Sul - MS; Minas Gerais - MG; Pará - PA; Paraíba - PB; Paraná - PR; Pernambuco - PE; Piauí - PI; Roraima - RR; Rondônia - RO; Rio de Janeiro - RJ; Rio Grande do Norte - RN; Rio Grande do Sul - RS; Santa Catarina - SC; São Paulo - SP; Sergipe - SE; Tocantins - TO.
                    </small>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="EditUf" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
