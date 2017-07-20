<div ng-controller="logicaproveedor">
 
 <div class="container" ng-init="get_permisos();">
 	<div class="row">
 		<div class="col-xs-12">
 			<h3 class="page-header"><strong>{{Titulo}}</strong></h3>
 		</div>
 	</div>
 	<div id="fmr_proveedor">
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
				  <input type="text" class="form-control" name="direccion_emp_pro"  id="direccion_emp_pro" ng-model="direccion_emp_pro" >
				</div>
	 		</div>
	 	</div>

	 	<div class="row">
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Telefono Op. </span>
				  <input type="text" class="form-control" name="telefono_emp_pro"  id="telefono_emp_pro" ng-model="telefono_emp_pro" >
				</div>
	 		</div>
	 	</div>

	 	<div class="row">
	 		<div class="text-center col-xs-12">
	 			<button type="button"  class="btn btn-sm btn-primary"> Registro</button>
	 			<button type="button" ng-disabled="list_permisos.access_save==0 "  class="btn btn-sm btn-success"> Guardar</button>
	 			<button type="button" ng-disabled="list_permisos.access_edit==0 "  class="btn btn-sm btn-info"> Guardar</button>

	 			<button type="button"  class="btn btn-sm btn-default"> Cancelar</button>
	 		</div>
	 	</div>


 	</div>

 	<div id="list_proveedor">
 		<div class="row">
 			<div class="col-xs-12">
 				<table class="table table-bordered table-condensend">
 					<thead>
 						<tr class="btn-primary">
 							<th></th>
 							<th>Dni</th>
 							<th>Proveedor</th>
 							<th>Telefono</th>
 							<th>Direccion</th>
 							<th></th>
 						</tr>
 					</thead>
 					<tbody>
 						
 					</tbody>
 				</table>
 			</div>
 		</div>
 	</div>


</div>

</div>