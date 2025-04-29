/**
 * Load lodash library
 */
import _ from 'lodash-es';
window._ = _;

/**
 * Load axios HTTP library
 */
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Initialize Laravel Echo for real-time events
 */
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Проверка наличия необходимых переменных окружения
if (!import.meta.env.VITE_PUSHER_APP_KEY) {
    console.error('Pusher app key is missing in environment variables');
}

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY, // Use import.meta.env for Vite
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER, // Use import.meta.env for Vite
    forceTLS: true,
    enabledTransports: ['ws', 'wss'], // Принудительно используем WebSocket
    disableStats: true, // Отключаем сбор статистики
});
