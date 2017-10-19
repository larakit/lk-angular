(function () {

    angular
        .module('lk-angular')
        .factory('LkHasher', Factory);

    Factory.$inject = [];

    function Factory() {
        return {
            encode: encodeHash,
            decode: decodeHash
        };

        function encodeHash(obj) {
            return btoa(JSON.stringify(obj));
        }

        function decodeHash(str) {
            var o;
            if (!str.length) {
                return {};
            }
            try {
                o = atob(str);
                if(undefined == o){
                    return {};
                }
                return JSON.parse(o);
            } catch (e) {
                console.error(str);
                console.error(atob(str));
                console.error(e);
                console.error('Ошибка при обработке хэша');
                return {};
            }
        }
    }

})();