<!DOCTYPE html>
<html lang="zh-CN">

<script type="text/javascript">
var commentdata;
</script>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
<meta name="description" content="">
<meta name="author" content="">

<title id='title'></title>
<script src="/babehouse/textcode/static/angular.min.js"></script>

<!-- Bootstrap core CSS -->
<link href="/babehouse/textcode/static/bootstrap.min.css" rel="stylesheet">

</head>

<body ng-app="myApp">

<div class="container">
    <div ng-include="'/babehouse/textcode/widget/menu-main.html'"></div>
</div>

<div id="myCarousel" class="carousel slide" data-ride="carousel" ng-controller='carouselController'>
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img class="first-slide" ng-src="{{pagedata.carousel_img1}}" alt="First slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>{{pagedata.carousel_h1}}</h1>
                    <p>{{pagedata.carousel_p1}}</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">{{pagedata.carousel_button1}}</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="second-slide" ng-src="{{pagedata.carousel_img2}}" alt="Second slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>{{pagedata.carousel_h2}}</h1>
                    <p>{{pagedata.carousel_p2}}</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">{{pagedata.carousel_button2}}</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="third-slide" ng-src="{{pagedata.carousel_img3}}" alt="Third slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>{{pagedata.carousel_h3}}</h1>
                    <p>{{pagedata.carousel_p3}}</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">{{pagedata.carousel_button3}}</a></p>
                </div>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- /.carousel -->

<br>

<div class='fluid-container'>
    <div class="row" ng-controller="myController">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">在此提交评论</h3>
                </div>
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" placeholder="Email" ng-model="commentdata.email">
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <input type="text" class="form-control" placeholder="Content" ng-model="commentdata.content">
                        </div>
                        <button type="submit" class="btn btn-default" ng-click='submit_comment(commentdata)'>Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<div class='container'>
    <div class='row' ng-controller='commentTableController'>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">已有评论</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Comment</th>
                                <th>Create Time</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="item in items">
                            <th>{{$index + 1}}</th>
                            <td>{{item.email}}</td>
                            <td>{{item.content}}</td>
                            <td>{{item.create_time}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<div class="container">
    <div ng-include="'/babehouse/textcode/widget/footer.html'"></div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/babehouse/textcode/static/jquery.min.js"></script>
<script src="/babehouse/textcode/static/bootstrap.min.js"></script>
</body>

<script type="text/javascript">

var app = angular.module('myApp', []);
app.controller('myController', function($scope, $http) {
        $scope.commentdata = angular.copy(commentdata);
        $scope.submit_comment = function(commentdata) {
        console.log(commentdata);
        $http.post('/babehouse/textcode/api/comment', commentdata).
        success(function(data, status, headers, config) {
            alert(data.errmsg);
            }).
        error(function(data, status, headers, config) {
            });
        }
        });

app.controller('carouselController', function($scope, $http) {
        $scope.pagedata = angular.copy(pagedata);
        console.log('test');
        console.log(pagedata);
        });

app.controller('commentTableController', function($scope, $http) {
        $http.get('/babehouse/textcode/api/getComment').
        success(function(data, status, headers, config) {
            $scope.items = data.data;
            });
        });

app.config(function($httpProvider) {
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

</html>
