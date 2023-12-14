<?php
// Conexão com o banco de dados (substitua com suas próprias configurações)
$host = 'localhost';
$dbname = 'id21646862_banco_amigo_secreto';
$username = 'id21646862_root';
$password = 'Sprtuoe243_';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
    exit();
    }

// Se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $participante = $_POST["participante"];
    $recado = $_POST["recado"];

    // Insere os recados no banco de dados
    $stmt = $conn->prepare("INSERT INTO recados
    (participante, recado)
     VALUES (:participante, :recado)");
    // $stmt->bindparam("s", $senhaHash);
    $stmt->execute(['participante' => $participante, 'recado' => $recado]); //executa os valores das variáveis

}

try {
    $stmt = $conn->query("SELECT participante, recado FROM recados");
    $recados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao recuperar os recados: " . $e->getMessage();
    exit();
}
// Exibe os recados na div recados
// echo '<div class="recados" id="recadosContainer">';

// echo '</div>';

// Fecha a conexão com o banco de dados

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="img/mensagens.png" type="image/x-icon">
  <title>Amigo Secreto</title>
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,600&display=swap" rel="stylesheet">
</head>
<body>

  <div class="container">
    <div class="flex">
    <h1>Recados Para Amigo Secreto</h1>
    
    <!-- ... Código anterior ... -->

    
      <form action="" method="post">
        <label for="participante">Participante:</label>
        <select id="participante" name="participante">
        <option>Selecione os Participantes:</option>
        <option value="Mary">Mary</option>
        <option value="Maraisa">Mara isa</option>
        <option value="Marlene">Marlene</option>
        <option value="Paulinha">Paulinha</option>
        <option value="Lucas">Lucas</option>
        <option value="Monike">Monike</option>
        <option value="Rebeca">Rebeca</option>
        <option value="Karol">Karol</option>

        </select>
    
        <label for="recado">Recado:</label>
        <textarea id="recado" name="recado" required placeholder="Escreva seu recado:"></textarea>
    
        <button type="submit">Enviar Recado</button>
      </form>
    </div>
  
  <!-- ... Código anterior ... -->
  

    <div class="recados" id="recadosContainer">
     <?php
      if ($recados) {
        foreach ($recados as $recado) {
            echo '<div class="recado-item">';
            echo '<strong>Para a Participante:</strong> ' . htmlspecialchars($recado["participante"]) . '<br>';
            echo '<strong>Recado:</strong> ' . htmlspecialchars($recado["recado"]);
            echo '</div>';
        }
    } else {
        echo '<div class="recado-item">';
        echo "Nenhum recado foi enviado até o momento.";
        echo '</div>';
    }
    $conn = null;
    ?>
    </div>
  </div>

  <!-- <script src="script.js"></script> -->
</body>
</html>
