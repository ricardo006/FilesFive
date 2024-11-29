import { showNotification } from './notifications.js';

// Exemplo de notificação quando a página carrega
document.addEventListener('DOMContentLoaded', () => {
    if (window.successMessage) 
        showNotification(window.successMessage, 'success');
});
