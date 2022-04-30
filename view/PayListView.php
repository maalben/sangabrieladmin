<?php
require_once __DIR__.'/resources2.php';
?>

    <h2>Consulta de Pagos pendientes</h2>

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
        </tr>
        </thead>
        <tbody>
        <?php
        if($consulta !== ''){
        foreach($consulta as $dato): ?>
        <tr class="odd gradeX">
            <td align="center"><?php echo $dato['cedulafiliado']; ?></td>
            <td align="center"><?php echo $dato['valor']; ?></td>
            <td align="center"><?php echo $dato['recordDate']; ?></td>
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
        </tr>
        </tfoot>
    </table>

<?php require_once 'footer2.php' ?>