var app = angular.module('myApp');
          app.controller('financialrecordCtrl',function($scope,$stateParams,apiManager){
              var memberId = $stateParams.memberId;
              $scope.transactions
              
              var getMemeberTransaction = apiManager.fetchMemeberTransaction(memberId);
              getMemeberTransaction.success(function(data){
                   $scope.transactions  = data.data.account;
                   $scope.member  = data.data.member[0];
              });
              getMemeberTransaction.error(function(data){
                   console.log("Error Occurred");
              });
            
          });


