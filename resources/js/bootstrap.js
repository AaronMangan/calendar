import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

if (document.getElementById('fullscreenBtn')) { 
    document.getElementById('fullscreenBtn').addEventListener('click', () => {
        document.getElementById('content').requestFullscreen();
    });
}