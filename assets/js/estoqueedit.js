$(document).ready(function () {
  // Abrir o modal dinâmico e carregar os dados
  window.abrirModal = function (categoria) {
    console.log("Abrindo modal para categoria:", categoria);

    // Salvar a categoria no campo oculto para reutilização
    $("#addCategoria").val(categoria);
    $("#editCategoria").val(categoria);

    let actionUrl = `../back/controller/estoqueedit.php?action=listar&categoria=${categoria}`;

    // Carregar os dados dinamicamente no modal
    $.ajax({
      url: actionUrl,
      type: "GET",
      success: function (response) {
        console.log("Resposta do servidor:", response);

        // Acessando os dados da resposta
        const data = response.data;

        // Criar o conteúdo do modal com a tabela de itens
        let conteudoModal = `
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>`;

        // Iterar pelos itens e adicioná-los à tabela
        data.forEach((item) => {
          conteudoModal += `
                        <tr>
                            <td>${item.descricao}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="abrirModalEditar(${item.id}, '${item.descricao}', '${categoria}')">Editar</button>
                                <button class="btn btn-danger btn-sm" onclick="confirmarExcluir(${item.id}, '${categoria}')">Excluir</button>
                            </td>
                        </tr>`;
        });

        conteudoModal += `</tbody></table>`;
        $("#modalContent").html(conteudoModal);

        // Exibir o modal de itens
        $("#manageModal").modal("show");
      },
      error: function () {
        Swal.fire("Erro!", "Erro ao carregar os dados.", "error");
      },
    });
  };

  // Função para abrir o modal de edição
  window.abrirModalEditar = function (id, descricao, categoria) {
    // Definir os valores nos campos do modal de edição
    $("#editId").val(id); // Salvar o ID do item
    $("#editDescricaoModal").val(descricao);
    $("#editCategoria").val(categoria);

    // Abrir o modal de edição
    $("#editModal").modal("show");
  };

  // Submeter edição de item
  $("#editForm").on("submit", function (e) {
    e.preventDefault();

    const id = $("#editId").val();
    const descricaoNova = $("#editDescricaoModal").val();
    const categoria = $("#editCategoria").val();

    $.ajax({
      url: "../back/controller/estoqueedit.php",
      type: "POST",
      data: {
        edit: true,
        id: id,
        descricaoNova: descricaoNova,
        categoria: categoria,
      },
      success: function (response) {
        try {
          response = JSON.parse(response);
        } catch (e) {
          Swal.fire("Erro!", "Resposta inesperada do servidor.", "error");
          return;
        }

        if (response.status === "success") {
          Swal.fire(
            "Atualizado!",
            "A informação foi atualizada com sucesso.",
            "success"
          );
          $("#editModal").modal("hide");
          abrirModal(categoria); // Atualizar os dados após editar
        } else {
          Swal.fire("Erro!", response.message, "error");
        }
      },
      error: function () {
        Swal.fire("Erro!", "Erro ao atualizar.", "error");
      },
    });
  });

  // Função para confirmar exclusão
  window.confirmarExcluir = function (id, categoria) {
    Swal.fire({
      title: "Tem certeza?",
      text: "Você não poderá reverter isso!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Sim, excluir!",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        excluirItem(id, categoria);
      }
    });
  };

  // Função para excluir um item
  function excluirItem(id, categoria) {
    // Fazer a requisição AJAX para o backend
    $.ajax({
      url: "../back/controller/estoqueedit.php",
      type: "POST",
      data: {
        delete: true,
        id: id,
        categoria: categoria,
      },
      success: function (response) {
        try {
          // Garantir que a resposta seja um JSON válido
          response =
            typeof response === "string" ? JSON.parse(response) : response;

          if (response.status === "success") {
            Swal.fire(
              "Excluído!",
              "O item foi excluído com sucesso.",
              "success"
            ).then(() => {
              // Fechar o modal e recarregar a lista de itens
              abrirModal(categoria);
            });
          } else {
            Swal.fire(
              "Erro!",
              response.message || "Erro desconhecido ao excluir o item.",
              "error"
            );
          }
        } catch (e) {
          console.error("Erro ao analisar resposta do servidor:", e);
          console.log("Resposta recebida:", response);
          Swal.fire("Erro!", "Resposta inesperada do servidor.", "error");
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        // Erro na requisição AJAX
        console.error("Erro AJAX:", textStatus, errorThrown);
        Swal.fire(
          "Erro!",
          "Erro ao excluir o item. Verifique sua conexão e tente novamente.",
          "error"
        );
      },
    });
  }

  // Adicionar novo item - formulário no modal
  $("#addFormModal").on("submit", function (e) {
    e.preventDefault();

    const descricao = $("#addDescricaoModal").val();
    const categoria = $("#addCategoria").val();
    console.log("Dados enviados:", { descricao, categoria });

    if (!categoria) {
      Swal.fire(
        "Erro!",
        "Categoria não definida. Por favor, selecione a categoria antes de adicionar.",
        "error"
      );
      return;
    }

    $.ajax({
      url: "../back/controller/estoqueedit.php",
      type: "POST",
      data: {
        add: true,
        descricao: descricao,
        categoria: categoria,
      },
      success: function (response) {
        // Garantir que a resposta seja um objeto JSON válido
        try {
          response =
            typeof response === "string" ? JSON.parse(response) : response;
        } catch (e) {
          Swal.fire("Erro!", "Resposta inesperada do servidor.", "error");
          return;
        }

        if (response.status === "success") {
          Swal.fire(
            "Adicionado!",
            "O item foi adicionado com sucesso.",
            "success"
          );
          $("#addModal").modal("hide");
          abrirModal(categoria); // Atualizar os dados após adicionar
        } else {
          Swal.fire("Erro!", response.message, "error");
        }
      },
      error: function () {
        Swal.fire("Erro!", "Erro ao adicionar o item.", "error");
      },
    });
  });
});