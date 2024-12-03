<?php
require_once './Views/painel/header.php';

?>

<body>
    <?php
    require_once './Views/painel/nav.php';
    ?>
    <br><br><br><br>
    <div class="container-fluid mt-3">
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
            <div class="col-sm-4 chart-container" style="position: relative;">
                <canvas id="ticketSalaChart"></canvas>
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

function carregarGraficoSala() {
    $.ajax({
        url: '?route=/dadosGraficoSala',
        method: 'GET',
        dataType: 'json',
        success: function(dados) {
            const months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 
                            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

            const ctx = document.getElementById('ticketSalaChart').getContext('2d');
            const colorPalette = [
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 99, 132, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(199, 199, 199, 0.6)',
                'rgba(83, 102, 255, 0.6)',
                'rgba(40, 159, 64, 0.6)'
            ];

            if (window.ticketSalaChart instanceof Chart) {
                window.ticketSalaChart.destroy();
            }

            const allRooms = dados && dados.length > 0
                ? [...new Set(dados.flatMap(period => period.Salas))]
                : [''];
            
            const datasets = dados && dados.length > 0
                ? dados.map((period, index) => {
                    const roomData = allRooms.map(room => {
                        const roomIndex = period.Salas.indexOf(room);
                        return roomIndex !== -1 ? period.QtdChamados[roomIndex] : 0;
                    });

                    return {
                        label: `${months[period.Mes - 1]} ${period.Ano}`,
                        data: roomData,
                        backgroundColor: colorPalette[index % colorPalette.length],
                        borderColor: colorPalette[index % colorPalette.length].replace('0.6', '1'),
                        borderWidth: 2
                    };
                })
                : [{
                    label: '',
                    data: [0],
                    backgroundColor: 'rgba(199, 199, 199, 0.6)',
                    borderColor: 'rgba(199, 199, 199, 1)',
                    borderWidth: 2
                }];

            window.ticketSalaChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: allRooms,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Número de Chamados'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Chamados por Sala por Mês',
                            padding: {
                                top: 10,
                                bottom: 10
                            }
                        },
                        legend: {
                            display: dados.length > 0, 
                            position: 'top',
                            onClick: (evt, legendItem, legend) => {
                                const index = legendItem.datasetIndex;
                                const chart = legend.chart;
                                const meta = chart.getDatasetMeta(index);
                                meta.hidden = !meta.hidden;
                                chart.update();
                            }
                        }
                    }
                }
            });

            console.log('Períodos disponíveis:', dados.map(period => `${months[period.Mes - 1]} ${period.Ano}`));
        },
        error: function() {
            console.error('Erro ao carregar dados do gráfico de salas.');
        }
    });
}

function carregarMediaAVA() {
    $.ajax({
        url: '?route=/dadosGraficoMediaAVA',
        method: 'GET',
        dataType: 'json',
        success: function(dados) {
            const ctx = document.getElementById('ticketMediaChart').getContext('2d');
            const months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 
                            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
            const colorPalette = [
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 99, 132, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(199, 199, 199, 0.6)',
                'rgba(83, 102, 255, 0.6)',
                'rgba(40, 159, 64, 0.6)'
            ];

            const allUsers = dados && dados.length > 0
                ? [...new Set(dados.flatMap(period => period.Usuarios))]
                : [];
            
            const datasets = dados && dados.length > 0
                ? dados.map((period, index) => {
                    const userData = allUsers.map(user => {
                        const userIndex = period.Usuarios.indexOf(user);
                        return userIndex !== -1 ? period.MediaAVA[userIndex] : 0;
                    });

                    return {
                        label: `Média ${months[period.Mes - 1]} ${period.Ano}`,
                        data: userData,
                        backgroundColor: colorPalette[index % colorPalette.length],
                        borderColor: colorPalette[index % colorPalette.length].replace('0.6', '1'),
                        borderWidth: 2
                    };
                })
                : []; 

            if (window.ticketMediaChart instanceof Chart) {
                window.ticketMediaChart.destroy();
            }

            window.ticketMediaChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: allUsers.length > 0 ? allUsers : [''], 
                    datasets: datasets.length > 0
                        ? datasets
                        : [{ 
                            label: '',
                            data: [0],
                            backgroundColor: 'rgba(199, 199, 199, 0.6)',
                            borderColor: 'rgba(199, 199, 199, 1)',
                            borderWidth: 2
                        }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Média das Avaliações'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Média de notas por mês',
                            padding: {
                                top: 10,
                                bottom: 10
                            }
                        },
                        legend: {
                            display: datasets.length > 0, 
                            position: 'top',
                            onClick: (evt, legendItem, legend) => {
                                const index = legendItem.datasetIndex;
                                const chart = legend.chart;
                                const meta = chart.getDatasetMeta(index);
                                meta.hidden = !meta.hidden;
                                chart.update();
                            }
                        }
                    }
                }
            });

            if (!dados || dados.length === 0) {
                console.warn('Nenhum dado encontrado, gráfico renderizado vazio.');
            }
        },
        error: function() {
            console.error('Erro ao carregar dados do gráfico de média das avaliações.');
        }
    });
}


