<?php 
# importando o arquivo php, responsavel por mexer com a base de dados
require 'conexicao.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ELEIÇÃO CIPA</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/candidatos.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
</head>

<body>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/highcharts-3d.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>

  <figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
      Mova os controles deslizantes abaixo para alterar as configurações 3D básicas do gráfico.
    </p>
    <div id="sliders">
      <table>
        <tr>
          <td><label for="alpha">Alpha Angle</label></td>
          <td><input id="alpha" type="range" min="0" max="45" value="15" /> <span id="alpha-value" class="value"></span>
          </td>
        </tr>
        <tr>
          <td><label for="beta">Beta Angle</label></td>
          <td><input id="beta" type="range" min="-45" max="45" value="15" /> <span id="beta-value" class="value"></span>
          </td>
        </tr>
        <tr>
          <td><label for="depth">Depth</label></td>
          <td><input id="depth" type="range" min="20" max="100" value="50" /> <span id="depth-value"
              class="value"></span></td>
        </tr>
      </table>
    </div>
  </figure>

  <figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
      Escolha o método de visualização
    </p>
    <!--====Butões para alterar a previsualização do gráfico===-->
    <a href="pie3D.php"><button id="inverted">PIZZA</button></a>
    <a href="Colum3D.php"><button id="plain">BARRAS</button></a>
    <a href="home.html"><button id="polar">VOLTAR</button></a>

  </figure>

  <script type="text/javascript">
    // Set up the chart
var chart = Highcharts.chart('container', {
      chart: {
        renderTo: 'container',
        type: 'column',
        options3d: {
          enabled: true,
          alpha: 15,
          beta: 15,
          depth: 50,
          viewDistance: 25
        }
      },
      xAxis: {
        categories: ['André',
          'Caleb',
          'Daniel',
          'Emanuel',
          'Felipe',
          'Gabriel',
          'João',
          'José',
          'Lucas',
          'Matheus',
          'Marcos',
          'Miguel',
          'Noah',
          'Pedro',
          'Tiago',
          'Rafael'
        ]
      },
      yAxis: {
        title: {
          enabled: false
        }
      },
      tooltip: {
        headerFormat: '<b>{point.key}</b><br>',
        pointFormat: 'TOTAL DE VOTOS: {point.y}'
      },
      title: {
        text: 'GRÁFICO DO RESULTADO DOS VOTOS POR ORDEM ALFABÉTICA',
        align: 'left'
      },

      legend: {
        enabled: false
      },
      plotOptions: {
        column: {
          depth: 25
        }
      },
      series: [{
        data: [
          /*Alterando os dados do gráfico de uma forma dinâmica
        essa estrutura de condição vai apresentar no gráfico o candidato do candidato
        e os votos, de acordo com os dados que estiver na
        base de dados
        */
          <?php while ($resultado = $busca->fetch()) { ?>['<?= $resultado->candidato ?>', <?= $resultado->votos ?>],
          <?php } ?>
        ],
      colorByPoint: true
    }]
        });

    function showValues() {
      document.getElementById('alpha-value').innerHTML = chart.options.chart.options3d.alpha;
      document.getElementById('beta-value').innerHTML = chart.options.chart.options3d.beta;
      document.getElementById('depth-value').innerHTML = chart.options.chart.options3d.depth;
    }

    // Activate the sliders
    document.querySelectorAll('#sliders input').forEach(input => input.addEventListener('input', e => {
      chart.options.chart.options3d[e.target.id] = parseFloat(e.target.value);
      showValues();
      chart.redraw(false);
    }));

    showValues();
  </script>
</body>

</html>