$(document).ready(function() {
    $("#form_login, #form_editar").on("submit", function(event){
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


    $("#form_cadastro_usuario").on("submit", function(event) {
        event.preventDefault(); // Impede o envio automático do formulário
        $(".error-message").hide(); // Esconde todas as mensagens de erro
        let validacao = true;
    
        // Validação do Nome
        const nomeUsuario = $("input[name='nome_usuario']").val().trim();
        if (nomeUsuario === "") {
            $("#nomeError").text("O nome é obrigatório.").show();
            validacao = false;
        } else if (nomeUsuario.length < 3) {
            $("#nomeError").text("O nome deve ter pelo menos 3 caracteres.").show();
            validacao = false;
        }
    
        // Validação do E-mail
        const emailUsuario = $("input[name='email_usuario']").val().trim();
        const email = $("#email").val().trim(); //.val() = pega o valor ;;; .trim() = tira os espaços do inicio e final
        const formatoEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const caracteresInvalidos = /[<>{}[\]/'"!#$%^&*()]/;
    
        if (emailUsuario === "") {
            $("#emailError").text("O e-mail é obrigatório.").show();
            validacao = false;
        }
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
    
        // Validação da Senha
        const senhaUsuario = $("input[name='senha_usuario']").val().trim();
        if (senhaUsuario === "") {
            $("#senhaError").text("A senha é obrigatória.").show();
            validacao = false;
        } else if (senhaUsuario.length < 4) {
            $("#senhaError").text("A senha deve ter pelo menos 4 caracteres.").show();
            validacao = false;
        }
    
        // Validação da Modalidade
        const modalidade = $("select[name='p_modalidade']").val();
        if (modalidade === "") {
            $("#modalidadeError").text("Por favor, selecione uma modalidade.").show();
            validacao = false;
        }
    
        // Envia o formulário apenas se todas as validações forem aprovadas
        if (validacao) {
            this.submit();
        }
    });

    $("#form_editar_usuario").on("submit", function(event) {
        event.preventDefault(); // Impede o envio automático do formulário
        $(".error-message").hide(); // Esconde todas as mensagens de erro
        let validacao = true;
    
        // Validação do Nome
        const nomeUsuario = $("input[name='n_nome']").val().trim();
        if (nomeUsuario === "") {
            $("#nomeError").text("O nome é obrigatório.").show();
            validacao = false;
        } else if (nomeUsuario.length < 3) {
            $("#nomeError").text("O nome deve ter pelo menos 3 caracteres.").show();
            validacao = false;
        }
    
        // Validação do E-mail
        const emailUsuario = $("input[name='n_email']").val().trim();
        const email = $("#n_email").val().trim(); //.val() = pega o valor ;;; .trim() = tira os espaços do inicio e final
        const formatoEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const caracteresInvalidos = /[<>{}[\]/'"!#$%^&*()]/;
    
        if (emailUsuario === "") {
            $("#emailError").text("O e-mail é obrigatório.").show();
            validacao = false;
        }
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
        // Validação da Modalidade
        const modalidade = $("select[name='p_modalidade']").val();
        if (modalidade === "") {
            $("#modalidadeError").text("Por favor, selecione uma modalidade.").show();
            validacao = false;
        }
    
        // Envia o formulário apenas se todas as validações forem aprovadas
        if (validacao) {
            this.submit();
        }
    });
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
