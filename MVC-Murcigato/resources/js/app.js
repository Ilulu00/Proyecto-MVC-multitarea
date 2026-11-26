import 'bootstrap/dist/js/bootstrap.bundle.min.js';

const sidebarToggle = document.getElementById('sidebarToggle');
const sidebarBackdrop = document.getElementById('sidebarBackdrop');

if (sidebarToggle && sidebarBackdrop) {
    const setSidebarOpen = (isOpen) => {
        document.body.classList.toggle('sidebar-open', isOpen);
        sidebarToggle.setAttribute('aria-expanded', String(isOpen));
    };

    sidebarToggle.addEventListener('click', () => {
        setSidebarOpen(sidebarToggle.getAttribute('aria-expanded') !== 'true');
    });

    sidebarBackdrop.addEventListener('click', () => setSidebarOpen(false));

    document.querySelectorAll('.sidebar-link').forEach((link) => {
        link.addEventListener('click', () => setSidebarOpen(false));
    });
}
