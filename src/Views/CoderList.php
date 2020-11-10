

    <main class="container">
        <a href="?action=create">
            <button class="btn btn-primary btn-circle btn-lg">
                <i class="fas fa-plus"></i>
            </button>
        </a>
        <table class="table table-light">

            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Created At</th>
                    <th>Options</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($data["students_db"] as $coder) {
                    echo "
                    <tr>
                        <td>{$coder->getId()}</td>
                        <td>{$coder->getName()}</td>
                        <td>{$coder->getSubject()}</td>
                        <td>{$coder->getCreatedAt()}</td>
                        <td>               
                        <a href='?action=edit&id={$coder->getId()}'><i class='lnr lnr-pencil'></i></a>
                        <a href='?action=delete&id={$coder->getId()}'><i class='lnr lnr-trash'></i></a>
                        </td>
                    </tr>
                    ";
                } ?>

            </tbody>
        </table>
    </main>
</body>

</html>