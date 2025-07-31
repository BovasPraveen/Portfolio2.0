// Optional: smooth scroll
document.querySelectorAll('nav a').forEach(a => {
  a.addEventListener('click', e => {
    e.preventDefault();
    document.querySelector(a.getAttribute('href')).scrollIntoView({
      behavior: 'smooth'
    });
  });
});

// Theme toggle example (light/dark)
const toggle = document.createElement('button');
toggle.textContent = '🌙';
toggle.classList.add('theme-toggle');
toggle.style = "position:fixed;bottom:1rem;right:1rem;";
document.body.appendChild(toggle);
toggle.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');
  toggle.textContent = document.body.classList.contains('dark-mode') ? '☀️' : '🌙';
});
// Smooth scroll for nav
document.querySelectorAll('nav a').forEach(a => {
  a.addEventListener('click', e => {
    e.preventDefault();
    document.querySelector(a.getAttribute('href')).scrollIntoView({
      behavior: 'smooth'
    });
  });
});

// Reveal sections on scroll
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
    }
  });
}, {
  threshold: 0.1
});

// Apply to all .section elements
document.querySelectorAll('.section').forEach(section => {
  observer.observe(section);
});

