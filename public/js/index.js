(function () {
  window.addEventListener("scroll", detachmentMenu);

  const menu = document.querySelector("ul");
  const links = menu.querySelectorAll("li a");

  function detachmentMenu() {
    let positions = [...links].map((link) => {
      let href = link.getAttribute("href");

      let h2 = document.querySelector(href);
      return h2.getBoundingClientRect().top;
    });

    let linkAtivo = pegaUltimoElementoVisto(positions);
    let menuActived = menu.querySelector(".actived");
    if (menuActived) {
      menuActived.classList.remove("actived");
    }
    if (linkAtivo) {
      linkAtivo.classList.add("actived");
    }
  }

  function pegaUltimoElementoVisto(_positions) {
    let positions = _positions.filter((n) => n < 100);
    return links[positions.length - 1];
  }

  detachmentMenu();
})();

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
