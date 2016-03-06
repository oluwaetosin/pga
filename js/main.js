var app = angular.module('myApp',['ui.router','restangular','ngSanitize',
    'ngAnimate','ui.bootstrap','ngFileUpload']);
app.config(function($stateProvider,$urlRouterProvider,RestangularProvider){
    RestangularProvider.setBaseUrl("/pganigeria/api/v1/api.php");
    $urlRouterProvider.otherwise('/members');
    $stateProvider
    .state('members', {
        url: "/members",
        templateUrl: 'partials/members.html',
        controller: "membersCtrl",
        resolve: {
            members:function(Restangular){
               var member =  Restangular.all("/member");
               return member.getList();
            }
        }
    })
    .state('member', {
        url: "/members/:Id",
        templateUrl: 'partials/member.html',
        controller: 'memberCtrl'
    })
    .state('newmember', {
        url: "/newmember",
        templateUrl: 'partials/newmember.html',
        controller: 'newMemberCtrl'
    })
    .state('careers', {
        url: "/careers",
        templateUrl: 'partials/careers.html',
        controller: 'careersCtrl',
         resolve: {
            members:function(Restangular){
               var member =  Restangular.all("/member");
               return member.getList();
            }
        }
    })
//    .state('finacialrecord', {
//        url: "/finacialrecord",
//        templateUrl: 'partials/financialrecord.html',
//        controller: 'financialrecordCtrl'
//    })
    .state('newfinancialRecord',{
        url: "/finacialrecord",
        templateUrl: 'partials/newfinancialrecord.html',
        controller: 'newfinancialRecordCtrl',
        resolve: {
            members:function(Restangular){
               var member =  Restangular.all("/member");
               return member.getList();
            }
        }
    })
    .state('memberTransaction', {
        url: "/financialRecord/member/:memberId",
        templateUrl: 'partials/financialrecord.html',
        controller: 'financialrecordCtrl'
    })
    .state('memberCareer', {
        url: "/Career/member/:memberId",
        templateUrl: 'partials/membercareer.html',
        controller: 'memberCareerCtrl'
    });
    
});


