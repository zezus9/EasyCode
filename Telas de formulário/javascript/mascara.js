// *Quando a página carrega essa função ativa e atribui as mascaras aos inputs
$(document).ready(function() {
    $('#nascimento').mask('00/00/0000'),
    $('#celular').mask('+55 (00) 00000-0000'),
    $('#cpf').mask('000.000.000-00')
})