function carregarGraficoFechamento() {
    $.ajax({
        url: '?route=/dadosGraficoFechamento',
        method: 'GET',
        dataType: 'json',
        success: function(dados) {
            const months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

            const ctx = document.getElementById('ticketClosureChart').getContext('2d');
            const colorPalette = [
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 99, 132, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(199, 199, 199, 0.6)',
                'rgba(83, 102, 255, 0.6)',
                'rgba(40, 159, 64, 0.6)'
            ];

            if (window.ticketClosureChart instanceof Chart) {
                window.ticketClosureChart.destroy();
            }

            if (dados.length === 0) {
                console.warn('Nenhum dado encontrado para o gráfico de fechamento.');
                window.ticketClosureChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [],
                        datasets: []
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Número de Chamados Concluídos'
                                }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Desempenho de Fechamento de Chamados por Período',
                                padding: {
                                    top: 10,
                                    bottom: 10
                                }
                            },
                            legend: {
                                display: false
                            }
                        }
                    }
                });
                return;
            }

            const allUsers = [...new Set(dados.flatMap(period => period.Usuarios))];

            const datasetsWithColors = dados.map((periodData, index) => {
                const userData = allUsers.map(user => {
                    const userIndex = periodData.Usuarios.indexOf(user);
                    return userIndex !== -1 ? periodData.QtdChamados[userIndex] : 0;
                });

                return {
                    label: `Chamados - ${months[periodData.Mes - 1]} ${periodData.Ano}`,
                    data: userData,
                    backgroundColor: colorPalette[index % colorPalette.length],
                    borderColor: colorPalette[index % colorPalette.length].replace('0.6', '1'),
                    borderWidth: 2,
                };
            });

            window.ticketClosureChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: allUsers,
                    datasets: datasetsWithColors
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Número de Chamados Concluídos'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Desempenho de Fechamento de Chamados por Período',
                            padding: {
                                top: 10,
                                bottom: 10
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top',
                            onClick: (evt, legendItem, legend) => {
                                const index = legendItem.datasetIndex;
                                const chart = legend.chart;
                                const meta = chart.getDatasetMeta(index);
                                meta.hidden = !meta.hidden;
                                chart.update();
                            }
                        }
                    }
                }
            });
        },
        error: function() {
            console.error('Erro ao carregar dados do gráfico de fechamento.');
        }
    });
}

