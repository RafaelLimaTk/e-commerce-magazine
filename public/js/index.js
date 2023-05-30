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
