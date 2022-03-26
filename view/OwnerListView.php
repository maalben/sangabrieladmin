<?php require_once 'resources2.php' ?>

    <h2>Consulta de Titulares</h2>

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
            <th>C&eacute;dula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Estado civil</th>
            <th>Fecha Nac.</th>
            <th>Edad</th>
            <th>Direcci&oacute;n</th>
            <th>Barrio</th>
            <th>Municipio</th>
            <th>Celular</th>
            <th>Email</th>
            <th>Mensualidad</th>
            <th>Afiliados</th>
            <th>Fecha registro</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($consulta !== ''){
        foreach($consulta as $dato):

            $quantityOwner = $dato['cantidadbeneficiarios'];

            if($this->beneficiariesModel->getQuantityBeneficiaries($dato['cedulaafiliado']) > 0){
                $quantityOwner = $this->beneficiariesModel->getQuantityBeneficiaries($dato['cedulaafiliado']);
            }
        ?>
        <tr class="odd gradeX">
            <td><?php echo $dato['id']; ?></td>
            <td><?php echo $dato['cedulaafiliado']; ?></td>
            <td><?php echo utf8_decode($dato['nombretitular']); ?></td>
            <td><?php echo utf8_decode($dato['apellidotitular']); ?></td>
            <td><?php echo $dato['estadociviltitular']; ?></td>
            <td><?php echo $dato['fechanacimientotitular']; ?></td>
            <td><?php echo $dato['edadtitular']; ?></td>
            <td><?php echo utf8_decode($dato['direcciontitular']); ?></td>
            <td><?php echo utf8_decode($dato['barriotitular']); ?></td>
            <td><?php echo utf8_decode($dato['municipiotitular']); ?></td>
            <td><?php echo $dato['celulartitular']; ?></td>
            <td><?php echo $dato['correotitular']; ?></td>
            <td><?php echo $dato['mensualidadtitular']; ?></td>
            <td><?php echo $quantityOwner; ?></td>
            <td><?php echo $dato['recordDate']; ?></td>
        </tr>
        <?php endforeach;
        }
        ?>

        </tbody>
        <tfoot>
        <tr>
            <th>#</th>
            <th>C&eacute;dula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Estado civil</th>
            <th>Fecha Nac.</th>
            <th>Edad</th>
            <th>Direcci&oacute;n</th>
            <th>Barrio</th>
            <th>Municipio</th>
            <th>Celular</th>
            <th>Email</th>
            <th>Mensualidad</th>
            <th>Afiliados</th>
            <th>Fecha registro</th>
        </tr>
        </tfoot>
    </table>

<?php require_once 'footer2.php' ?>