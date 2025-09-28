(function() {
    const toggle = document.querySelector('.menu-toggle');
    const nav = document.getElementById('primary-menu');
  
    if (!toggle || !nav) return;
  
    toggle.addEventListener('click', function () {
      const isOpen = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
  })();
  