<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">        
    <title>Fluxo de caixa</title>
    <link rel="icon" href="<?php echo URLADM . 'assets/imagens/icone/favicon.ico'; ?>">
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
        <script defer src="<?php echo URLADM . 'assets/js/fontawesome-all.min.js'; ?>"></script>
        <script defer src="<?php echo URLADM . 'app/cx/assets/js/webcam-easy.min.js'; ?>"></script>
        <script defer src="<?php echo URLADM . 'app/cx/assets/js/form.js'; ?>"></script>
        <script defer src="<?php echo URLADM . 'assets/fontawesome/js/fontawesome.min.js'; ?>"></script>
        <link rel="stylesheet" href="<?php echo URLADM . 'assets/css/fontawesome.min.css'; ?>">
        <link rel="stylesheet" href="<?php echo URLADM . 'assets/fontawesome/css/fontawesome.min.css'; ?>">
        <link rel="stylesheet" href="<?php echo URLADM . 'assets/css/dashboard.css'; ?>">
        <link rel="stylesheet" href="<?php echo URLADM . 'app/cx/assets/css/webcam.css'; ?>">
</head>
<body>