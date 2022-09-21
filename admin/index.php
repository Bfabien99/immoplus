<?php include('includes/header.php'); ?>
<?php
  $properties = new Properties();
  $recent_properties = $properties->getRecent_properties();
  $all_properties = $properties->getAll_properties();

  $users = new Users();
  $recent_users = $users->getRecent_users();
  $all_users = $users->getAll_users();
?>
<h3 style="text-align: center;margin:1em;color:var(--black2)">Tableau de bord</h3>

<div class="cardBox">
  <div class="card">
    <div>
      <div class="numbers"><?php echo $all_users ? number_format(count($all_users),0,',','.') : 0;?></div>
      <div class="cardName">Utilisateurs</div>
    </div>
    <div class="iconBx">
      <ion-icon name="people"></ion-icon>
    </div>
  </div>
  <div class="card">
    <div>
      <div class="numbers"><?php echo $all_properties ? number_format(count($all_properties),0,',','.') : 0;?></div>
      <div class="cardName">Propriétés</div>
    </div>
    <div class="iconBx">
      <ion-icon name="home"></ion-icon>
    </div>
  </div>
  <div class="card">
    <div>
      <div class="numbers">1000</div>
      <div class="cardName">Messages</div>
    </div>
    <div class="iconBx">
      <ion-icon name="send"></ion-icon>
    </div>
  </div>
  <div class="card">
    <div>
      <div class="numbers">1000</div>
      <div class="cardName">Agents</div>
    </div>
    <div class="iconBx">
      <ion-icon name="globe"></ion-icon>
    </div>
  </div>
</div>

<div class="details">
  <div class="recentOrders">
    <div class="cardHeader">
      <h2>Propriétés recentes</h2>
      <a href="" class="btn">Tout voir</a>
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
        <?php if($recent_properties):?>
          <?php foreach($recent_properties as $property):?>
        <tr>
          <td><?php echo $property['title'] ?></td>
          <td><?php echo number_format($property['price'],0,',','.') ?></td>
          <td><?php echo $property['type'] ?></td>
          <td><?php echo datediff($property['post_date']) ?></td>
          <td><?php echo ($property['etat'] == 0) ? "<span class='status attente'>En attente</span>" : "<span class='status confirmer'>Confirmer</span>"?></td>
        </tr>
        <?php endforeach; ?>
        <?php else:?>
          <tr>
            <td colspan="5">Aucune propriété enregistrée</td>
          </tr>
        <?php endif;?>
      </tbody>
    </table>
  </div>

  <div class="recentCustomers">
  <div class="cardHeader">
      <h2>Utilisateurs recents</h2>
    </div>
    <table>
    <?php if($recent_users):?>
          <?php foreach($recent_users as $user):?>
    <tr>
        <td width="60px"><div class="imgBx"><img src="<?php echo $user['picture'] ?? ""?>" alt=""></div></td>
        <td><h4><?php echo $user['fullname']?></h4><span><?php echo datediff($user['insert_date']) ?></span></td>
    </tr>
    <?php endforeach; ?>
        <?php else:?>
          <tr>
            <td colspan="2">Aucun utilisateur enregistré</td>
          </tr>
        <?php endif;?>
    </table>
  </div>
</div>
<?php include('includes/footer.php'); ?>