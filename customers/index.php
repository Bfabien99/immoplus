<?php include('includes/header.php'); ?>
<?php
$properties = new Properties();
$recent_properties = $properties->getRecent_properties($user['id']);
$all_properties = $properties->getAll_properties($user['id']);

$active_properties = $inactive_properties = [];

if($all_properties){
    foreach ($all_properties as $property) {
    if($property['etat'] == 1){
        $active_properties[] = $property; 
    }else{
        $inactive_properties[] = $property; 
    }
}
}

?>
<h3 style="text-align: center;margin:1em;color:var(--black2)">Tableau de bord</h3>

<div class="cardBox">
    <div class="card">
        <div>
            <div class="numbers"><?php echo $all_properties ? number_format(count($all_properties), 0, ',', '.') : 0; ?></div>
            <div class="cardName">Propriétés</div>
        </div>
        <div class="iconBx">
            <ion-icon name="people"></ion-icon>
        </div>
    </div>
    <div class="card">
        <div>
            <div class="numbers"><?php echo $active_properties ? number_format(count($active_properties), 0, ',', '.') : 0; ?></div>
            <div class="cardName">Propriétés publiées</div>
        </div>
        <div class="iconBx">
            <ion-icon name="home"></ion-icon>
        </div>
    </div>
    <div class="card">
        <div>
            <div class="numbers"><?php echo $inactive_properties ? number_format(count($inactive_properties), 0, ',', '.') : 0; ?></div>
            <div class="cardName">Propriétés en attente</div>
        </div>
        <div class="iconBx">
            <ion-icon name="send"></ion-icon>
        </div>
    </div>
</div>

<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Propriétés recentes</h2>
            <a href="./property" class="btn">Tout voir</a>
        </div>
        <table>
            <thead>
                <tr>
                    <td>Titre</td>
                    <td>Prix</td>
                    <td>Type</td>
                    <td>Date</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                <?php if ($recent_properties) : ?>
                    <?php foreach ($recent_properties as $property) : ?>
                        <tr>
                            <td><?php echo $property['title'] ?></td>
                            <td><?php echo number_format($property['price'], 0, ',', '.') ?></td>
                            <td><?php echo $property['type'] ?></td>
                            <td><?php echo datediff($property['post_date']) ?></td>
                            <td><?php echo ($property['etat'] == 0) ? "<span class='status attente'>En attente</span>" : "<span class='status confirmer'>Confirmer</span>" ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">Aucune propriété enregistrée</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include('includes/footer.php'); ?>