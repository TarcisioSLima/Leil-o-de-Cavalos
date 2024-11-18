$(document).ready(function() {
    $("#form_login").on("submit", function(event){
        event.preventDefault();
        $(".error-message").hide();

        // Verifica o campo de email
        let validacao = true;
        const email = $("#email").val().trim(); //.val() = pega o valor ;;; .trim() = tira os espaços do inicio e final
        const formatoEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const caracteresInvalidos = /[<>{}[\]/'"!#$%^&*()]/;

        if (email === "") {
            $("#emailError").text("O email é obrigatório.").show();
            validacao = false;
        } else if (email.length < 5) {
            $("#emailError").text("O e-mail deve ter pelo menos 5 caracteres.").show();
            validacao = false;
        } else if (caracteresInvalidos.test(email)) {
            $("#emailError").text("O e-mail contém caracteres inválidos.").show();
            validacao = false;
        } else if (!formatoEmail.test(email)) {
             $("#emailError").text("Formato de e-mail inválido.").show();
             validacao = false;         
        } 
        else {
            $("#emailError").hide();
        }
        // Verifica o campo de senha
        const senha = $("#senha").val().trim();
        if (senha === "") {
            $("#senhaError").text("A senha é obrigatória.").show();
            validacao = false;
        }
        // Envia o formulário apenas se os campos forem válidos
        if (validacao) {
            this.submit();
        }
    })
})



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
