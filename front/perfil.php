<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            padding: 20px;
            text-align: center;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #ddd;
            display: inline-block;
            margin-bottom: 20px;
        }
        .user-info {
            margin-bottom: 15px;
        }
        .user-info input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        @media (max-width: 600px) {
            .container {
                width: 100%;
                margin: 10px;
            }
        }
        .save-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .save-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-pic" id="profile-pic"></div>
        <div class="user-info">
            <input type="text" id="user-name" placeholder="Nome" value="<?php echo isset($_SESSION['usuario_nome']) ? $_SESSION['usuario_nome'] : ''; ?>">
            <input type="text" id="user-sobrenome" placeholder="Sobrenome" value="<?php echo isset($_SESSION['usuario_sobrenome']) ? $_SESSION['usuario_sobrenome'] : ''; ?>">
            <input type="email" id="user-email" placeholder="Email" value="<?php echo isset($_SESSION['usuario_email']) ? $_SESSION['usuario_email'] : ''; ?>">
            <input type="password" id="user-password" placeholder="Senha" value="<?php echo isset($_SESSION['usuario_senha']) ? $_SESSION['usuario_senha'] : ''; ?>">
            <input type="text" id="user-funcao" placeholder="Função" value="<?php echo isset($_SESSION['usuario_funcao_nome']) ? $_SESSION['usuario_funcao_nome'] : ''; ?>">
        </div>
        <button class="save-btn" onclick="salvarDados()">Salvar Alterações</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Utilizando dados do PHP via sessão
            const userProfilePicUrl = "<?php echo isset($_SESSION['usuario_profile_pic']) ? $_SESSION['usuario_profile_pic'] : ''; ?>";
            
            // Aqui poderíamos também definir uma foto de perfil se existir na sessão
            if (userProfilePicUrl) {
                document.getElementById('profile-pic').style.backgroundImage = `url(${userProfilePicUrl})`;
                document.getElementById('profile-pic').style.backgroundSize = 'cover';
            }
        });

        function salvarDados() {
            const userName = document.getElementById('user-name').value;
            const userSobrenome = document.getElementById('user-sobrenome').value;
            const userEmail = document.getElementById('user-email').value;
            const userPassword = document.getElementById('user-password').value;
            const userFuncao = document.getElementById('user-funcao').value;

            // Enviar os dados atualizados para o servidor via fetch
            fetch('atualizar_usuario.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    nome: userName,
                    sobrenome: userSobrenome,
                    email: userEmail,
                    senha: userPassword,
                    funcao: userFuncao
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Dados atualizados com sucesso!');
                } else {
                    alert('Erro ao atualizar os dados.');
                }
            })
            .catch(error => {
                console.error('Erro ao salvar os dados:', error);
            });
        }
    </script>
</body>
</html>