function valorEmReais() {
    var input = document.getElementById('valor');
    var valor = input.value.replace(/\D/g, ''); // Remove tudo que não for número

    // Divide por 100 para colocar as casas decimais
    var valorFormatado = (valor / 100).toLocaleString('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });

    // Adiciona o símbolo R$ na frente
    input.value = 'R$ ' + valorFormatado;
}