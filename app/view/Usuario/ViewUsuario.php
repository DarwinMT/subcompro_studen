<div ng-controller="logicausuarios" >
 
 <div class="container" ng-init="get_permisos();get_usuarios();">
 	
 	<div class="row">
 		<div class="col-xs-12">
 			<h3 ><strong>&nbsp;</strong></h3>
 		</div>
 	</div>
 	<div class="row">
 		<div class="col-xs-12">
 			<h3 class="page-header"><strong>{{Titulo}}</strong></h3>
 		</div>
 	</div>

 	<div id="" ng-hide="  usuariosincondatos!='3' " ng-show=" usuariosincondatos=='3' " >
 		<div class="row">
 			<div class="col-xs-12 text-center">
 				<div class="btn-group" role="group" aria-label="...">
				  <button type="button" class="btn btn-primary" ng-click=" usuariosincondatos='1' " ><i class="glyphicon glyphicon-user"></i> Usuario sin datos</button>
				  <button type="button" class="btn btn-success"><i class="glyphicon glyphicon-user"></i> Usuario Con datos</button>
				</div>
 			</div>
 		</div>
 	</div>

 	<!--usuario sin datos -->
 	<div id="" ng-hide=" newandedit!='1' || usuariosincondatos!='0' " ng-show=" newandedit=='1' &&  usuariosincondatos=='1' ">
	 	<div class="row">
	 		<div class="col-xs-12">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">DNI : </span>
				  <input type="text" class="form-control" name="dni_per"  id="dni_per" ng-model="dni_per" >
				</div>
	 		</div>
	 	</div>
	 	<div class="row">
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Nombres : </span>
				  <input type="text" class="form-control" name="nombre_per"  id="nombre_per" ng-model="nombre_per" >
				</div>
	 		</div>
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Appellidos : </span>
				  <input type="text" class="form-control" name="apellido_per"  id="apellido_per" ng-model="apellido_per" >
				</div>
	 		</div>
	 	</div>
	 	<div class="row">
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Género : </span>
				  <select class="form-control" name="genero_per"  id="genero_per" ng-model="genero_per" >
				  	<option value="M">Masculino</option>
				  	<option value="F">Femenino</option>
				  </select>
				</div>
	 		</div>
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Dirección : </span>
				  <input type="text" class="form-control" name="direccion_per"  id="direccion_per" ng-model="direccion_per" >
				</div>
	 		</div>
	 	</div>

	 	<div class="row">
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Teléfono : </span>
				  <input type="text" class="form-control" name="telefono_per"  id="telefono_per" ng-model="telefono_per" >
				</div>
	 		</div>
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Celular : </span>
				  <input type="text" class="form-control" name="celular_per"  id="celular_per" ng-model="celular_per" >
				</div>
	 		</div>
	 	</div>

	 	<div class="row">
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Correo : </span>
				  <input type="text" class="form-control" name="correo_per"  id="correo_per" ng-model="correo_per" >
				</div>
	 		</div>
	 		<!--Datos para crear un pesrsona -->
	 	</div>
	 	<div class="row">
	 		<!--Datos para crear el usuario -->
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"> Usuario : </span>
				  <input type="text" class="form-control" name="usuario_usu"  id="usuario_usu" ng-model="usuario_usu" >
				</div>
	 		</div>
	 	

	 	
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Clave : </span>
				  <input type="password" class="form-control" name="password_usu"  id="password_usu" ng-model="password_usu" >
				</div>
	 		</div>
	 		<h5 class="page-header">&nbsp;</h5>
	 	</div>

	 	<div class="row">
	 		<div class="text-center col-xs-12">
	 			<button type="button"  class="btn btn-sm btn-primary" ng-click=" newandedit='0'; get_usuarios(); " > Registro</button>
	 			<button type="button" ng-disabled="list_permisos.access_save==0 " ng-hide=" aux_edicion!='0' " ng-show=" aux_edicion=='0' " ng-click="int_usuario();"  class="btn btn-sm btn-success"> Guardar</button>
	 			<button type="button" ng-disabled="list_permisos.access_edit==0 " ng-hide=" aux_edicion!='1' " ng-show=" aux_edicion=='1' " ng-click="save_edit();" class="btn btn-sm btn-info"> Guardar</button>

	 			<button type="button"  class="btn btn-sm btn-default"> Cancelar</button>
	 		</div>
	 	</div>


 	</div>

 	<div id="list_proveedor" ng-hide=" newandedit!='0' " ng-show=" newandedit=='0' " >
 		<div class="row">
 			<div class="col-xs-4">
 				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-search"></i></span>
				  <input type="text" class="form-control" name="txt_buscar" ng-keyup="get_usuarios();"  id="txt_buscar" ng-model="txt_buscar" >
				</div>
 			</div>
 			<div class="col-xs-4">
 				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1" >Estado </span>
				  <select class="form-control" name="cmb_estado" ng-change="get_usuarios();" id="cmb_estado" ng-model="cmb_estado">
				  	<option value="1">Activo</option>
				  	<option value="0">Inactivo</option>
				  </select>
				</div>
 			</div>
 			<div class="col-xs-4">
 				<button class="btn btn-primary " ng-click="get_usuarios();"><i class="glyphicon glyphicon-search"></i></button>
 				<button class="btn btn-primary " ng-click=" newandedit='1'; aux_edicion='0'; clear_data(); usuariosincondatos='3'; ">Nuevo</button>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-xs-12" style="height:450px; overflow-x: scroll;">
 				<table class="table table-bordered table-condensend">
 					<thead>
 						<tr class="btn-primary">
 							<th></th>
 							<th>Dni</th>
 							<th>Usuario Nombre</th>
 							<th>Usuario </th>
 							<th>Teléfono</th>
 							<th>Dirección</th>
 							<th></th>
 						</tr>
 					</thead>
 					<tbody>
 						<tr ng-repeat=" p in lista_usuario">
 							<td>{{$index+1}}</td>
 							<td>{{p.dni_per}}</td>
 							<td>{{p.apellido_per+' '+p.nombre_per}}</td>
 							<td>{{p.usuario_usu}}</td>
 							<td>{{p.telefono_per}}</td>
 							<td>{{p.direccion_per}}</td>
 							<td>
 								<button type="button" class="btn btn-primary" ng-click="init_edit(p);"><i class="glyphicon glyphicon-pencil"></i></button>
 								<button type="button" class="btn btn-success" ng-click=" permisos_usuario(p); " ><i class="glyphicon glyphicon-cog"></i></button>
 								<button type="button" class="btn btn-danger" ng-disabled="list_permisos.access_delete==0 " ng-click=" activar_inactivar(p); " ><i class="glyphicon glyphicon-trash"></i></button>
 								<button type="button" class="btn btn-info" ng-click="init_user(p);"><i class="glyphicon glyphicon-pencil"></i> <i class="glyphicon glyphicon-user"></i></button>
 							</td>
 						</tr>
 					</tbody>
 				</table>
 			</div>
 		</div>
 	</div>



 	<!--frm para asignar permisos -->
 	<div class="row" ng-hide=" newandedit!='3'  " ng-show=" newandedit=='3' ">
 		<div class="col-xs-12">
 			<table class="table table-condensend table-bordered">
 				<thead class="bg-primary">
 					<tr>
 						<th>Permisos del usuario: </th>
 						<th colspan="5">{{aux_user_permisos.apellido_per+' '+aux_user_permisos.nombre_per}}</th>
 					</tr>
 					<tr>
 						<th>Descripcion:</th>
 						<th colspan="5"><input type="text" class="form-control" name="descripcion_rol" ng-model="descripcion_rol" ></th>
 					</tr>
 					<tr>
 						<th></th>
 						<th>Menu</th>
 						<th>Guardar</th>
 						<th>Editar</th>
 						<th>Borrar</th>
 						<th>Imprimir</th>
 					</tr>
 				</thead>
 				<tbody>
 					<tr ng-repeat=" i in list_menu ">
 						<td>{{i.Id_menu}}</td>
 						<td>{{i.Descipcion}}</td>
 						<td><input type="checkbox" name="" ng-model="i.access_save" ></td>
 						<td><input type="checkbox" name="" ng-model="i.access_edit" ></td>
 						<td><input type="checkbox" name="" ng-model="i.access_delete" ></td>
 						<td><input type="checkbox" name="" ng-model="i.access_print" ></td>
 					</tr>
 				</tbody>
 				<tfoot>
 					<tr>
 						<th colspan="6" class="text-center">
 							<button type="button" ng-click="save_permisos_usuario()" class="btn btn-success"> Guardar </button>
 							<button type="button"  class="btn btn-primary" ng-click=" newandedit='0'; get_usuarios(); " > Registro</button>
 						</th>
 					</tr>
 				</tfoot>
 			</table>
 		</div>
 	</div>
 	<!--frm para asignar permisos -->

 	<!--cambiar clave user -->
 	<div class="row" ng-hide=" newandedit!='4'  " ng-show=" newandedit=='4' ">
 		<div class="row text-center">
 			<h3><strong>Cambio de Clave</strong></h3>
 			<br>
 		</div>
 		<div class="row">
 			<div class="col-xs-4">
 			</div>
 			<div class="col-xs-4">
 				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Usuario</span>
				  <input type="text" class="form-control" name="user_edit"  id="user_edit" ng-model="user_edit" >
				</div>
 			</div>
 			<div class="col-xs-4">
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-xs-4">
 			</div>
 			<div class="col-xs-4">
 				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Clave</span>
				  <input type="password" class="form-control" name="clave_edit"  id="clave_edit" ng-model="clave_edit" >
				</div>
 			</div>
 			<div class="col-xs-4">
 			</div>
 		</div>
 		<div class="row text-center">
 			<h5 class="page-header">&nbsp;</h5>
 			<button type="button" ng-click="save_user_pass()" class="btn btn-success"> Guardar </button>
 			<button type="button"  class="btn btn-primary" ng-click=" newandedit='0'; get_usuarios(); " > Registro</button>
 		</div>
 	</div>
 	<!--cambiar clave user -->


</div>


<div class="modal fade" id="sms" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Mensaje</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-xs-12">
        		<strong>{{Mensaje}}</strong>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>








</div>