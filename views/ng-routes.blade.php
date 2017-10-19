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
    ]);