if (document.querySelector('.checkbox') !== null) {
    let checks = document.querySelectorAll('.check')
    document.querySelector('.submit').addEventListener('click',function(e) {
        let pass = false
        for (let i = 0; i < checks.length; i++) {
            if (checks[i].checked) {
                pass = true
            }
        }

        if (!pass) {
            e.preventDefault()
        }
    })
} else if (document.querySelector('.QuestaoB') !== null) {
    let botoes = document.querySelectorAll('.botoes')
    let espaco = document.querySelector('#espaco')
    let array  = Array()
    for (let i = 0; i < botoes.length; i++) {
        botoes[i].addEventListener('click',function(e) {
            e.preventDefault()
            let spanNew = document.createElement('span')

            if (espaco.innerHTML == 'Aqui vai a resposta') {
                espaco.innerHTML = ''
            }
            spanNew.textContent = `${botoes[i].innerHTML.trim()} `
            spanNew.classList.add('bg-color','p-2','m-2','spanNew')
            spanNew.style.cursor = 'pointer'
            espaco.parentElement.classList.add('h-auto')
            espaco.parentElement.appendChild(spanNew)
            botoes[i].hidden = 'true'
            
            array.push(i+1)
            spanNew.addEventListener('click',function(e) {
                spanNew.remove()
                botoes[i].removeAttribute("hidden")
                array.splice(array.indexOf(i+1),1)
                if (espaco.parentElement.children.length == 1) {
                    espaco.parentElement.classList.remove('h-auto')
                }
            })
            document.querySelector('#array').value = array.join(',')
        })
    }
    document.querySelector('.submit').addEventListener('click',function(e) {
        let pass = false
        if (espaco.innerHTML != 'Aqui vai a resposta') {
            pass = true
        }
        
        if (!pass) {
            e.preventDefault()
        }
    })
}