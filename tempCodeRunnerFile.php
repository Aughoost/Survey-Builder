<?php
$connect = mysqli_connect("localhost", "root", "", "form_builder_db");


$query1= "SELECT meta_field FROM responses where SurveyId =  '" . $_GET['code'] . "'  GROUP BY meta_value";
 
$query = "SELECT meta_field,meta_value, count(meta_value) as number FROM responses where SurveyId =  '" . $_GET['code'] . "'   GROUP BY meta_value";


$result = mysqli_query($connect, $query);
 
// while($row = mysqli_fetch_array($result))  
// {  
//      echo "['".$row["meta_field"]."','".$row["meta_value"]."','".$row["number"]."']";
// }
// SELECT meta_field,meta_value, count(meta_value) as number FROM `responses` WHERE SurveyId = 9240875571 and meta_field = "What is your age" GROUP BY meta_value;
?>


<!DOCTYPE html>
<html>

<head>

     <!-- <script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script>  -->
     <!-- <script src="js\surveyanswer.js"></script>
     -->
     <!-- <script src="node_modules\core-js\actual\array\group-by.js"></script>
     <script src="node_modules\core-js\actual\array\group-by-to-map.js"></script> -->
     <!-- <script src="node_modules\core-js\actual\array\group-by.js"></script>
     <script src="node_modules\core-js\actual\array\group-to-map.js"></script> -->
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <!-- <script type="module" src="node_modules\core-js\actual\array\group-by.js"></script>
     <script type="module" src="node_modules\core-js\actual\array\group-by-to-map.js"></script> -->
     <?php
               while($rows=$result->fetch_assoc())  
               {  
             $arrayResult[] = $rows;
} 

// echo json_encode($arrayResult);

?>


    

     
     <script type="text/javascript">


          google.charts.load('current', { 'packages': ['corechart'] });
          google.charts.setOnLoadCallback(drawChart);

      
       

          function drawChart()
           {

            
       
            let array1   = <?php echo json_encode($arrayResult); ?>;

groupBy = (array, keygetter) => {
return Object.values(array1.reduce((a, {meta_field,meta_value,number}) => {
// let key = keygetter(meta_field);
(a[meta_field] || (a[meta_field] = {meta_field: meta_field}))[meta_value] = number;
return a;
}, Object.create(null)));
},
result = groupBy(array1, (o) => o.location);

// console.log(result);
var newArray = [];

              let r = 0;
            for( var index in result){
               weeksData1 = result[index];
               QuestionName = result[index]["meta_field"];
            // //  console.log(weeksData)

            // // alert(newArray)

           
            r++;
            console.log(r);
            console.log(weeksData1)
            console.log(QuestionName)


              //  let week1 = ['23', 2, '50', 1, '54', 1, 'meta_field', 'What is your age'];

              //  let week2 = [{meta_field: 'Gender', Female: '2', Male: '2'}];
               
              //  let week2 = [
              //        ['24',2],
              //       ['50',1],
              //     ['55',1],
              //  ];
               
              //  let week3 = [
              //        ['23',2],
              //       ['50',1],
              //     ['54',1],
              //  ];


                  //  let weeksData = [week1];

                  
                    // alert("inside");
                    $("#piechart").append('<div id="chart'+r+'">');
                    var options = {
  title: QuestionName
};

  var data = new google.visualization.DataTable();
  data.addColumn('string', 'x');
  data.addColumn('number', 'y');

  for (var key in weeksData1) {
    data.addRow([key, parseFloat(weeksData1[key])]);
  }

  var chart = new google.visualization.PieChart(document.getElementById('chart'));
  var container = document.getElementById('chart'+r).appendChild(document.createElement('div'));
  var chart = new google.visualization.PieChart(container);
  chart.draw(data,options);
               }
              
          }  
     </script>
</head>

<body>

<div id="chart" ></div>
     <div style="width:900px;    padding-top: 4rem;">
          <div id="piechart" style="width: 900px; height: 500px;"></div>
     </div>
</body>
<style>
  .home-section .text {
    display: inline-block !important;
}
</style>
</html>
<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="Cart\styles.css">
</head>
<body>
 
   <div class="chart">
      <div class="chart_types">
         <button onclick="setChartType('bar')">Bars</button>
         <button onclick="setChartType('line')">Line</button>
         <button onclick="setChartType('doughnut')">Doughnut</button>
         <button onclick="setChartType('polarArea')">PolarArea</button>
         <button onclick="setChartType('radar')">Radar</button>
      </div>
      <canvas id="myChart"></canvas>
   </div>
 
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script src="Cart\script.js"></script> -->
<!--  
   <script>
     let ctx = document.getElementById('myChart');
let myChart;
// let data;
let Jsondata

let array1   = <?php echo json_encode($arrayResult); ?>;

groupBy = (array, keygetter) => {
return Object.values(array1.reduce((a, {meta_field,meta_value,number}) => {
// let key = keygetter(meta_field);
(a[meta_field] || (a[meta_field] = {meta_field: meta_field}))[meta_value] = number;
return a;
}, Object.create(null)));
},
result = groupBy(array1, (o) => o.location);

console.log(result);
var newArray = [];


for(var index in result){
             weeksData = result[index];
             console.log(weeksData)
             Jsondata = weeksData;
             createChart(Jsondata, 'bar');
}

const data =Jsondata;


function createChart(data, type){

  
  myChart = new Chart(ctx, {
		type: type, 
		data: {
		  labels: data.map(row => row.month), 
		  datasets: [{
		    label: '# of Income',
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
		  maintainAspectRatio: false,
		}
	});
}


function setChartType(chartType){
	myChart.destroy();
	createChart(Jsondata, chartType);
}
   </script> -->
<!-- </body>
</html>  -->