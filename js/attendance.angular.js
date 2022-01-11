angular.module('attendance', ['ngAnimate', 'angularMoment']).controller('attendanceController', 
	function ($scope, $http, $interval, $filter	) {
		$scope.students = [];
		$scope.wctAJAX = function( wctData, wctCallback ) {
			wctRequest = {
				method: 'POST',
				url: 'centers_manage.php',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				transformRequest: function(obj) {
					var str = [];
					for(var p in obj){
						str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
					}
					return str.join("&");
				},
				data: wctData
			}
			$http(wctRequest).then(function(wctResponse){
				wctCallback(wctResponse.data);
			}, function () {
				console.log("Error in fetching data");
			});
		}
		$scope.wctAJAX( {tab: 'trainee_list', id: $("#id").val(), date: $("#date").val()}, function( response ){
			$scope.students = response;
		});
	}
)