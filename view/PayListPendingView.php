<?php
require_once __DIR__.'/resources2.php';
require_once __DIR__ . '/../model/AdvisorModel.php';
require_once __DIR__ . '/../model/OwnerModel.php';
$advisorModel = new AdvisorModel();
$ownerModel = new OwnerModel();
?>

    <h2>Pagos pendientes</h2>
    <br />

    <script type="text/javascript">
        jQuery( document ).ready( function( $ ) {
            var $table1 = jQuery( '#table-1' );

            // Initialize DataTable
            $table1.DataTable( {
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "bStateSave": true
            });

            // Initalize Select Dropdown after DataTables is created
            $table1.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
                minimumResultsForSearch: -1
            });
        } );
    </script>

    <table class="table table-bordered datatable" id="table-1">
        <thead>
        <tr>
            <th align="center">C&eacute;dula afiliado</th>
            <th align="center">Valor</th>
            <th align="center">Fecha registro</th>
            <?php if($_SESSION['rol'] === '1'){ ?>
                <th align="center">Asesor</th>
                <th align="center">Pagar</th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        if($consulta !== ''){
        foreach($consulta as $dato): ?>
        <tr class="odd gradeX">
            <td align="center"><?php echo $ownerModel->getInformationOwner($dato['cedulafiliado'])['nombretitular'] . ' ' . $ownerModel->getInformationOwner($dato['cedulafiliado'])['apellidotitular'] . ' - ('.$dato['cedulafiliado'].')'; ?></td>
            <td align="center"><?php echo $dato['valor']; ?></td>
            <td align="center"><?php echo $dato['recordDate']; ?></td>
            <?php if($_SESSION['rol'] === '1'){ ?>
                <td align="center">
                    <?php
                    if($advisorModel->getNameAdvisor($dato['nickasesor']) ===  ''){
                        echo 'Sin especificar';
                    }else{
                        echo $advisorModel->getNameAdvisor($dato['nickasesor']);
                    }
                    ?>
                </td>
                <td align="center"><a href="../index.php?accion=payOwner&id=<?php echo $dato['id']; ?>"><i class="fa fa-rocket"></i></a></td>
            <?php } ?>
        </tr>
        <?php endforeach;
        }
        ?>

        </tbody>
        <tfoot>
        <tr>
            <th align="center">C&eacute;dula afiliado</th>
            <th align="center">Valor</th>
            <th align="center">Fecha registro</th>
            <?php if($_SESSION['rol'] === '1'){ ?>
                <th align="center">Asesor</th>
                <th align="center">Pagar</th>
            <?php } ?>
        </tr>
        </tfoot>
    </table>
    <br>
    <p><h2>Total pago pendiente: <?php echo Util::moneyFormat($totalPay); ?></h2></p>

<?php require_once 'footer2.php' ?>