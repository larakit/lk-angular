(function () {

    angular
        .module('lk-angular')
        .factory('LkUser', Factory);

    Factory.$inject = ['$http', '$q'];

    function Factory($http, $q) {
        var self = this;
        self.user = {};
        return {
            me: getAuthUser
        };

        function getAuthUser(is_clear) {
            var deferred = $q.defer();
            if (true == is_clear) {
                self.user = {};
            }
            if ('undefined' === typeof (self.user.id)) {
                $http
                    .get('/!/lkng/me')
                    .then(function (response) {
                        self.user = response.data;
                        deferred.resolve(self.user);
                        return deferred.promise;
                    }, function () {
                        self.user = {};
                        deferred.resolve(self.user);
                        return deferred.promise;
                    });
            } else {
                deferred.resolve(self.user);
            }
            return deferred.promise;
        }

    }

})();