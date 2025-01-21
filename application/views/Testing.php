<?php
    $this->load->view('./templates/header.php');
?>

<div class="col">
    <div class="card" style="width: 12rem;">
        <div class="card-body">
            <h5 class="card-title">MTNB</h5>
    
            <a data-toggle="modal" data-target="#ticketDetailsModal" class="btn btn-block btn-primary">Details</a>
        </div>
    </div>
    <div class="card" style="width: 12rem;">

        <div class="card-body">
             <h5 class="card-title">MTNN</h5>
            <a data-toggle="modal" data-target="#ticketDetailsModal" class="btn btn-block btn-danger">Details</a>
        </div>
    </div>
    <div class="card" style="width: 12rem;">
        <div class="card-body">
             <h5 class="card-title">MTNGC</h5>

            <a data-toggle="modal" data-target="#ticketDetailsModal" class="btn btn-block btn-warning">Details</a>
        </div>
    </div>
    <div class="card" style="width: 12rem;">
        <div class="card-body">
             <h5 class="card-title">MTNU</h5>

            <a data-toggle="modal" data-target="#ticketDetailsModal" class="btn btn-block btn-success">Details</a>
        </div>
    </div>
    <div class="card" style="width: 12rem;">
        <div class="card-body">
             <h5 class="card-title">MTNZ</h5>

            <a data-toggle="modal" data-target="#ticketDetailsModal" class="btn btn-block btn-info">Details</a>
        </div>
    </div>
</div>
</div>
<?php
    $this->load->view('./templates/footer.php');
    $this->load->view('./metaDataScript.php');
?>
<style>
    .card-title{
        font-size: 15px;
        padding: 6px;
    }
    #myChart{
        float:left;
    }
  
</style>
<div class="modal fade" id="ticketDetailsModal" tabindex="-1" role="dialog" aria-labelledby="ticketDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ticketDetailsModalLabel">Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
            <canvas id="myChart" style="width:400px;max-width:700px;height:400px;"></canvas>
                <!-- <table class="table table-striped table-bordered">
                    <thead>
                        <tr style="background-color:#1c00c8;color:white;">
                            <th class="text-center">OPCO</th>
                            <th class="text-center">Jan</th>
                            <th class="text-center">Feb</th>
                            <th class="text-center">Mar</th>
                            <th class="text-center">Apr</th>
                            <th class="text-center">May</th>
                            <th class="text-center">Jun</th>
                            <th class="text-center">Jul</th>
                            <th class="text-center">Aug</th>
                            <th class="text-center">Sep</th>
                            <th class="text-center">Oct</th>
                            <th class="text-center">Nov</th>
                            <th class="text-center">Dec</th> 
                            <th class="text-center">OPCO</th>
                            <th class="text-center">S1</th>
                            <th class="text-center">S2</th>
                            <th class="text-center">S3</th>
                            <th class="text-center">S4</th>
                        </tr>
                    </thead>
                    <tbody id="modal_content">

                    </tbody>
                </table> -->
            </div>
            <div class="col-md-4">
                <canvas id="myChart1" style="width:400px;max-width:700px;height:400px;"></canvas>
            </div>
            
        </div>
        <div class="col-md-6">
                <div id="myChart2" style="width:100%; max-width:600px; height:500px;"></div>
            </div>
      </div>
      <div class="col-md-6">
        <canvas id="myChart3" style="width:100%;max-width:600px"></canvas>
</div>

      <div class="modal-footer">
        <a type="button" class="btn btn-primary" data-dismiss="modal" style="color:white">Close</a>
      </div>
    </div>
  </div>
</div>
<style>
    .modal-body{
        height:500px;
    }
    .modal-header{
        width:100%;

    }
</style>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
var xValues = ["S1", "S2", "S3", "S4"];
var yValues = [55, 49, 44, 24];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  
];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Incident Count"
    }
  }
});
</script>
<script>
var xValues = ["Open Incident","Security Incident"];
var yValues = [55, 49, 44, 24, 15];
var barColors = ["red", "green","blue","orange"];

new Chart("myChart1", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Overall Count"
    }
  }
});
</script>
<script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
var data = google.visualization.arrayToDataTable([
  ['Contry', 'Count'],
  ['KM',55],
  ['AC',49],
]);

var options = {
  title:'KM and Automation Count'
};

var chart = new google.visualization.BarChart(document.getElementById('myChart2'));
  chart.draw(data, options);
}
</script>

<script>
var xValues = [50,60,70,80,90,100,110,120,130,140,150];
var yValues = [7,8,8,9,9,9,10,11,14,14,15];

new Chart("myChart3", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 6, max:16}}],
    }
  }
});
</script>