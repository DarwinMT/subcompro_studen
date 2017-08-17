<div ng-controller="logicaproducto" ng-init="get_notificaciones();">
 
 <!--notificaciones-->
 <div class="row ">
 	<div class="col-xs-12 notificaciones" style="position: absolute; z-index: 2000;">
 	</div>	
 </div>
<!--notificaciones-->


 <div class="container" ng-init="get_permisos();get_productos(); get_marcas();get_proveedore(); ">
 	<div class="row">
 		<div class="col-xs-12">
 			<h3 ><strong>&nbsp;</strong></h3>
 			<h3 class="page-header"><strong>{{Titulo}}</strong></h3>
 		</div>
 	</div>
 	<div id="fmr_proveedor" ng-hide=" newandedit=='0' " ng-show=" newandedit=='1' ">
	 	
	 	<div class="row">
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Nombre : </span>
				  <input type="text" class="form-control" name="nombre_prod"  id="nombre_prod" ng-model="nombre_prod" >
				</div>
	 		</div>
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Categoría : </span>
				  <input type="text" class="form-control" name="categoria_prod"  id="categoria_prod" ng-model="categoria_prod" >
				</div>
	 		</div>
	 	</div>
	 	<div class="row">
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Precio : </span>
				  <input type="text" class="form-control" name="precio_prod"  id="precio_prod" ng-model="precio_prod" >
				</div>
	 		</div>
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Código : </span>
				  <input type="text" class="form-control" name="codigo_prod"  id="codigo_prod" ng-model="codigo_prod" >
				</div>
	 		</div>
	 	</div>

	 	<div class="row">
	 		<div class="col-xs-6">
	 		<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Marca : </span>
				  <select class="form-control" name="aux_marca" id="aux_marca" ng-model="aux_marca" >
				  	<option value="">Seleccione</option>
				  	<option ng-repeat=" m in lista_marcas" value="{{m.id_mar}}">{{m.descripcion_mar}}</option>
				  </select>
			</div>
			</div>

			<div class="col-xs-6">
	 		<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Proveedor : </span>
				  <select class="form-control" name="aux_proveedor" id="aux_proveedor" ng-model="aux_proveedor" >
				  	<option value="">Seleccione</option>
				  	<option ng-repeat=" p in lista_proveedor" value="{{p.id_pro}}">{{p.apellido_per+' '+p.nombre_per}}</option>
				  </select>
			</div>
			</div>

	 	</div>


	 	<div class="row">
	 		<div class="text-center col-xs-12">
	 			<h5 class="page-header">&nbsp;</h5>
	 			<button type="button"  class="btn btn-sm btn-primary" ng-click=" newandedit='0'; get_productos(); " > Registro</button>
	 			<button type="button" ng-disabled="list_permisos.access_save==0 " ng-hide=" aux_edicion!='0' " ng-show=" aux_edicion=='0' " ng-click="int_producto();"  class="btn btn-sm btn-success"> Guardar</button>
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
				  <input type="text" class="form-control" name="txt_buscar" ng-keyup="get_productos();"  id="txt_buscar" ng-model="txt_buscar" >
				</div>
 			</div>
 			<div class="col-xs-4">
 				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1" >Estado </span>
				  <select class="form-control" name="cmb_estado" ng-change="get_productos();" id="cmb_estado" ng-model="cmb_estado">
				  	<option value="1">Activo</option>
				  	<option value="0">Inactivo</option>
				  </select>
				</div>
 			</div>
 			<div class="col-xs-4">
 				<button class="btn btn-primary " ng-click="get_productos();"><i class="glyphicon glyphicon-search"></i></button>
 				<button class="btn btn-primary " ng-click=" newandedit='1'; aux_edicion='0'; clear_data(); ">Nuevo</button>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-xs-12">
 				<table class="table table-bordered table-condensend">
 					<thead>
 						<tr class="btn-primary">
 							<th></th>
 							<th>Código</th>
 							<th>Nombre</th>
 							<th>Categoría</th>
 							<th>Marca</th>
 							<th>Precio</th>
 							<th></th>
 						</tr>
 					</thead>
 					<tbody>
 						<tr ng-repeat=" p in lista_productos">
 							<td>{{$index+1}}</td>
 							<td>{{p.codigo_prod}}</td>
 							<td>{{p.nombre_prod}}</td>
 							<td>{{p.categoria_prod}}</td>
 							<td>{{p.desri_marca}}</td>
 							<td>{{p.precio_prod}}</td>
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