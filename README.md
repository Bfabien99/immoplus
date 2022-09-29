<p align="center">
  <a href="" rel="noopener">
 <img width=200px height=200px src="https://i.imgur.com/6wj0hh6.jpg" alt="Project logo"></a>
</p>

<h3 align="center">Immoplus</h3>

<div align="center">

[![Status](https://img.shields.io/badge/status-active-success.svg)]()
[![GitHub Issues](https://img.shields.io/github/issues/kylelobo/The-Documentation-Compendium.svg)](https://github.com/kylelobo/The-Documentation-Compendium/issues)
[![GitHub Pull Requests](https://img.shields.io/github/issues-pr/kylelobo/The-Documentation-Compendium.svg)](https://github.com/kylelobo/The-Documentation-Compendium/pulls)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](/LICENSE)

</div>

---

<p align="center"> 
    Immoplus est une plateforme de vente et de gestion de bien immobilier en ligne.
    <br> 
    Immoplus permet aux personnes dans le besoin de pouvoir trouver la maison de leurs rêve.
    <br>
</p>

## 📝 Table of Contents

- [About](#about)
- [Getting Started](#getting_started)
- [Deployment](#deployment)
- [Usage](#usage)
- [Built Using](#built_using)
- [TODO](../TODO.md)
- [Contributing](../CONTRIBUTING.md)
- [Authors](#authors)
- [Acknowledgments](#acknowledgement)

## 🧐 About <a name = "about"></a>

<p>Grâce à Immoplus, vous pourrez mettre en vente ou en location votre bien. Avec un personnel qualifié, vous serrez soutenu durant tout le processus.</p>
<p>Immoplus ne se limite pas à cela, elle met à votre dispositions bien d'autres services.</p>

## 🏁 Getting Started <a name = "getting_started"></a>

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See [deployment](#deployment) for notes on how to deploy the project on a live system.

### Prerequisites

```
XAMMP OR WAMMP OR OTHER SERVER WITCH ALLOW PHP
```
Export database immoplus.sql
```
Run composer install (you need composer packagist)
```

## 🎈 Usage <a name="usage"></a>

<p>Les propriétés sont gérées grâce à une API.</p>
<p>Route : <span>/directory_name/api/v1/property</span> ou <span><a href="https://allmysite.000webhostapp.com/immoplus/api/v1/property">allmysite.000webhostapp.com/immoplus/api/v1/property</a></span></p>
<ul>
  <li><h3>GET api/v1/property</h3> => <i>obtenir toutes les propriétés</i></li>
  <li><h3>GET api/v1/property/:id</h3> => <i>obtenir une propriété par l'id</i></li>
  <li><h3>POST api/v1/property</h3> => <i>ajouter une nouvelle propriété</i></li>
  <li><h3>GET api/v1/property/location</h3> => <i>obtenir toutes les propriétés en location</i></li>
  <li><h3>GET api/v1/property/vente</h3> => <i>obtenir toutes les propriétés en vente</i></li>
</ul>
## Accéder à la plateforme en ligne
<p>Lien <a href='https://allmysite.000webhostapp.com/immoplus'>allmysite.000webhostapp.com/immoplus</a></p>

## Comment poster
<p>Les données postées doivent être sous le format JSON</p>
<p>Les champs de l'api </p>
<br>
<h4>
```
{
  *title, *description, *type = 'location' ou 'vendre', *address, *area, *price, *shower, *bedroom, picture
}
```
</h4>
<br>
<i>Tous ces champs(*) sont requis</i>

## 🚀 Deployment <a name = "deployment"></a>
```
Just use your server.
```

## ⛏️ Built Using <a name = "built_using"></a>

- [MySQL](https://www.MySQL.com/) - Database
- [PHP](https://php.net/) - Code Language

## ✍️ Authors <a name = "authors"></a>

- [@bfabien99](https://github.com/bfabien99) - Idea & Initial work


## 🎉 Acknowledgements <a name = "acknowledgement"></a>

- Hat tip to anyone whose code was used
- Inspiration
- References
