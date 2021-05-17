<main id="webcam-app">
    <div class="form-control webcam-start" id="webcam-control">
        <label class="form-switch">
            <input type="checkbox" id="webcam-switch">
            <i></i> 
            <span id="webcam-caption">Iniciar Câmera</span>
        </label>      
        <button id="cameraFlip" class="btn d-none"></button>                  
    </div>

    <div id="errorMsg" class="col-12 col-md-6 alert-danger d-none">
        Falha ao iniciar a câmera, dê permissão para acessar a câmera. <br/>
        Se você estiver navegando em mídias sociais integradas a navegadores, deverá abrir a página em Sarafi (iPhone) / Chrome (Android)
        <button id="closeError" class="btn btn-primary ml-3">OK</button>
    </div>
    <div class="md-modal md-effect-12">
        <div id="app-panel" class="app-panel md-content row p-0 m-0">     
            <div id="webcam-container" class="webcam-container col-12 d-none p-0 m-0">
                <video id="webcam" autoplay playsinline width="320" height="240"></video>
                <canvas id="canvas" class="d-none"></canvas>
                <div class="flash"></div>
                <audio id="snapSound" src="<?php echo URLADM . 'app/bib/assets/audio/snap.wav'; ?>" preload="auto"></audio>
            </div>
            <div id="cameraControls" class="cameraControls">
                <a href="#" id="exit-app" title="Sair do App" class="d-none"><i class="material-icons">exit_to_app</i></a>
                <a href="#" id="take-photo" title="Tirar fotos"><i class="material-icons">camera_alt</i></a>
                <a href="#" id="download-photo" download="<?php echo 'foto.png'; ?>" target="_blank" title="Salvar Foto" class="d-none"><i class="material-icons">file_download</i></a>  
                <a href="#" id="resume-camera"  title="Resumo Camera" class="d-none"><i class="material-icons">camera_front</i></a>
            </div>
        </div>        
    </div>
    <div class="md-overlay"></div>
</main>