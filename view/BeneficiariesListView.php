<?php require_once 'resources2.php' ?>

    <h2>Consulta de Beneficiarios</h2>

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
            <th>C&eacute;dula titular</th>
            <th>C&eacute;dula beneficiario</th>
            <th>Nombre Completo</th>
            <th>Fecha Nac.</th>
            <th>Edad</th>
            <th>Parentesco</th>
            <th>Fecha de registro</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($consulta !== ''){
        foreach($consulta as $dato): ?>
        <tr class="odd gradeX">
            <td><?php echo $dato['id']; ?></td>
            <td><?php echo $dato['cedulatitular']; ?></td>
            <td><?php echo $dato['cedulabeneficiario']; ?></td>
            <td><?php echo utf8_decode($dato['nombrecompletobeneficiario']); ?></td>
            <td><?php echo utf8_decode($dato['fechanacimientobeneficiario']); ?></td>
            <td><?php echo $dato['edadbeneficiario']; ?></td>
            <td><?php echo $dato['parentescobeneficiario']; ?></td>
            <td><?php echo $dato['recordDate']; ?></td>
        </tr>
        <?php endforeach;
        }
        ?>

        </tbody>
        <tfoot>
        <tr>
            <th>#</th>
            <th>C&eacute;dula titular</th>
            <th>C&eacute;dula beneficiario</th>
            <th>Nombre Completo</th>
            <th>Fecha Nac.</th>
            <th>Edad</th>
            <th>Parentesco</th>
            <th>Fecha de registro</th>
        </tr>
        </tfoot>
    </table>

<?php require_once 'footer2.php' ?>