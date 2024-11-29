import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import 'flowbite/dist/flowbite.turbo.js';
document.addEventListener('turbo:load', () => {
    const drawers = document.querySelectorAll('[data-drawer-fetch]');
    drawers.forEach((drawer) => {
        drawer.addEventListener('click', async (event) => {
            event.preventDefault();
            const url = drawer.getAttribute('data-drawer-fetch');
            const id = drawer.getAttribute('data-drawer-target');

            try {
              const response = await fetch(url);
              const html = await response.text();
              const modal = document.querySelector(`#${id}`);
              if (modal) {
                modal.innerHTML = html;
              }
            } catch (error) {
              console.error('Error:', error);
            }
        });
    });
});
