// *Importa a função validar de validacao.js
import { validar } from "./validacao.js";

// *Recebe todos inputs
const input = document.querySelectorAll('.input')

// *Ativa um eventListener para cada input que aconetcerá cada vez que um input for "deselecionado"
input.forEach(input => {
    input.addEventListener('blur', evento => {
        validar(evento.target)
    })
})