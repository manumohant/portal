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
                    when('/newMetaData', {
                        templateUrl: 'dashboard/newMetaData/',
                        controller: 'newmetadata'
                    }).
                    otherwise({
                        redirectTo: '/dashboard'
                    });
        }]);