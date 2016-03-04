admin.factory('customalert', ['$http', function ($http) {
    'use strict';

    return {

        showAlertMessage: function (type, title, text) {
            if(type=='success')
            {
                jQuery.gritter.add({
                title: title,
                text: text,
                class_name: 'growl-success',
                image: 'assets/images/success.png',
                sticky: false,
                time: ''
                });
            }
            else if(type =='error')
            {
            	jQuery.gritter.add({
				title: title,
				text: text,
		      	class_name: 'growl-danger',
		      	image: 'assets/images/danger.png',
				sticky: false,
				time: ''
			 });
            }
            else
            {
            	jQuery.gritter.add({
				title: title,
				text: text,
      			class_name: 'growl-info',
      			image: 'assets/images/warning.png',
				sticky: false,
				time: ''
	 			});
            }
            
            
        }
    };
}]);