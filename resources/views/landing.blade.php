<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DISNAKER - Landing Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
      background: linear-gradient(180deg, #0e2a47, #183e60, #245a80);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
      color: white;
    }

    .container {
      position: relative;
      z-index: 2;
      background: rgba(255, 255, 255, 0.1);
      padding: 3rem;
      border-radius: 2rem;
      backdrop-filter: blur(12px);
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
      text-align: center;
    }

    .title {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 2rem;
    }

    .button-container {
      display: flex;
      justify-content: center;
      gap: 1.5rem;
      flex-wrap: wrap;
    }

    .button {
      background: linear-gradient(135deg, #3b82f6, #60a5fa);
      color: white;
      border: none;
      border-radius: 2rem;
      padding: 0.75rem 2rem;
      font-size: 1.125rem;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
    }

    .button:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
    }

    /* Asap */
    .smoke {
      position: absolute;
      bottom: 60px; /* titik keluar asap (knalpot) */
      left: 60px;   /* geser sesuai posisi mobil */
      width: 20px;
      height: 20px;
      background: radial-gradient(circle, rgba(200, 200, 200, 0.3), transparent);
      border-radius: 50%;
      opacity: 0.4;
      pointer-events: none;
      z-index: 0;
      animation: smokeUp 5s linear forwards;
    }

    @keyframes smokeUp {
      0% {
        transform: translate(0, 0) scale(1);
        opacity: 0.4;
      }

      100% {
        transform: translate(-30px, -200px) scale(2);
        opacity: 0;
      }
    }
  </style>
</head>

  <div class="container">
    <h1 class="title">CarZ App</h1>
    <div class="button-container">
      <button class="button" onclick="window.location.href='{{ route('login') }}'">Masuk</button>
      <button class="button" onclick="window.location.href='{{ route('register') }}'">Daftar</button>
    </div>
  </div>

  <script>
    const smokeContainer = document.getElementById('smokeContainer');

    function createSmoke() {
      const smoke = document.createElement('div');
      smoke.classList.add('smoke');

      // Random size and angle
      const size = Math.random() * 20 + 10;
      smoke.style.width = size + 'px';
      smoke.style.height = size + 'px';
      smoke.style.animationDuration = (Math.random() * 2 + 3) + 's';

      smokeContainer.appendChild(smoke);

      setTimeout(() => {
        smoke.remove();
      }, 5000);
    }

    setInterval(createSmoke, 300); // frekuensi asap
  </script>
</body>

</html>