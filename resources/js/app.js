/**
 * app.js — KPM Group
 * Initializes Alpine.js and AOS
 * Keep this file minimal — interactivity lives in Blade via x-data
 */

import Alpine from 'alpinejs';
import focus  from '@alpinejs/focus';

// ── Alpine ──────────────────────────────────────
Alpine.plugin(focus);
window.Alpine = Alpine;
Alpine.start();

// ── Active nav link highlight (non-Alpine) ──────
document.addEventListener('DOMContentLoaded', () => {
    const path   = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href && (href === path || (href !== '/' && path.startsWith(href)))) {
            link.classList.add('active');
        }
    });
});
