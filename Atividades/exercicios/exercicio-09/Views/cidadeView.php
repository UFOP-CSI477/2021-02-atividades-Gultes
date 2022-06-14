<body>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr class="thead-dark">
                <th>id</th>
                <th>nome</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($cidades as $cidade) {
                echo "<tr>";
                echo "<td>{$cidade['id']}</td>";
                echo "<td>{$cidade['nome']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>