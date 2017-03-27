<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li<?php
            if ($_GET['id'] == 'dashboard') {
                echo ' class="active"';
            }
            ?>><a href="./?id=dashboard"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
            <!--<li><a href="./?id=items"><i class="fa fa-cubes"></i> <span>Items</span></a></li>-->
            <li<?php
            if ($_GET['id'] == 'items' || $_GET['id'] == 'additem' || $_GET['id'] == 'edititem') {
                echo ' class="active"';
            }
            ?>><a href="./?id=items"><i class="fa fa-cubes"></i> <span>Items</span></a>
                <span></span>
                <ul class="treeview-menu">
                    <li><a href="./?id=additem"><i class="fa fa-plus"></i> Add Item</a></li>
                </ul>
            </li>
            <li<?php
            if ($_GET['id'] == 'cats' || $_GET['id'] == 'addcat' || $_GET['id'] == 'editcat' || $_GET['id'] == 'rmcat') {
                echo ' class="active"';
            }
            ?>><a href="./?id=cats"><i class="fa fa-archive"></i> <span>Categories</span></a>
                <span></span>
                <ul class="treeview-menu">
                    <li><a href="./?id=addcat"><i class="fa fa-plus"></i> Add Category</a></li>
                </ul>
            </li>
            <li<?php
            if ($_GET['id'] == 'locs' || $_GET['id'] == 'addloc' || $_GET['id'] == 'editloc' || $_GET['id'] == 'rmloc') {
                echo ' class="active"';
            }
            ?>><a href="./?id=locs"><i class="fa fa-map-marker"></i> <span>Locations</span></a>
                <span></span>
                <ul class="treeview-menu">
                    <li><a href="./?id=addloc"><i class="fa fa-plus"></i> Add Location</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>