<?php
    require_once __DIR__.'/resources2.php';
    require_once __DIR__.'/../model/AdvisorModel.php';
    require_once __DIR__.'/../model/BeneficiariesModel.php';
    $advisorModel = new AdvisorModel();
    $beneficiariesModel = new BeneficiariesModel();
?>

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
            <th>C&eacute;dula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Ver detalle</th>
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
            <td><?php echo $dato['cedulaafiliado']; ?></td>
            <td><?php echo utf8_decode($dato['nombretitular']); ?></td>
            <td><?php echo utf8_decode($dato['apellidotitular']); ?></td>
            <td align="center">
                <?php if($this->payModel->blockDetailsOwner($_SESSION['rol'], $_SESSION['username'], $dato['cedulaafiliado']) === 1){ ?>
                <a href="javascript:;" onclick="jQuery('#modal-<?php echo $dato["id"]; ?>').modal('show', {backdrop: 'static'});"><i class="fa fa-eye"></i></a></td>
            <?php } ?>
            <!-- Modal 6 -->
            <div class="modal fade" id="modal-<?php echo $dato['id']; ?>">
                <div class="modal-dialog">
                    <form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="../index.php?accion=saveChangeOwner">

                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Informaci&oacute;n de <?php echo utf8_decode($dato['nombretitular']) . ' ' . utf8_decode($dato['apellidotitular']); ?></h4>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="txtcedula" class="control-label">C&eacute;dula</label>
                                        <p><?php echo $dato['cedulaafiliado']; ?></p>
                                        <input type="hidden" id="txtcedula" name="txtcedula" value="<?php echo utf8_decode($dato['cedulaafiliado']); ?>">
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtnombre" class="control-label">Nombre</label>
                                        <input type="text" class="form-control" id="txtnombre" name="txtnombre" value="<?php echo utf8_decode($dato['nombretitular']); ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtapellido" class="control-label">Apellido</label>
                                        <input type="text" class="form-control" id="txtapellido" name="txtapellido" value="<?php echo utf8_decode($dato['apellidotitular']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="selestadocivil" class="control-label">Estado civil:</label>
                                        <select name="selestadocivil" id="selestadocivil" class="form-control">
                                            <?php $civilState = utf8_decode($dato['estadociviltitular']); ?>
                                            <option value="Casado(a)" <?php if ($civilState === 'Casado(a)'): ?>selected<?php endif; ?>>CASADO(A)</option>
                                            <option value="Soltero(a)" <?php if ($civilState === 'Soltero(a)'): ?>selected<?php endif; ?>>SOLTERO(A)</option>
                                            <option value="Union libre" <?php if ($civilState === 'Union libre'): ?>selected<?php endif; ?>>UNION LIBRE</option>
                                            <option value="Viudo(a)" <?php if ($civilState === 'Viudo(a)'): ?>selected<?php endif; ?>>VIUDO(A)</option>
                                            <option value="Otro" <?php if ($civilState === 'Otro'): ?>selected<?php endif; ?>>OTRO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtfechanacimiento" class="control-label">F. Nacimi. (A&ntilde;o-Mes-D&iacute;a) :</label>
                                        <input type="text" name="txtfechanacimiento" id="txtfechanacimiento" class="form-control" data-format="yyyy-mm-dd"  value="<?php echo $dato['fechanacimientotitular']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtedad" class="control-label">Edad:</label>
                                        <p><?php echo $dato['edadtitular']; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtdireccion" class="control-label">Direcci&oacute;n:</label>
                                        <input type="text" id="txtdireccion" name="txtdireccion" class="form-control" data-format="yyyy-mm-dd"  value="<?php echo utf8_decode($dato['direcciontitular']); ?>">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtbarrio" class="control-label">Barrio:</label>
                                        <input type="text" class="form-control" id="txtbarrio" name="txtbarrio" value="<?php echo $dato['barriotitular']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="selmunicipio" class="control-label">Municipio:</label>
                                        <select name="selmunicipio" id="selmunicipio" class="form-control">
                                            <?php $city = utf8_decode($dato['municipiotitular']); ?>
                                            <option value="Barbosa" <?php if ($city === 'Barbosa'): ?>selected<?php endif; ?>>Barbosa</option>
                                            <option value="Girardota" <?php if ($city === 'Girardota'): ?>selected<?php endif; ?>>Girardota</option>
                                            <option value="Copacabana" <?php if ($city === 'Copacabana'): ?>selected<?php endif; ?>>Copacabana</option>
                                            <option value="Bello" <?php if ($city === 'Bello'): ?>selected<?php endif; ?>>Bello</option>
                                            <option value="Sabaneta" <?php if ($city === 'Sabaneta'): ?>selected<?php endif; ?>>Sabaneta</option>
                                            <option value="Itagüí" <?php if ($city === 'Itagüí'): ?>selected<?php endif; ?>>Itagüí</option>
                                            <option value="La estrella" <?php if ($city === 'La estrella'): ?>selected<?php endif; ?>>La estrella</option>
                                            <option value="Caldas" <?php if ($city === 'Caldas'): ?>selected<?php endif; ?>>Caldas</option>
                                            <option value="San Cristóbal" <?php if ($city === 'San Cristóbal'): ?>selected<?php endif; ?>>San Cristóbal</option>
                                            <option value="San Antonio de prado" <?php if ($city === 'San Antonio de prado'): ?>selected<?php endif; ?>>San Antonio de prado</option>
                                            <option value="Palmitas" <?php if ($city === 'Palmitas'): ?>selected<?php endif; ?>>Palmitas</option>
                                            <option value="Envigado" <?php if ($city === 'Envigado'): ?>selected<?php endif; ?>>Envigado</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtcelular" class="control-label">Celular:</label>
                                        <input type="text" class="form-control" id="txtcelular" name="txtcelular" value="<?php echo utf8_decode($dato['celulartitular']); ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtcorreo" class="control-label">Correo:</label>
                                        <input type="text" class="form-control" id="txtcorreo" name="txtcorreo" value="<?php echo utf8_decode($dato['correotitular']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtmensualidad" class="control-label">Mensualidad:</label>
                                        <input type="text" class="form-control" id="txtmensualidad" name="txtmensualidad" value="<?php echo utf8_decode($dato['mensualidadtitular']); ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtcantidadbeneficiarios" class="control-label">Cantidad de beneficiarios:</label>
                                        <p><?php echo $beneficiariesModel->getQuantityBeneficiaries($dato['cedulaafiliado']); ?></p>
                                        <input type="hidden" id="txtcantidadbeneficiarios" name="txtcantidadbeneficiarios" value="<?php echo $beneficiariesModel->getQuantityBeneficiaries($dato['cedulaafiliado']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Fecha de registro:</label>
                                        <p><?php echo Util::fechaCastellano(utf8_decode($dato['recordDate'])); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Registro realizado por:</label>
                                        <p><?php echo utf8_decode($advisorModel->getNameAdvisor($dato['codigoasesor'])) . ' ('.$dato['codigoasesor'].')'; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="txtcambioasesor" name="txtcambioasesor" placeholder="(Opcional) Escriba el c&oacute;digo
 del asesor si desea cambiarlo">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Beneficiarios asociados:</label>
                                                <br>
                                                <?php
                                                $beneficiariesModel->toListBeneficiariesByOwner($dato['cedulaafiliado']);
                                                 ?>
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

        </tr>
        <?php endforeach;
        }
        ?>

        </tbody>
        <tfoot>
        <tr>
            <th>C&eacute;dula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Ver detalle</th>
        </tr>
        </tfoot>
    </table>

<?php require_once 'footer2.php' ?>