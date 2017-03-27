<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php
            if (is_empty($_GET['itemid'])) {
                echo "Add";
            } else {
                echo "Edit";
            }
            ?> Item
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="./?id=items"><i class="fa fa-cubes"></i> Items</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <?php
    $itemdata = [
        'itemname' => '',
        'catid' => '',
        'catname' => '',
        'locid' => '',
        'locname' => '',
        'loccode' => '',
        'itemcode1' => '',
        'itemcode2' => '',
        'itemtext1' => '',
        'itemtext2' => '',
        'itemtext3' => ''];
    if (!is_empty($_GET['itemid']) && $database->has('items', ['itemid' => $_GET['itemid']])) {
        $itemdata = $database->select(
                        'items', [
                    '[>]categories' => [
                        'catid' => 'catid'
                    ],
                    '[>]locations' => [
                        'locid' => 'locid'
                    ]
                        ], [
                    'itemname',
                    'itemcode1',
                    'itemcode2',
                    'itemtext1',
                    'itemtext2',
                    'itemtext3',
                    'items.catid',
                    'catname',
                    'items.locid',
                    'locname',
                    'loccode'
                        ], [
                    'itemid' => $_GET['itemid']
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
                        <h3 class="box-title">Item Data</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="./actions/saveitem.php" method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name"><i class="fa fa-cube"></i> Name</label>
                                <input type="text" class="form-control" id="name" name="itemname" placeholder="Foo Bar" required="required" value="<?php echo $itemdata['itemname']; ?>" />
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="cat"><i class="fa fa-archive"></i> Category</label>
                                        <input type="text" class="form-control" id="cat" placeholder="BoxCat" required="required" value="<?php echo $itemdata['catname']; ?>" />
                                        <input type="hidden" id="realcat" name="itemcat" value="<?php echo $itemdata['catid']; ?>" />
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="loc"><i class="fa fa-map-marker"></i> Location</label>
                                        <input type="text" class="form-control" id="loc" placeholder="Over the Hills" required="required" value="<?php echo $itemdata['locname']; ?>" />
                                        <input type="hidden" id="realloc" name="itemloc" value="<?php echo $itemdata['locid']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <script>
                                $("#cat").easyAutocomplete({
                                    url: "api/catlist.php",
                                    getValue: function (element) {
                                        return element.name;
                                    },
                                    list: {
                                        onSelectItemEvent: function () {
                                            var catid = $("#cat").getSelectedItemData().id;
                                            $("#realcat").val(catid).trigger("change");
                                        },
                                        match: {
                                            enabled: true
                                        }
                                    },
                                    theme: "square"
                                });
                                $("#loc").easyAutocomplete({
                                    url: "api/loclist.php",
                                    getValue: function (element) {
                                        return element.name;
                                    },
                                    list: {
                                        onSelectItemEvent: function () {
                                            var locid = $("#loc").getSelectedItemData().id;
                                            $("#realloc").val(locid).trigger("change");
                                        },
                                        match: {
                                            enabled: true
                                        }
                                    },
                                    theme: "square"
                                });
                            </script>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="code1"><i class="fa fa-barcode"></i> Code 1</label>
                                        <input type="text" class="form-control" id="code1" name="itemcode1" placeholder="fbr123" value="<?php echo $itemdata['itemcode1']; ?>" />
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="code2"><i class="fa fa-qrcode"></i> Code 2</label>
                                        <input type="text" class="form-control" id="code2" name="itemcode2" placeholder="qwerty987" value="<?php echo $itemdata['itemcode2']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="info1"><i class="fa fa-info"></i> Info 1</label>
                                        <textarea class="form-control" id="info1" name="itemtext1"><?php echo $itemdata['itemtext1']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="info2"><i class="fa fa-sticky-note-o"></i> Info 2</label>
                                        <textarea class="form-control" id="info2" name="itemtext2"><?php echo $itemdata['itemtext2']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="info3"><i class="fa fa-comments-o"></i> Info 3</label>
                                        <textarea class="form-control" id="info3" name="itemtext3"><?php echo $itemdata['itemtext3']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <input type="hidden" name="itemid" value="<?php echo htmlspecialchars($_GET['itemid']); ?>" />

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