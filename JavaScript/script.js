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



  if (typeof btnSubir !== "undefined" && btnSubir !== null) {
  window.addEventListener('scroll', () => {
    if (window.scrollY > 200) btnSubir.style.display = "block";
    else btnSubir.style.display = "none";
  });
}


  // Cuando se hace clic, subir al inicio
  btnSubir.addEventListener("click", function() {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });
  document.addEventListener('DOMContentLoaded', () => {
  // selector seguro para botones de favorito (puede devolver 0 elementos sin error)
  const botonesFavorito = document.querySelectorAll('.favorito');

  botonesFavorito.forEach(btn => {
    btn.addEventListener('click', function(e) {
      // Si el botón está dentro de un <form>, evitar el envío normal
      if (e) e.preventDefault();

      // Cambiar visual del corazón
      this.classList.toggle('active');
      const icon = this.querySelector('i');
      if (icon) {
        if (this.classList.contains('active')) {
          icon.classList.replace('fa-regular', 'fa-solid');
        } else {
          icon.classList.replace('fa-solid', 'fa-regular');
        }
      }

      // Enviar AJAX si el botón está dentro de un form
      const form = this.closest('form');
      if (form) {
        const formData = new FormData(form);
        fetch(form.action, {
          method: form.method || 'POST',
          body: formData
        })
        .then(resp => {
          // opcional: manejar respuesta (mensaje, actualizar contador, etc.)
          // console.log('OK', resp);
        })
        .catch(err => console.error('Error al guardar favorito:', err));
      }
    });
  });

  // BOTÓN "SUBIR" seguro: busca el elemento y solo luego usa addEventListener
  const btnSubir = document.getElementById('btnSubir'); // asegúrate de que exista en tu HTML con ese id
  if (btnSubir) {
    // Mostrar / ocultar según scroll
    window.addEventListener('scroll', () => {
      if (window.scrollY > 200) {
        btnSubir.style.display = 'block';
      } else {
        btnSubir.style.display = 'none';
      }
    });

    // Al hacer clic, subir suavemente
    btnSubir.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // Guardar/recuperar scroll (opcional, útil si aún usas recarga en otros formularios)
  window.addEventListener('load', () => {
    const scrollY = localStorage.getItem('scrollY');
    if (scrollY) {
      window.scrollTo(0, parseInt(scrollY, 10));
      localStorage.removeItem('scrollY');
    }
  });

  // Antes de enviar FORM (sólo si quieres guardar scroll para envíos normales)
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', () => {
      try { localStorage.setItem('scrollY', window.scrollY); } catch (e) {}
    });
  });
});
