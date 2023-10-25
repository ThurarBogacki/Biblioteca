<?php 

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Agora você pode usar o valor de $id para buscar os dados no banco de dados
        // e exibi-los na página.
    } else {
        echo "ID não encontrado na URL.";
    }

     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "biblioteca";

     $conn = new mysqli($servername, $username, $password, $dbname);

     if ($conn->connect_error) {
         die("Conexão com o banco de dados falhou: " . $conn->connect_error);
     }
     $sql = $conn->prepare("SELECT * FROM livros WHERE id = $id");
     $sql->execute();
     $result = $sql->get_result();
     $info = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
        <head>
            <title>LivroSingle</title>
            <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/all.min.css">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Happy+Monkey&family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta charset="utf-8">
            <meta name="keywords" content="biblioteca">
            <meta name="description content="A Rede Social dos Leitores">
            <link href="estilo/style.css" rel="stylesheet">
        </head>

        <body>
            <div class="header">
                <h2><?php foreach($info as $key => $value){
                    echo $value['nome'];
                }?></h2>
                <p><?php foreach($info as $key => $value){
                    echo $value['autor'];
                    echo '<br>';
                    echo 'ID: '.$value['id'];
                } ?></p>
            </div><!--header--> 
            <div class="descricao">
                <?php foreach($info as $key => $value){
                    echo '<p>"'.$value['resenha'].'"</p>';
                }?>
            </div><!--descricao-->
            <a href="index.php"><i class="fa-solid fa-left-long seta-livro-single"></i></a>
        </body>
</html>