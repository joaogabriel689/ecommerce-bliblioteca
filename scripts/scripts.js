ocument.addEventListener('DOMContentLoaded', function() {
    
    const mobileMenuBtn = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const cartBtn = document.querySelector('header nav#desktop-menu ul li i.fa-cart-shopping');
    const cartPanelDesktop = document.querySelector('.orders');
    const ordersBtn = document.querySelector('header nav#desktop-menu ul li:last-child');
    
    let overlay = document.querySelector('.mobile-menu-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'mobile-menu-overlay';
        document.body.appendChild(overlay);
    }
    
    // abre/fecha menu
    mobileMenuBtn?.addEventListener('click', function() {
        mobileMenu?.classList.toggle('active');
        overlay?.classList.toggle('active');
    });
    
    // fecha quando clica fora
    overlay?.addEventListener('click', function() {
        mobileMenu?.classList.remove('active');
        overlay?.classList.remove('active');
    });
    
    // fecha menu ao clicar num link
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', function() {
            mobileMenu?.classList.remove('active');
            overlay?.classList.remove('active');
        });
    });
    
    // carrinho
    if (cartBtn || ordersBtn) {
        (cartBtn || ordersBtn).addEventListener('click', function(e) {
            e.preventDefault();
            cartPanelDesktop?.classList.toggle('active');
        });
    }
    
    // fecha carrinho quando clica fora
    document.addEventListener('click', function(e) {
        if (!e.target.closest('header') && !e.target.closest('.orders')) {
            cartPanelDesktop?.classList.remove('active');
        }
    });
});
