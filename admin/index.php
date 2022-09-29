<?php include('includes/header.php'); ?>
<?php
$properties = new Properties();
$recent_properties = $properties->getRecent_properties();
$all_properties = $properties->getAll_properties();

$users = new Users();
$recent_users = $users->getRecent_users();
$all_users = $users->getAll_users();
$all_messages = $users->getAll_messages();
?>
<h3 style="text-align: center;margin:1em;color:var(--black2)">Tableau de bord</h3>

<div class="cardBox">
  <div class="card">
    <div>
      <div class="numbers"><?php echo $all_users ? number_format(count($all_users), 0, ',', '.') : 0; ?></div>
      <div class="cardName">Utilisateurs</div>
    </div>
    <div class="iconBx">
      <ion-icon name="people"></ion-icon>
    </div>
  </div>
  <div class="card">
    <div>
      <div class="numbers"><?php echo $all_properties ? number_format(count($all_properties), 0, ',', '.') : 0; ?></div>
      <div class="cardName">Propriétés</div>
    </div>
    <div class="iconBx">
      <ion-icon name="home"></ion-icon>
    </div>
  </div>
  <div class="card">
    <div>
      <div class="numbers"><?php echo $all_messages ? number_format(count($all_messages), 0, ',', '.') : 0; ?></div>
      <div class="cardName">Messages</div>
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

  <div class="recentCustomers">
    <div class="cardHeader">
      <h2>Utilisateurs recents</h2>
    </div>
    <table>
      <?php if ($recent_users) : ?>
        <?php foreach ($recent_users as $user) : ?>
          <tr>
            <td width="60px">
              <div class="imgBx"><img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoHCBURFRgSERYUGRgWHBgYGBgYGBgaGBwYGhgZGRkYHBoeIS4lHB4rHxgYJzgmKy8xNTU1HCQ7QDszPy41NTEBDAwMEA8QHRISGjQrJCgxOjQxMTc0NDQ+NDQ0NDQ0NDQxMTQxPTE0NjQ0NDYxNjQ0NjQ0MTQ0NDQ0NDQ0NDQ/NP/AABEIAOEA4QMBIgACEQEDEQH/xAAcAAEAAQUBAQAAAAAAAAAAAAAABgIDBAUHAQj/xABAEAACAQMABgcFBgUDBAMAAAABAgADBBEFBhIhMUEHIlFhcYGREzJSobEUI0JywdFDYoKSwjOislPS4fAWJCX/xAAZAQEAAwEBAAAAAAAAAAAAAAAAAgMEAQX/xAArEQEAAgIBAwIFAwUAAAAAAAAAAQIDETEEEiFBURMycYGxQmHRBRQiI5H/2gAMAwEAAhEDEQA/AOzREQEREBERAREQExry8p0FNSs6Iq7yzsFUeZkC106UKFkTRttmtWGQcHNND2Mw4kHkOHOcT01p670lU2rh3c56qD3F7lUbh4wOz6e6X7OhlbZWruN2R1aefzHeR4CQDSvS1pCtkUjTog/AuWH9TftI/YasvUxtnH8q729eAkosdVaS7yAO9usf2lVstY48ra4pnnwh9zrFfXBO3c3L54gVH2f7VOPlME2lZzkpVY9pDH5mdat9FUE4k+WFHymUtpbj8JPixkPjT7JfCj3caFlWXeEqDvCtM2303e2+Ni4uUxy9o4HpnE6ybW3+E+TGY1fRlBuBYeOD9Y+NPsfCj3RPRnSrpGhjbqLVHZUUZ9VxJ5oLpkt6uFu6b0mP4l6yfuPSRW+1XpNwCnw6pkX0hqsyZ9mT+Vv0MlXNWefCM4pjjy+mNG6Uo3SCpb1EqKeaMD5HsPcZnT5IsL+50fU9pRd6TjmOB7iODD1nYdTelunXxR0hs0nO4VRupk/zfB48JdHlU6tEoRgQCCCDvBG8ESuAiIgIiICIiAiIgIiICIiAiIgUOwUEkgAbyTwE4f0j9JrVi1pYMRTGVesNxftC9i8s85kdLmvZYto+0bqjdXdTxP8A01PYOZ8pzTRGjfaHbf3RwHaf2nLTFY3LtazadQo0bolq3WO5e3mfCS6wskpDCgD6nxMtowUYG7HCe+1mO+SbfRqrSKtqlyF3DdPftc1PtY9rK0m2+1x9rmp9rHtYG2+1x9rmp9rHtYG2+1zxrrO4zVe1j2sC/eWyVBhgCOw/p2SJ6T0M1PLJkrz7R+4kl9rPGfMnS9qz4RtSLcr/AEe9Iz6PK29yS9uSAOb0x2r2qPh9J9A21ylVFqU2DIwDKwOQQeBE+VtMaMxmpTG7mB9RJZ0V69GyqLaXLE29Q4Un+Gx4H8pPHs4zZW0WjcM1qzWdS+hIlKnO8cDKpJEiIgIiICIiAiIgIiICQzpM1pGjbU7B++rZSmOzd1n8APmRJnPmXpQ08b6+fZOUo/dIOXVPWPm2fQQI3ZW5ruSxJ37THmcnPqZJkwoAG4DhMTRlt7NAOZ3n9plzLlv3S0UrqFW1G1KYlaxVtRtSmIFW1G1KYgVbUbUpiBVtRtSmMQKtqNqUxA9LSOaXsvZttL7p+R7JIpZu6AqKUPPh3HlJ47dsoXr3Q6p0Pa2fa6BtKzZq0ANkk72p8AfEHcfKdKnyhqlph9H3lKuN2w2y47UO5wfLf5T6rpVA6hlOQQCD2gjIM1sy5ERAREQEREBERAREQNFrnpT7JZV644qjBfzN1V+Zny9o+n7SqM795Y9/P6zufTpeFLFKY/i1VB8EVm+oE4voBN7t2ACRvOqylWN2hu4iJjaiIiAiIgIiAICJudG6tXNxgqhVfifqjyHEyZaH1NpUiGq/eOO33B5c/OQm8QlFJlENB6uVLohmyifERvP5Rz8ZMNI6tU2oCjTXZ2d6Nz2v5jzzJSlsF/blPXTO4yi02md8La9seOXDrig1NjTcEMpwQZanUdYtXUuRn3XHuv8Ao3aJznSGjqlu2xUUjsP4T4GXUyRPj1V2pMefRiRESxBHdN0dl9ocGGfPnPoXoo0qbrR1PaOWpZpN29X3flicH0+mVVuw49ROk9AN4cXVA8AadQeJ2lb/AIrNeOd1hmvGpdkiIk0CIiAiIgIiICImq1k0utjbVbmpwpqSB8THcqjvLECByzp8vVP2agrAsvtHdeYBCBCezPWnOdX/AHX7cj6SmhSr6WvN5LVKzEsx4Acz4ASe60aAoWFKhToKMnb23PvMwC7yf0lGa9Y/x9ZW4qTPn0RxUYjIBI7QDierSY8FY+AM6NqfR2LZP5izHzO75ASRKJ509Tq0xpujD4iduNpZ1Dwp1D4Ix/SX6eh7huFGr5oR9Z2NVla0RJRmtPEI/DrHMuTUdVrp/wCHs/mIE2NtqNWb33RfUmdNWiOyXlpgchJxNpRnthBrPUOkN9R3fuHVH7yRWGr1Cj/p0kU/ERlvU5M3YEqku3fMud2uIYy2wHHfLmzjhLs8InYrEcOd0zytMJbYS8RKGEhaEqyxmExLq0SopR1VlPJhkTOcS04me0LqyhGktSkOWoOU/lbevkeMjGktAV7dS9RQUGMsDkbzgfMidWYTVacoe0oVU7UbHiN4+YEjXPaJiJ4dnFWYmYca03/pHxEk/QberSvqiOwX2tIqgO7acOhAHfja3S/qhoqjdvUpXChlNM8eKnaGGU8jIZrNoWpoy52FY7iHpONxIzuPiDPWw3r8vq8/LSfm9H1ZEjGoGsQ0jZpWJ+8XqVR2OuMnzBB85J5epIiICIiAiIgJyrp5vCtrQog7nqlmHaEU48st8p1Wci6faJ9jbPyDuvmVyPoYEe6HrIZr3BG8bNNT2Zyz/wCEkWvlItSR/gfHgGGPqBNJ0R3I9lXpc1dW8mXZ/wAJOdLWHt6FSn8S7vEbx8xPG6i0/wBxO/T+Hp4ax8H6rWr64t6Q/kWbdJptXWzb0weIXZPcVOCPlNykzfqn6r/0wyEl5ZZSXVmiimy6suCW1lxZpqplVERJIEREDwy20raUNI2SqtPLLy88svM911WO8xLsZRh/K30mY8wNIvso7HkrH5GZbctEIjqFRIao45YQepJ+glPS1ZipapWA61JwM/yOCCP7tmSHVbR5o267Qwz9dvPh8sTSdJ9yEsWQ8ajoo8jt/wCM047T/cRr1lReI+DO/Zi9AV4RUuaBPVZUqAd6kqT6MPQTt04R0CUCbm4fktNR5s+7/iZ3ee08siIgIiICIiAkV6RdBG/satJBmomKlPvdMnHmpZfOSqIHyrqfpr7BchnyEOUqDmBnjjtBE7pYXqsoYEMrDIYb9x5iQzpP6OnLte2CbQbJq0l94N8ajmDzHdzzu59oHWq4sTsKdpAd9N84B545rMXVdLOSYvTn8tWDPFY7bcfh3RaaqW2PdLFvNt5+eZlJIPqhrkL92pNTCMF2hhtoN2gDAxJtS3zy5pel5i8alvi1bViaz4ZKS8ssJLqy+iqy+srEtKZWDL6yqmF0T2UAz3MsiUNKp4Z5meExMmnhlDT0mUkyu0pxC20tNLjS08outqstMOvTV+o/unAPhnfMuocSI6360ro8J1NtnJ6u1s4A58Dzmftte8VrG5XbrWszbhKLm4GMDco4k7t37TivSFp8XdYU6RzTpZAI4Mx95v0ljT2u1xdgpupoeKrnf4sd8knRx0dVLqolzeIVt16wU7mqEcBjknae7HPM9PpultS3fk59I9mDPnia9teE96HNANaWXtagIe5YOQeIpgYpg+rN/VOhS2ihQABgDcAOQEuTeyEREBERAREQEREBIrrNqLZ6QDNUpKtQg4qJ1WzjdnHvb+2SqIHybQepoy86w69ByrDhkA4I8xO8aLvlrIlVDlXAYHxkL6cNCUldLxHRajgJUp5G0wHu1AOOcbj3AdhzH+jjWYUG+y1mwjnKMeCueXgfrMXW4JvXvrzH4a+myxWe2eJ/LtCS4sxbapncZliYKTuNw1WjU6XFlQMoWViXwqlWDPcykT2TiUXuZ4TE8MbFJMpaVGUNISnCgy08umY1epjxlN51G5WUjc+GNd1goJYgBQSSeAA4mcF1p0q1/dFkyQSEpjtGcA47Sd/nJj0kazgA2dFslv8AVYch8HiecxehvQlG4u/bVnTNDrJSJG0z8mweKrx8cdm/X0OCY/2W5nj6M3VZYn/CPTl0vU3o8tLOnTqVaSvcbIZnfLAORv2VO4Yk5AxwlUT0GMiIgIiICIiAiIgIieQPCccZyvX7pUW2LW2j9l6g3NVO9E7Qo/E3fwHfNR0pdIhctY2TYUZWtUU72PNFPIdpkG1Y1Wa7PtKmVpA8ebdy/vAwKdC50jVLkvUdj1nY7h4nl4SU6N1UpUsNU+8fs4ID4c5LbXRyU0FOkgRByHPvJ5mZKWfdJRCMyydEXrBAKh54U93ISSW10Dub1mha0wijHfNhZUSybuW6edn6SYt34vvH8NuHqYmO3J9pboCVgTVpWanx4d/CZtK+RuO6Zq5I3q3ifaV9qTrdfMfsyAJ7ieqQeBB8DK9mXxG1Uyt4nmJd2ZSxA4kDxMTDkSt4lJEoq3iLwOfCYNS4d9y8O79TKLZI3qPM+0La0tPmfEfuu3FwBuG8zQaTviFYIeuOfZ/5mzuKJVCx/wDSZrKNp7w7RNGDpLWnvy/aP5VZeoisduP/AKgGktW6VwS2CjnJLL7pJ5lZEL/RdxYuG3jBylRCcZ7iOBnYHs+6WKtkGUo6hkbcVYZBE9LUMW2FqH0rsCttpI5BwEr43juqDn+YefbOyUqiuoZSCrDIIOQQeYM+adaNUDRBrWwLUxvZeLL39pWbfoz6QWsXW2umLWzHAJ3mkTzB+DtHKRdfQkS3TqBwGUgggEEcCDwIlyAiIgIiICIiAnNOl/XA2dEWlucVqwO0wOClPgSOwtwHdmdEurhaSNUc4VFLMe5Rk/SfK2m9IVNKXr1N5as+yg7FzhF8h+sDL1M1cN7ULPkUqeNs9p5KP1nXqNoAAqqAqgBVAwABPNBaHS1opRQe6Ose1jxJ85uaVCSjw4wEtZkJazYpQl5aMbGE9vwHdPbP7uoFPBxgfmH7ibF6e+Yl/alkOzuZesD2EQNkbYHiJj1NFoeGR4TJ0Vdiugb8Q3MOxv8AzLeltKLbjHvOfdUcfE9glV8dL+LV2srktXzWdNJphUtE9o7gDkPxMewDnNMmtFP43HrNPp2lUq1/aVmLbQ6o/Co+FRymOLCeXmxYq21G4+6nJ/UM9Z1ERP1hIW1op/E59ZstC1kvQSjjK+8h98d+OyQz7BPbC0dayNRZkdTnaHYOIPaD2TmPHitaInc/dyn9RzzbWo+0Om09EqOOT9JkragbgMTF0Ppha33dTC1By5N3r+02N7XWkjO3LgO08hPUpipT5a6X2yXt807aPSfWdaY/D12/xH6y3Tt98uaPpMwao/vOcnw5DwmctPfLlbSPa7zMZ7WSCpR3yy9CNiOvb45Tl2verH2Y/aaI+7c4ZR+Bjw8jO01KE11/YJVR6bgFXBUg98T5Ea6F9by3/wCbcNnALUGJ34/FT/UeYnZJ8mXlGpo27wpIei4ZG7QDlT4ET6g1f0qt5b0rlOFRQ3gfxDyOZF1s4iICIiAiIgQfpe0gaGjKoBwarJSHgxy3+1WnIeizR4q3ZqMMiipYfmY7K/5ToPT25FpbryNYk+SNj6mRvobQbNw3PKDywxnYHTqNKZtOnLdFZnU0nXHiU5cVJdVZYuq2wgZfxEAec4KzTj2cv7MbMCOOHt3Y0/xDG/h3HxEtWOjjUcs5JJ3sxkgu7XbxjiPpLtKiEGBAi+tFsgTawBsLtDy5eciyaQUbiD6SV66nFCp3hV9WUH5EyDWlZ6a4ViJ5XXzWLR486Zs06tpnNpFOQPpN/qlSV/vMZ2yw8AN2JEbq6qOMM7H0kr1Bb7vHw1GHkVU/qZHou3v49EcU7tptNJ6Mwdpc9oI4gzzaq19hKhzs/PvPfiSR6YYYPAzGtrPYYn0nrtb1KQAAHLdKhTl/ZjZgY7pLbU5ctqu2zqeKNjy5S4MMMjeDwgYFSnMGtSm4qJMGss6OOdL2j9l6NwB74ZG8V3r8i0mXQTpAvaVaBP8Ao1MjuWouf+StNX0uUh9jVuYqLjzDTG6AHPtbpeRSkcd4ZwPqZyXXboiJwIiICIiBzHp2tS1jTqD+HWXPgyOM+uPWQ7oauQHuKXMhHHkSp+onYNdtD/brKvbj3mXK/mQhl+az5z1N0r9hvEqPkLk06g5hWOD6EA+UD6MoTPpTWW1QMAQcg7we6Z9J50ZTLtKR2gj5SOvWbqUnHuNJEjTT6VYe2XwX6wN7sxsyoT3E4KNmNmV4jECG66n7oj4nUeQyf0Eh6Juku1yPVQdrMflI2qbp43XTvKyZvNmurU5JtQ23VF7GRvUEH6CaKuk3OozYq1F7VB9DO9JOskK8c6vDomzGzKl4Ce4nsN6jZjZleIgRqvcslSoE4tum4tKZRFU8QN81aMPtJz8R+k3LNOizUmHWmTUeYNZ4HN+mG5C21OnzepnyVTv+YnvQBanN1W5fdUx49dj/AI+shvSbpoXV1sIcpQGwDyLE5c+oA8p2Pom0KbPR6bYw9cmsw5gMAFB/pAiRN4iJwIiICIiAnz90waom1rm8or9zXPXwNyVTxz2BuPjmfQMxNIWNO4ptRrKGRwQyngR+8DinRrroMCzumwRgUnJ4j4GPb2GdXpVJwvX3UCtoxjVpBntycq44p3N2eMv6pdI1S2xSu9qpTGAGHvr/ANw+fjO7HeEqTT6RqZr/ANss6H09QukD0KiuOwHrDxHETHva333mv6TriZK8rDTAStLi1px1m7UMd0xRVnrVN04Ilre2XRewE+pmlVd02esz7VcDsUTAVd08Lq53lllv80sKuszdT32bnHxIw+hmNcLPdX6mxdUz2kj1En006vCiJ1ePq6lTbcJVtTFSpug1Z7b0WQWlDPMdqsttWgadqmLnP883L1JGK1b/AOx/WJnaS0rTt0NSs6oo5scenbOuM+pUnO+kTXMWyG2t2BrNuZhwRTxP5jyHnNFrZ0mFwaVgCo4NVYdY/lHLxPpI5qfqfcaWq5GVp5zUrNnHHeB8TGc26yejbVRtJ3QZwfY0iGqseDHiEzzJ590+lUUKAAMAbgOwCa7QOhKNhRW3t12VXiebNzZjzJm0nAiIgIiICIiAiIgWqtMOpVgCp3EEZBHYQZy7W7ohpViatgwpMd5pHfTJ/l5r4cPCdWiB8paT0LfaKfNRKtIjg6k7J7MONx8JsdHa/wBwhBrhauMbz1W3d43H0n0vXorUUq6qynirAEHxBkL010XaOuclaZosfxUjsj+05X5QI1ozpStHwKoeme8bS+qyUWWtFrW/07ik39YB+cg2lOhSquTa3CMOS1FKn1GRIpfdGmk6P8Db76bBv2M7sd5S7VvdYHwIMuGvPmqpo6/tzvp3aY5hagHqN0U9Zb6nuFzXBHIsc/ONjtGlX2q7nswPQTxRunGf/lV5ksa7kniSFP1EvDXO9Ax7b/an7Ty8vRXvabRMeZU2xzM7dWuBMK1qbFam3Y6/XE5o2t14eNX/AGp+0sHWS6JB9q2QcjAA3+kni6S9JiZmFU4LTO4mH0uK8oe6A4kDxM+bautN7U3Nc1jnsYj6TxLa+uOCXdTPPFRh68J6O2t9AXusdtSGalekvi4/SRnSfSbZU8hC9RhyRcD+47pzqz6OtJ1jutmXPNyF+pzJTovoWuHwbmvTpjmEBdvInAjYj+lukOvUYtQVaWTkMeuw7xncD5GaOhbXulKmFFau5O87yo8T7q/Kdw0P0TaPt8NUV67D/qNhf7VwPXMnFnZ06KhKKIijgqqFHoJwck1T6HgCtTSL5xv9ih3HuZ+OO4YnW7O0Sgi0qKKiqMKqgAADuEyYgIiICIiAiIgIiICIiAiIgIiICIiBbrcJFdYfcPjEQOKayfj/ACH9ZDIiAko1a/h+LfUxEDtOqvuD+n6SaW3uxEC/ERAREQEREBERAREQERED/9k=" alt=""></div>
            </td>
            <td>
              <h4><?php echo $user['fullname'] ?></h4><span><?php echo datediff($user['insert_date']) ?></span>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="2">Aucun utilisateur enregistré</td>
        </tr>
      <?php endif; ?>
    </table>
  </div>
</div>
<?php include('includes/footer.php'); ?>