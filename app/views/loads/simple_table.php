<table class='table table-dark table-striped' style='font-size: 20px'>
    <thead>
        <tr>
            <th scope='col'>Data</th>
            <th scope='col'>Paciente</th>
            <th scope='col'>Temperatura</th>
            <th scope='col'>Saturação O2</th>
            <th scope='col'>BPM</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data as $row) {
            echo "<tr>";
            $dia = substr($row['data'], -2);
            $mes = substr($row['data'], -5, 2);
            $hora = substr($row['hora'], 0, 2);
            echo "<th scope='row'>" . $dia . "/" . $mes . " " . $hora .  "h</th>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['TEMPERATURA'] . "</td>";
            echo "<td>" . $row['O2'] . "</td>";
            echo "<td>" . $row['BPM'] . "</td>";

            echo "</tr>";
        }
        ?>

    </tbody>
</table>
<br>