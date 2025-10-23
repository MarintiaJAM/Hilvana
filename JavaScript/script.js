const botonesFavorito = document.querySelectorAll('.favorito');

  botonesFavorito.forEach(btn => {
    btn.addEventListener('click', () => {
      btn.classList.toggle('active');
      const icon = btn.querySelector('i');
      if (btn.classList.contains('active')) {
        icon.classList.replace('fa-regular', 'fa-solid'); // cambia a corazón lleno
      } else {
        icon.classList.replace('fa-solid', 'fa-regular'); // vuelve al vacío
      }
    });
  });



  // Mostrar el botón al hacer scroll
  window.onscroll = function() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
      btnSubir.style.display = "block";
    } else {
      btnSubir.style.display = "none";
    }
  };


  const btnSubir = document.getElementById("btnSubir");

// Mostrar el botón cuando se hace scroll
window.addEventListener("scroll", () => {
  if (document.documentElement.scrollTop > 200) {
    btnSubir.style.display = "block";
  } else {
    btnSubir.style.display = "none";
  }
});

// Al hacer clic, volver arriba con suavidad
btnSubir.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});

