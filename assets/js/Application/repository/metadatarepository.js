admin.factory('metadatarepository', ['$http', function ($http) {
    'use strict';

    return {

        upsertMetaData: function (metadata) {
            return $http.put("api/upsertMetadata/", metadata);
        }
    };
}]);