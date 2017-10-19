<?php
\Larakit\Boot::register_boot(__DIR__ . '/boot');
\Larakit\Boot::register_middleware_route('ng-larakit', \Larakit\LkNgComponentsMiddleware::class);
\Larakit\Boot::register_view_path(__DIR__ . '/views', 'ng-larakit');