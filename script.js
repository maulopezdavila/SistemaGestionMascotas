document.addEventListener("DOMContentLoaded", () => {
    
  // Buscar todos los h2 que serán clickeables
  const headers = document.querySelectorAll("h2")

  headers.forEach((header) => {
    // Detecta si depués de los h2 hay un panel
    const nextElement = header.nextElementSibling

    if (nextElement && nextElement.classList.contains("panel-content")) {

        //Si tiene lo hago clickeable
      header.addEventListener("click", function () {
        const panel = this.nextElementSibling

        // Alternar visibilidad
        if (panel.classList.contains("active")) { //Si está abierto lo cierro

          panel.classList.remove("active")
          this.style.background = "#ecf0f1"

        } else { // Si está cerrado lo abro

          panel.classList.add("active")
          this.style.background = "#d5dbdb"

        }

      })
    }

  })

  // Mostrar el primer panel por defecto
  const firstPanel = document.querySelector(".panel-content")

  if (firstPanel) {
    firstPanel.classList.add("active")
    firstPanel.previousElementSibling.style.background = "#d5dbdb"
  }
  
})
