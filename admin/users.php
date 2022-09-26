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
        } else {
            $properties = new Properties();
            $user['properties_published'] =  $properties->getAll_properties($user['id']) ? count($properties->getAll_properties($user['id'])) : 0;
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
        <a href="<?php echo $_SERVER['HTTP_REFERER'] ?? "/immoplus/admin" ?>" class="back">Retour</a>
    <?php else : ?>
        <?php if ($user) : ?>
            <section id="singleUser">
                <div class="userContentBx">
                    <div>
                        <p>Nom & prénoms : <span class="infos"><?php echo $user['fullname']; ?></span></p>
                        <p>Contact : <span class="infos"><?php echo $user['contact']; ?></span></p>
                        <p>Email : <span class="infos"><?php echo $user['email'] ?? ""; ?></span></p>
                        <p>Publication : <span class="infos"><?php echo $user['properties_published'] ?? ""; ?></span></p>
                        <p>Inscrit le: <span class="infos"><?php echo $user['insert_date']; ?> ( il y a <?php echo datediff($user['insert_date']); ?> )</span></p>
                    </div>

                    <div class="actions">
                        <i onclick="del(<?php echo $user['id']; ?>)" class="del">Supprimer</i>
                        <a href="<?php echo "/immoplus/admin/users" ?>" class="back">Retour</a>
                    </div>
                </div>
            </section>
        <?php elseif ($users) : ?>
            <section id="multipleUsers">
                <?php foreach ($users as $user) : ?>
                    <div class="userBx">
                        <p>Nom & prénoms : <span class="infos"><?php echo $user['fullname']; ?></span></p>
                        <p>Contact : <span class="infos"><?php echo $user['contact']; ?></span></p>
                        <p>Inscrit le: <span class="infos"><?php echo $user['insert_date']; ?></span></p>
                        <a class="btn" href="?user_id=<?php echo $user['id']; ?>">voir</a>
                    </div>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
    <?php endif; ?>
</div>
<script>
    function del(id) {
        Swal.fire({
            title: "Voulez vous supprimer l'utilisateur?",
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
                                window.location.href = '/immoplus/admin/users'
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