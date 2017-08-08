<div ng-controller="logicareporte" >
 
   <!--notificaciones-->
 <div class="row ">
 	<div class="col-xs-12 notificaciones" style="position: absolute; z-index: 2000;">
 	</div>	
 </div>
<!--notificaciones-->

 <div class="container" ng-init="get_permisos();get_productos();get_kardex_invetario_all(); get_notificaciones();">
 	<div class="row">
 		<div class="col-xs-12">
 			<h3 class="page-header"><strong>{{Titulo}}</strong></h3>
 		</div>
 	</div>
 	

 	<div id="list_proveedor" ng-hide=" newandedit=='1' " ng-show=" newandedit=='0' " >
 		<div class="row">
 			<div class="col-xs-3">
 				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-search"></i></span>
				  <input type="date" class="form-control" name="txt_fechabusca" ng-keyup="get_kardex_invetario();"  id="txt_fechabusca" ng-model="txt_fechabusca" >
				</div>
 			</div>
 			<div class="col-xs-3">
 				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1" >Producto </span>
				  <select class="form-control" name="busca_producto" ng-change="get_kardex_invetario();" id="busca_producto" ng-model="busca_producto">
				  	<option value="">Seleccione</option>
				  	<option ng-repeat=" auxp in lista_productos " value="{{auxp.id_prod}}"> {{auxp.nombre_prod+' | '+auxp.codigo_prod}}</option>
				  </select>
				</div>
 			</div>
 			<div class="col-xs-3">
 				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Bodega : </span>
				  <select class="form-control" name="cmb_bodega"  id="cmb_bodega" ng-model="cmb_bodega" >
				  	<option value="">Seleccione</option>
				  	<option ng-repeat="bodega in lista_bodegas2" value="{{bodega.id_bod}}">{{bodega.descripcion_bod}}</option>
				  </select>
				</div>
 			</div>
 			<div class="col-xs-3">
 				<button class="btn btn-primary " ng-click="get_kardex_invetario();"><i class="glyphicon glyphicon-search"></i></button>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-xs-12" id="reporte" style="height: 450px;">
 				<!--<table class="table table-bordered table-condensend">
 					<thead>
 						<tr class="btn-primary">
 							<th></th>
 							<th>Producto</th>
 							<th>Codigo</th>
 							<th>Fecha</th>
 							<th>Bodega</th>
 							<th>Entradas</th>
 							<th>Salidas</th>
 							<th>Balance</th>
 						</tr>
 					</thead>
 					<tbody>
 						<tr ng-repeat=" p in lista_kardex_producto">
 							<td>{{$index+1}}</td>
 							<td>{{p.nombre_prod}}</td>
 							<td>{{p.codigo_prod}}</td>
 							<td>{{p.fecha_kar}}</td>
 							<td>{{p.descripcion_bod}}</td>
 							<td>{{p.cant_entrada_kar}}</td>
 							<td>{{p.cant_salida_kar}}</td>
 							<td>{{p.balance}}</td>
 						</tr>
 					</tbody>
 				</table>-->
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