<?php
$connect = mysqli_connect("localhost", "root", "", "form_builder_db");


// $query1= "SELECT meta_field FROM responses where SurveyId =  '" . $_GET['code'] . "'  GROUP BY meta_value";
 
$query = "SELECT meta_field,meta_value, count(meta_value) as number FROM responses where SurveyId =  '" . $_GET['code'] . "'   GROUP BY meta_value";


$result = mysqli_query($connect, $query);
while($rows=$result->fetch_assoc())  
{  
$arrayResult[] = $rows;
} 

echo json_encode($arrayResult);
// while($row = mysqli_fetch_array($result))  
// {  
//      echo "['".$row["meta_field"]."','".$row["meta_value"]."','".$row["number"]."']";
// }
// SELECT meta_field,meta_value, count(meta_value) as number FROM `responses` WHERE SurveyId = 9240875571 and meta_field = "What is your age" GROUP BY meta_value;
?>


<!-- <!DOCTYPE html>
<html>

<head> -->

     <!-- <script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script>  -->
     <!-- <script src="js\surveyanswer.js"></script>
     -->
     <!-- <script src="node_modules\core-js\actual\array\group-by.js"></script>
     <script src="node_modules\core-js\actual\array\group-by-to-map.js"></script> -->
     <!-- <script src="node_modules\core-js\actual\array\group-by.js"></script>
     <script src="node_modules\core-js\actual\array\group-to-map.js"></script> -->
     <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
     <!-- <script type="module" src="node_modules\core-js\actual\array\group-by.js"></script>
     <script type="module" src="node_modules\core-js\actual\array\group-by-to-map.js"></script> -->


    

     
     <!-- <script type="text/javascript">


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
     </script> -->
<!-- </head>

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
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="Cart\styles.css">
   <script src="http://neue.cc/linq.min.js"></script>
</head>
<body>
  <canvas id="NewChart"></canvas>

   <div class="chart" id="CanvasChart">
     
     
      <canvas id="myChart"></canvas>
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


function createChart(data, type){

  
groupBy = (array, keygetter) => {
return Object.values(array1.reduce((a,{meta_field,meta_value,number}) => {
// let key = keygetter(meta_field);
(a[meta_field] || (a[meta_field] = {meta_field: meta_field}))[meta_value] = number;
return a;
}, Object.create(null)));
},
result = groupBy(array1, (o) => o.location);



console.log(result)

// const result1 = Object.groupBy(array1, ({ meta_field }) => meta_field)

// // If you want to remove the "album" property from each object in the nested structure, 
// // you need to take another iteration.
// for (const key in result1) {
//   result1[key].forEach(obj => {
//     // Delete the "album" property from each object
//     delete obj.album;
//   });
// }

// console.log(result1)

// var  groupedData = _.groupBy(data, 'meta_field');
// console.log(groupedData)

// const groupBy1 = (key) => array1.sort((a, b) => a[key].localeCompare(b[key])).reduce((total, currentValue) => {
//   const newTotal = total;
//   if (
//     total.length &&
//     total[total.length - 1][key] === currentValue[key]
//   )
//     newTotal[total.length - 1] = {
//       ...total[total.length - 1],
//       ...currentValue,
//       // Value: parseInt(total[total.length - 1].Value) + parseInt(currentValue.Value),
//     };
//   else newTotal[total.length] = currentValue;
//   return newTotal;
// }, []);
// alert(JSON.stringify(result));
grouped = {};
array1.forEach(function (a) {
    grouped[a.meta_field] = grouped[a.album] || [];
    grouped[a.album].push({ title: a.title, artist: a.artist });
});
document.write('<pre>' + JSON.stringify(grouped, 0, 4) + '</pre>');
// console.log(array1);



// console.log(groupBy1('meta_field'));
let r =0;
for( var index in result){

            weeksData1 = JSON.stringify(result[index]);

          

            

            QuestionName = result[index]["meta_field"];
            number = result[index]["number"];
            // meta_value = weeksData1[Object.keys(weeksData1)[3]];
           
           
            r++;
            console.log(r);
            console.log(weeksData1)
            console.log(QuestionName)
            console.log(number)


    $("#CanvasChart").append('<canvas id="NewChart'+r+'"></canvas>');

    $("#CanvasChart").append('<button id="bar'+r+'">Bars</button><button id="line'+r+'">Line</button><button id="doughnut'+r+'">Doughnut</button><button id="polarArea'+r+'">PolarArea</button><button id="radar'+r+'">Radar</button>');

    let ctx = document.getElementById('NewChart'+r);
     

    // let ctx = document.getElementById('myChart'+r);
    myChart = new Chart(ctx, {
		type: type, 
		data: {
		  labels: data.map(row => row.month ), 
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
// let ctx = document.getElementById('myChart'+r).appendChild(document.createElement('div'));




}

function setChartType(chartType){
	myChart.destroy();
	createChart(Jsondata, chartType);
}

// $("#line").click(function() {
//   change('line');
// });

// $("#bar").click(function() {
//   change('bars');
// });




// function change(newType) {
//   var ctx = document.getElementById("canvas").getContext("2d");

//   // Remove the old chart and all its event handles
//   if (myChart) {
//     myChart.destroy();
//   }

//   // Chart.js modifies the object you pass in. Pass a copy of the object so we can use the original object later
//   var temp = jQuery.extend(true, {}, config);
//   temp.type = newType;
//   myChart = new Chart(ctx, temp);
// };




   </script>
</body>
</html> 