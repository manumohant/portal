
admin.controller("newmetadata", ['$scope', '$window', 'metadatarepository','customalert', 
    function ($scope, $window, metadatarepository, customalert) {
    $scope.modules = [];
    $scope.initMetaData = function () {
        $scope.MetaData = $window.metadata;
        angular.forEach($scope.MetaData, function (meta) {
            angular.forEach(meta.modules, function (module) {
                $scope.modules.push(module);
            })
        })
    };

    $scope.saveMetaData = function()
    {
        $scope.metadata.modules.apis.req_fields = document.getElementById("tags").value;
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