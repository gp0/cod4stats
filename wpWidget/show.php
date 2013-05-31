<?php
$data = file_get_contents("stats.txt", true);

$dataTable = array(
    'cols' => array(
         // each column needs an entry here, like this:
         array('type' => 'date', 'label' => 'Date'), 
         array('type' => 'number', 'label' => 'Kills'),
         array('type' => 'number', 'label' => 'Deaths')
    )
);


$lines = explode("\n", $data);

foreach ($lines as $line) {
	$arr = explode(",", $line);
	
	if ($arr[0] != "") {

		$year = date("Y", $arr[0]);

		//both php and the format google expects are idiotic google wants months starting with 0, php delivers months starting with 1
		$month = date("n", $arr[0])-1;

		$day = date("j", $arr[0]);
		$hour = date("n", $arr[0]);

		$dataTable['rows'][] = array(	
	        'c' => array (
	             array('v' => "Date(".$year.",".$month.",".$day.",".$hour.")"), 
	             array('v' => (int) $arr[1]),
	             array('v' => (int) $arr[2])
	         )
	    );
	    
	}
}

$jsonString = json_encode($dataTable);


?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        
   			var data = new google.visualization.DataTable(<?= $jsonString ?>);
   			 var options = {
          title: 'Call of Duty 4: MW Stats'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
		

       
      }

</script>

<div id="chart_div" style="width: 100%; height: 200px;"></div>
