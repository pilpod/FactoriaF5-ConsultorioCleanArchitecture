<?php require('src/Infrastructure/Views/Components/Layout.php'); ?>

    <?php require('src/Infrastructure/Views/Components/Header.php'); ?>

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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>