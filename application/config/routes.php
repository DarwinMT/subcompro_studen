<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'welcome';
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//---- LOGICA INICIO DE SESSION Y FIN 
$route['init_session'] = 'Login/start_login';
$route['end_session'] = 'Login/end_session';

//---- LOGICA INICIO DE SESSION Y FIN 

//---- LOGICA PROVEEOR ------
$route['get_permisos_proveedor'] = 'Proveedor/list_permisos'; 
$route['save_proveedor'] = 'Proveedor/save_proveedor'; 
$route['list_proveedor'] = 'Proveedor/get_proveedores'; 
$route['activar_inactivar'] = 'Proveedor/edit_estado';  
$route['save_edit_proveedor'] = 'Proveedor/edit_proveedor';  


//-----LOGICA USUARIO ------
$route['save_usuario'] = 'Usuario/save_usuario'; // pendiente xD
$route['list_usuario'] = 'Usuario/get_usuario'; 
	////---- logica de asignacion de permisos usuario 
	$route['menu'] = 'Usuario/list_menu'; 
	$route['save_permisos_usuario'] = 'Usuario/save_permisos'; 
	$route['edit_permisos_usuario'] = 'Usuario/edit_permisos';
	////---- logica de asignacion de permisos usuario 
$route['save_edit_usuario'] = 'Usuario/edit_usuario'; 

//-----LOGICA USUARIO ------

///---------- LOGICA EMPLEADO 
$route['save_empleado'] = 'Empleado/save_empleado';
$route['list_empleado'] = 'Empleado/get_empleados'; 
$route['save_edit_empleado'] = 'Empleado/edit_empleado';  

//----LOGICA MARCA ----
$route['save_marca'] = 'Marca/save_marca';
$route['list_marcas'] = 'Marca/get_marcas';
$route['save_edit_marca'] = 'Marca/edit_marca';
$route['activar_inactivar_marca'] = 'Marca/edit_estado';  
//---- LOGICA PRODUCTO 
$route['save_producto'] = 'Producto/save_producto';
$route['list_producto'] = 'Producto/get_productos';
$route['save_edit_producto'] = 'Producto/edit_producto';
$route['activar_inactivar_producto'] = 'Producto/edit_estado';
///----- LOGICA BODEGA
$route['save_bodega'] = 'Bodega/save_bodega';
$route['list_bodegas'] = 'Bodega/get_bodegas';
$route['save_edit_bodega'] = 'Bodega/edit_bodega';
$route['activar_inactivar_bodega'] = 'Bodega/edit_estado';

//----- LOGICA KARDEX
$route['save_kardex'] = 'Kardex/save_kardex';
$route['kardex_producto'] = 'Kardex/kardex_producto';


//-------- notificacion producto
$route['get_cant_productos'] = 'Producto/notificacion';

//------ Datos para el reporte filtro de fecha , producto y bodega  : se ve en que estado esta el producto en dicha fecha  
$route['list_data_reporte'] = 'Kardex/data_reporte';
