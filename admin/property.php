<?php include('includes/header.php'); ?>
<?php
// MyAPI url
$url = 'http://localhost/immoplus/api/v1/property';

// Get Data from Api
$response = GetDataFromMyApi($url);
// Decode API response to array
$data = json_decode($response, JSON_UNESCAPED_UNICODE);
$properties = [];
if ($data) {
    if ($data['statusCode'] == 200)
        foreach ($data['data']['properties'] as $property) {
            $properties[] = $property;
        }
}

?>
<div class="container">
    <?php if (!empty($properties)) : ?>
        <div class="properties">
            <?php foreach ($properties as $property) : ?>
                <div class="property">
                    <div class="imgBx" style="background-image:url('<?php echo $property['picture'] ?? 'https://images.unsplash.com/photo-1518780664697-55e3ad937233?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8aG91c2V8ZW58MHx8MHx8&auto=format&fit=crop&w=1100&q=60' ?>')">
                    </div>
                    <div class="contentBx">
                        <h3 class="title"><?php echo $property['title'] ?></h3>
                        <section class="description">
                            <?php echo $property['description'] ?>
                        </section>
                        <a href="./property/view/<?php echo $property['id'] ?>" class="see">Voir</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <h4>Aucune propriété pour l'instant</h4>
    <?php endif; ?>
</div>
<?php include('includes/footer.php'); ?>