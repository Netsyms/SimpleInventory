<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Items
            <small>All tracked items.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Items</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Items</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="itemtable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th><i class="fa fa-cube"></i> Name</th>
                                    <th><i class="fa fa-archive"></i> Category</th>
                                    <th><i class="fa fa-map-marker"></i> Location</th>
                                    <th><i class="fa fa-barcode"></i> Code 1</th>
                                    <th><i class="fa fa-qrcode"></i> Code 2</th>
                                    <th><i class="fa fa-info"></i> Info 1</th>
                                    <th><i class="fa fa-sticky-note-o"></i> Info 2</th>
                                    <th><i class="fa fa-comments-o"></i> Info 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $items = $database->select('items', [
                                    '[>]categories' => ['catid' => 'catid'],
                                    '[>]locations' => ['locid' => 'locid']
                                        ], [
                                    'itemid',
                                    'itemname',
                                    'catname',
                                    'locname',
                                    'loccode',
                                    'itemcode1',
                                    'itemcode2',
                                    'itemtext1',
                                    'itemtext2',
                                    'itemtext3'
                                ]);
                                foreach ($items as $item) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="./?id=edititem&itemid=<?php echo $item['itemid']; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            &nbsp; &nbsp;
                                            <a href="./api/printlabel.php?itemid=<?php echo $item['itemid']; ?>"><i style="color: green;" class="fa fa-print"></i></a>
                                            &nbsp; &nbsp;
                                            <a href="./?id=rmitem&itemid=<?php echo $item['itemid']; ?>"><i style="color: red;" class="fa fa-trash-o"></i></a>
                                        </td>
                                        <td><?php echo $item['itemname']; ?></td>
                                        <td><?php echo $item['catname']; ?></td>
                                        <td><?php echo $item['locname'] . " (" . $item['loccode'] . ")"; ?></td>
                                        <td><?php echo $item['itemcode1']; ?></td>
                                        <td><?php echo $item['itemcode2']; ?></td>
                                        <td><?php echo $item['itemtext1']; ?></td>
                                        <td><?php echo $item['itemtext2']; ?></td>
                                        <td><?php echo $item['itemtext3']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Actions</th>
                                    <th><i class="fa fa-cube"></i> Name</th>
                                    <th><i class="fa fa-archive"></i> Category</th>
                                    <th><i class="fa fa-map-marker"></i> Location</th>
                                    <th><i class="fa fa-barcode"></i> Code 1</th>
                                    <th><i class="fa fa-qrcode"></i> Code 2</th>
                                    <th><i class="fa fa-info"></i> Info 1</th>
                                    <th><i class="fa fa-sticky-note-o"></i> Info 2</th>
                                    <th><i class="fa fa-comments-o"></i> Info 3</th>
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
    $('#itemtable').DataTable({});
</script>