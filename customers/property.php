<?php include('includes/header.php'); ?>
<?php
$properties = new Properties();
$properties = $properties->getAll_properties($user['id']);
?>
<div class="container">
<h3 style="text-align: center;margin:1em;color:var(--black2)">Toutes les propriétés</h3>
    <a href="./property/add" class="btn">Ajouter une nouvelle propriété</a>
    <?php if (!empty($properties)) : ?>
        <div class="properties">
            <?php foreach ($properties as $property) : ?>
                <div class="property">
                    <div class="imgBx">
                    <?php echo $property['type'] == 'location' ? "<span class='type location'>En location</span>" : "<span class='type vente'>En vente</span>";?>
                    <?php echo $property['etat'] == 0 ? "<span class='status attente'>En attente</span>" : "<span class='status confirmer'>Confirmer</span>";?>
                    <a href="./property/view/<?php echo $property['id'] ?>"><img src="<?php echo $property['picture']?>" alt=""></a>
                    </div>
                    <div class="contentBx">
                        <h3 class="title"><?php echo $property['title'] ?></h3>
                        <p class="price">
                            <?php echo number_format($property['price'],0,',','.') ?> FCFA
                        </p>
                        <p>
                        <?php echo datediff($property['post_date']) ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <h4>Aucune propriété pour l'instant</h4>
    <?php endif; ?>
</div>
<?php include('includes/footer.php'); ?>