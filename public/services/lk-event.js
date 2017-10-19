(function () {
    angular
        .module('lk-angular')
        .factory('LkEvent', Factory);

    Factory.$inject = [];

    function Factory() {
        var self = this;
        self.events = {};

        return {
            listener: listener,
            fire: fire
        };

        function listener(event_name, callback) {
            if (!self.events[event_name]) {
                self.events[event_name] = [];
            }
            self.events[event_name].push(callback);
        }

        function fire(event_name) {
            if (self.events[event_name]) {
                _.each(self.events[event_name], function(callback){
                    callback.call();
                });
            }
        }
    }
})();