import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {

    /* =======================
       SORT DROPDOWN
    ======================= */
    const dropdown = document.getElementById('sortDropdown');
    if (dropdown) {
        const trigger = dropdown.querySelector('.dropdown-trigger');
        const menu = dropdown.querySelector('.dropdown-menu');
        const selectedText = document.getElementById('selectedOption');

        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            menu.classList.toggle('show');
        });

        menu.querySelectorAll('li').forEach(item => {
            item.addEventListener('click', () => {
                selectedText.innerText = item.innerText;
                menu.classList.remove('show');
            });
        });

        document.addEventListener('click', () => {
            menu.classList.remove('show');
        });
    }

    /* =======================
       GENDER TOGGLE
    ======================= */
    document.querySelectorAll('.tgl-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.tgl-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    /* =======================
       SLIDER LOGIC
    ======================= */
    const track      = document.getElementById('track');
    const slides     = document.querySelectorAll('.slide');
    const dottedArea = document.getElementById('dottedArea');
    const cursorArrow = document.getElementById('cursorArrow');

    if (track && slides.length > 0 && dottedArea) {
        let currentIndex = Math.floor(slides.length / 2);

        function updateSlider() {
            const slideWidth = slides[0].offsetWidth;
            const gap = window.innerWidth < 768 ? 24 : 100;
            const offset = -(currentIndex * (slideWidth + gap));

            track.style.transform = `translateX(${offset}px)`;

            slides.forEach((slide, index) => {
                slide.classList.remove('active', 'side-slide');

                if (index === currentIndex) {
                    slide.classList.add('active');
                } else {
                    slide.classList.add('side-slide');
                }
            });
        }

        // Arrow direction follows mouse position
        if (cursorArrow) {
            dottedArea.addEventListener('mousemove', (e) => {
                const rect = dottedArea.getBoundingClientRect();
                const mouseX = e.clientX - rect.left;
                const half = rect.width / 2;

                cursorArrow.textContent = mouseX < half ? '←' : '→';
                dottedArea.dataset.dir = mouseX < half ? 'left' : 'right';

                cursorArrow.style.left = (e.clientX - rect.left - 20) + 'px';
                cursorArrow.style.top = (e.clientY - rect.top - 20) + 'px';
            });

            dottedArea.addEventListener('mouseleave', () => {
                cursorArrow.textContent = '→';
            });
        }

        // Click logic
        dottedArea.addEventListener('click', () => {
            if (dottedArea.dataset.dir === 'left') {
                currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            } else {
                currentIndex = (currentIndex + 1) % slides.length;
            }
            updateSlider();
        });

        window.addEventListener('resize', updateSlider);
        updateSlider();
    }
});

/* =======================
   GLOBAL HELPERS
======================= */
window.closeModal = () => {
    const modal = document.getElementById('modalOverlay');
    if (modal) modal.style.display = 'none';
};

window.handleHeroClick = (btn) => {
    btn.parentElement.querySelectorAll('.btn-hero')
        .forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
};

/* =======================
   SEARCH MODAL
======================= */
window.toggleSearch = () => {
    const modal = document.getElementById('searchModal');
    if (modal) {
        modal.classList.remove('hidden');
        setTimeout(() => {
            const input = document.getElementById('searchInput');
            if (input) input.focus();
        }, 100);
    }
};

window.closeSearch = () => {
    const modal = document.getElementById('searchModal');
    if (modal) modal.classList.add('hidden');
};

/* =======================
   CART SIDEBAR
======================= */
window.openCart = () => {
    const overlay = document.getElementById('cartOverlay');
    const sidebar = document.getElementById('cartSidebar');
    
    if (overlay && sidebar) {
        overlay.classList.add('active');
        sidebar.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
};

window.closeCart = () => {
    const overlay = document.getElementById('cartOverlay');
    const sidebar = document.getElementById('cartSidebar');
    
    if (overlay && sidebar) {
        overlay.classList.remove('active');
        sidebar.classList.remove('active');
        document.body.style.overflow = '';
    }
};

/* =======================
   KEYBOARD SHORTCUTS
======================= */
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        window.closeCart();
        window.closeSearch();
    }
});
document.querySelector('.cart-checkout-btn').addEventListener('click', function() {
    window.location.href = '/checkout'; // Or your specific checkout URL
});