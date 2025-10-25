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

  // Cuando se hace clic, subir al inicio
  btnSubir.addEventListener("click", function() {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });

// Espera a que todo el contenido cargue
window.addEventListener("scroll", function() {
    const btn = document.getElementById("btnSubir");

    // Muestra el botón al bajar más de 200px
 if (window.scrollY > 80) {

        btn.style.display = "block";
    } else {
        btn.style.display = "none";
    }
});

// Acción al hacer clic
document.getElementById("btnSubir").addEventListener("click", function() {
    window.scrollTo({
        top: 0,
        behavior: "smooth" // Desplazamiento suave
    });
});
