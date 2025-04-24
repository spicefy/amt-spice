document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.counter');
    const speed = 200; // The lower the faster
    
    counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;
        const increment = target / speed;
        
        if (count < target) {
            counter.innerText = Math.ceil(count + increment);
            setTimeout(updateCounter, 1, counter, target, speed);
        } else {
            counter.innerText = target.toLocaleString();
        }
    });
    
    function updateCounter(counter, target, speed) {
        const count = +counter.innerText;
        const increment = target / speed;
        
        if (count < target) {
            counter.innerText = Math.ceil(count + increment);
            setTimeout(updateCounter, 1, counter, target, speed);
        } else {
            counter.innerText = target.toLocaleString();
        }
    }
});