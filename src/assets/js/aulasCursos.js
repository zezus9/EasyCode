const btn = document.querySelectorAll(".submit")
const changeQTDE = document.querySelectorAll(".changeQTDE")
const nomeCurso = document.querySelector('#submitNC')

if (nomeCurso !== null) {
    nomeCurso.addEventListener("click", function(e) {
        if (document.querySelector('#selectNC').value == 'none') {
            e.preventDefault()
        }
    })
} else if (btn.length !== 0) {
    const fases = document.querySelector('#fases').value
    let faseAtual = document.querySelector('#faseA')
    let materialVa = document.querySelectorAll('.materialVa')
    let videoVa = document.querySelectorAll('.videoVa')
    let allQuestoesVa = document.querySelectorAll('.questaoVa')
    let questaoAlt = document.querySelectorAll('.questaoAlt')
    let questaoMes = document.querySelectorAll('.questaoMes')
    let questaoBot = document.querySelectorAll('.questaoBot')

    for (let i = 0; i < btn.length; i++) {
        btn[i].addEventListener("click", function(e) {
            let selects = document.querySelectorAll('.selects')
            let escolhaA = document.querySelector('#opcaoMVQ').value
            let escolhaQ = document.querySelector('#opcaoAMB').value
    
            opcaoE(escolhaA,escolhaQ)
    
            let Ncontinuar = true
            for (let i = 0; i < selects.length; i++) {
                if (selects[i].value == 'none') {
                    Ncontinuar = false
                }
            }
    
            if (faseAtual.value < fases) {
                if (valid(escolhaA,escolhaQ)) {
                    faseAtual.value = parseInt(faseAtual.value) + 1
                } else {
                    e.preventDefault()
                }
            } else if (!Ncontinuar || !valid(escolhaA,escolhaQ)) {
                e.preventDefault()
            } else if (faseAtual.value == fases) {
                document.querySelector('#formAulas').action = 'Auxiliares/ministrandoCurso.php'
            }
    
        })
    }
    
    for (let i = 0; i < changeQTDE.length; i++) {
        changeQTDE[i].addEventListener("click", function(e) {
            required(allQuestoesVa,false)
    
            let escolhaQ = document.querySelector('#opcaoAMB').value
            if (escolhaQ == 'alternativa') {
                if (document.querySelector('#qtdeOpcoesA').value == '') {
                    e.preventDefault()
                }
            } else if (escolhaQ == 'Mescolha') {
                if (document.querySelector('#qtdeOpcoesM').value == '') {
                    e.preventDefault()
                }
            } else if (escolhaQ == 'botao') {
                if (document.querySelector('#qtdeOpcoesB').value == '') {
                    e.preventDefault()
                }
            }
        })
    }
    
    function opcaoE(inclusao,escolhaQ) {
    
        if (inclusao == 'material') {
            required(materialVa,true)
            required(videoVa,false)
            required(allQuestoesVa,false)
            document.querySelector('#tipoNone').removeAttribute("value")
        } else if (inclusao == 'video') {
            required(materialVa,false)
            required(videoVa,true)
            required(allQuestoesVa,false)
            document.querySelector('#tipoNone').removeAttribute("value")
        } else if (inclusao == 'questao') {
            required(materialVa,false)
            required(videoVa,false)
            opcaoQ(escolhaQ)
            document.querySelector('#tipoNone').value = 'none'
        }
    }
    
    function opcaoQ(inclusao) {
    
        if (inclusao == 'alternativa') {
            required(questaoAlt,true)
            required(questaoMes,false)
            required(questaoBot,false)
        } else if (inclusao == 'Mescolha') {
            required(questaoAlt,false)
            required(questaoMes,true)
            required(questaoBot,false)
        } else if (inclusao == 'botao') {
            required(questaoAlt,false)
            required(questaoMes,false)
            required(questaoBot,true)
        }
    }
    
    function required(input,required) {
    
        for (let i = 0; i < input.length; i++) {
            if (required) {
                input[i].required = 'true'
            } else {
                input[i].removeAttribute("required")
            }
        }
    }
    
    function valid(escolhaA,escolhaQ) {
    
        if (escolhaA == 'material') {
            let valided = true
            for (let i = 0; i < materialVa.length; i++) {if (!validating(materialVa[i])) {valided = false}}
    
            return valided
        } else if (escolhaA == 'video') {
            let valided = true
            for (let i = 0; i < videoVa.length; i++) {if (!validating(videoVa[i])) {valided = false}}
    
            return valided
        } else {
            if (escolhaQ == 'alternativa') {
                let valided = true
                for (let i = 0; i < questaoAlt.length; i++) {if (!validating(questaoAlt[i])) {valided = false}}
                
                return valided
            } else if (escolhaQ == 'Mescolha') {
                let valided = true
                let checkboxs = document.querySelectorAll('.questaoC')
                let checked = false
    
                for (let i = 0; i < questaoMes.length; i++) {if (!validating(questaoMes[i])) {valided = false}}
                for (let i = 0; i < checkboxs.length; i++)  {
                    if (checkboxs[i].checked) {
                        checked = true
                    }
                }
                return valided && checked
            } else if (escolhaQ == 'botao') {
                let valided = true
                for (let i = 0; i < questaoBot.length; i++) {if (!validating(questaoBot[i])) {valided = false}}
                
                return valided
            }
        }
    }
    
    function validating(value) {
        return value.validity.valid
    }
    
    function resetQuestao() {
        if (document.querySelector('#opcaoMVQ').value == 'questao') {
            document.querySelector('#opcaoAMB').options.selectedIndex = 0
        }
    }
}