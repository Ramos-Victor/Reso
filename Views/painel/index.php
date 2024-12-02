<?php
require_once './Views/painel/header.php';

?>

<body>
    <?php
    require_once './Views/painel/nav.php';
    ?>
    <br><br><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4" id="card-container">
            </div>
            <div class="col-sm-4 chart-container" style="position: relative;">
                <canvas id="ticketClosureChart"></canvas>
            </div>
            <div class="col-sm-4 chart-container" style="position: relative;">
                <canvas id="ticketOpeningChart"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 chart-container" style="position: relative;">
                <canvas id="ticketCategoryChart"></canvas>
            </div>
            <div class="col-sm-4 chart-container" style="position: relative;">
                <canvas id="ticketMediaChart"></canvas>
            </div>
        </div>
    </div>
    <?php
    include_once 'footer.php';
    ?>
</body>
<script>
function carregarCards() {
    $.ajax({
        url: '?route=/painelAjax',
        method: 'GET',
        success: function(data) {
            $('#card-container').html(data);
        },
        error: function() {
            console.error('Erro ao carregar os cards');
        }
    });
}

function carregarMediaAVA() {
    $.ajax({
        url: '?route=/dadosGraficoMediaAVA',
        method: 'GET',
        dataType: 'json',
        success: function(dados) {
            var ctx = document.getElementById('ticketMediaChart').getContext('2d');
            
            if (window.ticketMediaChart instanceof Chart) {
                window.ticketMediaChart.destroy();
            }
            
            window.ticketMediaChartt = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dados.usuario,
                    datasets: [{
                        label: 'Média das avaliações',
                        data: dados.mediaAVA,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: false,
                                text: 'Número de Chamados'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Média notas avaliações dos chamados',
                            padding: {
                                top: 10,
                                bottom: 10
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        },
        error: function() {
            console.error('Erro ao carregar dados do gráfico');
        }
    });
}

function carregarGraficoFechamento() {
    $.ajax({
        url: '?route=/dadosGraficoFechamento',
        method: 'GET',
        dataType: 'json',
        success: function(dados) {
            var ctx = document.getElementById('ticketClosureChart').getContext('2d');
            
            if (window.ticketClosureChart instanceof Chart) {
                window.ticketClosureChart.destroy();
            }
            
            // Configurações do gráfico
            window.ticketClosureChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dados.usuarios,
                    datasets: [{
                        label: 'Chamados Concluidos',
                        data: dados.qtdChamados,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: false,
                                text: 'Número de Chamados'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Desempenho de Fechamento de Chamados',
                            padding: {
                                top: 10,
                                bottom: 10
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        },
        error: function() {
            console.error('Erro ao carregar dados do gráfico');
        }
    });
}

function carregarGraficoAbertura() {
    $.ajax({
        url: '?route=/dadosGraficoAbertura',
        method: 'GET',
        dataType: 'json',
        success: function(dados) {
            var ctx = document.getElementById('ticketOpeningChart').getContext('2d');
            
            if (window.ticketOpeningChart instanceof Chart) {
                window.ticketOpeningChart.destroy();
            }
            
            window.ticketOpeningChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dados.usuarios,
                    datasets: [{
                        label: 'Chamados Abertos',
                        data: dados.qtdChamados,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: false,
                                text: 'Número de Chamados'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Usuarios que mais abrem chamados',
                            padding: {
                                top: 10,
                                bottom: 10
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        },
        error: function() {
            console.error('Erro ao carregar dados do gráfico');
        }
    });
}

function carregarGraficoCategoria() {
    $.ajax({
        url: '?route=/dadosGraficoCategoria',
        method: 'GET',
        dataType: 'json',
        success: function(dados) {
            var ctx = document.getElementById('ticketCategoryChart').getContext('2d');
            
            if (window.ticketCategoryChart instanceof Chart) {
                window.ticketCategoryChart.destroy();
            }
            
            window.ticketCategoryChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dados.Categoria,
                    datasets: [{
                        label: 'Qtd Categoria Chamado',
                        data: dados.qtdChamados,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: false,
                                text: 'Número de Chamados'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Categorias listadas nos chamados',
                            padding: {
                                top: 10,
                                bottom: 10
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        },
        error: function() {
            console.error('Erro ao carregar dados do gráfico');
        }
    });
}

$(document).ready(function() {
    carregarCards();
    carregarGraficoFechamento();
    carregarGraficoAbertura();
    carregarGraficoCategoria();
    carregarMediaAVA();
    
    $('.chart-container').css({
        'position': 'relative',
        'height': '300px',
        'width': '100%'
    });
    
    setInterval(carregarCards, 5000);
    setInterval(carregarGraficoFechamento, 50000);
    setInterval(carregarGraficoCategoria, 50000);
    setInterval(carregarGraficoAbertura, 50000);
    setInterval(carregarMediaAVA, 50000);
});
</script>