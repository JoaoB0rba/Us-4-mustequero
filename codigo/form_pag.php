<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha o Tipo de Cliente</title>
    <!-- Incluindo Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center">Selecione o Tipo de Cliente</h2>
        <form action="pags1.php" method="GET">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipocliente" value="pf" id="pf">
                <label class="form-check-label" for="pf">
                    Físico
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipocliente" value="pj" id="pj">
                <label class="form-check-label" for="pj">
                    Jurídico
                </label>
            </div>

            <br><br>

            <div class="text-center">
                <input type="submit" value="Enviar" class="btn btn-primary">
            </div>
        </form>

        <div class="mt-3 text-center">
            <a href="teladeinicial.html" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

    <!-- Incluindo Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
