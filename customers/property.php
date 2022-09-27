<?php include('includes/header.php'); ?>
<?php
$properties = new Properties();
$properties = $properties->getAll_properties($user['id']);

if(isset($_POST['search'])){
    $_properties = new Properties();
    
        $sql = "select * from property where";
    if (!empty(trim(strip_tags($_POST['searchprice'])))) {
        $sql .= " price <= " . $_POST['searchprice'] . " AND";
    }
    if (!empty(trim(strip_tags($_POST['searcharea'])))) {
        $sql .= " area <= " . $_POST['searcharea'] . " AND";
    }
    if (!empty(trim(strip_tags($_POST['searchaddress'])))) {
        $sql .= " address like '%" . $_POST['searchaddress'] . "%' AND";
    }

    if (!empty($_POST['searchprice']) || !empty($_POST['searcharea']) || !empty($_POST['searchaddress'])) {
        $sql = substr($sql, 0, -3);
        $sql = rtrim($sql);
        $sql .= " AND _userId = ".$user['id']." etat = 1 order by price ASC";
        $results = $_properties->getSearched_properties($sql);
        if (!$results) {
            $search_error = "<i style='color:red'>Aucun resultat trouvé</i>";
        }else{
            $properties = $results;
        }
    }
    
}
?>
<div class="container">
<h3 style="text-align: center;margin:1em;color:var(--black2)">Toutes les propriétés</h3>
    <a href="./property/add" class="btn">Ajouter une nouvelle propriété</a>
    <?php if (!empty($properties)) : ?>
        <form action="" method="post" id="searchForm">
            <?php echo $search_error ?? ""?>
            <div class="inputBox">
                <input type="number" name="searchprice" id="searchprice" placeholder="Rechercher par prix inférieur ou égale à" min=5000>
                <input type="number" name="searcharea" id="searcharea" placeholder="Rechercher par superficie inférieure ou égale à" min=50>
                <input type="text" name="searchaddress" id="searchaddress" placeholder="Rechercher par localité">
                <button type="submit" name="search">Rechercher</button>
            </div>
            </form>
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