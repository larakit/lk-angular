(function () {

    angular
        .module('lk-angular')
        .factory('BreadCrumbs', Factory);

    Factory.$inject = ['$route', 'namedRouteService', '$filter'];

    function Factory($route, namedRouteService, $filter) {
        var self = this, page_routes = [];
        return {
            clear: clear,
            add: add,
            all: all
        };

        function clear() {
            page_routes = [];
        }

        function all() {
            return page_routes;
        }

        function add(name, params, replaces) {
            var item = {};
            if (undefined == params) {
                params = {};
            }
            if (undefined == replaces) {
                replaces = {};
            }
            var url = namedRouteService.reverse(name, params),
                route, title, subtitle;
            _.each($route.routes, function (o) {
                if (o.name == name) {
                    route = o;
                }
            });
            title = route.title;
            _.each(replaces, function (v, k) {
                title = title.replace('{{' + k + '}}', v);
            });
            subtitle = route.subtitle;
            if (undefined == subtitle) {
                subtitle = '';
            }
            _.each(replaces, function (v, k) {
                subtitle = subtitle.replace('{{' + k + '}}', v);
            });
            item = {
                title: title,
                subtitle: subtitle,
                url: url,
                icon: route.icon
            };
            page_routes.push(item);
            // console.log(title, $filter('translate')(title));
            $('title').html($filter('translate')(title));
            return item;
        }
    }

})();