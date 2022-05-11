<?php
require_once __DIR__.'/resources2.php';
require_once __DIR__.'/../model/AdvisorModel.php';
require_once __DIR__.'/../model/OwnerModel.php';
require_once __DIR__.'/../model/BeneficiariesModel.php';
$advisorModel = new AdvisorModel();
$ownerModel = new OwnerModel();
$beneficiariesModel = new BeneficiariesModel();
?>

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
            <th>C&eacute;dula titular</th>
            <th>C&eacute;dula beneficiario</th>
            <th>Nombre Completo</th>
            <th>Ver detalle</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($consulta !== ''){
        foreach($consulta as $dato):
            $ownerIdentify = $dato["cedulatitular"];
            $Identify = $dato["cedulabeneficiario"];
            $ownerRow = $ownerModel->getInformationOwner($ownerIdentify);
            ?>
        <tr class="odd gradeX">
            <td>
                <?php if($this->payModel->blockDetailsOwner($_SESSION['rol'], $_SESSION['username'], $dato['cedulatitular']) === 1){ ?>
                <a href="javascript:;" onclick="jQuery('#modalOwner-<?php echo $ownerIdentify; ?>').modal('show',{backdrop:'static'});"><?php echo $ownerIdentify; ?></a>
                <?php }else{
                    echo $ownerIdentify;
                } ?>
            </td>
            <!-- Modal owner -->
            <div class="modal fade" id="modalOwner-<?php echo $ownerIdentify; ?>">
                <div class="modal-dialog">
                    <form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="../index.php?accion=saveChangeOwner">

                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Informaci&oacute;n del titular <?php echo utf8_decode($ownerRow['nombretitular']) . ' ' . utf8_decode($ownerRow['apellidotitular']); ?></h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label for="txtcedula" class="control-label">C&eacute;dula</label>
                                            <p><?php echo $ownerIdentify; ?></p>
                                            <input type="hidden" id="txtcedula" name="txtcedula" value="<?php echo $ownerIdentify; ?>">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtnombre" class="control-label">Nombre</label>
                                            <input type="text" class="form-control" id="txtnombre" name="txtnombre" value="<?php echo utf8_decode($ownerRow['nombretitular']); ?>">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtapellido" class="control-label">Apellido</label>
                                            <input type="text" class="form-control" id="txtapellido" name="txtapellido" value="<?php echo utf8_decode($ownerRow['apellidotitular']); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="selestadocivil" class="control-label">Estado civil:</label>
                                            <select name="selestadocivil" id="selestadocivil" class="form-control">
                                                <?php $civilState = utf8_decode($ownerRow['estadociviltitular']); ?>
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
                                            <input type="text" name="txtfechanacimiento" id="txtfechanacimiento" class="form-control" data-format="yyyy-mm-dd"  value="<?php echo $ownerRow['fechanacimientotitular']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtedad" class="control-label">Edad:</label>
                                            <p><?php echo $ownerRow['edadtitular']; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtdireccion" class="control-label">Direcci&oacute;n:</label>
                                            <input type="text" id="txtdireccion" name="txtdireccion" class="form-control" data-format="yyyy-mm-dd"  value="<?php echo utf8_decode($ownerRow['direcciontitular']); ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtbarrio" class="control-label">Barrio:</label>
                                            <input type="text" class="form-control" id="txtbarrio" name="txtbarrio" value="<?php echo $ownerRow['barriotitular']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="selmunicipio" class="control-label">Municipio:</label>
                                            <select name="selmunicipio" id="selmunicipio" class="form-control">
                                                <?php $relationship = utf8_decode($ownerRow['municipiotitular']); ?>
                                                <option value="Barbosa" <?php if ($relationship === 'Barbosa'): ?>selected<?php endif; ?>>Barbosa</option>
                                                <option value="Girardota" <?php if ($relationship === 'Girardota'): ?>selected<?php endif; ?>>Girardota</option>
                                                <option value="Copacabana" <?php if ($relationship === 'Copacabana'): ?>selected<?php endif; ?>>Copacabana</option>
                                                <option value="Bello" <?php if ($relationship === 'Bello'): ?>selected<?php endif; ?>>Bello</option>
                                                <option value="Sabaneta" <?php if ($relationship === 'Sabaneta'): ?>selected<?php endif; ?>>Sabaneta</option>
                                                <option value="Itagüí" <?php if ($relationship === 'Itagüí'): ?>selected<?php endif; ?>>Itagüí</option>
                                                <option value="La estrella" <?php if ($relationship === 'La estrella'): ?>selected<?php endif; ?>>La estrella</option>
                                                <option value="Caldas" <?php if ($relationship === 'Caldas'): ?>selected<?php endif; ?>>Caldas</option>
                                                <option value="San Cristóbal" <?php if ($relationship === 'San Cristóbal'): ?>selected<?php endif; ?>>San Cristóbal</option>
                                                <option value="San Antonio de prado" <?php if ($relationship === 'San Antonio de prado'): ?>selected<?php endif; ?>>San Antonio de prado</option>
                                                <option value="Palmitas" <?php if ($relationship === 'Palmitas'): ?>selected<?php endif; ?>>Palmitas</option>
                                                <option value="Envigado" <?php if ($relationship === 'Envigado'): ?>selected<?php endif; ?>>Envigado</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtcelular" class="control-label">Celular:</label>
                                            <input type="text" class="form-control" id="txtcelular" name="txtcelular" value="<?php echo utf8_decode($ownerRow['celulartitular']); ?>">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtcorreo" class="control-label">Correo:</label>
                                            <input type="text" class="form-control" id="txtcorreo" name="txtcorreo" value="<?php echo utf8_decode($ownerRow['correotitular']); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtmensualidad" class="control-label">Mensualidad:</label>

                                            <?php if($_SESSION['rol'] === '1'){ ?>
                                                <input type="text" class="form-control" id="txtmensualidad" name="txtmensualidad" value="<?php echo utf8_decode($ownerRow['mensualidadtitular']); ?>">
                                            <?php }else{ ?>
                                                <p><h4><b><?php echo utf8_decode($ownerRow['mensualidadtitular']); ?></b></h4></p>
                                                <input type="hidden" id="txtmensualidad" name="txtmensualidad" value="<?php echo utf8_decode($ownerRow['mensualidadtitular']); ?>">
                                            <?php  } ?>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtcantidadbeneficiarios" class="control-label">Cantidad de beneficiarios:</label>
                                            <p><?php echo $beneficiariesModel->getQuantityBeneficiaries($ownerRow['cedulaafiliado']); ?></p>
                                            <input type="hidden" id="txtcantidadbeneficiarios" name="txtcantidadbeneficiarios" value="<?php echo $beneficiariesModel->getQuantityBeneficiaries($ownerRow['cedulaafiliado']); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group no-margin">
                                            <label for="field-7" class="control-label">Fecha de registro:</label>
                                            <p><?php echo Util::fechaCastellano(utf8_decode($ownerRow['recordDate'])); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group no-margin">
                                            <label for="field-7" class="control-label">Registro realizado por:</label>
                                            <p>
                                                <?php
                                                if(utf8_decode($advisorModel->getNameAdvisor($ownerRow['codigoasesor']))===''){
                                                    echo 'Sin especificar código de asesor. -Actual: <b>'.$ownerRow['codigoasesor'].'</b>';
                                                }else{
                                                    echo utf8_decode($advisorModel->getNameAdvisor($ownerRow['codigoasesor'])) . ' (<b>'.$ownerRow['codigoasesor'].'</b>)';
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <?php if($_SESSION['rol'] === '1'){ ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="txtcambioasesor" name="txtcambioasesor" placeholder="(Opcional) Escriba el c&oacute;digo del asesor si desea asignarlo">
                                            </div>
                                        </div>
                                    </div>
                                <?php }else{  ?>
                                    <input type="hidden" id="txtcambioasesor" name="txtcambioasesor">
                                <?php } ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group no-margin">
                                            <label for="field-7" class="control-label">Beneficiarios asociados:</label>
                                            <br>
                                            <?php
                                            $beneficiariesModel->toListBeneficiariesByOwner($ownerRow['cedulaafiliado']);
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
            <td><?php echo $dato['cedulabeneficiario']; ?></td>
            <td><?php echo $dato['nombrebeneficiario'] . ' ' . $dato['apellidobeneficiario']; ?></td>
            <td align="center">

                <?php if($this->payModel->blockDetailsOwner($_SESSION['rol'], $_SESSION['username'], $dato['cedulatitular']) === 1){ ?>
                    <a href="javascript:;" onclick="jQuery('#modalBeneficiaries-<?php echo $Identify; ?>').modal('show', {backdrop: 'static'});"><i class="fa fa-eye"></i></a>
                <?php } ?>

            </td>
            <!-- Modal 6 -->
            <div class="modal fade" id="modalBeneficiaries-<?php echo $Identify; ?>">
                <div class="modal-dialog">
                    <form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="../index.php?accion=saveChangeBeneficiary">

                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Informaci&oacute;n del beneficiario <?php echo $dato['nombrebeneficiario'] . ' ' . $dato['apellidobeneficiario']; ?></h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label for="txtcedula" class="control-label">C&eacute;dula</label>
                                            <p><?php echo $Identify; ?></p>
                                            <input type="hidden" id="txtcedulabeneficiario" name="txtcedulabeneficiario" value="<?php echo $Identify; ?>">
                                            <input type="hidden" id="txtcedulaTitular" name="txtcedulaTitular" value="<?php echo $ownerIdentify; ?>">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtnombrebeneficiario" class="control-label">Nombre</label>
                                            <input type="text" class="form-control" id="txtnombrebeneficiario" name="txtnombrebeneficiario" value="<?php echo $dato['nombrebeneficiario']; ?>">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtapellidobeneficiario" class="control-label">Apellido</label>
                                            <input type="text" class="form-control" id="txtapellidobeneficiario" name="txtapellidobeneficiario" value="<?php echo $dato['apellidobeneficiario']; ?>">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtfechanacimientobeneficiario" class="control-label">F. Nacimi. (A&ntilde;o-Mes-D&iacute;a) :</label>
                                            <input type="text" name="txtfechanacimientobeneficiario" id="txtfechanacimientobeneficiario" class="form-control" data-format="yyyy-mm-dd"  value="<?php echo $dato['fechanacimientobeneficiario']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtedad" class="control-label">Edad:</label>
                                            <p><?php echo $dato['edadbeneficiario']; ?></p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="selparentesco" class="control-label">Parentesco:</label>
                                                    <select name="selparentesco" id="selparentesco" class="form-control">
                                                        <?php $relationship = utf8_decode($dato['parentescobeneficiario']); ?>
                                                        <option value="Padre" <?php if ($relationship === 'Padre'): ?>selected<?php endif; ?>>Padre</option>
                                                        <option value="Madre" <?php if ($relationship === 'Madre'): ?>selected<?php endif; ?>>Madre</option>
                                                        <option value="Hijo/A" <?php if ($relationship === 'Hijo/A'): ?>selected<?php endif; ?>>Hijo/A</option>
                                                        <option value="Sobrino/A" <?php if ($relationship === 'Sobrino/A'): ?>selected<?php endif; ?>>Sobrino/A</option>
                                                        <option value="Cuñado/A" <?php if ($relationship === 'Cuñado/A'): ?>selected<?php endif; ?>>Cuñado/A</option>
                                                        <option value="Padrastro" <?php if ($relationship === 'Padrastro'): ?>selected<?php endif; ?>>Padrastro</option>
                                                        <option value="Nieto/A" <?php if ($relationship === 'Nieto/A'): ?>selected<?php endif; ?>>Nieto/A</option>
                                                        <option value="Amigo/A" <?php if ($relationship === 'Amigo/A'): ?>selected<?php endif; ?>>Amigo/A</option>
                                                        <option value="Hermano/A" <?php if ($relationship === 'Hermano/A'): ?>selected<?php endif; ?>>Hermano/A</option>
                                                        <option value="Primo/A" <?php if ($relationship === 'Primo/A'): ?>selected<?php endif; ?>>Primo/A</option>
                                                        <option value="Conyugue" <?php if ($relationship === 'Conyugue'): ?>selected<?php endif; ?>>Conyugue</option>
                                                        <option value="Hijastro/A" <?php if ($relationship === 'Hijastro/A'): ?>selected<?php endif; ?>>Hijastro/A</option>
                                                        <option value="Suegro/A" <?php if ($relationship === 'Suegro/A'): ?>selected<?php endif; ?>>Suegro/A</option>
                                                        <option value="Nuera" <?php if ($relationship === 'Nuera'): ?>selected<?php endif; ?>>Nuera</option>
                                                        <option value="Yerno" <?php if ($relationship === 'Yerno'): ?>selected<?php endif; ?>>Yerno</option>
                                                        <option value="Madrastra" <?php if ($relationship === 'Madrastra'): ?>selected<?php endif; ?>>Madrastra</option>
                                                        <option value="Bisnieto/A" <?php if ($relationship === 'Bisnieto/A'): ?>selected<?php endif; ?>>Bisnieto/A</option>
                                                        <option value="Hermanastro/A" <?php if ($relationship === 'Hermanastro/A'): ?>selected<?php endif; ?>>Hermanastro/A</option>
                                                    </select>
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
                                            <p><?php
                                                if($advisorModel->getNameAdvisor($ownerRow['codigoasesor']) !== ''){
                                                    echo utf8_decode($advisorModel->getNameAdvisor($ownerRow['codigoasesor'])) . ' ('.$ownerRow['codigoasesor'].')';
                                                }else{
                                                    echo 'No registra asesor';
                                                }
                                                 ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group no-margin">
                                            <label for="field-7" class="control-label">Titular:</label>
                                            <p><?php echo utf8_decode($ownerRow['nombretitular']) . ' ' . utf8_decode($ownerRow['apellidotitular']); ?></p>
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
            <th>C&eacute;dula titular</th>
            <th>C&eacute;dula beneficiario</th>
            <th>Nombre Completo</th>
            <th>Ver detalle</th>
        </tr>
        </tfoot>
    </table>

<?php require_once 'footer2.php' ?>