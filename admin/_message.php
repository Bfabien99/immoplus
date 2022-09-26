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
<style>
    #singleMessage {
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 1200px;
        margin: auto;
    }

    .messageContentBx {
        display: flex;
        flex-direction: column;
        gap: 1em;
        width: 100%;
        padding: 20px;
        background-color: var(--white);
        border-radius: 5px 2px 15px 10px;
    }

    .messageContentBx .top {
        display: flex;
        justify-content: space-between;
    }

    .messageContentBx .top .email {
        color: var(--black2);
    }

    .messageContentBx .message {
        align-self: center;
        text-align: justify;
        padding: 20px;
        margin: 0.4em;
        font-style: normal;
        font-size: 1.2rem;
    }

    .messageContentBx .actions {
        display: flex;
        width: 300px;
        justify-content: center;
        align-items: center;
    }

    .messageContentBx .actions * {
        padding: 5px;
        text-decoration: none;
        cursor: pointer;
    }

    #multipleMessages {
        display: grid;
        grid-template-columns: repeat(1, minmax(300px, 400px));
        gap: 0.5em;
        margin: auto;
    }

    #multipleMessages .messageBx {
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        background-color: var(--white);
        padding: 15px;
        border-radius: 5px 2px 15px;
        box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.0.8);
    }

    #multipleMessages .messageBx .icon {
        font-size: 2rem;
        color: var(--green);
    }

    #multipleMessages .messageBx .message {
        display: flex;
        flex-direction: column;
    }

    #multipleMessages .messageBx .message .btn {
        max-width: 100px;
    }
</style>
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