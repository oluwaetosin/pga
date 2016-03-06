var app = angular.module('myApp');

app.factory('apiManager',function($http){
    var api = {};
    var baseUrl = "api/v1/api.php/";
  
    
    
    api.updateMember = function (_member,_updatePic,_oldPicName){
        console.log(_member);
        return $http({
            method:"PUT",
            url: baseUrl + "member/" + _member.member_Id,
            data : {member:_member,meta:{updatePic:_updatePic,old_pic:_oldPicName}}
        });
    };
    api.deleteMember = function (_member){
        console.log(_member);
        return $http({
            method:"DELETE",
            url: baseUrl + "member/" + _member.member_Id
          });
        
    };
    
    
    api.createMember = function (_career){
        return $http({
            method:"POST",
            url: baseUrl + "member",
            data : {member:_career}
        });
    };
    
    
      api.createCareer = function (_career){
        return $http({
            method:"POST",
            url: baseUrl + "careerRecord",
            data : {career:_career}
        });
    };
    
    api.createTransaction = function (_transaction){
        return $http({
            method:"POST",
            url: baseUrl + "financialRecord",
            data : {transaction:_transaction}
        });
    };
    api.fetchMemeberTransaction = function (_memberId){
        return $http({
            method:"GET",
            url: baseUrl + "financialRecord/member/" +_memberId
          
        });
    };
    api.fetchMemeberCareer = function (_memberId){
        return $http({
            method:"GET",
            url: baseUrl + "careerRecord/member/" +_memberId
          
        });
    };
    
    return api;
});


