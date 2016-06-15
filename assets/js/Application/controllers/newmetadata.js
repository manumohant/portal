
admin.controller("newmetadata", ['$scope', '$window','$routeParams', 'metadatarepository','customalert', 
    function ($scope, $window, $routeParams, metadatarepository, customalert) {
    $scope.modules = [];

    $scope.metadata = {};var val={};
    if(!$scope.metadata.modules)$scope.metadata.modules={};
    val.desc = $scope.metadata.desc = $routeParams.param;
    val.module = $scope.metadata.modules.name=$routeParams.param2;
    val.appId=$scope.metadata.appId = $routeParams.param3;
    $scope.metadata.Api={};
    metadatarepository.getSingle(val).success(function(result){
        angular.forEach(result, function (data) {
            
            angular.forEach(data.modules, function (module,key) {
                if(key == val.module)
                {
                    $scope.metadata.modules.apis = module.apis[$scope.metadata.desc];
                    $scope.metadata.appname = data.appname;
                }
            })
        })
    });

    $scope.initMetaData = function () {
        $scope.MetaData = $window.metadata;
        angular.forEach($scope.MetaData, function (meta) {
            angular.forEach(meta.modules, function (module,key) {
                var obj = {};
                obj[key]=module;
                $scope.modules.push(obj);
            })
        })
    };

    $scope.saveMetaData = function()
    {
        $scope.metadata.modules.apis.req_fields = document.getElementById("tags").value;
        $scope.metadata.modules.apis.mapping = document.getElementById("tags2").value;
        metadatarepository.upsertMetaData($scope.metadata).success(function(data){

            if(data==1) 
            {
                customalert.showAlertMessage('success','Success!','Meta Data saved successfully.');
            }
            else 
                customalert.showAlertMessage('error','Error!','Meta Data could not saved.');
        });
        
    }

}]);