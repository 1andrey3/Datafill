<body>
    <br><br><br>
    <div class="container">
    <table border="1" class="table table-striped" id="tabla_usuarios">
        <thead>
            <tr>
                <th>cedf</th>
                <th>xxxxxxx</th>
                <th>xxxxxxx</th>
                <th>xxxxxxx</th>
                <th>xxxxxxx</th>
                <th>xxxxxxx</th>
                <th>xxxxxxx</th>
                <th>xxxxxxx</th>
            </tr>
            <?php
            for ($i = 0; $i < count($usuarios); $i++) {

                echo "<tr>";
                echo "<th>" . $usuarios[$i]->K_IDUSER . "</th>";
                echo "<th>" . $usuarios[$i]->K_IDROLE . "</th>";
                echo "<th>" . $usuarios[$i]->N_NAME . "</th>";
                echo "<th>" . $usuarios[$i]->K_IDUSER . "</th>";
                echo "<th>" . $usuarios[$i]->K_IDUSER . "</th>";
                echo "<th>" . $usuarios[$i]->K_IDUSER . "</th>";
                echo "<th>" . $usuarios[$i]->K_IDUSER . "</th>";
                echo "<th>" . $usuarios[$i]->K_IDUSER . "</th>";
                echo "</tr>";
            }
            ?>
    </div>

        </thead>
    </table>
    <script>
        $(function() {

            $('#tabla_usuarios').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
</body>
