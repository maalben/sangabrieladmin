<?php require_once __DIR__.'/resources2.php'; ?>

<h2>Perfil de usuario</h2>

<br />

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    Datos cargados
                </div>

                <div class="panel-options">
                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>

                </div>
            </div>

            <div class="panel-body">

                <form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="../index.php?accion=saveChangeProfile">

                <?php foreach($consulta as $dato):
                    if($_SESSION['rol'] === '1'){ ?>

                    <div class="form-group">
                        <label for="txtnombre" class="col-sm-3 control-label">Nombre: </label>
                        <div class="col-sm-5">
                            <input type="text" required class="form-control" id="txtnombre" name="txtnombre" value="<?php echo $dato['nombre']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtnick" class="col-sm-3 control-label">Nick o c&oacute;digo: </label>
                        <div class="col-sm-5">
                            <input type="text" required class="form-control" id="txtnick" name="txtnick" value="<?php echo $dato['nick']; ?>">
                        </div>
                    </div>
                        <input type="hidden" required class="form-control" id="txtrol" name="txtrol" value="<?php
                        echo $dato['rol']; ?>">
                    <!--<div class="form-group">
                        <label for="txtrol" class="col-sm-3 control-label">Rol: </label>
                        <div class="col-sm-5">

                        </div>
                    </div>-->

                    <div class="form-group">
                        <label for="txtpassword" class="col-sm-3 control-label">Password: </label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="txtpassword" name="txtpassword">
                        </div>
                    </div>

                    <?php }else{ ?>

                        <div class="form-group">
                            <label for="txtnombre" class="col-sm-3 control-label">Nombre: </label>
                            <div class="col-sm-5">
                                <input type="text" required class="form-control" id="txtnombre" name="txtnombre" value="<?php echo $dato['nombre']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtapellido" class="col-sm-3 control-label">Apellido: </label>
                            <div class="col-sm-5">
                                <input type="text" required class="form-control" id="txtapellido" name="txtapellido" value="<?php echo $dato['apellido']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtcedula" class="col-sm-3 control-label">C&eacute;dula: </label>
                            <div class="col-sm-5">
                                <p><?php echo utf8_decode($dato['cedula']); ?></p>
                                <input type="hidden" id="txtcedula" name="txtcedula" value="<?php echo $dato['cedula']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtnick" class="col-sm-3 control-label">Nick o c&oacute;digo: </label>
                            <div class="col-sm-5">
                                <p><?php echo utf8_decode($dato['codigoasesor']); ?></p>
                                <input type="hidden" id="txtnick" name="txtnick" value="<?php echo $dato['codigoasesor']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtnick" class="col-sm-3 control-label">Password: </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="txtpassword" name="txtpassword" placeholder="(Opcional si deseas cambiar la clave)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtemail" class="col-sm-3 control-label">Email: </label>
                            <div class="col-sm-5">
                                <input type="text" required class="form-control" id="txtcorreo" name="txtcorreo" value="<?php echo $dato['emailasesor']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtdireccion" class="col-sm-3 control-label">Direcci&oacute;n: </label>
                            <div class="col-sm-5">
                                <input type="text" required class="form-control" id="txtdireccion" name="txtdireccion" value="<?php echo $dato['direccionasesor']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txttelefono" class="col-sm-3 control-label">Tel&eacute;fono: </label>
                            <div class="col-sm-5">
                                <input type="text" required class="form-control" id="txttelefono" name="txttelefono" value="<?php echo $dato['telefonoasesor']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtcelular" class="col-sm-3 control-label">Celular: </label>
                            <div class="col-sm-5">
                                <input type="text" required class="form-control" id="txtcelular" name="txtcelular" value="<?php echo $dato['celularasesor']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtcelular" class="col-sm-3 control-label">Tipo de cuenta: </label>
                            <div class="col-sm-5">
                                <select name="seltipocuenta" id="seltipocuenta" class="form-control" required>
                                    <?php $accountType = utf8_decode($dato['tipocuenta']); ?>
                                    <option value="Cuenta de ahorros" <?php if ($accountType === 'Cuenta de ahorros'): ?>selected<?php endif; ?>>Cuenta de ahorros</option>
                                    <option value="Bancolombia a la mano" <?php if ($accountType === 'Bancolombia a la mano'): ?>selected<?php endif; ?>>Bancolombia a la mano</option>
                                    <option value="Cuenta corriente" <?php if ($accountType === 'Cuenta corriente'): ?>selected<?php endif; ?>>Cuenta corriente</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtbanco" class="col-sm-3 control-label">Banco cuenta: </label>
                            <div class="col-sm-5">
                                <input type="text" required class="form-control" id="txtentidadbancaria" name="txtentidadbancaria" value="<?php echo $dato['bancocuentaasesor']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtnumerocuenta" class="col-sm-3 control-label">N&uacute;mero cuenta: </label>
                            <div class="col-sm-5">
                                <input type="text" required class="form-control" id="txtnumerocuenta" name="txtnumerocuenta" value="<?php echo $dato['numerocuentaasesor']; ?>">
                            </div>
                        </div>

                    <?php } ?>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-default">Guardar</button>
                        </div>
                    </div>
                </form>
                <?php endforeach; ?>
            </div>

        </div>

    </div>
</div>


<?php require_once 'footer2.php' ?>
