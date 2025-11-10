
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

// Add parallax effect to trend icons (DISABLED - too much movement)
function addParallaxEffect() {
    // Parallax effect disabled per user preference
    return;
}

setTimeout(animateNumbers, 800);
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

//POPULATION
document.addEventListener('DOMContentLoaded', function() {
    var chartEl = document.getElementById('population-donut-chart');
    var male = JSON.parse(chartEl.dataset.male);
    var female = JSON.parse(chartEl.dataset.female);

    const options = {
        series: [male, female],
        chart: {
            type: 'donut',
            height: 350
        },
        labels: ['Male', 'Female'],
        legend: { position: 'right' },
        responsive: [{
            breakpoint: 480,
            options: { legend: { position: 'bottom' } }
        }],
        dataLabels: { enabled: true }
    };

    var chart = new ApexCharts(document.querySelector("#population-donut-chart"), options);
    chart.render();
});

// BLOTTER INCIDENTS PER LOCATION
document.addEventListener('DOMContentLoaded', function () {
    var chartEl = document.getElementById('blotter-report-stacked-chart');
    var locations = JSON.parse(chartEl.dataset.locations);
    var series = JSON.parse(chartEl.dataset.series);

    var options = {
        series: series,
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
            toolbar: {
                show: true
            }
        },
        xaxis: {
            categories: locations,
            title: {
                text: 'Locations'
            }
        },
        yaxis: {
            title: {
                text: 'Total Incidents'
            }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left'
        },
        fill: {
            opacity: 1
        },
    };

    var chart = new ApexCharts(document.querySelector("#blotter-report-stacked-chart"), options);
    chart.render();
});
