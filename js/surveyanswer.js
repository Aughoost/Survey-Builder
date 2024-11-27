
require("core-js/actual/array/group-by-to-map");
require("core-js/actual/array/group-by");
google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

function drawChart()
 {

     const Answer = `<?php echo json_encode($arrayResult); ?>`;
     console.log(Answer)

     const groupbyAnswers = Answer.groupBy((answers) =>{
          return answers.meta_field;
     });
     console.log(groupbyAnswers);

     // alert(Answer);

      let week1 = [
           ['23',2],
          ['50',1],
        ['54',1],
     ];
     
     let week2 = [
           ['24',2],
          ['50',1],
        ['55',1],
     ];
     
     let week3 = [
           ['23',2],
          ['50',1],
        ['54',1],
     ];

         let weeksData = [week1,week2,week3];

         for( let r=0; r<weeksData.length; r++){

          $("#piechart").append('<div id="draw-charts'+r+'">');
          
          google.charts.load('current', {
               callback:function(){
                    var data  = new google.visualization.DataTable();
                    data.addColumn('string','Days');
                    data.addColumn('number','Income');
                    data.addRows(weeksData[r]);
                    var options = {
                         width:400,
                         height:300
                    };
                    var container = document.getElementById('draw-charts'+r).appendChild(document.createElement('div'));
                    var chart = new google.visualization.PieChart(container);
                    chart.draw(data,options);
               },
               packages:['corechart']
          });
     }

}  