<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Locations
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Locations</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Locations</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="loctable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th><i class="fa fa-map-marker"></i> Location</th>
                                    <th><i class="fa fa-barcode"></i> Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $locs = $database->select('locations', [
                                    'locid',
                                    'locname',
                                    'loccode'
                                ]);
                                foreach ($locs as $loc) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="./?id=editloc&locid=<?php echo $loc['locid']; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            &nbsp; &nbsp;
                                            <a href="./api/printlabel.php?locid=<?php echo $loc['locid']; ?>"><i style="color: green;" class="fa fa-print"></i></a>
                                            &nbsp; &nbsp;
                                            <a href="./?id=rmloc&locid=<?php echo $loc['locid']; ?>"><i style="color: red;" class="fa fa-trash-o"></i></a>
                                        </td>
                                        <td><?php echo $loc['locname']; ?></td>
                                        <td><?php echo $loc['loccode']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Actions</th>
                                    <th><i class="fa fa-map-marker"></i> Location</th>
                                    <th><i class="fa fa-barcode"></i> Code</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $('#loctable').DataTable({});
</script>