


<?php
$connect = mysqli_connect("localhost", "root", "", "form_builder_db");


// $query1= "SELECT meta_field FROM responses where SurveyId =  '" . $_GET['code'] . "'  GROUP BY meta_value";
 
$query = "SELECT meta_field,meta_value, count(meta_value) as number FROM responses where SurveyId =  '" . $_GET['code'] . "'    GROUP BY meta_value";


$result = mysqli_query($connect, $query);
while($rows=$result->fetch_assoc())  
{  
$arrayResult[] = $rows;
} 
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="Cart\styles.css">
   <?php include_once 'header.php'?>
</head>
<body>
<div class="container">

    <!-- <h1 style="font-size:4rem;">Test</h1> -->
<canvas id="NewChart"></canvas>
<div class="d-flex justify-content-center row row-centered pos">
         <button type="button" class="btn btn-primary  m-1" onclick="setChartType('bar')">Bars</button>
         <button type="button" class="btn btn-primary m-1" onclick="setChartType('line')"> Line</button>
         <button type="button" class="btn btn-primary m-1" onclick="setChartType('doughnut')">Doughnut</button>
         <button type="button" class="btn btn-primary  m-1 " onclick="setChartType('polarArea')">PolarArea</button>
         <button type="button" class="btn btn-primary m-1" onclick="setChartType('radar')">Radar</button>
</div>
        

   <div class="d-flex flex-column" id="CanvasChart">
      <!-- <canvas id="myChart"></canvas> -->
   </div>
 
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <!-- <script src="Cart\script.js"></script> -->
  
   <script>
let myChart;
// let data;
let Jsondata = [
  { "month": "Ian", "income": 1210 },
  { "month": "Feb", "income": 1920},
  { "month": "mar", "income": 830 },
  { "month": "Apr", "income": 1300 },
  { "month": "Mai", "income": 990 },
  { "month": "Jun", "income": 1250 }
];
const data = Jsondata;

let array1   = <?php echo json_encode($arrayResult); ?>;

createChart(Jsondata, 'doughnut');

let ArraCount;

function createChart(data, type){
let r =0;


result = Object.groupBy(array1, ({ meta_field }) => meta_field);


for( var index1 in result){

const keys = result[index1];

console.log(keys);
   r++;

    $("#CanvasChart").append(' <div class="d-flex justify-content-center"><canvas class="myCharts1" id="NewChart'+r+'"></canvas></div>');

    let ctx = document.getElementById('NewChart'+r);


    myChart = new Chart(ctx, {
    type: type, 
    data: {
      labels: data.map(row => row.month ), 
      datasets: [{
        label: '# of respondents',
        data: data.map(row => row.income),
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      },
      responsive: true,
      plugins: {
               legend: {position: 'top',},
               title: {display: true, text: 'test'}, // <-- title!
        },
      maintainAspectRatio: false,
      responsive: false
    }
  });

  const meta_value = keys.map(function(index){
    return index.meta_value
})


// console.log(meta_value);

// myChart.update();

const number = keys.map(function(index){
    return index.number
})

// const SurveyQUestion = keys.map(function(index){
//     return index.meta_field
// })

// console.log(number);
myChart.config.data.labels = meta_value;
myChart.config.data.datasets[0].data = number;

const surveyqustion =result[index1][0]["meta_field"];

myChart.config.options.plugins.title.text = surveyqustion;
myChart.update();

}
// let ctx = document.getElementById('myChart'+r).appendChild(document.createElement('div'));
}




function setChartType(chartType){

  const config = {
    type:'line',
    data,
    options:{}
  }

    let x = 0;
    result = Object.groupBy(array1, ({ meta_field }) => meta_field);

      for( var index1 in result){
      x++;
      const keys = result[index1];
      let chartStatus = Chart.getChart('NewChart'+x); 
      chartStatus.destroy();
      }
     UpdateChart(Jsondata, chartType);
  }


function UpdateChart(Jsondata, chartType){
let r =0;

result = Object.groupBy(array1, ({ meta_field }) => meta_field);
// console.log(result);

// result = ArraCount;


for( var index1 in result){
    // console.log(result);
const keys = result[index1];
// const meta_value1 = result[index1]['meta_field'];
// console.log(meta_value1);
console.log(keys);



   r++;

    let ctx = document.getElementById('NewChart'+r);


    myChart = new Chart(ctx, {
    type: chartType, 
    data: {
      labels: data.map(row => row.month ), 
      datasets: [{
        label: '# of respondents',
        data: data.map(row => row.income),
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      },
      responsive: true,
      plugins: {
               legend: {position: 'top',},
               title: {display: true, text: 'test'}, // <-- title!
        },
      maintainAspectRatio: false,
      responsive: false
    }
  });

  const meta_value = keys.map(function(index){
    return index.meta_value
})


// console.log(meta_value);

// myChart.update();

const number = keys.map(function(index){
    return index.number
})

// const SurveyQUestion = keys.map(function(index){
//     return index.meta_field
// })

// console.log(number);
myChart.config.data.labels = meta_value;
myChart.config.data.datasets[0].data = number;

const surveyqustion =result[index1][0]["meta_field"];

myChart.config.options.plugins.title.text = surveyqustion;
myChart.update();

}
}

   </script>
  <style>
    .home-section .text {
    display: contents !important;
}

  </style>
   </div>
</body>
</html>