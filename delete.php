<?php 

    if (isset($_POST['excluir'])) {
        $row_id = $_POST['row_id']; // Recupere o valor do campo "row_id" do formulário

            
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "biblioteca";

        $conn = new mysqli($servername, $username, $password, $dbname);


        $sql = $conn->prepare("DELETE FROM livros WHERE id = $row_id");
        $sql->execute();
        // Redirecione o usuário para uma nova página após a exclusão
        header("Location: livros.php");
        exit;
}

?>