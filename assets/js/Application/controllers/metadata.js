
admin.controller("metadata", ['$scope','$window','metadatarepository','customalert', function ($scope,$window,metadatarepository,customalert) {
    $scope.initMetaData = function () {
        $scope.MetaData = $window.metadata;
        //$scope.DisplayData = $scope.MetaData;
    };
    $scope.getReqFieldString = function(req_fields){
    	return req_fields.toString();
    };
    $scope.getAppMetaData=function(){
    	metadatarepository.getAppDetails($scope.selectedApp).success(function(data){

    		$scope.DisplayData =data;
    	});
    };

    $scope.deleteMeta=function(desc,key,appId){
    	metadatarepository.deleteDoc(key,appId,desc).success(function(data){
    		customalert.showAlertMessage('success','Success!','Meta Data deleted successfully.');
    		$scope.DisplayData =data;
    		
    	}).error(function(data){
    		customalert.showAlertMessage('error','Error!','Meta Data could not be deleted.');
    	});
    };
}]);



admin.controller("viewMetaData", ['$scope','$window','$routeParams','metadatarepository', function ($scope,$window,$routeParams,metadatarepository) {
    $scope.value = {};
    $scope.value.desc = $routeParams.param;
    $scope.value.module=$routeParams.param2;
    $scope.value.appId = $routeParams.param3;
    $scope.value.Api={};
    metadatarepository.getSingle($scope.value).success(function(result){
    	angular.forEach(result, function (data) {
    		
            angular.forEach(data.modules, function (module,key) {
                if(key == $scope.value.module)
                {
                	$scope.value.Api = module.apis[$scope.value.desc];
                	$scope.value.appname = data.appname;
                }
            })
        })
    });
   
    
}]);