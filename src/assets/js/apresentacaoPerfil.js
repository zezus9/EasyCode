function opcoes(escolha){
    let secoes = document.querySelectorAll('.secao')
    for (let i = 0; i < secoes.length; i++) {
        secoes[i].style.display = 'none'
    }
    let secao = document.getElementById(escolha)
    secao.style.display = 'block'
}