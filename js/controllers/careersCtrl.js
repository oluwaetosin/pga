var app = angular.module('myApp');
          app.controller('careersCtrl',function($scope,$timeout,members,apiManager){
              $scope.allMembers = members;
              $scope.submit = function(_career){
                 var career =  apiManager.createCareer(_career);
        career.success(function(data){
             
            if(data.status){
            $scope.showSuccess = true;
            $scope. successMessage    = "Career Created";
            $scope.member = {};
          $timeout(function(){
              $scope.successMessage = "";
              $scope.showSuccess = false;
          },10000);  
            }else{
                 $scope.errorMessage = "Error Creating Career";
            $scope.showError = true;
             $timeout(function(){
               $scope.errorMessage = "";
              $scope.showError = false;
          },10000);
            }
        });
        career.error(function(data){
            $scope.errorMessage = "Error Creating Career";
            $scope.showError = true;
             $timeout(function(){
               $scope.errorMessage = "";
              $scope.showError = false;
          },10000);  
        });
          
              }
               $timeout(function(){
                       $('select').select2(); 
                   },3000);
          });