function carregarGraficoAbertura() {
    $.ajax({
        url: '?route=/dadosGraficoAbertura',
        method: 'GET',
        dataType: 'json',
        success: function(dados) {
            const months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
            
            const ctx = document.getElementById('ticketOpeningChart').getContext('2d');
            const colorPalette = [
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 99, 132, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(199, 199, 199, 0.6)',
                'rgba(83, 102, 255, 0.6)',
                'rgba(40, 159, 64, 0.6)'
            ];

            if (window.ticketOpeningChart instanceof Chart) {
                window.ticketOpeningChart.destroy();
            }

            if (dados.length === 0) {
                console.warn('Nenhum dado encontrado para o gráfico');
                window.ticketOpeningChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [],
                        datasets: []
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Número de Chamados'
                                }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Aberturas de chamados de usuario por período',
                                padding: {
                                    top: 10,
                                    bottom: 10
                                }
                            },
                            legend: {
                                display: false
                            }
                        }
                    }
                });
                return;
            }

            const allUsers = [...new Set(dados.flatMap(period => period.Usuarios))];

            const datasetsWithColors = dados.map((periodData, index) => {
                const userData = allUsers.map(user => {
                    const userIndex = periodData.Usuarios.indexOf(user);
                    return userIndex !== -1 ? periodData.QtdChamados[userIndex] : 0;
                });

                return {
                    label: `Chamados - ${months[periodData.Mes - 1]} ${periodData.Ano}`,
                    data: userData,
                    backgroundColor: colorPalette[index % colorPalette.length],
                    borderColor: colorPalette[index % colorPalette.length].replace('0.6', '1'),
                    borderWidth: 2,
                };
            });

            window.ticketOpeningChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: allUsers,
                    datasets: datasetsWithColors
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Número de Chamados'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Aberturas de chamados de usuario por período',
                            padding: {
                                top: 10,
                                bottom: 10
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top',
                            onClick: (evt, legendItem, legend) => {
                                const index = legendItem.datasetIndex;
                                const chart = legend.chart;
                                const meta = chart.getDatasetMeta(index);
                                meta.hidden = !meta.hidden;
                                chart.update();
                            }
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
            const months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
            
            const ctx = document.getElementById('ticketCategoryChart').getContext('2d');
            const colorPalette = [
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 99, 132, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(199, 199, 199, 0.6)',
                'rgba(83, 102, 255, 0.6)',
                'rgba(40, 159, 64, 0.6)',
                'rgba(210, 99, 132, 0.6)',
                'rgba(90, 162, 235, 0.6)',
                'rgba(255, 69, 0, 0.6)'
            ];

            if (window.ticketCategoryChart instanceof Chart) {
                window.ticketCategoryChart.destroy();
            }

            if (dados.length === 0) {
                console.warn('Nenhum dado encontrado para o gráfico');
                window.ticketCategoryChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [],
                        datasets: []
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Número de Chamados'
                                }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Categorias de Chamados por Período',
                                padding: {
                                    top: 10,
                                    bottom: 10
                                }
                            },
                            legend: {
                                display: false
                            }
                        }
                    }
                });
                return;
            }
            
            const allCategories = [...new Set(dados.flatMap(period => period.Categorias))];
            
            const datasetsWithColors = dados.map((periodData, index) => {
                const categoryData = allCategories.map(category => {
                    const categoryIndex = periodData.Categorias.indexOf(category);
                    return categoryIndex !== -1 ? periodData.QtdChamados[categoryIndex] : 0;
                });
                
                return {
                    label: `Chamados - ${months[periodData.Mes - 1]} ${periodData.Ano}`,
                    data: categoryData,
                    backgroundColor: colorPalette[index % colorPalette.length],
                    borderColor: colorPalette[index % colorPalette.length].replace('0.6', '1'),
                    borderWidth: 2
                };
            });
            
            window.ticketCategoryChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: allCategories,
                    datasets: datasetsWithColors
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Número de Chamados'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Categorias de Chamados por Período',
                            padding: {
                                top: 10,
                                bottom: 10
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top',
                            onClick: (evt, legendItem, legend) => {
                                const index = legendItem.datasetIndex;
                                const chart = legend.chart;
                                const meta = chart.getDatasetMeta(index);
                                meta.hidden = !meta.hidden;
                                chart.update();
                            }
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
    carregarGraficoSala();
    
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
    setInterval(carregarGraficoSala,50000)
});
</script>