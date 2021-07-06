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
                <h2 class="display-4 titulo">Gerar QrCode</h2>
            </div>
        </div>
        <div class="alert alert-primary" role="alert">
           Escolha uma tabela do bando de dados para gerar os QrCode.
        </div>
        <form method="POST" action="">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>Selecione a Tabela</label>
                    <select name="tabela" class="custom-select">
                        <option value="">Selecione a Tabela</option>
                        <option value="bib_leitor">Leitor</option>
                        <option value="bib_copia">Cópias</option>
                        <option value="bib_biblio">Bibliografia</option>
                        <option value="bib_uf">UF</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Imprimir ou Baixar</label>
                    <select name="tipo" class="custom-select">
                        <option value="imprimir" selected="">Imprimir Etiquetas PDF</option>
                        <option value="download">Baixar PNG</option>
                        <option value="texto">Somente Texto</option>
                        <option value="matrix">Imagem + Texto</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>Nome do Arquivo</label>
                    <input type="text" name="slug" class="form-control" placeholder="Titulo">
                </div>
            </div>
            <input name="QrCode" type="submit" class="btn btn-info" value="Enviar">
        </form>
        <?php
        //var_dump($this->Dados['listQr']);
        //echo '<img src="' . $this->Dados['listQr'] . '" />';
        ?>
    </div>
</div>