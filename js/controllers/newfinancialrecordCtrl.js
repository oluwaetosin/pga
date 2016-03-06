var app = angular.module('myApp');
          app.controller('newfinancialRecordCtrl',function($scope,$timeout,members,apiManager){
              $scope.allMembers = members;
              $scope.submit = function(_transaction){
                 var transaction =  apiManager.createTransaction(_transaction);
        transaction.success(function(data){
             
            if(data.status){
            $scope.showSuccess = true;
            $scope. successMessage    = "Record Created";
            $scope.transaction = {};
          $timeout(function(){
              $scope.successMessage = "";
              $scope.showSuccess = false;
          },10000);  
            }else{
                 $scope.errorMessage = "Error Creating Transaction";
            $scope.showError = true;
             $timeout(function(){
               $scope.errorMessage = "";
              $scope.showError = false;
          },10000);
            }
        });
        transaction.error(function(data){
            $scope.errorMessage = "Error Creating Transaction";
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



