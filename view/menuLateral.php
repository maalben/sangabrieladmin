<div class="sidebar-menu">

    <div class="sidebar-menu-inner">

        <header class="logo-env">

            <!-- logo -->
            <div class="logo">
                <a href="index">
                    <img src="assets/images/logo.png" width="120" alt="" />
                </a>
            </div>

            <!-- logo collapse icon -->
            <div class="sidebar-collapse">
                <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                    <i class="entypo-menu"></i>
                </a>
            </div>


            <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
            <div class="sidebar-mobile-menu visible-xs">
                <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                    <i class="entypo-menu"></i>
                </a>
            </div>

        </header>
        <ul id="main-menu" class="main-menu">
        <?php
        if($listPermissionsEnable !== ''){
            foreach($listPermissionsEnable as $permissions): ?>
                    <li class="active opened active has-sub">
                        <a href="#">
                            <i class="entypo-user"></i>
                            <span class="title"><?php echo $permissions['Nombre']; ?></span>
                        </a>
                        <ul class="visible">
                            <?php
                                $permissionsModel->getModuleEnableByUser($permissions['Id'], $_SESSION['id'], '');
                            ?>
                        </ul>
                    </li>
        <?php endforeach; } ?>
        </ul>
    </div>

</div>