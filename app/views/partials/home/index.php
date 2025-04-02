<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class=""><br/> </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_expensestoday();  ?>
                    <a class="animated zoomIn record-count card bg-danger text-white"  href="<?php print_link("payments/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="material-icons ">attach_money</i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Expenses Today</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_expensesthismonth();  ?>
                    <a class="animated zoomIn record-count card bg-danger text-white"  href="<?php print_link("payments/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="material-icons ">attach_money</i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Expenses This Month</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_expensesthisyear();  ?>
                    <a class="animated zoomIn record-count card bg-danger text-white"  href="<?php print_link("payments/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="material-icons ">attach_money</i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Expenses This Year</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-sm-6 comp-grid">
                    <div class="card card-body">
                        <?php 
                        $chartdata = $comp_model->barchart_expensesbycategory();
                        ?>
                        <div>
                            <h4>Expenses By Category</h4>
                            <small class="text-muted">Transactions this month</small>
                        </div>
                        <hr />
                        <canvas id="barchart_expensesbycategory"></canvas>
                        <script>
                            $(function (){
                            var chartData = {
                            labels : <?php echo json_encode($chartdata['labels']); ?>,
                            datasets : [
                            {
                            label: 'Amount',
                            backgroundColor:'rgba(0 , 211 , 0, 0.5)',
                            type:'',
                            borderWidth:3,
                            data : <?php echo json_encode($chartdata['datasets'][0]); ?>,
                            }
                            ]
                            }
                            var ctx = document.getElementById('barchart_expensesbycategory');
                            var chart = new Chart(ctx, {
                            type:'bar',
                            data: chartData,
                            options: {
                            scaleStartValue: 0,
                            responsive: true,
                            scales: {
                            xAxes: [{
                            ticks:{display: true},
                            gridLines:{display: true},
                            categoryPercentage: 1.0,
                            barPercentage: 0.8,
                            scaleLabel: {
                            display: true,
                            labelString: ""
                            },
                            }],
                            yAxes: [{
                            ticks: {
                            beginAtZero: true,
                            display: true
                            },
                            scaleLabel: {
                            display: true,
                            labelString: ""
                            }
                            }]
                            },
                            }
                            ,
                            })});
                        </script>
                    </div>
                </div>
                <div class="col-sm-6 comp-grid">
                    <div class="card card-body">
                        <?php 
                        $chartdata = $comp_model->barchart_expensesbyaccount();
                        ?>
                        <div>
                            <h4>Expenses By Account</h4>
                            <small class="text-muted">Transactions This month</small>
                        </div>
                        <hr />
                        <canvas id="barchart_expensesbyaccount"></canvas>
                        <script>
                            $(function (){
                            var chartData = {
                            labels : <?php echo json_encode($chartdata['labels']); ?>,
                            datasets : [
                            {
                            label: 'Amount',
                            backgroundColor:'rgba(0 , 6 , 51, 0.5)',
                            type:'',
                            borderWidth:3,
                            data : <?php echo json_encode($chartdata['datasets'][0]); ?>,
                            }
                            ]
                            }
                            var ctx = document.getElementById('barchart_expensesbyaccount');
                            var chart = new Chart(ctx, {
                            type:'bar',
                            data: chartData,
                            options: {
                            scaleStartValue: 0,
                            responsive: true,
                            scales: {
                            xAxes: [{
                            ticks:{display: true},
                            gridLines:{display: true},
                            categoryPercentage: 1.0,
                            barPercentage: 0.8,
                            scaleLabel: {
                            display: true,
                            labelString: ""
                            },
                            }],
                            yAxes: [{
                            ticks: {
                            beginAtZero: true,
                            display: true
                            },
                            scaleLabel: {
                            display: true,
                            labelString: ""
                            }
                            }]
                            },
                            }
                            ,
                            })});
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-sm-12 comp-grid">
                    <div class="card card-body">
                        <?php 
                        $chartdata = $comp_model->linechart_expensesthismonth();
                        ?>
                        <div>
                            <h4>Expenses This Month</h4>
                            <small class="text-muted"></small>
                        </div>
                        <hr />
                        <canvas id="linechart_expensesthismonth"></canvas>
                        <script>
                            $(function (){
                            var chartData = {
                            labels : <?php echo json_encode($chartdata['labels']); ?>,
                            datasets : [
                            {
                            label: 'Amount',
                            fill:true,
                            backgroundColor:'rgba(0 , 211 , 0, 0.5)',
                            borderWidth:3,
                            pointStyle:'circle',
                            pointRadius:5,
                            lineTension:0.1,
                            type:'',
                            steppedLine:false,
                            data : <?php echo json_encode($chartdata['datasets'][0]); ?>,
                            },{
                            label: 'Transactions',
                            fill:true,
                            backgroundColor:'rgba(0 , 6 , 51, 0.5)',
                            borderWidth:3,
                            pointStyle:'circle',
                            pointRadius:5,
                            lineTension:0.1,
                            type:'',
                            steppedLine:false,
                            data : <?php echo json_encode($chartdata['datasets'][1]); ?>,
                            }
                            ]
                            }
                            var ctx = document.getElementById('linechart_expensesthismonth');
                            var chart = new Chart(ctx, {
                            type:'line',
                            data: chartData,
                            options: {
                            scaleStartValue: 0,
                            responsive: true,
                            scales: {
                            xAxes: [{
                            ticks:{display: true},
                            gridLines:{display: true},
                            scaleLabel: {
                            display: true,
                            labelString: ""
                            }
                            }],
                            yAxes: [{
                            ticks: {
                            beginAtZero: true,
                            display: true
                            },
                            scaleLabel: {
                            display: true,
                            labelString: ""
                            }
                            }]
                            },
                            }
                            ,
                            })});
                        </script>
                    </div>
                </div>
                <div class="col-sm-12 comp-grid">
                    <div class="card card-body">
                        <?php 
                        $chartdata = $comp_model->linechart_expensesthisyear();
                        ?>
                        <div>
                            <h4>Expenses This Year</h4>
                            <small class="text-muted"></small>
                        </div>
                        <hr />
                        <canvas id="linechart_expensesthisyear"></canvas>
                        <script>
                            $(function (){
                            var chartData = {
                            labels : <?php echo json_encode($chartdata['labels']); ?>,
                            datasets : [
                            {
                            label: 'Amount',
                            fill:true,
                            backgroundColor:'rgba(0 , 211 , 0, 0.5)',
                            borderWidth:3,
                            pointStyle:'circle',
                            pointRadius:5,
                            lineTension:0.1,
                            type:'',
                            steppedLine:false,
                            data : <?php echo json_encode($chartdata['datasets'][0]); ?>,
                            },{
                            label: 'Transactions',
                            fill:true,
                            backgroundColor:'rgba(0 , 6 , 51, 0.5)',
                            borderWidth:3,
                            pointStyle:'circle',
                            pointRadius:5,
                            lineTension:0.1,
                            type:'',
                            steppedLine:false,
                            data : <?php echo json_encode($chartdata['datasets'][1]); ?>,
                            }
                            ]
                            }
                            var ctx = document.getElementById('linechart_expensesthisyear');
                            var chart = new Chart(ctx, {
                            type:'line',
                            data: chartData,
                            options: {
                            scaleStartValue: 0,
                            responsive: true,
                            scales: {
                            xAxes: [{
                            ticks:{display: true},
                            gridLines:{display: true},
                            scaleLabel: {
                            display: true,
                            labelString: ""
                            }
                            }],
                            yAxes: [{
                            ticks: {
                            beginAtZero: true,
                            display: true
                            },
                            scaleLabel: {
                            display: true,
                            labelString: ""
                            }
                            }]
                            },
                            }
                            ,
                            })});
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
