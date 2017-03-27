<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-cubes"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Tracked Items</span>
                        <span class="info-box-number"><?php echo $database->count('items'); ?><small></small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-map-marker"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Locations</span>
                        <span class="info-box-number"><?php echo $database->count('locations'); ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-archive"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Categories</span>
                        <span class="info-box-number"><?php echo $database->count('categories'); ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Items per Category</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chart-responsive">
                                    <canvas id="itemcatchart" height="150"></canvas>
                                </div>
                                <!-- ./chart-responsive -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <?php /* <div class="col-md-6">
              <div class="info-box bg-green">
              <span class="info-box-icon"><i class="fa fa-money"></i></span>

              <div class="info-box-content">
              <span class="info-box-text">Total Camp Fees</span>
              <?php
              $totalfees = $database->sum('billing', 'amount_total');
              $paidfees = $database->sum('billing', 'amount_paid');
              $paidpercent = round($paidfees / $totalfees * 100);
              ?>
              <span class="info-box-number">$<?php echo $totalfees; ?></span>

              <div class="progress">
              <div class="progress-bar" style="width: <?php echo $paidpercent; ?>%"></div>
              </div>
              <span class="progress-description">
              <?php echo $paidpercent; ?>% already paid ($<?php echo $paidfees; ?> paid)
              </span>
              </div>
              <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
              <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="fa fa-cube"></i></span>

              <div class="info-box-content">
              <?php
              $extrashirts = $database->sum('shirts', 'count');
              $freeshirts = $database->count('people', ['tshirt[!]' => null]);
              $totalshirts = $freeshirts + $extrashirts;
              $shirtspercent = round($extrashirts / $totalshirts * 100);
              ?>
              <span class="info-box-text">T-shirts</span>
              <span class="info-box-number"><?php echo $totalshirts; ?></span>

              <div class="progress">
              <div class="progress-bar" style="width: <?php echo $shirtspercent; ?>%"></div>
              </div>
              <span class="progress-description">
              <?php echo $shirtspercent; ?>% are extra shirts (<?php echo $extrashirts; ?> of <?php echo $totalshirts; ?> total)
              </span>
              </div>
              <!-- /.info-box-content -->
              </div>
             */ ?>

            <!-- PRODUCT LIST -->
            <?php /* <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Recently Added Products</h3>

              <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
              <ul class="products-list product-list-in-box">
              <li class="item">
              <div class="product-img">
              <img src="dist/img/default-50x50.gif" alt="Product Image">
              </div>
              <div class="product-info">
              <a href="javascript:void(0)" class="product-title">Samsung TV
              <span class="label label-warning pull-right">$1800</span></a>
              <span class="product-description">
              Samsung 32" 1080p 60Hz LED Smart HDTV.
              </span>
              </div>
              </li>
              <!-- /.item -->
              <li class="item">
              <div class="product-img">
              <img src="dist/img/default-50x50.gif" alt="Product Image">
              </div>
              <div class="product-info">
              <a href="javascript:void(0)" class="product-title">Bicycle
              <span class="label label-info pull-right">$700</span></a>
              <span class="product-description">
              26" Mongoose Dolomite Men's 7-speed, Navy Blue.
              </span>
              </div>
              </li>
              <!-- /.item -->
              <li class="item">
              <div class="product-img">
              <img src="dist/img/default-50x50.gif" alt="Product Image">
              </div>
              <div class="product-info">
              <a href="javascript:void(0)" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>
              <span class="product-description">
              Xbox One Console Bundle with Halo Master Chief Collection.
              </span>
              </div>
              </li>
              <!-- /.item -->
              <li class="item">
              <div class="product-img">
              <img src="dist/img/default-50x50.gif" alt="Product Image">
              </div>
              <div class="product-info">
              <a href="javascript:void(0)" class="product-title">PlayStation 4
              <span class="label label-success pull-right">$399</span></a>
              <span class="product-description">
              PlayStation 4 500GB Console (PS4)
              </span>
              </div>
              </li>
              <!-- /.item -->
              </ul>
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-center">
              <a href="javascript:void(0)" class="uppercase">View All Products</a>
              </div>
              <!-- /.box-footer -->
              </div>
              <!-- /.box -->
             */ ?>
        </div>
        <!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>
<?php
$chartcolors = ['f56954', '00a65a', 'f39c12', '00c0ef', '3c8dbc', 'd2d6de'];
?>
    var itemcatChartData = <?php
$allcats = $database->select('categories', ['catname', 'catid']);
$activecats = ['names' => [], 'ids' => []];
foreach ($allcats as $cat) {
    if ($database->has('items', ['catid' => $cat['catid']])) {
        $activecats['ids'][] = $cat['catid'];
        $activecats['names'][] = $cat['catname'];
    }
}

$colorcounter = 0;
$colorsexpanded = [];
for ($i = 0; $i < count($activecats['ids']); $i++) {
    $colorsexpanded[] = '#' . $chartcolors[$colorcounter];
    $colorcounter++;
    if ($colorcounter >= count($chartcolors)) {
        $colorcounter = 0;
    }
}
$colorcounter = 0;
$data = [
    'labels' => $activecats['names'],
    'datasets' => [
        [
            'label' => "Items",
            'backgroundColor' => $colorsexpanded,
            'borderColor' => $colorsexpanded,
            'borderWidth' => 1,
            'data' => []
        ]
    ]
];
foreach ($activecats['ids'] as $cat) {
    $val = $database->count('items', ['catid' => $cat]);
    //$val = rand(0, 20); // fake values for chart testing
    $data['datasets'][0]['data'][] = $val;
}
echo json_encode($data);
?>;
    var itemcatChart = new Chart($("#itemcatchart"), {
        type: 'bar',
        data: itemcatChartData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animationSteps: 50,
            animationEasing: "linear",
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            min: 0,
                            suggestedMax: 10
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "# of Items"
                        }
                    }],
                xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: "Categories"
                        }
                    }]
            }
        }
    });

</script>