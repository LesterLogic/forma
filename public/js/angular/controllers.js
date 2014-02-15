//'use strict';

/* Controllers */
var controllers = angular.module('formaApp.controllers', []);

forma.controller('MainCtrl', ['$scope', '$bct', function($scope, $bct) {
    $scope.bct = $bct;
    $scope.sheets = $bct.sheets;

    $scope.init = function() {
        if (this.bct.sheets.length == 1) {
            this.bct.init();
        }
    }
}]);

forma.controller('SheetCtrl', ['$scope', '$bct', function($scope, $bct) {
    $scope.bct = $bct;

    $scope.printSheet = function($index, $event) {
        $event.stopPropagation();
        this.bct.loadSheet('app/dashboard', null, $index);
    };
    $scope.emailSheet = function($index, $event) {
        $event.stopPropagation();
    };
    $scope.editSheet = function($index, $event) {
        $event.stopPropagation();
    };
    $scope.closeSheet = function($index, $event) {
        $event.stopPropagation();
        this.bct.closeSheet($index);
    };
    $scope.openSheet = function($path, $index, $event) {
        console.log($path);
        $event.stopPropagation();
        this.bct.loadSheet($path, {}, $index);

        return false;
    };
    $scope.haveFocus = function($index) {
        this.bct.setActiveSheet($index);
    };
}]);