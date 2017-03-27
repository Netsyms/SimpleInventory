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
            ?> Category
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="./?id=cats"><i class="fa fa-cubes"></i> Categories</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <?php
    $catdata = [
        'catid' => '',
        'catname' => ''
    ];
    if (!is_empty($_GET['catid']) && $database->has('categories', ['catid' => $_GET['catid']])) {
        $catdata = $database->select(
                        'categories', [
                    'catid',
                    'catname'
                        ], [
                    'catid' => $_GET['catid']
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
                        <h3 class="box-title">Category Data</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="./actions/savecategory.php" method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name"><i class="fa fa-archive"></i> Name</label>
                                <input type="text" class="form-control" id="name" name="catname" placeholder="Foo Bar" required="required" value="<?php echo $catdata['catname']; ?>" />
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <input type="hidden" name="catid" value="<?php echo htmlspecialchars($_GET['catid']); ?>" />

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