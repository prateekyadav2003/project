<style>
  @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;600&display=swap');

  .banner-wrapper {
    perspective: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: ;
  }

  .ultimate-pg-banner {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 90vw;
    max-width: 800px;
    padding: 2rem 3rem;
    border-radius: 16px;
    background: linear-gradient(135deg, #4B47D9, #0c0c24);
    background-size: 200% 200%;
    animation: gradientShift 8s ease infinite;
    box-shadow: 0 0 40px rgba(75,71,217,0.3);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    transform-style: preserve-3d;
    overflow: hidden;
  }

  .ultimate-pg-banner:hover {
    cursor: pointer;
  }

  .banner-wrapper:hover .ultimate-pg-banner {
    transform: rotateX(calc((var(--mouse-y) - 50) * 0.1deg)) rotateY(calc((var(--mouse-x) - 50) * 0.1deg));
    box-shadow: calc((var(--mouse-x) - 50) * 2px) calc((var(--mouse-y) - 50) * 2px) 60px rgba(75,71,217,0.4);
  }

  .left-text {
    flex: 1;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.8s ease, transform 0.8s ease;
  }

  .left-text.visible {
    opacity: 1;
    transform: translateY(0);
  }

  .left-text h2 {
    font-size: 2rem;
    color: #ffffff;
  }

  .left-text p {
    margin: 0.8rem 0;
    font-size: 1rem;
    color: #dcdcff;
  }

  .left-text button {
    position: relative;
    overflow: hidden;
    padding: 0.6rem 1.5rem;
    background-color: #ffffff;
    color: #4B47D9;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    outline: none;
    transition: transform 1.5s ease-in-out;
    animation: pulse 3s ease-in-out infinite;
  }

  @keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  @keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.02); }
  }

  .left-text button .ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(75,71,217,0.3);
    transform: scale(0);
    animation: ripple-effect 0.6s linear;
    pointer-events: none;
  }

  @keyframes ripple-effect {
    to {
      transform: scale(4);
      opacity: 0;
    }
  }

  .right-image {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .right-image img {
    width: 260px;
    max-width: 100%;
    filter: drop-shadow(0 0 12px rgba(255,255,255,0.2));
    border-radius: 8px;
  }

  @media (max-width: 768px) {
    .ultimate-pg-banner {
      flex-direction: column;
      text-align: center;
      padding: 1.5rem;
    }

    .right-image {
      margin-top: 1rem;
    }
  }

  .star {
    position: absolute;
    width: 2px;
    height: 2px;
    background: #ffffff;
    border-radius: 50%;
    opacity: 0.7;
    animation: twinkle 2s infinite ease-in-out;
  }

  @keyframes twinkle {
    0%, 100% { opacity: 0.7; transform: scale(1); }
    50% { opacity: 0.2; transform: scale(1.5); }
  }
</style>

<div class="banner-wrapper">
  <a href="../../pgmaalik/index.html" class="ultimate-pg-banner">
    <div class="left-text">
      <h2>🎉 Rent Out Your PG Space Today!</h2>
      <p>List your PG, get seen by thousands of renters daily, and manage everything easily.</p>
      <button id="ctaBtn">Start Listing</button>
    </div>
    <div class="right-image">
      <img src="img/banner.png" alt="PG Illustration" />
    </div>
  </a>
</div>

<script>
  const banner = document.querySelector('.banner-wrapper');
  const card = document.querySelector('.ultimate-pg-banner');

  banner.addEventListener('mousemove', e => {
    const rect = banner.getBoundingClientRect();
    const xPct = ((e.clientX - rect.left) / rect.width) * 100;
    const yPct = ((e.clientY - rect.top) / rect.height) * 100;
    card.style.setProperty('--mouse-x', xPct);
    card.style.setProperty('--mouse-y', yPct);
  });

  const leftText = document.querySelector('.left-text');
  window.addEventListener('load', () => {
    setTimeout(() => leftText.classList.add('visible'), 200);
  });

  const btn = document.getElementById('ctaBtn');
  btn.addEventListener('click', function (e) {
    const rect = this.getBoundingClientRect();
    const ripple = document.createElement('span');
    ripple.classList.add('ripple');
    const size = Math.max(rect.width, rect.height);
    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
    ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
    this.appendChild(ripple);
    ripple.addEventListener('animationend', () => ripple.remove());
  });

  function addStars(count = 60) {
    const banner = document.querySelector('.ultimate-pg-banner');
    for (let i = 0; i < count; i++) {
      const star = document.createElement('div');
      star.className = 'star';
      star.style.top = Math.random() * 100 + '%';
      star.style.left = Math.random() * 100 + '%';
      star.style.animationDelay = `${Math.random() * 3}s`;
      banner.appendChild(star);
    }
  }

  addStars(80);

  function burst() {
    const colors = ['#ffffff', '#4B47D9', '#a0a0ff'];
    for (let i = 0; i < 20; i++) {
      const dot = document.createElement('div');
      dot.style.position = 'absolute';
      dot.style.width = dot.style.height = '6px';
      dot.style.background = colors[Math.floor(Math.random() * colors.length)];
      dot.style.borderRadius = '50%';
      dot.style.left = Math.random() * 100 + '%';
      dot.style.top = Math.random() * 100 + '%';
      dot.style.opacity = 1;
      dot.style.pointerEvents = 'none';
      dot.style.transition = 'transform 1s ease-out, opacity 1s ease-out';
      document.body.appendChild(dot);

      setTimeout(() => {
        dot.style.transform = `translate(${(Math.random() - 0.5) * 200}px, ${(Math.random() - 0.5) * 200}px)`;
        dot.style.opacity = 0;
      }, 50);

      setTimeout(() => dot.remove(), 1050);
    }
  }

  setInterval(burst, 3000);
</script>
