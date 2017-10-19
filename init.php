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
    ->usePackage('larakit/sf-toastrjs')
    ->setSourceDir('public')
    ->jsPackage('lk-angular.js')
    ->jsPackage('services/breadcrumbs-builder.js')
    ->jsPackage('services/lk-hasher.js')
    ->jsPackage('services/lk-list.js')
    ->jsPackage('services/lk-alerts.js')
    ->jsPackage('services/lk-page.js')
    ->jsPackage('services/lk-event.js')
    ->jsPackage('services/lk-sidebars.js')
    ->jsPackage('services/lk-user.js')

;

//\Larakit\LkNgModule::register('ngNamedRoute');
//\Larakit\LkNgModule::register('ngSanitize');
//\Larakit\LkNgModule::register('ngResource');
//\Larakit\LkNgModule::register('ngRoute');
//\Larakit\LkNgModule::register('ngCookies');
//\Larakit\LkNgModule::register('cfp.hotkeys');
\Larakit\LkNgModule::register('lk-angular');