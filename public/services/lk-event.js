(function () {
    angular
        .module('lk-angular')
        .factory('LkEvent', Factory);

    Factory.$inject = [];

    function Factory() {
        var self = this;
        self.events = {};

        return {
            subscribe: subscribe,
            unsubscribe: unsubscribe,
            fire: fire
        };

        function has(event_name, sender) {
            if (!self.events[event_name]) {
                return false;
            }
            return _.filter(self.events[event_name], function (listener) {
                return listener.sender == sender;
            }).length;
        }

        function subscribe(event_name, sender, callback) {
            console.log('subscribe', event_name, sender);
            if (!has(event_name, sender)) {
                if (undefined == self.events[event_name]) {
                    self.events[event_name] = [];
                }
                self.events[event_name].push({
                    sender: sender,
                    callback: callback
                });
            }
        }

        function unsubscribe(event_name, sender) {
            console.log('unsubscribe', event_name, sender);
            if (has(event_name, sender)) {
                _.remove(self.events[event_name], function (listener) {
                    return listener.sender == sender;
                });
            }
            self.events[event_name][sender] = null;
        }

        function fire(event_name) {
            if (undefined != self.events[event_name]) {
                _.each(self.events[event_name], function (listener) {
                    listener.callback.call();
                })
            }
        }
    }
})();