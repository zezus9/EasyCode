function inicio(){
    let secaoI = document.querySelector('#secoes')
    if (secaoI != null) {
        opcoes(secaoI.value)
    } else {
        opcoes('home')
    }
}

function opcoes(escolha){
    let secoes = document.querySelectorAll('.secao')
    for (let i = 0; i < secoes.length; i++) {
        secoes[i].style.display = 'none'
        secoes[i].classList.remove('secaoAp')
    }
    let secao = document.getElementById('secao_'+escolha)
    secao.style.display = 'block'

    let opcoes = document.querySelectorAll('.opcoes')
    for (let i = 0; i < opcoes.length; i++) {        
        let elementPai = opcoes[i].parentElement
        elementPai.classList.remove('active')
    }
}

document.querySelectorAll(".opcoes").forEach( function(opcao) {
    opcao.addEventListener("click", function(event) {
        const el = event.target.parentElement;
        el.classList.add('active')
    });
});

$("#opcaoMVQ").on("change", function(){
    $("div.collapse.show").removeClass("show"); // esconde os visíveis
    $("#"+this.value).collapse('show'); // mostra a div relacionada ao value do option selecionado
});

$("#opcaoAMB").on("change", function () {
    $("div.collapse.AMB.show").removeClass("show");
    $("#"+this.value).collapse('show');
});