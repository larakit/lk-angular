(function () {

    angular
        .module('lk-angular')
        .factory('LkSidebars', Factory);

    Factory.$inject = ['$cookies'];

    function Factory($cookies) {
        var self = this;
        self.cookie_name_left = 'sidebar_left';
        self.cookie_name_right = 'sidebar_right';
        self.left = false;
        self.right = false;
        leftSet(('undefined' != typeof $cookies.get(self.cookie_name_left)) ? ('true' == $cookies.get(self.cookie_name_left)) : false);
        rightSet(('undefined' != typeof $cookies.get(self.cookie_name_right)) ? ('true' == $cookies.get(self.cookie_name_right)) : false);
        // leftSet(true);
        // rightSet(false);
        // rightSet($cookies.get(self.cookie_name_right));

        return {
            rightSet: rightSet,
            leftSet: leftSet,
            leftValue: leftValue,
            leftToggle: leftToggle,
            rightValue: rightValue,
            rightToggle: rightToggle
        };

        function leftSet(val) {
            self.left = val;
            $cookies.put(self.cookie_name_left, self.left);
        }

        function leftValue() {
            return self.left;
        }

        function leftToggle() {
            leftSet(!self.left);
        }

        function rightSet(val) {
            self.right = val;
            $cookies.put(self.cookie_name_right, self.right);
        }

        function rightValue() {
            return self.right;
        }

        function rightToggle() {
            rightSet(!self.right);
        }

    }

})();