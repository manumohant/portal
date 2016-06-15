admin.factory('metadatarepository', ['$http', function ($http) {
    'use strict';

    return {

        upsertMetaData: function (metadata) {
            return $http.put("api/upsertMetadata/", metadata);
        },
        getAppDetails:function(appUnique){
        	return $http.get("api/getAppDetails/?appId="+appUnique.appId);
        },
        getSingle:function(value){
        	return $http.get("api/getSingle/?desc="+value.desc+"&module="+value.module+"&appId="+value.appId);	
        },
        deleteDoc:function(key,appId,desc){
        	return $http.delete("api/deleteDoc/?desc="+desc+"&module="+key+"&appId="+appId);	
        }
    };
}]);