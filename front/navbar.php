<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="../assets/css/navbar.css">
</head>

<nav>
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <i class="fas fa-bars" id="btn"></i>
                <div class="logo_name">Sistema de Estoque</div>
            </div>
        </div>
        <ul>
            <li><a href="homeadmEV.php"><i class="fas fa-home"></i><span class="links_name">Início</span></a></li>
            <li><a href="cadastro_estoque.php"><i class="fas fa-box"></i><span class="links_name">Cadastro de Estoque</span></a></li>
            <li><a href="consulta_deposito.php"><i class="fas fa-search"></i><span class="links_name">Consulta de Estoque</span></a></li>
            <li><a href="painel-adm.php"><i class="fas fa-file-invoice"></i><span class="links_name">Painel de Adm</span></a></li>
            <li><a href="perfil.php"><i class="fas fa-user"></i><span class="links_name">Usuário: Eduardo</span></a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i><span class="links_name">Sair</span></a></li>
        </ul>
    </div>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let btn = document.querySelector("#btn");

        btn.onclick = function() {
            sidebar.classList.toggle("active");
        }
    </script>
</nav>

</html>