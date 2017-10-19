<?php
\Larakit\Boot::register_boot(__DIR__ . '/boot');
\Larakit\Boot::register_middleware_route('ng-larakit', \Larakit\LkNgComponentsMiddleware::class);
\Larakit\Boot::register_view_path(__DIR__ . '/views', 'ng-larakit');

\Larakit\StaticFiles\Manager::package('larakit/lk-angular')
    ->usePackage('larakit/sf-lodash.js')
    ->usePackage('larakit/sf-angular-route')
    ->usePackage('larakit/sf-angular-named-route')
    ->usePackage('larakit/sf-angular-resource')
    ->usePackage('larakit/sf-angular-sanitize')
    ->usePackage('larakit/sf-angular-hotkeys')
    ->usePackage('larakit/sf-angular-cookies')
    ->usePackage('larakit/sf-bootstrap')
    ->usePackage('larakit/sf-toastrjs');