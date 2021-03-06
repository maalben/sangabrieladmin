<?php
require_once __DIR__ . '/../model/AdvisorModel.php';
require_once __DIR__ . '/../model/OwnerModel.php';
$advisorModel = new AdvisorModel();
$ownerModel = new OwnerModel();
?>

    <h2>Pagos completados</h2>

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
            <?php } ?>
            <th align="center">Fecha de pago</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($consulta !== ''){
        foreach($consulta as $dato): ?>
        <tr class="odd gradeX">
            <td align="center"><?php echo $ownerModel->getInformationOwner($dato['cedulafiliado'])['nombretitular'] . ' ' . $ownerModel->getInformationOwner($dato['cedulafiliado'])['apellidotitular'] . ' - ('.$dato['cedulafiliado'].')'; ?></td>
            <td align="center"><?php echo Util::moneyFormat($dato['valor']); ?></td>
            <td align="center"><?php echo $dato['recordDate']; ?></td>
            <?php if($_SESSION['rol'] === '1'){ ?>
                <td align="center"><?php echo $advisorModel->getNameAdvisor($dato['nickasesor']); ?></td>
            <?php } ?>
            <td align="center"><?php echo $dato['payDate']; ?></td>
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
            <?php } ?>
            <th align="center">Fecha de pago</th>
        </tr>
        </tfoot>
    </table>
    <p><h2>Total pagos completados: <?php echo Util::moneyFormat($totalPay); ?></h2></p>
