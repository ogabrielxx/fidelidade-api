<!DOCTYPE html>
<html lang="pt-BR" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Notificação')</title>
  <style>
    /* Reset básico */
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f8fa;
      color: #2c3e50;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      background-color: #fff;
      max-width: 600px;
      width: 90%;
      min-height: 400px;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.12);
      padding: 30px 40px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      box-sizing: border-box;
    }

    .header {
      text-align: center;
      border-bottom: 2px solid #3490dc;
      padding-bottom: 15px;
      margin-bottom: 25px;
    }

    .header h1 {
      margin: 0;
      font-weight: 700;
      font-size: 1.8rem;
      color: #3490dc;
      letter-spacing: 1px;
    }

    .content {
      text-align: center;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      gap: 10px;
    }

    .content h3 {
      font-size: 1.4rem;
      margin: 0;
      font-weight: 700;
      color: #1c2833;
    }

    .content h5 {
      font-weight: 400;
      font-size: 1rem;
      color: #555f66;
      margin: 0;
    }

    .footer {
      text-align: center;
      font-size: 0.85rem;
      color: #999999;
      border-top: 1px solid #e1e4e8;
      padding-top: 12px;
      margin-top: 30px;
    }

    a.button {
      display: inline-block;
      margin: 20px auto 0;
      padding: 12px 28px;
      background-color: #3490dc;
      color: #fff;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 700;
      transition: background-color 0.3s ease;
    }

    a.button:hover {
      background-color: #2779bd;
    }

    @media (max-width: 640px) {
      .container {
        padding: 25px 20px;
      }
      .header h1 {
        font-size: 1.5rem;
      }
      .content h3 {
        font-size: 1.2rem;
      }
      .content h5 {
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>
  <div class="container" role="main" aria-labelledby="email-title">
    <header class="header">
      <h1 id="email-title">Você comprou e pontuou!</h1>
    </header>
    <section class="content" aria-describedby="email-message">
      <h3><strong>Seu saldo é de {{ $pontos }} pontos!</strong></h3>
      <h5 id="email-message">Parabéns, com essa pontuação já é possível resgatar o prêmio máximo, venha até nossa loja para saber mais!</h5>
    </section>
    <footer class="footer">
      <p>© {{ date('Y') }} Restaurante tatata - Todos os direitos reservados.</p>
    </footer>
  </div>
</body>
</html>
