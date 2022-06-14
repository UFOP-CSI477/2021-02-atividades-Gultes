<body>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr class="thead-dark">
                <th>id</th>
                <th>nome</th>
                <th>um</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($produtos as $produto) {
                echo "<tr>";
                echo "<td>{$produto['id']}</td>";
                echo "<td>{$produto['nome']}</td>";
                echo "<td>{$produto['um']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>