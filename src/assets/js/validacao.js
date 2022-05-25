// *A partir do data-type do input chama uma função para o custom error tipo de dado
const validadores = {
    dataNascimento:input => validarDataNascimento(input),
    cpf:input => validarCPF(input),
    celular:input => validarCel(input)
}

// *Essa é a função chamada no app.js, recebe o input como parametro
export function validar(input) {

    const tipoInput = input.dataset.tipo

    // ?Testa se o input tem um dos data-type que tem customError
    if (validadores[tipoInput]) {
        validadores[tipoInput](input)
    }

    // ?Se o valid for false significa que há um erro e o formulario é lockado
    if (input.validity.valid) {
        input.parentElement.classList.remove('input-container--invalido')
        input.parentElement.querySelector('.input-mensagem-erro').innerHTML = ''
    }
    else {
        input.parentElement.classList.add('input-container--invalido')
        input.parentElement.querySelector('.input-mensagem-erro').innerHTML = mostrarErro(tipoInput,input)
    }
}

// *Objeto que guarda todos os tipos de erro baseados no data-type do input
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
    senhaEnt: {
        valueMissing: 'A senha não pode estar vazio',
        patternMismatch: 'A senha deve conter entre 6 a 12 caracteres, deve conter pelo menos uma letra maiúscula e minuscula, um número e não deve conter símbolos ou barras'
    },
    senhaCad: {
        valueMissing: 'A senha não pode estar vazio',
        patternMismatch: 'A senha deve conter entre 6 a 12 caracteres, deve conter pelo menos uma letra maiúscula e minuscula, um número e não deve conter símbolos ou barras'
    },
    dataNascimento: {
        valueMissing: 'A data de nasc não pode estar vazio',
        customError: 'A data não é válida',
        tooShort: 'Favor fornecer data de nascimento completa'
    },
    cpf: {
        valueMissing: 'O CPF não pode estar vazio',
        customError: 'O CPF digitado não é valido'
    },
    celular: {
        valueMissing: 'O celular não pode estar vazio',
        customError: 'Favor informar um número de celular'
    }
}
// ?valueMissing : Campo vazio
// ?typeMismatch : Tipo do input não obedecido
// ?CustomErro : Erro customizado
// ?patternMismatch : A regra de preenchimento do input não foi obedecida


// *Array com erros em string
const tiposErro = [
    'customError',
    'typeMismatch',
    'patternMismatch',
    'tooShort',
    'valueMissing'
]

// *Função que valida se há algum erro no input e caso sim configura a mensagem que aparecerá no input
function mostrarErro(tipoInput,input) {

    let mensagem = ''
    
    // ?Verifica se há um erro no validity que está no array com erros
    tiposErro.forEach(erro => {
        if (input.validity[erro]) {
            mensagem = mensagensErros[tipoInput][erro]
        }
    })
    return mensagem
}

// *Verifica se o texto enviado é uma data
function validarDataNascimento(input) {

    let mensagem = ''
    let data = new Date(input.value.split('/').reverse())

    // ?Chama uma função para verificar a idade do usuário
    if (!maior6(data)) {
        mensagem = 'Você deve ter mais de 10 anos'
    }
    
    input.setCustomValidity(mensagem)
}

// *Função que verifica se o usuário é maior de 6 anos
function maior6(data) {

    const dataAtual = new Date()
    const dataMais6 = new Date(data.getUTCFullYear() + 6, data.getUTCMonth(), data.getUTCDate())
    return dataAtual > dataMais6
}

// *Função que controla a validação do CPF
function validarCPF(input) {

    // ?Retira tudo que não é número do CPF
    const cpfFormat = input.value.replace(/\D/g,'')

    let mensagem = ''

    // ?Checa a veracidade do CPF
    if (!checaCPFRepetido(cpfFormat) || !checarEstruturaCPF(cpfFormat)) {
        mensagem = 'O CPF digitado não é valido'
    }

    input.setCustomValidity(mensagem)
}

// *Função para testar se o CPF faz parte da lista de CPF repetidas
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

    // ?Efetivamente testa cada CPF repetida com o CPF enviado
    valores.forEach(valor => {
        if (valor == cpf) {
            cpfValido = false
        }
    })
    return cpfValido
}

// *Define o valor do multiplicado e chama a função que testa o CPF 
function checarEstruturaCPF(cpf) {

    const multiplicador = 10
    return checarDigitoVerificador(cpf,multiplicador)
}

// *Função que testa se o CPF é valido
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

// *Função que realiza o ultimo teste para o CPF
function confirmarDigito(soma) {
    return 11 - (soma % 11) != 10 ? 11 - (soma % 11) : 0;
}

// *Função que valida o celular enviado
function validarCel(input) {

    let mensagem = ''
    let celular = converterCell(input.value)
    let tamanho = celular.length
    
    // ?Chama uma função para checar o tamanho do celular
    if (!checarTamanhoCel(tamanho)) {
        mensagem = 'Favor informar um número de celular'
    }

    input.setCustomValidity(mensagem)
}

// *Função que retorna apenas o número de celular do usuário
function converterCell(input) {

    let novoCampo = input.replace('+55 ','').replace('-',' ')
    return novoCampo
}

// *Função que checa se o tamanho do celualar é valido
function checarTamanhoCel(tamanho) {

    if (tamanho === 15) {
        return true
    }
    return false
}