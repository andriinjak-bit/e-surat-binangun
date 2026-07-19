import './bootstrap';
import '../css/app.css';

window.onerror = function (msg, url, lineNo, columnNo, error) {
    document.body.innerHTML = '<div style="padding: 20px; color: red;"><h1>Error</h1><p>' + msg + '</p><pre>' + (error && error.stack ? error.stack : '') + '</pre></div>';
    return false;
};
window.addEventListener('unhandledrejection', function(event) {
    document.body.innerHTML = '<div style="padding: 20px; color: red;"><h1>Unhandled Promise Rejection</h1><p>' + event.reason + '</p></div>';
});

import { createRoot } from 'react-dom/client';
import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.jsx', { eager: true });
        let page = pages[`./Pages/${name}.jsx`];
        if (!page) {
            throw new Error(`Page not found: ${name}`);
        }
        return page;
    },
    setup({ el, App, props }) {
        const root = createRoot(el);
        root.render(<App {...props} />);
    },
    progress: {
        color: '#4B5563',
    },
});
