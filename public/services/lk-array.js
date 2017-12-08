(function () {

    angular
        .module('lk-angular')
        .factory('LkArray', Factory);

    Factory.$inject = [];

    function Factory() {
        var self = this;

        return {
            in_array: in_array
        };


        /**
         * Функция проверки наличия значения в массиве
         * @param needle
         * @param haystack
         * @param strict
         * @returns {boolean}
         */
        function in_array(needle, haystack, strict) {
            var found = false, key, strict = !!strict;
            for (key in haystack) {
                if ((strict && parseInt(haystack[key]) === parseInt(needle)) || (!strict && parseInt(haystack[key]) == parseInt(needle))) {
                    found = true;
                    break;
                }
            }
            return found;
        };
    }

})();