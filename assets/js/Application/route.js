admin.config(['$routeProvider',
        function ($routeProvider) {
            $routeProvider.
                    when('/dashboard', {
                        templateUrl: 'dashboard/dashboardview',
                        controller: 'dashboard'
                    }).
                    when('/metadata', {
                        templateUrl: 'dashboard/metadataview',
                        controller: 'metadata'
                    }).
                    when('/newMetaData/', {
                        templateUrl: 'dashboard/newMetaData/',
                        controller: 'newmetadata'
                    }).
                    when('/newMetaData/:param/:param2/:param3', {
                        templateUrl: 'dashboard/newMetaData/',
                        controller: 'newmetadata'
                    }).
                    when('/viewMetaData/:param/:param2/:param3', {
                        templateUrl: 'dashboard/viewMetaData/',
                        controller: 'viewMetaData'
                    }).
                    otherwise({
                        redirectTo: '/dashboard'
                    });
        }]);