<!-- Modal -->
<div class="modal fade" id="formUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
               
                <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar usuario</h4>
            </div>

            <!-- form start -->
            <form class="form-horizontal" name="guardar-registro" id="guardar-registro" method="post"
                action="modelo/modelo-usuario.php">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="usuario" class="col-sm-4 col-form-label">Usuario</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nombreUsu" class="col-sm-4 col-form-label">Nombre</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nombreUsu" name="nombreUsu"
                                placeholder="Escribe tu nombre completo">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="mail" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="mail" name="mail"
                                placeholder="Escribe tu nombre completo">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="idPerfil" class="col-sm-4 col-form-label">Permisos de acceso</label>
                        <div class="col-sm-8">
                            <select class="form-control seleccionar select2-primary" id="idPerfil" name="idPerfil"
                                data-dropdown-css-class="select2-secondary" style="width: 100%;">
                                <option value="1">User</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password para iniciar sesion">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Repetir Password:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="repetir_password" name="repetir_password"
                                placeholder="Verificar Password">
                            <span id="resultado_password" class="help-block"></span>
                        </div>
                    </div>

                </div>
                <!-- /.modal-body -->
                <div class="modal-footer">
                    <input type="hidden" name="registro" value="nuevo">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="crear_registro_admin">Añadir</button>
                </div>
                <!-- /.modal-footer -->
            </form>

        </div>
    </div>
</div>