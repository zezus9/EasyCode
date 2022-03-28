import { validar } from "./validacao.js";

const input = document.querySelectorAll('input')

input.forEach(input => {
    input.addEventListener('blur', evento => {
        validar(evento.target)
    })
})