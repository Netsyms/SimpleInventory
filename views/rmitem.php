<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Remove Item
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="./?id=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="./?id=items"><i class="fa fa-cubes"></i> Items</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <style>
            .panel-modal .modal {
                position: relative;
                top: auto;
                bottom: auto;
                right: auto;
                left: auto;
                display: block;
                background: transparent !important;
                z-index: 1;
            }
        </style>
        <?php
        $item = $database->select('items', ['itemname', 'itemcode1', 'itemcode2'], ['itemid' => $_GET['itemid']])[0];
        ?>
        <div class="panel-modal">
            <div class="modal modal-danger">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Deleting <?php echo $item['itemname']; ?></h4>
                        </div>
                        <div class="modal-body">
                            <p>
                                <i class="fa fa-cube"></i> <?php echo $item['itemname']; ?><br />
                                <i class="fa fa-barcode"></i> <?php echo $item['itemcode1']; ?><br />
                                <i class="fa fa-qrcode"></i> <?php echo $item['itemcode2']; ?><br />
                            </p>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-outline pull-left" href="./?id=items">Cancel</a>
                            <a class="btn btn-outline" href="./actions/rmitem.php?id=<?php echo htmlspecialchars($_GET['itemid']); ?>"><i class="fa fa-trash-o"></i> Delete</a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->