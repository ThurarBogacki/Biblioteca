<!DOCTYPE html>
    <?php
     
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "biblioteca";

     $conn = new mysqli($servername, $username, $password, $dbname);

     if ($conn->connect_error) {
         die("Conexão com o banco de dados falhou: " . $conn->connect_error);
     }
     $sql = $conn->prepare("SELECT * FROM livros");
     $sql->execute();
     $result = $sql->get_result();
     $info = $result->fetch_all(MYSQLI_ASSOC);
    ?>
<html>
    <head>
        <title>Livros</title>
        <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Happy+Monkey&family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <link href="estilo/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="header">
            <h2>Livros Cadastrados</h2>
            <p>Dê uma olhada nos livros inseridos pelos amigos leitores</p>
        </div><!--header-->
        <div class="conteiner-livros">
            <?php 
            
            foreach ($info as $key => $value) {
                echo 
                '<div class="livro-single">
                <h2><a href="livrosingle.php?id='.$value['id'].'">'.$value['nome'].'</a></h2>';
                echo '<p>- '.$value['autor'].'</p>';
                echo '<p>ID: '.$value['id'].'</p>';
                for($i = 1; $i<6; $i++){
                    if($value['avaliacao'] >= $i){
                        echo '<label for="star" class="star" style="color:#ca6e3f; font-size:34px;">&#9733;</label>';
                    }else{
                        echo '<label for="star" class="star" style="color:#ccc; font-size:34px;">&#9733;</label>';
                    }
                }
                echo    '<form action="delete.php" method="post">
                            <input type="hidden" name="row_id" value="'.$value['id'].'">
                            <button type="submit" name="excluir"><i class="fa-solid fa-trash"></i></button>
                        </form>';
                echo '</div><!--livro-single-->';
            }
            ?>
        </div><!--conteiner-livros-->
    </body>
</html>
