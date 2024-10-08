<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campo de Valor em Reais</title>
    <script>
        function formatCurrency() {
            var input = document.getElementById('valor');
            var value = input.value.replace(/\D/g, '');
            value = (value/100).toFixed(2) + '';
            value = value.replace(".", ",");
            value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            input.value = 'R$ ' + value;
        }
    </script>
</head>
<body>
    <form action="processar.php" method="post">
        <label for="valor">Valor (R$):</label>
        <input type="text" id="valor" name="valor" onkeyup="formatCurrency()" placeholder="R$ 0,00">
        <button type="submit">Enviar</button>
    </form>
</body>