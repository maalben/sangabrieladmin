<?php
require_once __DIR__.'/resources2.php';
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

    <hr>
    <hr>
    <hr>

    <p><h2>Total pagos completados: <?php echo Util::moneyFormat($totalPay); ?></h2></p>

    <br>
    <p><h2>Filtra los pagos completados</h2></p>

    <div class="panel-body">

        <form role="form" method="post" class="form-horizontal form-groups-bordered validate">

            <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="txtfechainicial" class="control-label">Pagos desde:</label>
                            <input type="text" class="form-control datepicker" id="txtfechainicial" name="txtfechainicial" data-format="dd-mm-yyyy" required>
                        </div>

                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="txtfechafinal" class="control-label">Pagos hasta:</label>
                            <input type="text" class="form-control datepicker" id="txtfechafinal" name="txtfechafinal" data-format="dd-mm-yyyy" required>
                        </div>
                    </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="btnbutton" class="control-label">&nbsp;</label>
                        <button type="button" name="btnbutton" id="btnbutton" value="Filtrar" class="btn btn-default form-control" onclick="proceso( $('#txtfechainicial').val(), $('#txtfechafinal').val(), $('#btnbutton').val() );">Filtrar</button>
                    </div>
                </div>
            </div>

            <br>
            <span id="filtro"></span>



        </form>

    </div>


<?php require_once 'footer2.php' ?>