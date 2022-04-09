<?php require_once __DIR__.'/resources2.php' ?>

    <h2>Consulta de Asesores</h2>

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
            <th>#</th>
            <th>C&eacute;dula asesor</th>
            <th>Nombre Completo</th>
            <th>C&oacute;digo único</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($consulta !== ''){
        foreach($consulta as $dato): ?>
        <tr class="odd gradeX">
            <td><?php echo $dato['id']; ?></td>
            <td><?php echo $dato['cedula']; ?></td>
            <td><?php echo utf8_decode($dato['nombre']) . ' ' . utf8_decode($dato['apellido']); ?></td>
            <td><?php echo $dato['codigoasesor']; ?></td>
            <td><?php echo $dato['emailasesor']; ?></td>
        </tr>
        <?php endforeach;
        }
        ?>

        </tbody>
        <tfoot>
        <tr>
            <th>#</th>
            <th>C&eacute;dula asesor</th>
            <th>Nombre Completo</th>
            <th>C&oacute;digo único</th>
            <th>Email</th>
        </tr>
        </tfoot>
    </table>

<?php require_once 'footer2.php' ?>