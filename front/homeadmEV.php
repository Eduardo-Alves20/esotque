<?php
session_start();
require '../back/auth.php'; // Caminho para o arquivo auth.php
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistema de Estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>

    <?php include 'navbar.php'; ?> <!-- Aqui você inclui o menu lateral -->

    <div class="content">
        <!-- SweetAlert para exibir erro -->
        <?php
        if (isset($_GET['error']) && $_GET['error'] === 'no_permission') {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Acesso Negado',
                    text: 'Você não tem permissão para acessar essa página.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    const url = new URL(window.location);
                    url.searchParams.delete('error');
                    window.history.replaceState(null, '', url);
                });
            });
            </script>";
        }
        ?>

        <!-- Mensagem de Status -->
        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success') {
                echo "<script>alert('Material cadastrado com sucesso!');</script>";
            } elseif ($_GET['status'] == 'error') {
                $message = isset($_GET['message']) ? urldecode($_GET['message']) : 'Erro ao cadastrar material.';
                echo "<script>alert('Erro: " . htmlspecialchars($message) . "');</script>";
            }
        }
        ?>

        <!-- Seção principal -->
        <header class="bg-light text-center py-5">
            <div class="container">
                <h1 class="display-4">Bem-vindo ao Sistema de Estoque</h1>
                <p class="lead">Gerencie facilmente o seu estoque, cadastre materiais e acompanhe relatórios de desempenho.</p>
                <a href="cadastro_estoque.php" class="btn btn-primary btn-lg mt-3">Cadastrar Material</a>
                <a href="consulta_deposito.php" class="btn btn-outline-secondary btn-lg mt-3">Consultar Deposito</a>
            </div>
        </header>

        <!-- Seções adicionais -->
        <section class="container my-5">
            <div class="row text-center">
                <div class="col-md-4">
                    <h3>Cadastro Simples</h3>
                    <p>Cadastre novos materiais e acompanhe o estoque de forma intuitiva e organizada.</p>
                </div>
                <div class="col-md-4">
                    <h3>Relatórios Detalhados</h3>
                    <p>Visualize relatórios completos para monitorar o desempenho e manter o controle do estoque.</p>
                </div>
                <div class="col-md-4">
                    <h3>Facilidade de Acesso</h3>
                    <p>Acesse rapidamente as informações com uma interface limpa e funcional.</p>
                </div>
            </div>
        </section>
    </div> <!-- Fechando a div da content -->

    <!-- Rodapé -->
    <!--
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 P.E.M Tech. Todos os direitos reservados.</p>
    </footer>
    -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
