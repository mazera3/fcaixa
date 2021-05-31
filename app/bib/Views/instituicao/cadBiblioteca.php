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
                <h2 class="display-4 titulo">Cadastrar Biblioteca</h2>
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
        <form method="POST" action="" enctype="multipart/form-data"> 
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Nome da Biblioteca</label>
                    <input name="nome_bib" type="text" class="form-control" placeholder="Nome da Biblioteca" value="<?php
                    if (isset($valorForm['nome_bib'])) {
                        echo $valorForm['nome_bib'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Nome da Instituição</label>
                    <input name="nome_inst" type="text" class="form-control" placeholder="Nome da Instituição" value="<?php
                    if (isset($valorForm['nome_inst'])) {
                        echo $valorForm['nome_inst'];
                    }
                    ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label><span class="text-danger">*</span> Organizador Responsável 1</label>
                    <input name="resp_bib_1" type="text" class="form-control" placeholder="Organizador Responsável 1" value="<?php
                    if (isset($valorForm['resp_bib_1'])) {
                        echo $valorForm['resp_bib_1'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-3">
                    <label><span class="text-danger">*</span> E-mail do Responsável 1</label>
                    <input name="email_res_1" type="email" class="form-control" placeholder="E-mail do Responsável 1" value="<?php
                    if (isset($valorForm['email_res_1'])) {
                        echo $valorForm['email_res_1'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-3">
                    <label>Organizador Responsável 2</label>
                    <input name="resp_bib_2" type="text" class="form-control" placeholder="Organizador Responsável 2" value="<?php
                    if (isset($valorForm['resp_bib_2'])) {
                        echo $valorForm['resp_bib_2'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-3">
                    <label>E-mail do Responsável 2</label>
                    <input name="email_res_2" type="email" class="form-control" placeholder="E-mail do Responsável 2" value="<?php
                    if (isset($valorForm['email_res_2'])) {
                        echo $valorForm['email_res_2'];
                    }
                    ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Horário de Funcionamento</label>
                    <input name="horario_bib" type="text" class="form-control" placeholder="Horário de Funcionamento" value="<?php
                    if (isset($valorForm['horario_bib'])) {
                        echo $valorForm['horario_bib'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Horário Especial</label>
                    <input name="horario_esp" type="text" class="form-control" placeholder="Horário Especial" value="<?php
                    if (isset($valorForm['horario_esp'])) {
                        echo $valorForm['horario_esp'];
                    }
                    ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Endereço da Biblioteca</label>
                    <input name="endereco_bib" type="text" class="form-control" placeholder="Endereço da Biblioteca" value="<?php
                    if (isset($valorForm['endereco_bib'])) {
                        echo $valorForm['endereco_bib'];
                    }
                    ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Telefone da Biblioteca</label>
                    <input name="fone_bib" type="text" class="form-control" placeholder="fone" value="<?php
                    if (isset($valorForm['fone_bib'])) {
                        echo $valorForm['fone_bib'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>E-mail da Biblioteca</label>
                    <input name="email_bib" type="email" class="form-control" placeholder="E-mail da biblioteca" value="<?php
                    if (isset($valorForm['email_bib'])) {
                        echo $valorForm['email_bib'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Celular / WhatsApp</label>
                    <input name="whatsapp" type="text" class="form-control" placeholder="WhatsApp" value="<?php
                    if (isset($valorForm['whatsapp'])) {
                        echo $valorForm['whatsapp'];
                    }
                    ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Tema </label>
                    <span class="badge badge-primary">Primary</span>
                    <span class="badge badge-secondary">Secondary</span>
                    <span class="badge badge-success">Success</span>
                    <span class="badge badge-danger">Danger</span>
                    <span class="badge badge-warning">Warning</span>
                    <span class="badge badge-info">Info</span>
                    <span class="badge badge-light">Light</span>
                    <span class="badge badge-dark">Dark</span>
                    <select name="tema" id="tema" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($this->Dados['select']['tema'] as $t) {
                            extract($t);
                            if ($valorForm['tema'] == $cor_id) {
                                echo "<option value='$cor_id' selected>$nome_cor ($cor_cor)</option>";
                            } else {
                                echo "<option value='$cor_id'>$nome_cor ($cor_cor)</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <!-- Logo -->
                    <div class="form-group">
                        <label><span class="text-danger"></span> Logo (200x200)</label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group">
                        <?php
                        $imagem_antiga = URLADM . 'app/bib/assets/imagens/biblioteca/logo.jpeg';
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Logo" id="preview-user" class="img-thumbnail" style="width: 200px; height: 200px;">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadBiblioteca" type="submit" class="btn btn-info" value="Cadastrar">
        </form>
    </div>
</div>
