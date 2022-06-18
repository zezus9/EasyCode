const nomeCurso = document.querySelector('#submitNC')
const voltarNC = document.querySelector('#voltarNC')
const btn = document.querySelectorAll(".submit")
const changeQTDE = document.querySelectorAll(".changeQTDE")

if (nomeCurso !== null) {
    nomeCurso.addEventListener("click", function(e) {
        if (document.querySelector('#selectNC').value == 'none') {
            e.preventDefault()
        }
    })
} else if (voltarNC !== null) {
    voltarNC.addEventListener("click", function(e) {
        let vDefinicao = document.querySelectorAll('.vDefinicao')
        required(vDefinicao,false)
        document.querySelector('#voltarCon').value = 'voltar'
    })
} else if (btn.length !== 0) {
    var materialVa = document.querySelectorAll('.materialVa')
    var videoVa = document.querySelectorAll('.videoVa')
    var allQuestoesVa = document.querySelectorAll('.questaoVa')
    var questaoAlt = document.querySelectorAll('.questaoAlt')
    var questaoMes = document.querySelectorAll('.questaoMes')
    var questaoBot = document.querySelectorAll('.questaoBot')
    const voltarAu = document.querySelector('#voltarAu')
    let aulasComp = document.querySelector('#aulasComp')
    const fases = parseInt(document.querySelector('#fases').value)
    let faseAtual = document.querySelector('#faseA')

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
            
            if (parseInt(faseAtual.value) < fases) {
                if (valid(escolhaA,escolhaQ)) {
                    var aulas = aulasComp.value.split('.-.')[0] == '' ? Array() : aulasComp.value.split('.-.')
                    aulas.push(addAula(escolhaA,escolhaQ))
                    aulasComp.value = aulas.join('.-.')

                    faseAtual.value = parseInt(faseAtual.value) + 1
                } else {
                    e.preventDefault()
                }
            } else if (!Ncontinuar || !valid(escolhaA,escolhaQ)) {
                e.preventDefault()
            } else if (parseInt(faseAtual.value) == fases) {
                var aulas = aulasComp.value.split('.-.')[0] == '' ? Array() : aulasComp.value.split('.-.')
                aulas.push(addAula(escolhaA,escolhaQ))
                aulasComp.value = aulas.join('.-.')

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
    voltarAu.addEventListener("click", function(e) {
        required(materialVa,false)
        required(videoVa,false)
        required(allQuestoesVa,false)
        if (parseInt(faseAtual.value) == 1) {
            document.querySelector('#voltarAul').value = 'voltar'
        } else {
            faseAtual.value = parseInt(faseAtual.value) - 1
        }
    })

    function addAula(escolhaA,escolhaQ) {
        let aulaAtual = Array()

        if (escolhaA == 'material') {
            aulaAtual.push(faseAtual.value,escolhaA)
            for (let i = 0; i < materialVa.length; i++) {
                aulaAtual.push(materialVa[i].value.replace('\n','☺'))
            }
        } else if (escolhaA == 'video') {
            aulaAtual.push(faseAtual.value,escolhaA)
            for (let i = 0; i < videoVa.length; i++) {
                aulaAtual.push(videoVa[i].value.replace('\n','☺'))
            }
        } else if (escolhaQ == 'alternativa') {
            
            aulaAtual.push(faseAtual.value,escolhaA,escolhaQ)
            for (let i = 0; i < questaoAlt.length; i++) {
                if (questaoAlt[i].type != 'radio') {
                    aulaAtual.push(questaoAlt[i].value.replace('\n','☺'))
                }
            }

            let questaoRadio = document.getElementsByName('questaoR')
            let indexRadio = 0
            for (let i = 0; i < questaoRadio.length; i++) {
                if (questaoRadio[i].checked) {
                    indexRadio = questaoRadio[i].id.substr(8)
                }
            }
            aulaAtual.push(indexRadio)
        } else if (escolhaQ == 'Mescolha') {

            aulaAtual.push(faseAtual.value,escolhaA,escolhaQ)
            for (let i = 0; i < questaoMes.length; i++) {
                aulaAtual.push(questaoMes[i].value.replace('\n','☺'))
            }

            let questaoCheck = document.getElementsByName('questaoC')
            let indexCheckbox = []
            for (let i = 0; i < questaoCheck.length; i++) {
                if (questaoCheck[i].checked) {
                    indexCheckbox.push(questaoCheck[i].id.substr(8))
                }
            }
            aulaAtual.push(indexCheckbox.join(','))
        } else if (escolhaQ == 'botao') {

            aulaAtual.push(faseAtual.value,escolhaA,escolhaQ)
            for (let i = 0; i < questaoBot.length; i++) {
                aulaAtual.push(questaoBot[i].value.replace('\n','☺'))
            }

            let questaoOrdem = document.getElementsByName('ordem')
            let indexOrdem = []
            for (let i = 0; i < questaoOrdem.length; i++) {
                if (questaoOrdem[i].value != '') {
                    indexOrdem.push(`${questaoOrdem[i].id.substr(5)}:${questaoOrdem[i].value}`)
                }
            }
            aulaAtual.push(indexOrdem)
        }

        return aulaAtual.join('-.-')
    }
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
            let ordemP = document.querySelectorAll('.ordemP')
            let checked = false
            let rChecked = false
            let arrayOrdem = Array()
            let valided = true
            
            for (let i = 0; i < questaoBot.length; i++) {if (!validating(questaoBot[i])) {valided = false}}
            for (let i = 0; i < ordemP.length; i++)  {
                if (ordemP[i].value) {
                    if (arrayOrdem.includes(ordemP[i].value)) {
                        rChecked = true
                    } else {
                        arrayOrdem.push(ordemP[i].value)
                    }
                }
            }
            if (arrayOrdem.length >= 3 && !rChecked) {
                arrayOrdem.sort()
                checked = true
                for (let i = 0; i < arrayOrdem.length; i++)  {
                    if (arrayOrdem[i] != i+1) {
                        checked = false
                    }
                }
            }
            return valided && checked
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