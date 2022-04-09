<?php require_once __DIR__.'/resources2.php' ?>

<h2>Registro de Beneficiarios</h2>

<br />

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    Ingresa los datos del/los beneficiarios del titular
                </div>

                <div class="panel-options">
                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>

                </div>
            </div>

            <div class="panel-body">

                <form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="../index.php?accion=saveBeneficiaries">

                    <div class="form-group">
                        <label for="txtcedulaTitular" class="col-sm-1 control-label">C&eacute;dula del titular: </label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="txtcedulaTitular" id="txtcedulaTitular" data-validate="number"
                                   data-message-required="Campo numerico." placeholder="Campo requerido">
                        </div>
                    </div>

                    <div class="form-group">
                            <label for="txtnombre" class="col-lg-3 control-label">INFORMACION
                                BENEFICIARIO(S)
                            </label>
                        </div>

                <?php for ($i = 0; $i < 12; $i++) {  ?>
                    <div class="form-group">

                        <div class="col-md-2">
                            <label for="txtcedulaTitular" class="col-md-10 control-label">C&eacute;dula beneficiario:
                            </label>
                            <input type="text" class="form-control" name="txtcedulabeneficiario<?php echo $i; ?>" id="txtcedulabeneficiario<?php echo $i; ?>" data-validate="number" data-message-required="Campo numerico." placeholder="Campo requerido">
                        </div>



                        <div class="col-md-2">
                            <label for="txtnombre" class="col-md-5 control-label">Nombre: </label>
                            <input type="text" class="form-control" id="txtnombre<?php echo $i; ?>" name="txtnombre<?php echo $i; ?>">
                        </div>



                        <div class="col-md-2">
                            <label for="txtapellido" class="col-md-5 control-label">Apellido: </label>
                            <input type="text" class="form-control" id="txtapellido<?php echo $i; ?>" name="txtapellido<?php echo $i; ?>">
                        </div>



                            <div class="col-md-2">
                                <label for="txtfechanacimiento" class="col-md-11 control-label">Fecha de nacimiento:</label>
                                <input type="text" name="txtfechanacimiento<?php echo $i; ?>" id="txtfechanacimiento<?php echo $i; ?>" class="form-control datepicker" data-format="yyyy-mm-dd">
                            </div>



                        <div class="col-md-2">
                            <label class="col-md-1 control-label">Parentesco:</label>
                            <select name="selparentesco<?php echo $i; ?>" id="selparentesco<?php echo $i; ?>" class="form-control">
                                <option value selected="selected">Seleccione...</option>
                                <option value="Padre">Padre</option>
                                <option value="Madre">Madre</option>
                                <option value="Hijo/A">Hijo/A</option>
                                <option value="Sobrino/A">Sobrino/A</option>
                                <option value="Bello">Bello</option>
                                <option value="Cuñado/A">Cuñado/A</option>
                                <option value="Padrastro">Padrastro</option>
                                <option value="Nieto/A">Nieto/A</option>
                                <option value="Amigo/A">Amigo/A</option>
                                <option value="Hermano/A">Hermano/A</option>
                                <option value="Primo/A">Primo/A</option>
                                <option value="Conyugue">Conyugue</option>
                                <option value="Hijastro/A">Hijastro/A</option>
                                <option value="Suegro/A">Suegro/A</option>
                                <option value="Nuera">Nuera</option>
                                <option value="Yerno">Yerno</option>
                                <option value="Madrastra">Madrastra</option>
                                <option value="Bisnieto/A">Bisnieto/A</option>
                                <option value="Hermanastro/A">Hermanastro/A</option>
                            </select>
                        </div>
                    </div>
                <?php } ?>








                    <div class="form-group">
                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-default">Guardar</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>


<?php require_once 'footer2.php' ?>
