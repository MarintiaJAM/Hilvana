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

  //menu despegable
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const sideMenu = document.getElementById('sideMenu');
    const overlay = document.getElementById('overlay');

    function toggleSideMenu() {
        const isOpen = sideMenu.style.left === '0px';

        if (isOpen) {
            sideMenu.style.left = '-250px';
            overlay.style.display = 'none';
            document.body.classList.remove('menu-open');
        } else {
            sideMenu.style.left = '0px';
            overlay.style.display = 'block';
            document.body.classList.add('menu-open');
        }
    }

    hamburgerBtn.addEventListener('click', toggleSideMenu);
