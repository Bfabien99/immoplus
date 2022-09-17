<?php include('includes/header.php'); ?>

<h3 style="text-align: center;margin:1em;color:var(--black2)">Tableau de bord</h3>

<div class="cardBox">
  <div class="card">
    <div>
      <div class="numbers">1000</div>
      <div class="cardName">Utilisateurs</div>
    </div>
    <div class="iconBx">
      <ion-icon name="people"></ion-icon>
    </div>
  </div>
  <div class="card">
    <div>
      <div class="numbers">1000</div>
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
        <tr>
          <td>propriété1</td>
          <td>10000</td>
          <td>Location</td>
          <td>Il y a 2 jours</td>
          <td><span class="status attente">En attente</span></td>
        </tr>
        <tr>
          <td>propriété2</td>
          <td>10000</td>
          <td>Vente</td>
          <td>Il y a 2 mois</td>
          <td><span class="status confirmer">Confirmer</span></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="recentCustomers">
  <div class="cardHeader">
      <h2>Utilisateurs recents</h2>
    </div>
    <table>
      <tr>
        <td width="60px"><div class="imgBx"><img src="/pexels-expect-best-323780.jpg" alt=""></div></td>
        <td><h4>user1</h4><span>Il y a 2 jours</span></td>
    </tr>
    <tr>
        <td width="60px"><div class="imgBx"><img src="/pexels-expect-best-323780.jpg" alt=""></div></td>
        <td><h4>user2</h4><span>Il y a 2 mois</span></td>
    </tr>
    </table>
  </div>
</div>
<?php include('includes/footer.php'); ?>