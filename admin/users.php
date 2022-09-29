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
            $_properties = $properties->getAll_properties($user['id']);
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
        <a href="<?php echo "/immoplus/admin" ?>" class="back">Retour</a>
    <?php else : ?>
        <?php if ($user) : ?>
            <section id="singleUser">
                <div class="userContentBx">
                    <div>
                        <p>Nom & prénoms : <span class="infos"><?php echo $user['fullname']; ?></span></p>
                        <p>Contact : <span class="infos"><?php echo $user['contact']; ?></span></p>
                        <p>Email : <span class="infos"><?php echo $user['email'] ?? ""; ?></span></p>
                        <p>Publication : <span class="infos"><?php echo $user['properties_published'] ?? ""; ?></span></p>
                        <p>Inscrit le: <span class="infos"><?php echo $user['insert_date']; ?> (<?php echo datediff($user['insert_date']); ?> )</span></p>
                    </div>

                    <div class="actions">
                        <i onclick="del(<?php echo $user['id']; ?>)" class="del">Supprimer</i>
                        <a href="<?php echo "/immoplus/admin/users" ?>" class="back">Retour</a>
                    </div>
                </div>
                <?php if(!empty($_properties)):?>
                    <div id="user_properties">
                    <?php foreach ($_properties as $property) : ?>
                        <div class="contentProperty">
                        <img src="<?php echo $property['picture']?>" alt="">
                        <div>
                        <?php echo $property['etat'] == 0 ? "<p>En attente</p>" : "<p>Confirmer</p>"; ?>
                            <p>Prix : <?php echo number_format($property['price'], 0, ',', '.') ?> FCFA</p>
                            <p>Vue : <?php echo $property['view']?></p>
                            <?php echo $property['type'] == 'location' ? "<p>En location</p>" : "<p>En vente</p>"; ?>
                        </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif;?>
            </section>
        <?php elseif ($users) : ?>
            <section class="tableBx">
                <table id="Table" class="display nowrap dataTable dtr-inline">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Contact</th>
                            <th>Inscrit le</th>
                            <th>Action</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr class="userBx">
                                <td class="infos"><?php echo $user['fullname']; ?></td>
                                <td class="infos"><?php echo $user['contact']; ?></td>
                                <td class="infos"><?php echo datediff($user['insert_date']); ?></td>
                                <td><a class="btn" href="?user_id=<?php echo $user['id']; ?>">voir</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
<script>
    $(document).ready(function() {
        $('#Table').DataTable();
    });
</script>
<?php include('includes/footer.php'); ?>