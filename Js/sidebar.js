document.addEventListener("DOMContentLoaded", function() {
    const menuButtons = document.querySelectorAll(".menu-btn");
    let openSubmenus = []; // Array para rastrear los submenús abiertos

    menuButtons.forEach(button => {
        button.addEventListener("click", function() {
            const submenu = this.nextElementSibling;

            // Si el submenu está visible, lo oculta y lo elimina de la lista
            if (submenu.style.display === "block") {
                submenu.style.display = "none";
                this.classList.remove("active");
                openSubmenus = openSubmenus.filter(item => item !== submenu);
            } else {
                // Mostrar el submenu
                submenu.style.display = "block";
                this.classList.add("active");
                openSubmenus.push(submenu);

                // Si hay más de 3 submenús abiertos, cerrar el más antiguo
                if (openSubmenus.length > 3) {
                    const oldestSubmenu = openSubmenus.shift(); // Eliminar y cerrar el más antiguo
                    oldestSubmenu.style.display = "none";
                    
                    // Encontrar el botón correspondiente al submenú que se cerró
                    const oldestButton = Array.from(menuButtons).find(btn => btn.nextElementSibling === oldestSubmenu);
                    if (oldestButton) {
                        oldestButton.classList.remove("active"); // Remover la clase active del botón
                    }
                }
            }
        });
    });
});
