var cpfInput = document.getElementById("cpf");

cpfInput.addEventListener("input", function () {
  var cpf = cpfInput.value.replace(/\D/g, "");

  var formattedCPF = "";
  for (var i = 0; i < cpf.length; i++) {
    if (i === 3 || i === 6) {
      formattedCPF += ".";
    } else if (i === 9) {
      formattedCPF += "-";
    }
    formattedCPF += cpf.charAt(i);
  }

  cpfInput.value = formattedCPF;
});

function process(quant) {
  var value = parseInt(document.getElementById("quant").value);
  value += quant;
  if (value < 1) {
    document.getElementById("quant").value = 1;
  } else {
    document.getElementById("quant").value = value;
  }
}

$(document).ready(() => {
  $("#pesquisar").on("submit", function (event) {
    event.preventDefault();

    const termoPesquisa = $("#buscar").val();
    if (termoPesquisa !== "") {
      $("#home").html(
        '<div id="spinner-wrapper"><div id="spinner"></div></div>'
      );

      const url = "/buscar?pesquisar=" + encodeURIComponent(termoPesquisa);
      $("#home").load(url, () => {
        $("#spinner-wrapper").remove();
      });
    }
  });
});

$(document).ready(() => {
  $("#pesquisarProduto").on("submit", function (event) {
    event.preventDefault();

    const termoPesquisa = $("#buscarProduto").val();
    if (termoPesquisa !== "") {
      $("#home").html(
        '<div id="spinner-wrapper"><div id="spinner"></div></div>'
      );

      const url =
        "/buscarProduto?pesquisar=" + encodeURIComponent(termoPesquisa);
      $("#home").load(url, () => {
        $("#spinner-wrapper").remove();
      });
    }
  });
});

// Quando o botão de compra for clicado
$(document).on("click", "#buy-button", function (e) {
  e.preventDefault(); // Evita que o link seja seguido

  // Obtenha as informações do produto do atributo data
  var nome = $(this).data("nome");
  var valor = $(this).data("valor");
  var quantidade = $(this).data("quantidade");

  // Construa a mensagem do WhatsApp com as informações do produto
  var mensagem = "Olá, estou interessado em comprar o produto:\n";
  mensagem += "Nome: " + nome + "\n";
  mensagem += "Valor: R$ " + valor + "\n";
  mensagem += "Quantidade: " + quantidade;

  // Codifique a mensagem para uso no link do WhatsApp
  var mensagemCodificada = encodeURIComponent(mensagem);

  // Redirecione o cliente para o WhatsApp com a mensagem preenchida
  window.location.href =
    "https://wa.me/seu-numero-do-whatsapp?text=" + mensagemCodificada;
});
