<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
    <link rel="stylesheet" href=".\Visao\css\index.css">
</head>
<body>
<div class="container">
    <header>
        <nav class="navbar">
            <ul>
                <li><a href="Visao/Hospede/Listar.php">Hospedes</a></li>
                <li><a href="Visao/Quarto/Listar.php">Quartos</a></li>
                <li><a href="Visao/Reserva/Listar.php">Reservas</a></li>
            </ul>
        </nav>
    </header>

    <section class="topo">
        <h1>Nossos Serviços</h1>
        <p>Abaixo estão os nossos serviços de quarto
        </p>

        <div class="cards-container">
            <div class="topo-cards">
                <img src="./Visao/img/quarto_solteiro.jpeg" alt="Solteiro">
                <h3>Solteiro</h3>
                <p>Service Description. You can show/hide the title, 
                   subtitle, text, button in the Block Parameters.</p>
                <a href="./Visao/Hospede/Cadastrar.php?tipo=Solteiro">
                <button class="learn-btn">Reservar</button>
                </a>
            </div>

            <div class="topo-cards">
                <img src="./Visao/img/quarto_casal.jpeg" alt="Casal">
                <h3>Casal</h3>
                <p>Service Description. You can show/hide the title,
                   subtitle, text, button in the Block Parameters.</p>
                <a href="./Visao/Hospede/Cadastrar.php?tipo=Casal">
                <button class="learn-btn">Reservar</button>
                </a>
            </div>

            <div class="topo-cards">
                <img src="./Visao/img/quarto_suite.jpeg" alt="Suíte">
                <h3>Suíte</h3>
                <p>Service Description. You can show/hide the title, 
                   subtitle, text, button in the Block Parameters.</p>
                <a href="./Visao/Hospede/Cadastrar.php?tipo=Suite">
                <button class="learn-btn">Reservar</button>
                </a>
            </div>
        </div>
    </section>
</div>
</body>
</html>
