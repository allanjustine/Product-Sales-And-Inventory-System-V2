/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? "mt1",
    // wsHost: import.meta.env.VITE_PUSHER_HOST
    //     ? import.meta.env.VITE_PUSHER_HOST
    //     : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    // wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    // wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    wsHost: window.location.hostname,
    wssHost: window.location.hostname,
    wssPort: 6001,
    wsPort: 6001,
    // forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? "https") === "https",
    forceTLS: false,
    disableStats: true,
    enabledTransports: ["ws", "wss"],
    authEndpoint: '/broadcasting/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    }
});

window.Echo.connection.bind('error', function (err) {
    console.error('Pusher Error:', err);
  });
window.Echo.connection.bind('state_change', function (states) {
    console.log('Pusher State Change:', states);
});

