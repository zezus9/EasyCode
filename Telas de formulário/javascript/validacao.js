const validadores = {
    // dataNascimento:input => validarDataNascimento(input),
    cpf:input => validarCPF(input),
    celular:input => validarCel(input)
}

export function validar(input) {
    const tipoInput = input.dataset.tipo

    if (validadores[tipoInput]) {
        validadores[tipoInput](input)
    }
    if (input.validity.valid) {
        input.parentElement.classList.remove('input-container--invalido')

        input.parentElement.querySelector('.input-mensagem-erro').innerHTML = ''
    }
    else {
        input.parentElement.classList.add('input-container--invalido')

        input.parentElement.querySelector('.input-mensagem-erro').innerHTML = mostrarErro(tipoInput,input)
    }
}

const mensagensErros = {
    emailMatricula: {
        valueMissing: 'O campo de email ou usuário não pode estar vazio'
    },
    nome: {
        valueMissing: 'O nome não pode estar vazio'
    },
    email: {
        valueMissing: 'O email não pode estar vazio',
        typeMismatch: 'O email digitado não é valido'
    },
    senha: {
        valueMissing: 'A senha não pode estar vazio',
        patternMismatch: 'A senha deve conter entre 6 a 12 caracteres, deve conter pelo menos uma letra maiúscula e minuscula, um número e não deve conter símbolos'
    },
    dataNascimento: {
        valueMissing: 'A data de nasc não pode estar vazio'
    },
    cpf: {
        valueMissing: 'O CPF não pode estar vazio',
        customError: 'O CPF digitado não é valido'
    },
    celular: {
        valueMissing: 'O celular não pode estar vazio',
        customError: 'Você deve digitar 11 ou 12 caracteres no campo celular'
    }
}

const tiposErro = [
    'customError',
    'typeMismatch',
    'patternMismatch',
    'tooShort',
    'valueMissing'
]

function mostrarErro(tipoInput,input) {
    let mensagem = ''
    tiposErro.forEach(erro => {
        if (input.validity[erro]) {
            mensagem = mensagensErros[tipoInput][erro]
        }
    })
    return mensagem
}

// function validarDataNascimento(input) {
//     const dataRecebida = new Date(input.value)
//     let mensagem = ''

//     input.setCustomValidity(mensagem)
// }

function validarCPF(input) {
    const cpfFormat = input.value.replace(/\D/g,'')
    let mensagem = ''

    if (!checaCPFRepetido(cpfFormat) || !checarEstruturaCPF(cpfFormat)) {
        mensagem = 'O CPF digitado não é valido'
    }

    input.setCustomValidity(mensagem)
}

function checaCPFRepetido(cpf) {
    const valores = [
        '00000000000',
        '11111111111',
        '22222222222',
        '33333333333',
        '44444444444',
        '55555555555',
        '66666666666',
        '77777777777',
        '88888888888',
        '99999999999'
    ]
    let cpfValido = true

    valores.forEach(valor => {
        if (valor == cpf) {
            cpfValido = false
        }
    })
    return cpfValido
}

function checarEstruturaCPF(cpf) {
    const multiplicador = 10

    return checarDigitoVerificador(cpf,multiplicador)
}

function checarDigitoVerificador(cpf,multiplicador) {
    if (multiplicador >= 12) {
        return true 
    }

    let multiplicadorInicial = multiplicador
    let soma = 0
    const cpfSemDigitos = cpf.substr(0,multiplicador-1).split('')
    const digitoVerificador = cpf.charAt(multiplicador-1)

    for (let c = 0; multiplicadorInicial > 1; multiplicadorInicial--) {
        soma = soma + cpfSemDigitos[c] * multiplicadorInicial
        c++
    }

    if (digitoVerificador == confirmarDigito(soma)) {
        return checarDigitoVerificador(cpf,multiplicador+1)
    }
    
    return false
}

function confirmarDigito(soma) {
    return 11 - (soma % 11)
}

function validarCel(input) {
    let mensagem = ''
    let tamanho = input.value.length

    if (!checarTamannhoCel(tamanho,input)) {
        mensagem = 'Você deve digitar 11 ou 12 caracteres no campo celular'
    }

    input.setCustomValidity(mensagem)
}

function checarTamannhoCel(tamanho,input) {
    if (tamanho == 11 || tamanho == 12) {
        if (input.value.length === 11) {
            input.value = '0' + input.value
        }
        return true
    }
    return false

}