<!DOCTYPE html>
<html>  
        <?php
            // Conectar ao banco de dados
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "biblioteca";

            $conn = new mysqli($servername, $username, $password, $dbname); //CONECTA COM BANCO DE DADOS

            if ($conn->connect_error) {
                die("Conexão com o banco de dados falhou: " . $conn->connect_error);
            } // SE A CONEXAO FALHAR RETORNA FALHA

           if(isset($_POST['acao'])){ // SE EXISTIR O POST AÇÃO ALGUEM CLICOU EM ENVIAR O FORMULARIO
                $nome = $_POST['livro']; // SALVA NA VARIAVEL $NOME O QUE TIVER NO INPUT NAME=LIVRO
                $autor = $_POST['autor']; // SALVA NA VARIAVEL $AUTOR O QUE TIVER NO INPUT NAME=AUTOR
                if(isset($_POST['star'])){ // SE EXISTIR ESTRELINHAS MARCADAS 
                    $avaliacao = $_POST['star']; // SALVA EM AVALIACAO AS ESTRELAS
                }else{
                    $avaliacao = 0; // SE NAO A NOTA DE ESTRELAS É 0
                }
                $resenha = $_POST['resenha']; // SALVA NA VARIAVEL $RESENHA O QUE TIVER NO INPUT NAME=RESENHA

                //INSERE NA TABELA "LIVROS" (nome,autor,resenha,avaliacao) OS VALORES DAS VARIAVEIS $NOME,$AUTOR,$RESENHA.....
                $sql = "INSERT INTO livros (nome, autor, resenha, avaliacao) VALUES ('$nome', '$autor','$resenha','$avaliacao')";
                if ($conn->query($sql) === TRUE) { //SE SALVOU COM SUCESSO
                    echo '<div class="sucesso"><h2>Livro Inserido com Sucesso</h2></div>'; // PRINTA HTML
                    } else {
                    echo "Erro: " . $sql . "<br>" . $conn->error; // SE NAO PRINTA ERRO
                }
           } 

            $conn->close(); // FECHA CONEXÃO COM BANCO DE DADOS

            ?>
        <head>
            <title>Cadastro</title>
            <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/all.min.css">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Happy+Monkey&family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta charset="utf-8">
            <link href="estilo/style.css" rel="stylesheet">
        </head>
    <body>
    <a href="index.php"><i class="fa-solid fa-left-long seta-cadastro"></i></a>
        <div class="conteiner-cadastro">
            <div class="space">
            <form method="post">
                <div class="livro">
                    <h2 class="title1">Livro</h2>
                    <input type="text" name="livro" placeholder="Nome do Livro">
                    <h2 class="title2">Nota</h2>
                    <div class="rating">
                    <input type="radio" name="star" id="star1" value="1" class="star-radio">
                    <label for="star1" class="star-label">&#9733;</label>
                    <input type="radio" name="star" id="star2" value="2" class="star-radio">
                    <label for="star2" class="star-label">&#9733;</label>
                    <input type="radio" name="star" id="star3" value="3" class="star-radio">
                    <label for="star3" class="star-label">&#9733;</label>
                    <input type="radio" name="star" id="star4" value="4" class="star-radio">
                    <label for="star4" class="star-label">&#9733;</label>
                    <input type="radio" name="star" id="star5" value="5" class="star-radio">
                    <label for="star5" class="star-label">&#9733;</label>
                    </div><!--rating-->
                </div><!--livro-->

                <div class="resenha">
                    <h2>Resenha</h2>
                    <textarea name="resenha"></textarea>
                    <input type="text" placeholder="Nome do Autor" name="autor">
                    <input type="submit" value="Enviar" name="acao">
                </div><!--resenha-->
            </form>
            <div class="clear"></div>
            </div><!--space-->
        </div><!--conteiner-->
    </body>


    <script>
        const starRadios = document.querySelectorAll(".star-radio");
        const starLabels = document.querySelectorAll(".star-label");

        starRadios.forEach((radio, index) => {
            radio.addEventListener("click", () => {
                // Captura a classificação selecionada
                const rating = parseInt(radio.value);

                // Remove a cor amarela de todas as estrelas
                starLabels.forEach((label) => {
                    label.style.color = "#ddd"; // Cor das estrelas não selecionadas
                });

                // Aplica estilos apenas às estrelas selecionadas e anteriores
                for (let i = 0; i <= index; i++) {
                    starLabels[i].style.color = "#f0d800"; // Cor das estrelas selecionadas
                }
            });
        });
    </script>
</html>