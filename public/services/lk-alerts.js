(function () {

    angular
        .module('lk-angular')
        .factory('LkAlerts', Factory);

    Factory.$inject = [];

    function Factory() {
        var self = this;
        self.alerts = [];

        return {
            add: addItem,
            close: closeItem,
            get: getItems
        };

        function addItem(response) {
            if (undefined != response.result && undefined != response.message) {
                self.alerts.push(response);
            }
        }

        function closeItem(index) {
            self.alerts.splice(index, 1);
        }

        function getItems() {
            return self.alerts;
        }

    }

})();