//'use strict';

/* Services */
// Demonstrate how to register services
// In this case it is a simple value service.
var services = angular.module('formaApp.services', []);

forma.factory('$bct', ['$http', '$q', '$rootScope', function($http, $q, $rootScope) {
    var defaultUrl = 'app/dashboard';
    var bctService = {
		sheets: [{'template':defaultUrl+'/template', data:{}}],
		activeSheet: 0,
        loadSheet: function(url, data, $index) {
            var template = url+'/template';
            var bctIndex = this.addSheet({'template':template, 'data':{}}, $index);
            data = data == 'undefined' ? JSON.stringify(Array()) : JSON.stringify(data);
            $httpConfig = {
				method: 'POST',
				url: url,
				data: data,
				headers: {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'},
				$bct: this,
                $bctIndex: bctIndex,
                $rootScope: $rootScope
			};
			$http($httpConfig).success(function(data, status, headers, config) {
				config.$bct.updateSheet(data, config.$bctIndex);
			}).error(function(data, status, headers, config) {
				config.$bct.closeSheet(config.$bctIndex);
			});
        },
        closeSheet: function(index) {
            this.sheets.splice(index, 1);
            if (this.sheets.length == 0) {
                this.init();
                return;
            }
            if (index <= this.activeSheet) {
                index = this.activeSheet - 1;
            } else {
                index = this.activeSheet;
            }
            this.setActiveSheet(index);
        },
        setActiveSheet: function(index) {
            index = index < 0 ? 0 : index;
            this.activeSheet = index;
            for (var x=0; x < this.sheets.length; x++) {
                if (x == index) {
                    this.sheets[x].active = 1;
                } else {
                    this.sheets[x].active = 0;
                }
            }
            $rootScope.$broadcast('bctUpdate');
        },
        addSheet: function(data, $index) {
            var addIndex = 0;
            if ($index == "undefined" || $index == null) {
                this.sheets.splice(0, 1, data);
                addIndex = this.sheets.length-1;
            } else {
                this.sheets.splice($index+1, 0, data);
                addIndex = $index+1;
            }
            this.setActiveSheet(addIndex);

            return addIndex;
        },
        updateSheet: function(data, index) {
            this.sheets[index]['data'] = data;
            $rootScope.$broadcast('bctUpdate');
        },
        init: function() {
            this.loadSheet(defaultUrl, {}, null);
        },
    };

    return bctService;
}]);