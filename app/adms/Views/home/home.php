<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<div class="content p-1">
    <div class="col-lg-12 col-sm-6">
        <div class="card text-dark text-center" style="background-color: #ffffff">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-9">
                        <h2 class="card-title"><i class="fas fa-dollar-sign fa-1x"></i> Fluxo de Caixa</h2>
                        <span>Organizador: Profº Édio Mazera - mazera3@gmail.com </span>
                    </div>
                    <?php if (empty($_SESSION['usuario_id'])) { ?>
                        <div class="col-sm-3">
                            <form class="form-signin" method="POST" action="<?php echo URLADM . 'login/acesso' ?>">
                                <?php
                                if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                }
                                if (isset($this->Dados['form'])) {
                                    $valorForm = $this->Dados['form'];
                                }
                                ?>
                                <div class="form-group">
                                    <input name="usuario" type="text" class="form-control" placeholder="Digite o usuário" value="<?php
                                                                                                                                    if (isset($valorForm['usuario'])) {
                                                                                                                                        echo $valorForm['usuario'];
                                                                                                                                    }
                                                                                                                                    ?>">
                                </div>
                                <div class="form-group">
                                    <input name="senha" type="password" class="form-control" placeholder="Digite a senha">
                                </div>
                                <input name="SendLogin" type="submit" class="btn btn-sm btn-primary btn-block" value="Acessar">
                                <a href="<?php echo URLADM . 'esqueceu-senha/esqueceu-senha' ?>">Esqueceu a senha?</a></p>
                            </form>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <?php if (isset($_SESSION['usuario_id'])) {
                        $labels = ' ';
                        $data = 0;
                        foreach ($this->Dados['mes_atual'] as $ma) {
                            extract($ma);
                            $labels .= $descricao .',';
                            $data .= intval($valor) . ',';
                        }
                        $labels = explode(',', $labels);
                        $labels = json_encode($labels,JSON_UNESCAPED_UNICODE);
                        $data = explode(',', $data);
                        $data = json_encode($data,JSON_UNESCAPED_UNICODE);
                        
                    ?>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <div class="container" width="100px" height="100px">
                            <canvas id="myChart"></canvas>
                        </div>
                        <script>
                            const COLORS = [
                                '#4dc9f6',
                                '#f67019',
                                '#f53794',
                                '#537bc4',
                                '#acc236',
                                '#166a8f',
                                '#00a950',
                                '#58595b',
                                '#8549ba'
                            ];
                            const COLORS_BORD = [
                                '#4dc9a1',
                                '#c67019',
                                '#f53194',
                                '#537bf4',
                                '#aff236',
                                '#166f8f',
                                '#00a95f',
                                '#5f595b',
                                '#8f49ba'
                            ];
                            let data = <?php echo $data ?>;
                            let labels = <?php echo $labels ?>;
                            let legenda = "<?php echo 'Mês: ' . date('M') ?>";
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,//['Telefone Fixo','Energia Elétrica','Mirix Telecomunicações - Neorede','Loja Piffer','Hostgator Hospedagem','Mercado Livre','Agropecuária Popular','Tarifas BB','Farmácia','Gasolina','Celular','Peças para PC\/Celular','Farmácia','Peças para PC\/Celular','Pizza\/Salgados','Funcional','Biz 110i','Mercados'],
                                    datasets: [{
                                        label: legenda,
                                        data: data,//[017,333,80,359,34,194,528,22,177,103,20,100,26,150,60,198,340,1105,],
                                        borderColor: COLORS_BORD,
                                        backgroundColor: COLORS,
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                            labels: {
                                                usePointStyle: true,
                                            },
                                        },
                                        title: {
                                            display: true,
                                            text: "Balanço do mes Atual",
                                            color: 'blue',
                                            font: {
                                                size: 32,
                                                family: 'tahoma',
                                                weight: 'normal',
                                                style: 'bold'
                                            }
                                        },
                                    },
                                    scales: {
                                        x: {
                                            display: true,
                                            title: {
                                                display: true,
                                                text: 'Discriminação',
                                                color: 'black',
                                                font: {
                                                    size: 16
                                                }
                                            },
                                            grid: {
                                                color: 'rgba(0,0,0,0.7)',
                                                display: true,
                                                drawBorder: true,
                                                drawOnChartArea: true,
                                                drawTicks: true,
                                            }
                                        },
                                        y: {
                                            display: true,
                                            min: 0,
                                            title: {
                                                display: true,
                                                text: 'Valor',
                                                color: 'black',
                                                font: {
                                                    size: 16
                                                }
                                            },
                                            grid: {
                                                color: 'rgba(0,0,0,0.5)',
                                                display: true,
                                                drawBorder: true,
                                                drawOnChartArea: true,
                                                drawTicks: true,
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                    <?php
                    } ?>

                </div>
            </div>
        </div>
    </div>