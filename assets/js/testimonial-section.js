(function(){
    const slider = document.querySelector('.ts-slider');
    if (!slider) return;
  
    const track = slider.querySelector('.ts-track');
    const cards = Array.from(track.children);
    if (cards.length <= 1) return;
  
    // Clone first & second for smoother loop
    track.appendChild(cards[0].cloneNode(true));
    track.appendChild(cards[1] ? cards[1].cloneNode(true) : cards[0].cloneNode(true));
  
    let index = 0;
    let animating = false;
  
    // compute one step width (card + gap)
    function stepWidth() {
      const first = track.children[index];
      if (!first) return 0;
      const style = getComputedStyle(track);
      const gap = parseFloat(style.columnGap || style.gap || 0);
      return first.getBoundingClientRect().width + gap;
    }
  
    function goNext() {
      if (animating) return;
      animating = true;
      index++;
      track.style.transition = 'transform 1.5s ease';
      track.style.transform = `translateX(-${stepWidth() * index}px)`;
  
      track.addEventListener('transitionend', function handler(){
        track.removeEventListener('transitionend', handler);
        // if near the end, jump back to original without flicker
        if (index >= track.children.length - 2) {
          index = 0;
          track.style.transition = 'none';
          track.style.transform = 'translateX(0)';
          // force reflow
          void track.offsetWidth;
        }
        animating = false;
      });
    }
  
    const interval = parseInt(slider.dataset.interval || '2000', 10);
    let timer = setInterval(goNext, Math.max(1200, interval));
  
    // pause on hover
    slider.addEventListener('mouseenter', () => clearInterval(timer));
    slider.addEventListener('mouseleave', () => { timer = setInterval(goNext, Math.max(1200, interval)); });
  })();
  