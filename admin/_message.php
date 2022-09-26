<?php include('includes/header.php'); ?>
<?php
$users = new Users();
$messages = false;
$message = false;
$error = false;
if (isset($_GET['message_id']) && !empty($_GET['message_id'])) {
    $message_id = $_GET['message_id'];
    if (!is_numeric($message_id)) {
        $error = "<p class='error'>L'id doit être un entier</p>";
    } else {
        $message = $users->getMessage($message_id);
        if (!$message) {
            $error = "<p class='error'>Identifiant incorrect</p>";
        } else {
            $users->viewMessage($message_id);
        }
    }
} else {
    $messages = $users->getAll_messages();
    if (!$messages) {
        $error = "<h4>Aucun message pour l'instant</h4>";
    }
}

?>
<div class="container">
    <?php if ($error) : ?>
        <?php echo $error; ?>
        <a href="<?php echo $_SERVER['HTTP_REFERER'] ?? "/immoplus/admin" ?>" class="back">Retour</a>
    <?php else : ?>
        <?php if ($message) : ?>
            <section id="singleMessage">
                <div class="messageContentBx">
                    <div class="top">
                        <div class="topleft">
                            <p><?php echo $message['fullname']; ?><?php echo " <<i class='email'>{$message['email']}</i>>"; ?></p>
                            <p>Contact: <?php echo $message['contact']; ?></p>
                        </div>
                        <div class="topright">
                            <p><?php echo $message['date'] . " (" . datediff($message['date']) . ")"; ?></p>
                        </div>
                    </div>
                    <div class="message">
                        <p><?php echo $message['message']; ?></p>
                    </div>
                    <div class="actions">
                        <i onclick="del(<?php echo $message['id']; ?>)" class="del">Supprimer</i>
                        <a href="<?php echo "/immoplus/admin/messages" ?>" class="back">Retour</a>
                    </div>
                </div>
            </section>
        <?php elseif ($messages) : ?>
            <section id="multipleMessages">
                <?php foreach ($messages as $message) : ?>
                    <div class="messageBx">
                        <div class="icon">
                            <?php if ($message['etat'] == 0) : ?>
                                <ion-icon name="chatbox"></ion-icon>
                            <?php else : ?>
                                <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                            <?php endif; ?>
                        </div>
                        <div class="message">
                            <p>De : <?php echo $message['fullname']; ?></p>
                            <p>Envoyé le: <?php echo $message['date']; ?></p>
                            <a class="btn" href="?message_id=<?php echo $message['id']; ?>">voir</a>
                        </div>
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
                        url: "/immoplus/admin/_deletemessage.php",
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