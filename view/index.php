<?php require_once __DIR__.'/resources.php';
//    echo "Sesión: ".$_SESSION['lastActive'] . "<br>";
//    echo "Fingerprint: ".$_SESSION['fingerPrint'] . "<br>";
//    echo "Loggedin: ".$_SESSION['loggedin'] . "<br>";
//    echo  "Nick: ".$_SESSION['username'] . "<br>";
//    echo "Nombre: ".$_SESSION['name'] . "<br>";
//    echo "Rol: ".$_SESSION['rol'] . "<br>";
//    echo "ID: ".$_SESSION['id'] . "<br>";
?>

<?php if($_SESSION['rol'] === '1'){ ?>
    <div class="col-sm-3 col-xs-6">

        <div class="tile-stats tile-red">
            <div class="icon"><i class="entypo-star"></i></div>
            <div class="num" data-start="0" data-end="<?= $advisorsQuantity ?>" data-postfix="" data-duration="1500" data-delay="0">0</div>
            <h3>Asesores</h3>
        </div>

    </div>

<?php } ?>

    <div class="col-sm-3 col-xs-6">

        <div class="tile-stats tile-green">
            <div class="icon"><i class="entypo-chart-bar"></i></div>
            <div class="num" data-start="0" data-end="<?= $ownerQuantity; ?>" data-postfix="" data-duration="1500" data-delay="600">0</div>
            <h3>Titulares</h3>
        </div>

    </div>

    <div class="clear visible-xs"></div>

    <div class="col-sm-3 col-xs-6">

        <div class="tile-stats tile-aqua">
            <div class="icon"><i class="entypo-mail"></i></div>
            <div class="num" data-start="0" data-end="<?= $beneficiariesQuantity; ?>" data-postfix="" data-duration="1500" data-delay="1200">0</div>
            <h3>Beneficiarios</h3>
        </div>

    </div>

    <div class="col-sm-3 col-xs-6">
        <div class="tile-stats tile-gray">
            <div class="icon"><i class="entypo-rss"></i></div>
            <div class="num" data-start="0" data-end="<?= $pendingPay; ?>" data-end="52" data-postfix="" data-duration="1500" data-delay="1200">0</div>
            <h3>Pagos pendientes</h3>
        </div>
    </div>

    <div class="col-sm-3 col-xs-6">
        <div class="tile-stats tile-blue">
            <div class="icon"><i class="entypo-rss"></i></div>
            <div class="num" data-start="0" data-end="<?= $accomplishedPay; ?>" data-end="52" data-postfix="" data-duration="1500" data-delay="1200">0</div>
            <h3>Pagos completados</h3>
        </div>
    </div>




    <div class="col-lg-12 col-xs-12">
        <br>
        <br>
        <br>
        <p align="center"><b>Bienvenido, elige una opci&oacute;n</b></p>
    </div>

<?php require_once __DIR__.'/footer.php' ?>