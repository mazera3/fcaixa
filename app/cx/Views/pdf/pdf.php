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
                <h2 class="display-4 titulo">PDF de Relatórios</h2>
            </div>
        </div>
        <div class="alert alert-primary" role="alert">
           Escolha uma tabela do bando de dados e o formato (Retrato ou Paisagem) da página para gerar um PDF.
        </div>
        <form method="POST" action="">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>Selecione a Tabela</label>
                    <select name="tabela" class="custom-select">
                        <option value="">Selecione a Tabela</option>
                        <option value="bib_leitor">Leitor</option>
                        <option value="bib_biblio">Bibliografia</option>
                        <option value="bib_editora">Editoras</option>
                        <option value="bib_autores">Autores</option>
                        <option value="bib_colecao">Coleção</option>
                        <option value="bib_classificacao">Classificação</option>
                        <option value="bib_tipo_material">Material</option>
                        <option value="bib_copia">Cópias</option>
                        <option value="bib_historico">Histórico</option>
                        <option value="bib_uf">Estados (UF)</option>
                        <option value="bib_pais">Paises</option>
                        <option value="bib_municipio">Municipios</option>
                        <option value="bib_bairro">Bairros</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Formato (Retrato ou Paisagem)</label>
                    <select name="formato" class="custom-select">
                        <option value="portrait" selected="">Retrato</option>
                        <option value="landscape">Paisagem</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>Título do Relatório</label>
                    <input type="text" name="titulo" class="form-control" placeholder="Titulo">
                </div>
            </div>
            <input name="Imp" type="submit" class="btn btn-info" value="Enviar">
        </form>
        <?php
        ?>
    </div>
</div>