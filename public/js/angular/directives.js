//'use strict';

/* Directives */
var directives = angular.module('formaApp.directives', []);

forma.directive('sheet', ['$bct', '$compile', '$http', function($bct, $compile, $http) {
    var def = {
        restrict: "A",
        transclude: true,
        templateUrl: '/js/angular/templates/sheet.html',
        link: function(scope, element) {
            $http.get($bct.sheets[$bct.activeSheet]['template']).then(function(msg) {
                var template = msg.data;
                $compiled = $compile(template)(scope);
                console.log($compiled);
                element.children('div.content').html($compiled);
                console.log(element);
            });
        }
    };

    return def;
}]);

forma.directive('sheetwrapper', function($window) {
    return function($scope) {
        $scope.initializeWindowSize = function() {
            $scope.windowHeight = $window.innerHeight - 115;
            $scope.windowWidth = $window.innerWidth;
        };

        // Initiate the resize function default values
        $scope.initializeWindowSize();

        angular.element($window).bind('resize', function() {
            $scope.initializeWindowSize();
            $scope.$apply();
        });
    };
});

forma.directive('sheetblock', function($window, $animate) {
    function link(scope, element, attrs, controller) {
        scope.$on('bctUpdate', function() {
            $(element).css({'width':410*(scope.bct.sheets.length)});
            var oldLeft = element.css('left').replace('px', '');
            var newLeft = ($window.innerWidth/2 - 205) - (scope.bct.activeSheet * 410);
            $(element).animate({'left':newLeft}, 1000, 'swing');
        });

        angular.element($window).bind('resize', function() {
            element.css('left', ($window.innerWidth/2 - 205) - (scope.bct.activeSheet * 410));
        });
    }
    return { link: link };
});

forma.directive('bctblock', function($window, $animate, $compile) {
    function link(scope, element, attrs, controller) {
        scope.$on('bctUpdate', function() {
            var oldLeft = element.css('left').replace('px', '');
            var newLeft = ($window.innerWidth/2 - 60) - (scope.bct.activeSheet * 120);
            $(element).animate({'left':newLeft}, 1000, 'swing');
        });

        angular.element($window).bind('resize', function() {
            element.css('left', ($window.innerWidth/2 - 60) - (scope.bct.activeSheet * 120));
        });
    }
    return { link: link };
});