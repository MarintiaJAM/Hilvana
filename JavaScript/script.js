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

