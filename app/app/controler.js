app.controller("home",function($scope){
	$scope.Title="Citas";

	$scope.ModifyCita=function() {
		$("#EditarCita").modal("show");
	};
});

/////////////////////////////-------------------------------- Modelo o ejemplo--------------------
app.controller("AgregarPersona",function($scope,$http){
	$scope.MensajeError="";
	$scope.TipoPersona=[];
	$scope.Persona={};
	
	$scope.LoadTipoPersona=function () {
		
		$http.get("getTpersona")
		.success(function(data){
			$scope.TipoPersona=data;
		})
		.error(function(data){
			console.log(data);
		});	
	};

	$scope.ClearAll=function() {
		$scope.CmbTipp="";
		$scope.ci="";
		$scope.NombreP="";
		$scope.ApellidoP="";
		$("#FechaNac").val("");
	};

	$scope.AddPersona=function () {

		if($scope.CmbTipp!="" & $scope.CmbTipp!=undefined){
			$scope.Persona={
				id_tp: $scope.CmbTipp,
				ci: $scope.ci,
				nombre: $scope.NombreP,
				apellido : $scope.ApellidoP,
				fechaN :$("#FechaNac").val()
			};
			
			var files = $("#txtFile").get(0).files;
	        var data = new FormData();
	        for (i = 0; i < files.length; i++) {
	            data.append("file" + i, files[i]);
	        }
	        data.append("Datos",JSON.stringify($scope.Persona));
	        
	        $http.post("addTpersona",data,{
	        	headers:{
	        		'Content-Type': undefined
	        	}
	        })
			.success(function(res){
				if(parseInt(res)>0){
					$scope.MensajeError="Se guardo correctamente";
					$("#MnsjErr").modal("show");
					$scope.ClearAll();
				}else{
					$scope.MensajeError="Error al guardar";
					$("#MnsjErr").modal("show");
					$scope.ClearAll();
				}
			})
			.error(function(res){
			});


			/*$http.post("addTpersona",$scope.Persona)
			.success(function(data){
			})
			.error(function(data){
			});*/

		}else{
			$scope.MensajeError="Llene los campos para guardar..!!";
			$("#MnsjErr").modal("show");
		}
	};

});

app.controller("ListaClientes",function($scope,$http){
	$scope.Lista="Lista personas";
});



