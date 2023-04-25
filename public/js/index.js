(function () {
  window.addEventListener("scroll", detachmentMenu);

  const menu = document.querySelector("ul");
  const links = menu.querySelectorAll("li a");

  function detachmentMenu() {
    let positions = [...links].map((link) => {
      let href = link.getAttribute("href");

      let h2 = document.querySelector(href);
      console.log(h2);
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

    console.log(positions);
  }

  function pegaUltimoElementoVisto(_positions) {
    let positions = _positions.filter((n) => n < 100);
    return links[positions.length - 1];
  }

  detachmentMenu();
})();
