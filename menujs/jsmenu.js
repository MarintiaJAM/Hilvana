  //menu despegable
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const sideMenu = document.getElementById('sideMenu');
    const overlay = document.getElementById('overlay');

    function toggleSideMenu() {
        const isOpen = sideMenu.style.left === '0px';

        if (isOpen) {
            sideMenu.style.left = '-350px';
            overlay.style.display = 'none';
            document.body.classList.remove('menu-open');
        } else {
            sideMenu.style.left = '0px';
            overlay.style.display = 'block';
            document.body.classList.add('menu-open');
        }
    }

    hamburgerBtn.addEventListener('click', toggleSideMenu);
  const btnSubir = document.getElementById("btnSubir");