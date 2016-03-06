var app = angular.module('myApp');
app.controller('membersCtrl', function ($scope, members, Upload, apiManager,$timeout,$state) {
    $scope.pageTitle = "Member's List";
    $scope.pageDescription = "(members list)"
    $scope.allMembers = members;

    $scope.showMemberEdit = function (_member) {
        $scope.activeMember = _member;
        $scope.passport = _member.passport;
        $("#memberModal").modal('show');
    };
    $scope.printDiv = function(divName) {
     $('form input[type=text]').each(function() {
  $(this).attr('value', $(this).val());
});
    var printContents = document.getElementById(divName).innerHTML;
  var popupWin = window.open('', '_blank', 'width=600,height=600');
  popupWin.document.open();
  popupWin.document.write('<html><head><link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"><link rel="stylesheet" href="dist/css/AdminLTE.min.css"></head><body onload="window.print()">' + printContents + '</body></html>');
  popupWin.document.close();
}
   $scope.delete = function (activeMember){
      var deleteMember =  apiManager.deleteMember(activeMember);
      
           deleteMember.success(function (data) {
                   
                    if (data.status) {
                        $scope.showSuccess = true;
                        $scope.successMessage = "Member Deleted";
                        $scope.member = {};
                        $timeout(function () {
                            $scope.successMessage = "";
                            $scope.showSuccess = false;
                        }, 10000);
                    } else {
                        $scope.errorMessage = "Error Deleting member";
                        $scope.showError = true;
                        $timeout(function () {
                            $scope.errorMessage = "";
                            $scope.showError = false;
                        }, 10000);
                    }
                });
                     deleteMember.error(function (data) {
                    $scope.errorMessage = "Error Deleting member";
                    $scope.showError = true;
                    $timeout(function () {
                        $scope.errorMessage = "";
                        $scope.showError = false;
                    }, 10000);
                });
   }
    $scope.updateMember = function (_member, _passport) {
              console.log(_passport);
        if (_passport.name && _member.passport !== _passport.name) {
            
            Upload.upload({
                method: "POST",
                url: 'uploadManager.php',
                data: {update_pic: _passport, old: _member.passport}
            }).then(function (resp) {
                var old_passport = _member.passport;
                _member.passport = resp.data.file;
                var newMember = apiManager.updateMember(_member, 1, old_passport);
                newMember.success(function (data) {
                    console.log(data);
                    if (data.status) {
                        $scope.showSuccess = true;
                        $scope.successMessage = "Member Updated";
                        $scope.member = {};
                        $timeout(function () {
                            $scope.successMessage = "";
                            $scope.showSuccess = false;
                        }, 10000);
                    } else {
                        $scope.errorMessage = "Error Updatting member";
                        $scope.showError = true;
                        $timeout(function () {
                            $scope.errorMessage = "";
                            $scope.showError = false;
                        }, 10000);
                    }
                });
                newMember.error(function (data) {
                    $scope.errorMessage = "Error Creating member";
                    $scope.showError = true;
                    $timeout(function () {
                        $scope.errorMessage = "";
                        $scope.showError = false;
                    }, 10000);
                });

            }, function (resp) {
                console.log('Error status: ' + resp.status);
            });
        } else {
          var newMember = apiManager.updateMember(_member, 0, 0);
           newMember.success(function (data) {
                    console.log(data);
                    if (data.status) {
                        $scope.showSuccess = true;
                        $scope.successMessage = "Member Updated";
                        $scope.member = {};
                        $timeout(function () {
                            $scope.successMessage = "";
                            $scope.showSuccess = false;
                            $state.reload();
                        }, 10000);
                    } else {
                        $scope.errorMessage = "Error Updatting member";
                        $scope.showError = true;
                        $timeout(function () {
                            $scope.errorMessage = "";
                            $scope.showError = false;
                        }, 10000);
                    }
                });
                newMember.error(function (data) {
                    $scope.errorMessage = "Error Creating member";
                    $scope.showError = true;
                    $timeout(function () {
                        $scope.errorMessage = "";
                        $scope.showError = false;
                    }, 10000);
                });
        }


    };
});

