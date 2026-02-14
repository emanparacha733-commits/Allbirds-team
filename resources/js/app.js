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
       SLIDER (CLEAN VERSION)
    ======================= */
    const track      = document.getElementById('track');
    const slides     = document.querySelectorAll('.slide');
    const dottedArea = document.getElementById('dottedArea');

    if (!track || slides.length === 0 || !dottedArea) return;

    let currentIndex = Math.floor(slides.length / 2);

    function updateSlider() {
        const slideWidth = slides[0].offsetWidth;
        const gap = window.innerWidth < 768 ? 24 : 100;
        const offset = -(currentIndex * (slideWidth + gap));

        track.style.transform = `translateX(${offset}px)`;

        slides.forEach((slide, index) => {
            slide.classList.remove('active', 'side-slide');

            if (index === currentIndex) {
                slide.classList.add('active');       // center (biggest)
            } else {
                slide.classList.add('side-slide');   // sides (smaller)
            }
        });
    }

    // Hover logic (left/right half)
    dottedArea.addEventListener('mousemove', (e) => {
        const rect = dottedArea.getBoundingClientRect();
        const x = e.clientX - rect.left;
        dottedArea.dataset.dir = x < rect.width / 2 ? 'left' : 'right';
    });

    // Click logic
    dottedArea.addEventListener('click', () => {
        if (dottedArea.dataset.dir === 'left') {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        } else {
            currentIndex = (currentIndex + 1) % slides.length;
        }
        updateSlider();
    });

    // Responsive fix
    window.addEventListener('resize', updateSlider);

    updateSlider();
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
// --- 3. SLIDER LOGIC ---
const track       = document.getElementById('track');
const slides      = document.querySelectorAll('.slide');
const dottedArea  = document.getElementById('dottedArea');
const cursorArrow = document.getElementById('cursorArrow');

let currentIndex = 0;

function updateSlider() {
    if (!track || slides.length === 0) return;
    
    const slideWidth = slides[0].offsetWidth;
    const gap        = 100; // ← match your CSS gap
    const offset     = -(currentIndex * (slideWidth + gap));
    
    track.style.transform = `translateX(${offset}px)`;

    // Optional: highlight active slide (if you use these classes in CSS)
    slides.forEach((slide, index) => {
        slide.classList.toggle('active', index === currentIndex);
        slide.classList.toggle('side-slide', index !== currentIndex);
    });
}

// ── Arrow direction follows mouse position ──
if (cursorArrow && dottedArea) {
    dottedArea.addEventListener('mousemove', (e) => {
        const rect = dottedArea.getBoundingClientRect();
        const mouseX = e.clientX - rect.left;           // position inside container
        const half   = rect.width / 2;

        // Show left or right arrow
        cursorArrow.textContent = mouseX < half ? '←' : '→';

        // Position arrow near cursor (you can offset it if you want)
        cursorArrow.style.left = (e.clientX - rect.left - 20) + 'px'; // -20 = small offset
        cursorArrow.style.top  = (e.clientY - rect.top - 20)  + 'px';
    });

    // Optional: reset to right arrow when mouse leaves
    dottedArea.addEventListener('mouseleave', () => {
        cursorArrow.textContent = '→';
    });
}

// ── Click to advance (still works everywhere) ──
if (dottedArea) {
    dottedArea.addEventListener('click', (e) => {
        const rect   = dottedArea.getBoundingClientRect();
        const mouseX = e.clientX - rect.left;
        const half   = rect.width / 2;

        // Optional: left side = previous, right side = next
        if (mouseX < half) {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        } else {
            currentIndex = (currentIndex + 1) % slides.length;
        }

        updateSlider();
    });
}

// Initial setup
updateSlider();
