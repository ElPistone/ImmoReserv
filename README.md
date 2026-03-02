# 🏠 Application de Gestion de Réservations Immobilières

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-3-FB70A9?style=for-the-badge&logo=livewire&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-3-FFB703?style=for-the-badge&logo=filament&logoColor=black)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

## 📋 Description

Application web complète de gestion de réservations immobilières développée avec Laravel. Elle permet aux utilisateurs de parcourir des biens immobiliers, effectuer des réservations et gérer leurs séjours, tandis que les administrateurs disposent d'un panneau d'administration complet.

### ✨ Fonctionnalités principales

- **🔐 Authentification complète** (Inscription, Connexion, Mot de passe oublié) avec Laravel Breeze
- **🏘️ Gestion des propriétés** : Liste, détail, recherche
- **📅 Système de réservation** :
  - Sélection de dates avec validation
  - Calcul automatique du prix total
  - Vérification de disponibilité en temps réel
  - Gestion des statuts (confirmée, en-cours, annulée)
- **👤 Espace utilisateur** :
  - Consultation des réservations
  - Annulation des réservations modifiables
- **⚡ Interface dynamique** avec Livewire (pas de rechargement de page)
- **🛠️ Panneau d'administration** avec Filament :
  - CRUD complet pour les propriétés
  - CRUD complet pour les réservations
  - Filtres et recherches avancés
- **🎨 Design responsive** avec TailwindCSS

## 🚀 Technologies utilisées

| Technologie | Version | Utilisation |
|------------|---------|-------------|
| PHP | 8.2.12 | Langage backend |
| Laravel | 12 | Framework PHP |
| Livewire | 3 | Composants dynamiques |
| Filament | 3 | Panneau d'administration |
| TailwindCSS | 3 | Framework CSS |
| MySQL | 8 | Base de données |
| Composer | 2 | Gestionnaire de dépendances PHP |
| NPM | 10 | Gestionnaire de dépendances JS |

## 📦 Installation

### Prérequis
- PHP ≥ 8.2
- Composer
- MySQL ≥ 8.0
- Node.js & NPM
- Git

### Installation automatique (recommandée)

```bash
# Cloner le projet
git clone https://github.com/ElPistone/ImmoReserv


cd laravel-test

# Rendre le script exécutable
chmod +x install.sh

# Lancer l'installation interactive
./install.sh
```
### Développement
Author : Mamadou Dian Diaby
