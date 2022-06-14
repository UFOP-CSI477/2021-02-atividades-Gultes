<body>


    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr class="thead-dark">
                <th>Estado</th>
                <th>Sigla</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($estado = $estados->fetch()) {
                echo "<tr>";
                echo "<td>{$estado['nome']}</td>";
                echo "<td>{$estado['sigla']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>