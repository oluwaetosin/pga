var app = angular.module('myApp');
          app.controller('memberCareerCtrl',function($scope,$stateParams,apiManager){
              var memberId = $stateParams.memberId;
              $scope.careers = [];
              var getMemeberCareer = apiManager.fetchMemeberCareer(memberId);
              getMemeberCareer.success(function(data){
                   $scope.careers  = data.data.career;
                   $scope.member  = data.data.member[0];
              });
              getMemeberCareer.error(function(data){
                   console.log("Error Occurred");
              });
            
          });


