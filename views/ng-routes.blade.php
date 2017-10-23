(function () {
angular
    .module('larakit')
    .config(['$locationProvider', '$routeProvider',
        function config($locationProvider, $routeProvider) {
            $locationProvider.html5Mode(true);
            $routeProvider
                .otherwise('{{$otherwise}}');

@verbatim
/* ################################################## */
/*                      ROUTES START                  */
/* ################################################## */
$routeProvider@endverbatim
@foreach ($routes as $k=>$route)
.when('{{$k}}',
{!! $route->getJson() !!}
)@endforeach;
/* ################################################## */
/*                      ROUTES END                    */
/* ################################################## */

        }
    ]).run(function ($rootScope, LkSidebars) {
$rootScope.rightToggle = function () {
LkSidebars.rightToggle();
return false;
};
$rootScope.rightValue = function () {
return LkSidebars.rightValue();
};
$rootScope.leftToggle = function () {
LkSidebars.leftToggle();
return false;
};
$rootScope.leftValue = function () {
return LkSidebars.leftValue();
};
});;
})();
