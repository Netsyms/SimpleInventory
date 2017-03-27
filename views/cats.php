<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Categories
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Categories</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Categories</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="cattable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th><i class="fa fa-archive"></i> Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cats = $database->select('categories', [
                                    'catid',
                                    'catname'
                                ]);
                                foreach ($cats as $cat) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="./?id=editcat&catid=<?php echo $cat['catid']; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            &nbsp; &nbsp;
                                            <a href="./?id=rmcat&catid=<?php echo $cat['catid']; ?>"><i style="color: red;" class="fa fa-trash-o"></i></a>
                                        </td>
                                        <td><?php echo $cat['catname']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Actions</th>
                                    <th><i class="fa fa-archive"></i> Category</th>
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
    $('#cattable').DataTable({});
</script>