(function () {
angular
    .module('larakit')
    .config(['$locationProvider', '$routeProvider', '$translateProvider',
        function config($locationProvider, $routeProvider, $translateProvider) {
            $locationProvider.html5Mode(true);

            $translateProvider.useStaticFilesLoader({
                prefix: '/!/locales/',
                suffix: '.json'
            });
            $translateProvider
                .preferredLanguage('{{$locale}}')
                .fallbackLanguage('{{$locale}}');
            $translateProvider.useCookieStorage();

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
