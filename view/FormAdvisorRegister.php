<?php require_once __DIR__.'/resources2.php' ?>

<h2>Registro de Asesor</h2>

<br />

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    Ingresa los datos del asesor
                </div>

                <div class="panel-options">
                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>

                </div>
            </div>

            <div class="panel-body">

                <form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="../index.php?accion=saveAdvisor">

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
                        <label for="txtcodigounico" class="col-sm-3 control-label">C&oacute;digo &uacute;nico: </label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="txtcodigounico" name="txtcodigounico">
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
                        <label for="txtdireccion" class="col-sm-3 control-label">Direcci&oacute;n: </label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="txtdireccion" name="txtdireccion">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txttelefono" class="col-sm-3 control-label">Tel&eacute;fono: </label>

                        <div class="col-sm-5">
                            <input type="number" class="form-control" id="txttelefono" name="txttelefono">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtcelular" class="col-sm-3 control-label">Celular: </label>

                        <div class="col-sm-5">
                            <input type="number" class="form-control" id="txtcelular" name="txtcelular">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtnumerocuenta" class="col-sm-3 control-label">N&uacute;mero de cuenta: </label>

                        <div class="col-sm-5">
                            <input type="number" class="form-control" id="txtnumerocuenta" name="txtnumerocuenta">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtentidadbancaria" class="col-sm-3 control-label">Entidad bancaria: </label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="txtentidadbancaria" name="txtentidadbancaria">
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
