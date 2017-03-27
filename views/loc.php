<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php
            if (is_empty($_GET['locid'])) {
                echo "Add";
            } else {
                echo "Edit";
            }
            ?> Location
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="./?id=locs"><i class="fa fa-cubes"></i> Locations</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <?php
    $locdata = [
        'locid' => '',
        'locname' => '',
        'loccode' => ''
    ];
    if (!is_empty($_GET['locid']) && $database->has('locations', ['locid' => $_GET['locid']])) {
        $locdata = $database->select(
                        'locations', [
                    'locid',
                    'locname',
                    'loccode'
                        ], [
                    'locid' => $_GET['locid']
                ])[0];
    }
    ?>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-xs-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Location Data</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="./actions/savelocation.php" method="POST">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name"><i class="fa fa-map-marker"></i> Name</label>
                                        <input type="text" class="form-control" id="name" name="locname" placeholder="Foo Bar" required="required" value="<?php echo $locdata['locname']; ?>" />
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="code"><i class="fa fa-barcode"></i> Code</label>
                                        <input type="text" class="form-control" id="code" name="loccode" placeholder="Foo Bar" required="required" value="<?php echo $locdata['loccode']; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <input type="hidden" name="locid" value="<?php echo htmlspecialchars($_GET['locid']); ?>" />

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->