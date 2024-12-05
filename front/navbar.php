<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
body {
  font-family: "Poppins", sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  overflow-x: hidden;
}

.sidebar {
  position: fixed;
  left: 0;
  top: 0;
  width: 60px; /* Reduzindo a largura padrão */
  height: 100%;
  background: #ffffff;
  padding: 5px 10px; /* Reduzindo o padding */
  transition: all 0.5s ease;
  display: flex;
  flex-direction: column;
  align-items: flex-start; /* Alinhando mais próximo da borda */
  overflow: hidden;
}

.sidebar.active {
  width: 200px; /* Largura ajustada ao expandir */
}

.sidebar .logo_content {
  display: flex;
  align-items: center;
  justify-content: flex-start; /* Alinhando ao canto esquerdo */
  position: relative;
  width: 100%;
}

.sidebar .logo_content .logo {
  display: flex;
  align-items: center;
  justify-content: flex-start; /* Ícone fixo no canto */
  transition: 0.3s ease;
}

.sidebar .logo_content .logo i {
  font-size: 18px; /* Diminuindo o tamanho do ícone */
}

.sidebar .logo_content .logo_name {
  font-size: 14px; /* Reduzindo o tamanho da fonte */
  font-weight: 600;
  opacity: 0;
  transition: 0.5s ease;
  white-space: nowrap;
  display: inline-block;
}

.sidebar.active .logo_content .logo_name {
  opacity: 1;
}

@media (max-width: 768px) {
  .sidebar.active .logo_content .logo_name {
    display: none; /* Esconde o nome em telas pequenas */
  }

  .sidebar .logo_content .logo i {
    margin-right: 0;
  }
}

.sidebar #btn {
  position: relative;
  color: #202f49;
  font-size: 18px; /* Reduzindo o tamanho do botão */
  height: 40px;
  width: 40px;
  text-align: center;
  line-height: 40px;
  cursor: pointer;
}

.sidebar ul {
  margin-top: 20px; /* Reduzindo o espaçamento superior */
  padding: 0;
  width: 100%;
  display: flex;
  flex-direction: column;
}

.sidebar ul li {
  position: relative;
  list-style: none;
  height: 40px; /* Reduzindo a altura dos itens */
  width: 100%;
  line-height: 40px;
}

.sidebar ul li a {
  color: #202f49;
  display: flex;
  align-items: center;
  text-decoration: none;
  border-radius: 8px; /* Ajustando o arredondamento */
  transition: all 0.4s ease;
  padding: 0 10px; /* Reduzindo o padding */
  text-align: left; /* Garantindo alinhamento à esquerda */
}

.sidebar ul li a:hover {
  background: #f1f1f1;
}

.sidebar ul li a i {
  height: 40px;
  width: 40px; /* Reduzindo o tamanho do ícone */
  text-align: center;
  font-size: 16px; /* Diminuindo o tamanho do ícone */
  line-height: 40px;
}

.sidebar ul li a .links_name {
  font-size: 14px; /* Reduzindo o tamanho do texto */
  opacity: 0;
  transition: 0.4s ease;
  white-space: nowrap;
  margin-left: 5px;
}

.sidebar.active ul li a .links_name {
  opacity: 1;
}

@media (max-width: 768px) {
  .sidebar ul li a .links_name {
    display: none;
  }
}

@media (max-width: 1024px) {
  .sidebar {
    width: 50px;
  }

  .sidebar.active {
    width: 120px;
  }

  .sidebar .logo_content .logo_name {
    font-size: 12px;
  }

  .sidebar ul li a .links_name {
    font-size: 12px;
  }
}

@media (max-width: 768px) {
  .sidebar {
    width: 40px;
  }

  .sidebar.active {
    width: 100px;
  }

  .sidebar ul li {
    height: 35px;
  }

  .sidebar ul li a i {
    font-size: 14px;
  }

  .sidebar ul li a .links_name {
    font-size: 10px;
  }
}

@media (max-width: 480px) {
  .sidebar {
    width: 30px;
  }

  .sidebar.active {
    width: 90px;
  }

  .sidebar #btn {
    font-size: 16px;
    height: 30px;
    width: 30px;
    line-height: 30px;
  }

  .sidebar ul li {
    height: 30px;
  }

  .sidebar ul li a {
    padding: 0 5px;
  }

  .sidebar ul li a i {
    font-size: 12px;
  }

  .sidebar ul li a .links_name {
    font-size: 8px;
  }
}


  
</style>
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