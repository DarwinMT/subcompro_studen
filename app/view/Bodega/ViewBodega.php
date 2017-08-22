<div ng-controller="logicabodega" >
 

    <!--notificaciones-->
 <div class="row ">
 	<div class="col-xs-12 notificaciones" style="position: absolute; z-index: 2000;">
 	</div>	
 </div>
<!--notificaciones-->

 <div class="container" ng-init="get_permisos();get_bodegas();get_notificaciones();">
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
				  <span class="input-group-addon" id="basic-addon1">Descripción : </span>
				  <input type="text" class="form-control" name="descripcion_bod"  id="descripcion_bod" ng-model="descripcion_bod" >
				</div>
	 		</div>
	 		<div class="col-xs-6">
	 			<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Dirección : </span>
				  <input type="text" class="form-control" name="direccion_bod"  id="direccion_bod" ng-model="direccion_bod" >
				</div>
	 		</div>
	 	</div>
	 	

	 


	 	<div class="row">
	 		<div class="text-center col-xs-12">
	 			<h5 class="page-header">&nbsp;</h5>
	 			<button type="button"  class="btn btn-sm btn-primary" ng-click=" newandedit='0'; get_bodegas(); " > Registro</button>
	 			<button type="button" ng-disabled="list_permisos.access_save==0 " ng-hide=" aux_edicion!='0' " ng-show=" aux_edicion=='0' " ng-click="int_bodega();"  class="btn btn-sm btn-success"> Guardar</button>
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
				  <input type="text" class="form-control" name="txt_buscar" ng-keyup="get_bodegas();"  id="txt_buscar" ng-model="txt_buscar" >
				</div>
 			</div>
 			<div class="col-xs-4">
 				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1" >Estado </span>
				  <select class="form-control" name="cmb_estado" ng-change="get_bodegas();" id="cmb_estado" ng-model="cmb_estado">
				  	<option value="1">Activo</option>
				  	<option value="0">Inactivo</option>
				  </select>
				</div>
 			</div>
 			<div class="col-xs-4">
 				<button class="btn btn-primary " ng-click="get_bodegas();"><i class="glyphicon glyphicon-search"></i></button>
 				<button class="btn btn-primary " ng-click=" newandedit='1'; aux_edicion='0'; clear_data(); ">Nuevo</button>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-xs-12" style="height:450px; overflow-x: scroll;" >
 				<table class="table table-bordered table-condensend">
 					<thead>
 						<tr class="btn-primary">
 							<th></th>
 							<th>Descripción</th>
 							<th>Dirección</th>
 							<th></th>
 						</tr>
 					</thead>
 					<tbody>
 						<tr ng-repeat=" p in lista_bodegas">
 							<td>{{$index+1}}</td>
 							<td>{{p.descripcion_bod}}</td>
 							<td>{{p.direccion_bod}}</td>
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