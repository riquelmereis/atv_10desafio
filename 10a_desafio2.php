<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produtos</title>
</head>

<body>
    <h1>Cadastro de Produtos</h1>
    <form action="" method="post">

        <label for="produto">Produto: </label>
        <input type="text" name="produto" required> <br><br>

        <label for="preço">Preço: </label>
        <input type="number" name="preço" required> <br><br>

        <button type="submit">Cadastrar</button> <br><br>
</body>

</html>
</form

    <?php
    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recebe os valores enviados pelo formulário
        $produto= $_POST['produto'];
        $preco = $_POST['preço'];

        // Conecta com o banco de dados
        $server = "localhost";
        $user = "root";
        $pass = "Senai@118";
        $db = "exercicio";

        $conn = new mysqli($server, $user, $pass, $db);

        //Verfica a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }
        // Insere dados no Banco de Dados
        if (!empty($produto) && is_numeric($preco) && $preco > 0) {
            $sql = "INSERT INTO produtos (nome, preco) VALUES ('$produto', $preco)";

            if ($conn->query($sql) == TRUE) {
                echo "<p id='msg' style='color: darkgreen;'>Produto cadastrado com sucesso!</p>";
            }
        } elseif (empty($produto)) {
            echo "<p id='msg' style='color: red';>Erro: O produto precisa ter um nome válido.</p>";
        } elseif ($preco <= 0) {
            echo "<p id='msg' style='color: red';>Erro: O preço deve ser um número positivo.</p>";
        }

        // Ocultar a mensagem após 5 segundos
        echo "
        <script> 
            setTimeout(function() {
                document.getElementById('msg').style.display = 'none'
                }, 5000)
        </script>
        ";

        //fecha a conexão
        $conn->close();
    }
    ?>