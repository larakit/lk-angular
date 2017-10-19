(function () {

    angular
        .module('lk-angular')
        .factory('LkPage', Factory);

    Factory.$inject = ['$route', 'namedRouteService'];

    function Factory($route, namedRouteService) {
        var self = this;
        return {
            get: getPage,
            getTitle: getTitle,
            getSubTitle: getSubTitle,
            getUrl: getUrl,
            getIcon: getIcon
        };

        function getPage(name, params, replaces) {
            var item = {};
            if (undefined == params) {
                params = {};
            }
            if (undefined == replaces) {
                replaces = {};
            }
            var url = namedRouteService.reverse(name, params), route, title, subtitle;
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
            _.each(replaces, function (v, k) {
                subtitle = subtitle.replace('{{' + k + '}}', v);
            });
            return {
                title: title,
                subtitle: subtitle,
                url: route.url,
                icon: route.icon
            };
        }

        function getTitle(name, params, replaces) {
            var route = get(name, params, replaces);
            if(undefined!= route){
                return route.title;
            }
            return null;
        }
        function getSubTitle(name, params, replaces) {
            var route = get(name, params, replaces);
            if(undefined!= route){
                return route.subtitle;
            }
            return null;
        }
        function getUrl(name, params, replaces) {
            var route = get(name, params, replaces);
            if(undefined!= route){
                return route.url;
            }
            return null;
        }
        function getIcon(name, params, replaces) {
            var route = get(name, params, replaces);
            if(undefined!= route){
                return route.url;
            }
            return null;
        }
    }

})();