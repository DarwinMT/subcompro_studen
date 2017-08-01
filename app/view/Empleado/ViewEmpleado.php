<div ng-controller="logicaempleado" >
 
 <div class="container" ng-init="get_permisos();get_empleados();">
 	<div class="row">
 		<div class="col-xs-12">
 			<h3 class="page-header"><strong>{{Titulo}}</strong></h3>
 		</div>
 	</div>
 	<div id="fmr_proveedor" ng-hide=" newandedit=='0' " ng-show=" newandedit=='1' ">
	 	<div class="row">
	 		<div class="col-xs-12">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">DNI</span>
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
				  <span class="input-group-addon" id="basic-addon1">Appellidos </span>
				  <input type="text" class="form-control" name="apellido_per"  id="apellido_per" ng-model="apellido_per" >
				</div>
	 		</div>
	 	</div>
	 	<div class="row">
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Genero : </span>
				  <select class="form-control" name="genero_per"  id="genero_per" ng-model="genero_per" >
				  	<option value="M">Masculino</option>
				  	<option value="F">Femenino</option>
				  </select>
				</div>
	 		</div>
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Direccion </span>
				  <input type="text" class="form-control" name="direccion_per"  id="direccion_per" ng-model="direccion_per" >
				</div>
	 		</div>
	 	</div>

	 	<div class="row">
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Telefono </span>
				  <input type="text" class="form-control" name="telefono_per"  id="telefono_per" ng-model="telefono_per" >
				</div>
	 		</div>
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Celular </span>
				  <input type="text" class="form-control" name="celular_per"  id="celular_per" ng-model="celular_per" >
				</div>
	 		</div>
	 	</div>

	 	<div class="row">
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Correo </span>
				  <input type="text" class="form-control" name="correo_per"  id="correo_per" ng-model="correo_per" >
				</div>
	 		</div>

	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Direccion Op. </span>
				  <input type="text" class="form-control" name="direccion_empl"  id="direccion_empl" ng-model="direccion_empl" >
				</div>
	 		</div>
	 	</div>

	 	<div class="row">
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Telefono Op. </span>
				  <input type="text" class="form-control" name="telefono_empl"  id="telefono_empl" ng-model="telefono_empl" >
				</div>
	 		</div>
	 	</div>

	 	<div class="row">
	 		<div class="text-center col-xs-12">
	 			<button type="button"  class="btn btn-sm btn-primary" ng-click=" newandedit='0'; get_empleados(); " > Registro</button>
	 			<button type="button" ng-disabled="list_permisos.access_save==0 " ng-hide=" aux_edicion!='0' " ng-show=" aux_edicion=='0' " ng-click="int_empleado();"  class="btn btn-sm btn-success"> Guardar</button>
	 			<button type="button" ng-disabled="list_permisos.access_edit==0 " ng-hide=" aux_edicion!='1' " ng-show=" aux_edicion=='1' " ng-click="save_edit();" class="btn btn-sm btn-info"> Guardar</button>

	 			<button type="button"  class="btn btn-sm btn-default"> Cancelar</button>
	 		</div>
	 	</div>


 	</div>

 	<div id="list_proveedor" ng-hide=" newandedit=='1' " ng-show=" newandedit=='0' " >
 		<div class="row">
 			<div class="col-xs-4">
 				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-search"></i></span>
				  <input type="text" class="form-control" name="txt_buscar" ng-keyup="get_empleados();"  id="txt_buscar" ng-model="txt_buscar" >
				</div>
 			</div>
 			<div class="col-xs-4">
 				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1" >Estado </span>
				  <select class="form-control" name="cmb_estado" ng-change="get_empleados();" id="cmb_estado" ng-model="cmb_estado">
				  	<option value="1">Activo</option>
				  	<option value="0">Inactivo</option>
				  </select>
				</div>
 			</div>
 			<div class="col-xs-4">
 				<button class="btn btn-primary " ng-click="get_empleados();"><i class="glyphicon glyphicon-search"></i></button>
 				<button class="btn btn-primary " ng-click=" newandedit='1'; aux_edicion='0'; clear_data(); ">Nuevo</button>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-xs-12">
 				<table class="table table-bordered table-condensend">
 					<thead>
 						<tr class="btn-primary">
 							<th></th>
 							<th>Dni</th>
 							<th>Empleado</th>
 							<th>Telefono</th>
 							<th>Direccion</th>
 							<th></th>
 						</tr>
 					</thead>
 					<tbody>
 						<tr ng-repeat=" p in lista_empleado">
 							<td>{{$index+1}}</td>
 							<td>{{p.dni_per}}</td>
 							<td>{{p.apellido_per+' '+p.nombre_per}}</td>
 							<td>{{p.telefono_per}}</td>
 							<td>{{p.direccion_per}}</td>
 							<td>
 								<button type="button" class="btn btn-primary" ng-click="init_edit(p);"><i class="glyphicon glyphicon-pencil"></i></button>
 								<button type="button" class="btn btn-danger" ng-disabled="list_permisos.access_delete==0 " ng-click=" activar_inactivar(p); " ><i class="glyphicon glyphicon-trash"></i></button>
 							</td>
 						</tr>
 					</tbody>
 				</table>
 			</div>
 		</div>
 	</div>


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