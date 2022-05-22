function opcoes(escolha){
    let secoes = document.querySelectorAll('.secao')
    for (let i = 0; i < secoes.length; i++) {
        secoes[i].style.display = 'none'
        if (secoes[i].classList.contains('secaoAp')) {
            secoes[i].classList.remove('secaoAp')
        }
    }
    let secao = document.getElementById('secao_'+escolha)
    secao.style.display = 'block'
}