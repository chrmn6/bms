
document.addEventListener('DOMContentLoaded', function () {
// Animate stat numbers on page load
function animateNumbers() {
    const statNumbers = document.querySelectorAll('.stat-number');

    statNumbers.forEach(function (element) {
        const finalNumber = parseInt(element.getAttribute('data-count'));
        const duration = 2000; // 2 seconds
        const increment = finalNumber / (duration / 16); // 60fps
        let currentNumber = 0;

        const timer = setInterval(function () {
            currentNumber += increment;
            if (currentNumber >= finalNumber) {
                element.textContent = finalNumber;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(currentNumber);
            }
        }, 16);

        // Add animation class
        element.style.animation = 'countUp 0.6s ease-out';
    });
}

// Stagger the animation of stat cards
function staggerCardAnimations() {
    const cards = document.querySelectorAll('.enhanced-stat-card');
    cards.forEach(function (card, index) {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';

        setTimeout(function () {
            card.style.transition = 'all 0.6s ease-out';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
}

// Animate action cards
function animateActionCards() {
    const actionCards = document.querySelectorAll('.action-card');
    actionCards.forEach(function (card, index) {
        card.style.opacity = '0';
        card.style.transform = 'translateX(-30px)';

        setTimeout(function () {
            card.style.transition = 'all 0.6s ease-out';
            card.style.opacity = '1';
            card.style.transform = 'translateX(0)';
        }, 1000 + (index * 150));
    });
}

// Add enhanced hover effects to stat cards
function addStatCardInteractions() {
    const statCards = document.querySelectorAll('.enhanced-stat-card');
    statCards.forEach(function (card) {
        card.addEventListener('mouseenter', function () {
            const icon = card.querySelector('.stat-icon');
            const progressBar = card.querySelector('.stat-progress-bar');
            const number = card.querySelector('.stat-number');

            if (icon) {
                icon.style.transform = 'scale(1.15) rotate(10deg)';
            }
            if (progressBar) {
                progressBar.style.width = '85%';
            }
            if (number) {
                number.style.transform = 'scale(1.05)';
            }
        });

        card.addEventListener('mouseleave', function () {
            const icon = card.querySelector('.stat-icon');
            const progressBar = card.querySelector('.stat-progress-bar');
            const number = card.querySelector('.stat-number');

            if (icon) {
                icon.style.transform = 'scale(1) rotate(0deg)';
            }
            if (progressBar) {
                progressBar.style.width = '0%';
            }
            if (number) {
                number.style.transform = 'scale(1)';
            }
        });

        // Add pulse effect on click
        card.addEventListener('click', function () {
            card.style.animation = 'pulse 0.6s ease-in-out';
            setTimeout(() => {
                card.style.animation = '';
            }, 600);
        });
    });
}

// Add floating animation to cards (DISABLED - too much movement)
function addFloatingAnimation() {
    // Animation disabled per user preference
    return;
}

// Add parallax effect to trend icons (DISABLED - too much movement)
function addParallaxEffect() {
    // Parallax effect disabled per user preference
    return;
}

// Initialize all animations and effects
setTimeout(staggerCardAnimations, 300);
setTimeout(animateNumbers, 800);
setTimeout(animateActionCards, 1200);
setTimeout(addFloatingAnimation, 1500);
addStatCardInteractions();
addParallaxEffect();

// Add click ripple effect
function addRippleEffect() {
    const cards = document.querySelectorAll('.enhanced-stat-card, .action-card');
    cards.forEach(function (card) {
        card.addEventListener('click', function (e) {
            const ripple = document.createElement('span');
            const rect = card.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s ease-out;
                        pointer-events: none;
                    `;

            card.style.position = 'relative';
            card.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        });
    });
}

addRippleEffect();
});

// Add ripple animation CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(2);
            opacity: 0;
        }
    }
    `;
document.head.appendChild(style);