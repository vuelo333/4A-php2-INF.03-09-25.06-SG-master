<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl.css">
    <title>Document</title>
</head>

<body>
    <header>
        <h1>Malowanie i gipsowanie</h1>
    </header>

    <main>
        <nav>
            <a href="kontakt.html">Kontakt</a>
            <a href="https://remonty.pl" target="_blank">Partnerzy</a>
        </nav>

        <aside>
            <img src="tapeta_lewa.png" alt="usługi">
            <img src="tapeta_prawa.png" alt="usługi">
            <img src="tapeta_lewa.png" alt="usługi">
        </aside>

        <section id="lewa">
            <h2>Dla klientów</h2>
            <form action="zlecenia.php" method="post">
                <label for="pracownicy">Ilu co najmniej pracowników potrzebujesz?</label>
                <br>
                <input type="number" name="pracownicy-name" id="pracownicy">
                <button type="submit">Szukaj firm</button>
            </form>

            <?php
            $polaczenie = new mysqli("localhost", "root", "" , "remonty");
            if (!empty($_POST['pracownicy-name']))  {
            }
            $sql = "SELECT nazwa_firmy, liczba_pracownikow FROM wykonawcy WHERE liczba_pracownikow >=" . $_POST["pracownicy-name"] . ";";
            echo $sql;

            ?>

        </section>

        <section id="srodkowa">
            <h2>Dla wykonawców</h2>

            <form action="zlecenia.php" method="post">
                <select>
                     <?php
                            $sql = "SELECT DISTINCT miasto FROM klienci ORDER BY miasto ASC";
                            $wyniki = $polaczenie->query($sql);
                            while ($wiersz = $wyniki->fetch_assoc()){
                                echo "<option value>";
                                echo $wiersz["miasto"];
                                echo "</option>";
                            }
                        ?>
                </select>
                
                <br>
                
                <input type="radio" name="wykonanie" id="malowanie" checked>
                <label for="malowanie">Malowanie</label>
                
                <br>
                
                <input type="radio" name="wykonanie" id="gipsowanie">
                <label for="gipsowanie">Gipsowanie</label>
                
                <br>

                <input type="submit" value="Szukaj klientów">
            </form>

            <ul>
                <?php

                    if(isset($_POST["formularz2"])) {
                        $sql = "SELECT imie, cena FROM klienci JOIN zlecenia ON zlecenia.id_klienta=klienci.id_klienta WHERE miasto = 'Poznań' AND rodzaj='malowanie';";
                        $wyniki = $polaczenie->query($sql);
                        while ($wiersz = $wyniki-> fetch_assoc()){
                            echo "<li>";
                            echo $wiersz["imie"]. " - ";
                            echo $wiersz["cena"];
                            echo "</li>";
                        }
                    }                                
                    ?>
            </ul>
        </section>
    </main>

    <footer>
        <p><strong>Stronę wykonał</strong></p>
    </footer>
</body>

</html>

<?php
$polaczenie->close()
?>