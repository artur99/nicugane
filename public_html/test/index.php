<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <!-- Pentru a funcționa diacriticele -->
    <meta charset="utf-8">
    <!-- Codul pentru conectarea unui fișier css extern -->
    <link rel="stylesheet" href="style.css">
    <!-- Codul prin care aducem fonturi de pe google fonts aici. Este generat de fonts.google.com -->
    <!-- Acesta încarcă 3 fonturi: Pacifico, Roboto, Ubuntu, care vor putea fi setate din CSS -->
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Roboto:400,500,700|Ubuntu:400,500,700&amp;subset=latin-ext" rel="stylesheet">
</head>
<body>
    <!-- Bara portocalie de sus -->
    <div class="header">
        BitFall
    </div>
    <!-- Meniul(bara albă) -->
    <?php include 'parts/menu.php'; ?>
    <!-- Divul .cont, pentru structură, de 960px, centrat -->
    <div class="cont">
        <!-- Divul .left, care e 70% din .cont -->
        <div class="left">
            <!-- Divul .main, care e pătratul alb în care e conținutul -->
            <div class="main">
                <!-- H2-ul, titlul articolului -->
                <h2 class="titlu_articol">Jocurile Olimpice de vară</h2>
                <!-- Imaginea de pe pagină -->
                <img class="img_articol" src="https://s-media-cache-ak0.pinimg.com/originals/57/cc/88/57cc88c9b6db806d66200d89787bbc81.jpg">
                <!-- Câteva paragrafe cu conținutul -->
                <p>
                    Jocurile Olimpice de vară reprezintă un eveniment sportiv care se desfășoară odată la patru ani, eveniment organizat de Comitetul Internațional Olimpic (CIO). Primele Jocuri Olimpice moderne s-au desfășurat la Atena în 1896. Începând cu anul 1904, medaliile sunt acordate pentru fiecare eveniment sportiv cu aur pentru locul întâi, argint pentru locul doi și bronz pentru locul trei.
                </p>
                <p>
                    Regulile de calificare fiecare sport olimpic sunt stabilite de Federația Internațională care guvernează fiecare sport internațional din competiție.
                </p>
                <p>
                    Regulile calificare pentru fiecare sport olimpic sunt stabilite de Federația Internațională care guvernează fiecare sport internațional din competiție.
                </p>
                <p>
                    Regulile de calificare pentru fiecare sport olimpic sunt stabilite de Federația Internațională care guvernează fiecare sport internațional din competiție.
                </p>
            </div>
        </div>
        <!-- Divul .right, care e 30% din .cont -->
        <div class="right">
            <?php include 'parts/widgets.php'; ?>
        </div>
    </div>
    <?php include 'parts/footer.php'; ?>
</body>
</html>
