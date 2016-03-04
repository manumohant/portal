
admin.controller("metadata", ['$scope','$window', function ($scope,$window) {
    $scope.initMetaData = function () {
        $scope.MetaData = $window.metadata;
    };
    $scope.getReqFieldString = function(req_fields){
    	return req_fields.toString();
    };
}]);