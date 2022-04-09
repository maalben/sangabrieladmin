<?php require_once __DIR__.'/resources2.php' ?>

<h2>Registro de Titular</h2>

<br />

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    Ingresa los datos del titular
                </div>

                <div class="panel-options">
                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>

                </div>
            </div>

            <div class="panel-body">

                <form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="../index.php?accion=saveOwner">

                    <div class="form-group">
                        <label for="txtcedula" class="col-sm-3 control-label">C&eacute;dula: </label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="txtcedula" id="txtcedula" data-validate="number"
                                   data-message-required="Campo numerico." placeholder="Campo requerido">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtnombre" class="col-sm-3 control-label">Nombre: </label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="txtnombre" name="txtnombre">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtapellido" class="col-sm-3 control-label">Apellido: </label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="txtapellido" name="txtapellido">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Estado civil:</label>

                        <div class="col-sm-5">
                            <select name="selestadocivil" id="selestadocivil" class="form-control">
                                <option value selected="selected">Seleccione...</option>
                                <option value="Casado(a)">CASADO(A)</option>
                                <option value="Soltero(a)">SOLTERO(A)</option>
                                <option value="Union libre">UNION LIBRE</option>
                                <option value="Viudo(a)">VIUDO(A)</option>
                                <option value="Otro">OTRO</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Fecha de nacimiento:</label>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" name="txtfechanacimiento" id="txtfechanacimiento" class="form-control datepicker" data-format="yyyy-mm-dd">

                                <div class="input-group-addon">
                                    <a href="#"><i class="entypo-calendar"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtdireccion" class="col-sm-3 control-label">Direcci&oacute;n: </label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="txtdireccion" name="txtdireccion">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtbarrio" class="col-sm-3 control-label">Barrio: </label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="txtbarrio" name="txtbarrio">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Estado civil:</label>

                        <div class="col-sm-5">
                            <select name="selmunicipio" id="selmunicipio" class="form-control">
                                <option value selected="selected">Seleccione...</option>
                                <option value="Barbosa">Barbosa</option>
                                <option value="Girardota">Girardota</option>
                                <option value="Copacabana">Copacabana</option>
                                <option value="Bello">Bello</option>
                                <option value="Sabaneta">Sabaneta</option>
                                <option value="Itagüí">Itagüí</option>
                                <option value="La estrella">La estrella</option>
                                <option value="Caldas">Caldas</option>
                                <option value="San Cristóbal">San Cristóbal</option>
                                <option value="San Antonio de prado">San Antonio de prado</option>
                                <option value="Palmitas">Palmitas</option>
                                <option value="Envigado">Envigado</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtcelular" class="col-sm-3 control-label">Celular: </label>

                        <div class="col-sm-5">
                            <input type="number" class="form-control" id="txtcelular" name="txtcelular">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtcorreo" class="col-sm-3 control-label">Correo:</label>

                        <div class="col-sm-5">
                        <input type="text" class="form-control" id="txtcorreo" name="txtcorreo" data-validate="email"
                               placeholder="Campo de correo" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtcantidadbeneficiarios" class="col-sm-3 control-label">Cantidad de beneficiarios</label>
                        <div class="col-sm-5">
                        <input type="text" class="form-control" id="txtcantidadbeneficiarios" name="txtcantidadbeneficiarios" data-validate="number" placeholder="Campo num&eacute;rico" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtmensualidad" class="col-sm-3 control-label">Mensualidad: </label>
                        <div class="col-sm-5">
                        <input type="text" class="form-control" id="txtmensualidad" name="txtmensualidad" data-validate="number" placeholder="Campo num&eacute;rico" />
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-default">Guardar</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>


<?php require_once 'footer2.php' ?>
