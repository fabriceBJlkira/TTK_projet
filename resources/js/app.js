import './bootstrap';

import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    breadcaster: 'socket.io',
    host: window.location.hostname + '6001'
})