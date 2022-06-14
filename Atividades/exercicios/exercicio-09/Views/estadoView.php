<body>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr class="thead-dark">
                <th>id</th>
                <th>nome</th>
                <th>sigla</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($estados as $estado) {
                echo "<tr>";
                echo "<td>{$produto['id']}</td>";
                echo "<td>{$produto['nome']}</td>";
                echo "<td>{$produto['sligla']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>