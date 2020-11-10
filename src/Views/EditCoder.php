

    <main class="container text-center">

        <h2 class="text-center">Nuevo Estudiante</h2>

        <form action='?action=update&id=<?php echo $data["coder"]->getId() ?>' method="POST">
            <input type="text" name="name" required value='<?php echo $data["coder"]->getName() ?>'>
            <input type="text" name="subject" required value='<?php echo $data["coder"]->getSubject() ?>'>
            <input type="submit" value="Edit">
            <input type="reset" value="Reset">
        </form>
    </main>

</body>