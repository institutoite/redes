(function(){
  const header = document.querySelector('.site-header[data-header]');
  if(!header) return;

  let lastY = window.scrollY;
  const onScroll = () => {
    const y = window.scrollY;
    if(y > 24){
      header.classList.add('is-sticky');
    } else {
      header.classList.remove('is-sticky');
    }
    lastY = y;
  };

  // Mejora de accesibilidad: saltar a productos con tecla 'p'
  const onKey = (e) => {
    if(e.key.toLowerCase() === 'p'){
      const products = document.querySelector('#productos');
      if(products){
        products.scrollIntoView({behavior:'smooth'});
      }
    }
  };

  // Rotación de frases poderosas
  const quotesEl = document.querySelector('[data-quotes]');
  const quotesBgEl = document.querySelector('[data-quotes-bg]');
  const quotes = [
    '"La educación es el arma más poderosa para cambiar el mundo." — Nelson Mandela',
    '"La educación no cambia el mundo; la cambia la gente educada." — Paulo Freire',
    '"La enseñanza que deja huella no es la que se hace de cabeza a cabeza, sino de corazón a corazón." — Howard G. Hendricks',
    '"Aprender es la única cosa que la mente nunca se cansa, nunca teme y nunca se arrepiente." — Leonardo da Vinci',
    '"La educación es el pasaporte al futuro, porque el mañana pertenece a quienes se preparan para él hoy." — Malcolm X'
  ];
  // Fondo rotativo (opcional). Si no hay imágenes, se mostrará solo el gradiente
  const defaultBg = ''; // deja vacío si no tienes imágenes por defecto en /images
  const quoteBackgrounds = [
    defaultBg,
    '/images/-2.jpg',
    '/images/education-3.jpg',
  ];
  // Índice de la cita actual (-1 para forzar cambio inmediato al primer step)
  let qi = -1;
  // Utilidades de fade
  const applyFade = (el, nextText) => {
    if(!el) return;
    el.classList.remove('fade-enter','fade-enter-active');
    el.classList.add('fade-exit');
    requestAnimationFrame(() => {
      el.classList.add('fade-exit-active');
      setTimeout(() => {
        if(typeof nextText === 'string') el.textContent = nextText;
        el.classList.remove('fade-exit','fade-exit-active');
        el.classList.add('fade-enter');
        requestAnimationFrame(() => {
          el.classList.add('fade-enter-active');
        });
      }, 300);
    });
  };

  // Utilidad: pre-cargar imagen y aplicar fondo de forma segura
  const setBg = (el, url) => { el.style.backgroundImage = url ? `url(${url})` : ''; };
  const preloadBg = (url, onok, onfail) => {
    if(!url){ onfail && onfail(); return; }
    const tester = new Image();
    tester.onload = () => onok && onok();
    tester.onerror = () => onfail && onfail();
    tester.src = url;
  };

  const applyFadeBg = (el, nextBg) => {
    if(!el) return;
    el.classList.remove('fade-enter','fade-enter-active');
    el.classList.add('fade-exit');
    requestAnimationFrame(() => {
      el.classList.add('fade-exit-active');
      setTimeout(() => {
        const url = nextBg || defaultBg || '';
        preloadBg(url,
          () => {
            setBg(el, url);
            el.classList.remove('fade-exit','fade-exit-active');
            el.classList.add('fade-enter');
            requestAnimationFrame(() => el.classList.add('fade-enter-active'));
          },
          () => {
            setBg(el, '');
            el.classList.remove('fade-exit','fade-exit-active');
            el.classList.add('fade-enter');
            requestAnimationFrame(() => el.classList.add('fade-enter-active'));
          }
        );
      }, 300);
    });
  };

  let intervalId = null;
  const step = () => {
    if(!quotesEl || quotes.length === 0) return;
    qi = (qi + 1) % quotes.length;
    const nextQuote = quotes[qi];
    const nextBg = quoteBackgrounds[qi % quoteBackgrounds.length] || defaultBg;
    applyFade(quotesEl, nextQuote);
    applyFadeBg(quotesBgEl, nextBg);
  };

  // Inicializar contenido y fade enter
  if(quotesEl){
    quotesEl.classList.add('fade-enter','fade-enter-active');
  }
  if(quotesBgEl){
    const initUrl = quoteBackgrounds[0] || defaultBg || '';
    preloadBg(initUrl,
      () => setBg(quotesBgEl, initUrl),
      () => setBg(quotesBgEl, '')
    );
    quotesBgEl.classList.add('fade-enter','fade-enter-active');
  }

  // Arranque del auto-rotate
  const start = () => {
    if(!intervalId && quotesEl){
      intervalId = setInterval(step, 5000);
    }
  };
  const stop = () => { if(intervalId) { clearInterval(intervalId); intervalId = null; } };
  // Iniciar rotación y lanzar el primer cambio rápido
  start();
  setTimeout(() => { step(); }, 1500);

  // Rotación siempre activa sin controles

  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('keydown', onKey);

  // Primer cálculo
  onScroll();
})();
