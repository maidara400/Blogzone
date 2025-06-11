<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Stylisé</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color:rgb(48,50,51);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.card {
   
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 400px;
    height: 400px;
    background-color:white;
}

h2 {
    margin-bottom: 15px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin: 10px 0 5px;
    font-weight: bold;
}

input, textarea {
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
}

button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px;
    border-radius:30%;
    cursor: pointer;
    font-size: 16px;
    height: 50px;
}

button:hover {
    background-color: #0056b3;
}

</style>
<body>
    <div class="card">
        <h2>Connexion</h2>
        <form>
            <div class="form-floating mb-3">
                <input type="email" class="form-control " id="floatingInput">
                <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword">
                <label for="floatingPassword">Password</label>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">CONNEXION</button>
            <br>
           <p><a href="#" class="btn-primary">MOT DE PASSE OUBLIE ?</a></p>

                        <button type="submit" class="btn btn-success btn-sm">CONNEXION</button>
        </form>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</html>

