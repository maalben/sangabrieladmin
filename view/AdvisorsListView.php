<?php
require_once __DIR__.'/resources2.php';
require_once __DIR__.'/../model/AdvisorModel.php';
require_once __DIR__.'/../model/BeneficiariesModel.php';
require_once __DIR__.'/../model/PermissionsModel.php';
$advisorModel = new AdvisorModel();
$beneficiariesModel = new BeneficiariesModel();
$permissionsModel = new PermissionsModel();
?>

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
            <th align="center">C&eacute;dula asesor</th>
            <th align="center">Nombre Completo</th>
            <th align="center">C&oacute;digo único</th>
            <th align="center">Ver detalles</th>
            <th align="center">Permisos</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($consulta !== ''){
        foreach($consulta as $dato): ?>
        <tr class="odd gradeX">
            <td align="center"><?php echo $dato['cedula']; ?></td>
            <td align="center"><?php echo utf8_decode($dato['nombre']) . ' ' . utf8_decode($dato['apellido']); ?></td>
            <td align="center"><?php echo $dato['codigoasesor']; ?></td>
            <td align="center"><a href="javascript:;" onclick="jQuery('#modal-<?php echo $dato['id']; ?>').modal('show', {backdrop: 'static'});"><i class="fa fa-eye"></i></a></td>

            <!-- Modal 6 -->
            <div class="modal fade" id="modal-<?php echo $dato['id']; ?>">
                <div class="modal-dialog">
                    <form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="../index.php?accion=saveChangeAdvisor">

                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Informaci&oacute;n de <?php echo utf8_decode($dato['nombre']) . ' ' . utf8_decode($dato['apellido']); ?></h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label for="txtcedula" class="control-label">C&eacute;dula:</label>
                                            <p><?php echo $dato['cedula']; ?></p>
                                            <input type="hidden" id="txtcedula" name="txtcedula" value="<?php echo utf8_decode($dato['cedula']); ?>">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtnombre" class="control-label">Nombre:</label>
                                            <input type="text" class="form-control" id="txtnombre" name="txtnombre" value="<?php echo utf8_decode($dato['nombre']); ?>">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtapellido" class="control-label">Nombre:</label>
                                            <input type="text" class="form-control" id="txtapellido" name="txtapellido" value="<?php echo utf8_decode($dato['apellido']); ?>">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="txtcodigounico" class="control-label">C&oacute;digo &uacute;nico:
                                            </label>
                                            <p><?php echo utf8_decode($dato['codigoasesor']); ?></p>
                                            <input type="hidden" id="txtcodigounico" name="txtcodigounico" value="<?php echo utf8_decode($dato['codigoasesor']); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="txtcorreo" class="control-label">Correo:
                                            </label>
                                            <input type="text" class="form-control" id="txtcorreo" name="txtcorreo" value="<?php echo utf8_decode($dato['emailasesor']); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtdireccion" class="control-label">Direcci&oacute;n:</label>
                                            <input type="text" id="txtdireccion" name="txtdireccion" class="form-control" value="<?php echo utf8_decode($dato['direccionasesor']); ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txttelefono" class="control-label">Tel&eacute;fono:</label>
                                            <input type="text" class="form-control" id="txttelefono" name="txttelefono" value="<?php echo $dato['telefonoasesor']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtcelular" class="control-label">Celular:</label>
                                            <input type="text" class="form-control" id="txtcelular" name="txtcelular" value="<?php echo utf8_decode($dato['celularasesor']); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="seltipocuenta" class="control-label">Tipo de cuenta:</label>
                                            <select name="seltipocuenta" id="seltipocuenta" class="form-control" required>
                                                <?php $accountType = utf8_decode($dato['tipocuenta']); ?>
                                                <option value="Cuenta de ahorros" <?php if ($accountType === 'Cuenta de ahorros'): ?>selected<?php endif; ?>>Cuenta de ahorros</option>
                                                <option value="Bancolombia a la mano" <?php if ($accountType === 'Bancolombia a la mano'): ?>selected<?php endif; ?>>Bancolombia a la mano</option>
                                                <option value="Cuenta corriente" <?php if ($accountType === 'Cuenta corriente'): ?>selected<?php endif; ?>>Cuenta corriente</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtentidadbancaria" class="control-label">Banco cuenta:</label>
                                            <input type="text" class="form-control" id="txtentidadbancaria" name="txtentidadbancaria" value="<?php echo $dato['bancocuentaasesor']; ?>">
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="txtnumerocuenta" class="control-label">N&uacute;mero de cuenta:</label>
                                            <input type="text" class="form-control" id="txtnumerocuenta" name="txtnumerocuenta" value="<?php echo utf8_decode($dato['numerocuentaasesor']); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="txtpassword" class="control-label">Password:</label>
                                            <input type="text" class="form-control" id="txtpassword" name="txtpassword" placeholder="(Opcional si deseas cambiar la clave)">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <div class="form-group">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-info">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <td align="center"><a href="javascript:;" onclick="jQuery('#modalPermissions-<?php echo $dato['id']; ?>').modal('show',{backdrop:'static'});"><i class="fa fa-unlock"></i></a></td>

            <!-- Modal 6 -->
            <div class="modal fade" id="modalPermissions-<?php echo $dato['id']; ?>">
                <div class="modal-dialog">
                    <form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="../index.php?accion=saveChangePermissions">

                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Edici&oacute;n de permisos  de <?php echo utf8_decode($dato['nombre']) . ' ' . utf8_decode($dato['apellido']); ?></h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="txtcedula" class="control-label">C&eacute;dula:</label>
                                            <p><?php echo $dato['cedula']; ?></p>
                                            <input type="hidden" id="txtcedula" name="txtcedula" value="<?php echo utf8_decode($dato['cedula']); ?>">
                                            <input type="hidden" id="txtIdUser" name="txtIdUser" value="<?php echo utf8_decode($dato['id']); ?>">
                                            <input type="hidden" id="txtUsername" name="txtUsername" value="<?php echo utf8_decode($dato['codigoasesor']); ?>">
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if($listPermissionsOptions !== ''){
                                foreach($listPermissionsOptions as $permissions): ?>
                                <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <div class="checkbox">
                                            <label>
                                                <?php

                                                if($permissionsModel->advisorPermission($permissions['Id'], $this->permissionsModel->getIdUserSystem($dato['codigoasesor'])) === ''){  ?>
                                                <input id="modulo<?php echo $permissions['Id']; ?>" name="modulo<?php echo $permissions['Id']; ?>" type="checkbox" value="<?php echo $permissions['Nombre']; ?>">
                                                <?php }else{ ?>
                                                    <input id="modulo<?php echo $permissions['Id']; ?>" name="modulo<?php echo $permissions['Id']; ?>" type="checkbox" value="<?php echo $permissions['Nombre']; ?>" checked>
                                                <?php } ?>
                                            </label>
                                            <pre style='display:inline'> <?php echo $permissions['Nombre']; ?> </pre>

                                        </div>
                                    </div>
                                </div>
                                </div>

                                <?php endforeach;
                                }
                                ?>

                            </div>

                            <div class="modal-footer">
                                <div class="form-group">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-info">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



        </tr>
        <?php endforeach;
        }
        ?>

        </tbody>
        <tfoot>
        <tr>
            <th>C&eacute;dula asesor</th>
            <th>Nombre Completo</th>
            <th>C&oacute;digo único</th>
            <th>Ver detalles</th>
            <th>Permisos</th>
        </tr>
        </tfoot>
    </table>

<?php require_once 'footer2.php' ?>