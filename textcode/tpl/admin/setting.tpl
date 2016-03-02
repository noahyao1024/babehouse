<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
<meta name="description" content="">
<meta name="author" content="">
<title>yaokun tpl</title>
<script src="/babehouse/textcode/static/angular.min.js"></script>

<!-- Bootstrap core CSS -->
<link href="/babehouse/textcode/static/bootstrap.min.css" rel="stylesheet">

</head>
<body ng-app="myApp">

<div class="container-fluid">

    <div ng-include="'/babehouse/textcode/widget/menu.html'"></div>

    <div class="row">
        <div class="col-xs-6 col-sm-4"></div>
        <div class="col-xs-6 col-sm-4">

            <div ng-controller="myController">
                <form>
                    <div class="form-group"><span class="label label-primary">Title:</span>&nbsp<input type="text" ng-model="pagedata.title"/></div>
                    <div class="form-group"><span class="label label-primary">nav1Link:</span>&nbsp<input type="text" ng-model="pagedata.nav1Link"/></div>
                    <div class="form-group"><span class="label label-primary">nav1:</span>&nbsp<input type="text" ng-model="pagedata.nav1"/></div>
                    <div class="form-group"><span class="label label-primary">nav2Link:</span>&nbsp<input type="text" ng-model="pagedata.nav2Link"/></div>
                    <div class="form-group"><span class="label label-primary">nav2:</span>&nbsp<input type="text" ng-model="pagedata.nav2"/></div>
                    <div class="form-group"><span class="label label-primary">nav3Link:</span>&nbsp<input type="text" ng-model="pagedata.nav3Link"/></div>
                    <div class="form-group"><span class="label label-primary">nav3:</span>&nbsp<input type="text" ng-model="pagedata.nav3"/></div>
                    <div class="form-group"><span class="label label-primary">center:</span>&nbsp<input type="text" ng-model="pagedata.center"/></div>
                    <div class="form-group"><span class="label label-primary">intro:</span>&nbsp<input type="text" ng-model="pagedata.intro"/></div>
                    <div class="form-group"><span class="label label-primary">carousel_h1</span>&nbsp<input type="text" ng-model="pagedata.carousel_h1"/></div>
                    <div class="form-group"><span class="label label-primary">carousel_p1</span>&nbsp<input type="text" ng-model="pagedata.carousel_p1"/></div>
                    <div class="form-group"><span class="label label-primary">carousel_button1</span>&nbsp<input type="text" ng-model="pagedata.carousel_button1"/></div>
                    <div class="form-group"><span class="label label-primary">carousel_img1</span>&nbsp<input type="text" ng-model="pagedata.carousel_img1"/></div>
                    <div class="form-group"><span class="label label-primary">carousel_h2</span>&nbsp<input type="text" ng-model="pagedata.carousel_h2"/></div>
                    <div class="form-group"><span class="label label-primary">carousel_p2</span>&nbsp<input type="text" ng-model="pagedata.carousel_p2"/></div>
                    <div class="form-group"><span class="label label-primary">carousel_button2</span>&nbsp<input type="text" ng-model="pagedata.carousel_button2"/></div>
                    <div class="form-group"><span class="label label-primary">carousel_img2</span>&nbsp<input type="text" ng-model="pagedata.carousel_img2"/></div>
                    <div class="form-group"><span class="label label-primary">carousel_h3</span>&nbsp<input type="text" ng-model="pagedata.carousel_h3"/></div>
                    <div class="form-group"><span class="label label-primary">carousel_p3</span>&nbsp<input type="text" ng-model="pagedata.carousel_p3"/></div>
                    <div class="form-group"><span class="label label-primary">carousel_button3</span>&nbsp<input type="text" ng-model="pagedata.carousel_button3"/></div>
                    <div class="form-group"><span class="label label-primary">carousel_img3</span>&nbsp<input type="text" ng-model="pagedata.carousel_img3"/></div>

                    <button type="submit" ng-click="submit(pagedata)" class="btn btn-default">Submit</button>
                </form>
            </div>

        </div><!-- end of center-->

        <div class="col-xs-6 col-sm-4"></div>
    </div>
</div>

<script language='javascript'>
// create module
var app = angular.module('myApp', []);

app.controller('myController', function($scope, $http) {
        $scope.pagedata = angular.copy(pagedata);
        console.log(pagedata);
        $scope.submit = function(pagedata) {
        $http.post('/babehouse/textcode/admin/setting', pagedata).
        success(function(data, status, headers, config) {
            alert(data.errmsg);
            }).
        error(function(data, status, headers, config) {
            });
        }
        });

app.config(function($httpProvider){
        $httpProvider.defaults.transformRequest = function(obj){
        var str = [];
        for(var p in obj){
        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
        }
        return str.join("&");
        }

        $httpProvider.defaults.headers.post = {
        'Content-Type': 'application/x-www-form-urlencoded'
        }
        });
</script>

</body>
</html>
