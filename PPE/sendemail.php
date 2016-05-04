<?php
if(isset($_POST["sendticket"])) {


    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];


    $body = "Name: " . $name . "</br></br>" . "Email: " . $email . "</br></br>" . "Message: " . $message;

    $bdd = new PDO("mysql:host=localhost;dbname=auto_ecole", "root", "");
    $req = $bdd->prepare("INSERT INTO ticket(message, dates, etat) VALUES (:message, sysdate(), 0)");
    $req->execute(array("message" => $body));
    $resultat = $req->fetch(PDO::FETCH_ASSOC);
}
?>
<script>
    alert("Ticket envoyer!");
</script>
<meta http-equiv="Refresh" content="0;URL=index.php">