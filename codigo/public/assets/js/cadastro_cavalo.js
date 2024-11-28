$(document).ready(function () {
    $("#cadastro_cavalo").on("submit", function (event) {
        event.preventDefault();
        $(".error-message").text(""); // Limpa mensagens de erro existentes

        let validacao = true;

        // Validação do campo Nome
        const nome = $("input[name='nome_cavalo']").val().trim();
        if (nome === "") {
            $("#nomeError").text("O nome é obrigatório.").show();
            validacao = false;
        } else if (nome.length < 3) {
            $("#nomeError").text("O nome deve ter pelo menos 3 caracteres.").show();
            validacao = false;
        }

        // Validação do campo Raça
        const raca = $("input[name='raca_cavalo']").val().trim();
        if (raca === "") {
            $("#racaError").text("A raça é obrigatória.").show();
            validacao = false;
        } else if (raca.length < 3) {
            $("#racaError").text("A raça deve ter pelo menos 3 caracteres.").show();
            validacao = false;
        }

        // Validação do campo Pelagem
        const pelagem = $("input[name='pelagem_cavalo']").val().trim();
        if (pelagem === "") {
            $("#pelagemError").text("A pelagem é obrigatória.").show();
            validacao = false;
        } else if (pelagem.length < 3) {
            $("#pelagemError").text("A pelagem deve ter pelo menos 3 caracteres.").show();
            validacao = false;
        }

        // Validação do campo Prêmio
        const premio = $("input[name='premio_cavalo']").val().trim();
        if (premio === "") {
            $("#premioError").text("O prêmio é obrigatório.").show();
            validacao = false;
        } else if (premio.length < 3) {
            $("#premioError").text("O prêmio deve ter pelo menos 3 caracteres.").show();
            validacao = false;
        }

        // Validação da Modalidade
        const modalidade = $("select[name='modalidade_cavalo']").val();
        if (!["3 Tambores", "Laço", "Vaquejada"].includes(modalidade)) {

            $("#modalidadeError").text("Selecione uma modalidade válida.").show();
            validacao = false;
        }

        // Validação do campo Imagem 
        const imagem = $("input[name='imagem_cavalo']").val();
        if (imagem === "") {
            $("#imagemError").text("A imagem é obrigatória.").show();
            validacao = false;
        } 

        // Validação do campo Imagem Editar
        const imagem_editar = $("input[name='imagem_editar_cavalo']").val();
        if (imagem_editar === "") { 
             $("#imagem_obrigatoriaError").text("A imagem é obrigatória").show();
             validacao = false;
         }

        // Envia o formulário apenas se os campos forem válidos
        if (validacao) {
            this.submit();
        }
    });
});
