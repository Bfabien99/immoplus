<?php include('includes/header.php'); ?>
<?php
$class = new Users();
$error = false;
$users = false;
$user = false;
if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    if (!is_numeric($user_id)) {
        $error = "<p class='error'>L'id doit être un entier</p>";
    } else {
        $user = $class->getUserById($user_id);
        if (!$user) {
            $error = "<p class='error'>Identifiant incorrect</p>";
        }
    }
} else {
    $users = $class->getAll_users();
    if (!$users) {
        $error = "<h4>Aucun utilisateur pour l'instant</h4>";
    }
}

?>
<div class="container">
<?php if ($error) : ?>
        <?php echo $error; ?>
    <?php else : ?>
        <?php if ($user) : ?>
            <section id="singleUser">
                <div class="userContentBx">
                <p>Nom & prénoms : <?php echo $user['fullname']; ?></p>
                <p>Contact : <?php echo $user['contact']; ?></p>
                <p>Email : <?php echo $user['email'] ?? ""; ?></p>
                <p>Inscrit le: <?php echo $user['insert_date']; ?></p>
                    <i onclick="del(<?php echo $user['id']; ?>)" class="del">Supprimer</i>
                </div>
            </section>
        <?php elseif ($users) : ?>
            <section id="multipleUsers">
                <?php foreach ($users as $user) : ?>
                    <div class="userBx">
                    <p>Nom & prénoms : <?php echo $user['fullname']; ?></p>
                <p>Contact : <?php echo $user['contact']; ?></p>
                        <p>Inscrit le: <?php echo $user['insert_date']; ?></p>
                        <a href="?user_id=<?php echo $user['id']; ?>">voir</a>
                    </div>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
    <?php endif; ?>
</div>
<script>
    function del(id) {
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Supprimer',
            denyButtonText: `Annuler`,
            cancelButtonText: `Fermer`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                var input = id;

                if (input != "") {
                    $.ajax({
                        url: "/immoplus/admin/_deleteuser.php",
                        method: "POST",
                        data: {
                            input: input,
                        },
                        success: function(data) {
                            if (data) {
                                window.location.href = '/immoplus/admin/messages'
                            }

                        }
                    })
                } else {
                    window.location.reload()
                }
            } else if (result.isDenied) {
                Swal.fire('Suppression annulée', '', 'info')
            }
        })


    }
</script>
<?php include('includes/footer.php'); ?>