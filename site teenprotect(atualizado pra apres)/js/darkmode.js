
let darkmode = localStorage.getItem('darkmode')
const themeSwitch = document.getElementById('theme-switch')
const radios = document.querySelectorAll('input[name="tema"]')

const enableDarkmode = () => {
  document.body.classList.add('darkmode')
  localStorage.setItem('darkmode', 'active')
}

const disableDarkmode = () => {
  document.body.classList.remove('darkmode')
  localStorage.setItem('darkmode', null)

}

if(darkmode === "active") enableDarkmode()

radios.forEach(radio => {
    radio.addEventListener('change', () => {
        darkmode = localStorage.getItem('darkmode')
        if (darkmode !== "active") {
            enableDarkmode()
            
        }else{
            disableDarkmode()

        }

        localStorage.setItem('temaSelecionado', radio.value);
    })
})

const temaSalvo = localStorage.getItem('temaSelecionado')

if (temaSalvo) {
    const radioSelecionado = document.querySelector(`input[value="${temaSalvo}"]`);

    if (radioSelecionado) {
        radioSelecionado.checked = true;
    }
} else {
    let temaPadrao = document.querySelector('input[value="light"]')
    temaPadrao.checked = true;
}


