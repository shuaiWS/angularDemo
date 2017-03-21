/**
 * Created by Administrator on 2016/2/20.
 */
angular.module("kaifanla", ["ng","ngTouch"])
    .controller("parent", function ($scope) {
        $scope.jump=function(url){
            $.mobile.changePage(url);
        };
        $(document).on('pagecreate', function (event) {
            var page = event.target;
            var scope = $(page).scope();
            $(page).injector().invoke(function ($compile) {
                $compile(page)(scope);
                scope.$digest();
            })

        });


    })
    .controller("start", function ($scope) {

    })
    .controller("main", function ($scope,$http) {
        $scope.dislist = [];
        $scope.more = false;
        $http.get("date/dish_getbypage.php?start=0").success(function (date) {
            
			

            $scope.dislist = date;
            
        });
        $scope.loadmore = function () {
            $http.get("date/dish_getbypage.php?start=" + $scope.dislist.length).success(function (date) {
                $scope.dislist = $scope.dislist.concat(date);
                $scope.more = true;
            });
        };
        $scope.$watch("kw", function () {
            if (!$scope.kw) {
                return;
            }
            $http.get("date/dish_getbykw.php?kw=" + $scope.kw).success(function (date) {
                $scope.dislist = date;
            })
        });
        $scope.show=function(did){
           sessionStorage.did=did;
            $.mobile.changePage("detail.html")
        }
    })
    .controller("detail", function ($scope,$http) {
        $scope.disList = [];
        $http.get("date/dish_getbyid.php?did=" + sessionStorage.did).success(function (date) {
            $scope.disList = date;
        });
        $scope.show=function(did){
            $.mobile.changePage("order.html");
        }
    })
    .controller("order", function ($scope,$http) {
        $scope.isok=true;
        $scope.tan=true;
        $scope.order = {did: sessionStorage.did};
        $scope.subs = function () {
            if($scope.order.phone){
                sessionStorage.phone=$scope.order.phone;
                $scope.tan=true;
                var orderDate = jQuery.param($scope.order);
                $http.post('date/order_add.php', orderDate)
                    .success(function (data) {
                        $scope.isok=false;

                    });
            }else{
                $scope.tan=false;
            }

        };
        $scope.myorders=function(){
            $.mobile.changePage("myorder.html");
        }
    })
    .controller("myorder", function ($scope,$http) {
        $scope.disList = [];
        $http.get("date/order_getbyphone.php?phone=" + sessionStorage.phone).success(function (date) {
            $scope.disList = date;
        });

    })
    .run(function ($http) {
        $http.defaults.headers.post =
        {'Content-Type': 'application/x-www-form-urlencoded'};

    })