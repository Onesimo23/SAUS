<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Limite de Tentativas Excedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            color: #d9534f;
        }
        .message {
            font-size: 18px;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        #retry-button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: not-allowed;
            opacity: 0.6;
            transition: all 0.3s;
        }
        #retry-button.enabled {
            cursor: pointer;
            opacity: 1;
            background-color: #28a745;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let retryAfter = {{ $retryAfter }}; // Tempo em segundos do Laravel
            const button = document.getElementById('retry-button');
            const timer = document.getElementById('timer');

            const updateTimer = () => {
                if (retryAfter > 0) {
                    timer.textContent = `${retryAfter} segundo${retryAfter > 1 ? 's' : ''}`;
                    retryAfter--;
                } else {
                    clearInterval(interval);
                    timer.textContent = "Agora você pode tentar novamente.";
                    button.textContent = 'Voltar para a Página Inicial';
                    button.classList.add('enabled');
                    button.removeAttribute('disabled');
                    button.style.cursor = 'pointer';
                    button.addEventListener('click', () => {
                        window.location.href = '/'; // Redirecionar para a página inicial
                    });
                }
            };

            const interval = setInterval(updateTimer, 1000);
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Limite de Tentativas Excedido</h1>
        <div class="message">
            Você excedeu o limite de tentativas de login. Por favor, aguarde o tempo de espera antes de tentar novamente.
            <br>
            <hr>
            Aproveite esse tempo para tentar se lembrar da sua senha ou verificar se os dados inseridos estão corretos.
        </div>
        <div class="message">
            Tempo de espera restante: <span id="timer">{{ $retryAfter }} segundos</span>.
        </div>
        <button id="retry-button" disabled>Por favor, aguarde...</button>
    </div>
</body>
</html>
