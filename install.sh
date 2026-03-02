#!/bin/bash

# Couleurs pour les messages
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Fonction pour afficher les titres
print_title() {
    echo -e "\n${BLUE}═══════════════════════════════════════════════════════════════${NC}"
    echo -e "${BLUE}  $1${NC}"
    echo -e "${BLUE}═══════════════════════════════════════════════════════════════${NC}\n"
}

# Fonction pour afficher les succès
print_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

# Fonction pour afficher les warnings
print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

# Fonction pour afficher les erreurs
print_error() {
    echo -e "${RED}❌ $1${NC}"
}

clear
print_title "🚀 INSTALLATION DU PROJET LARAVEL TEST"

# Vérifier que les commandes nécessaires existent
command -v php >/dev/null 2>&1 || { print_error "PHP n'est pas installé. Installe PHP 8.1+"; exit 1; }
command -v composer >/dev/null 2>&1 || { print_error "Composer n'est pas installé"; exit 1; }
command -v npm >/dev/null 2>&1 || { print_error "NPM n'est pas installé"; exit 1; }
command -v mysql >/dev/null 2>&1 || { print_warning "MySQL n'est pas trouvé en ligne de commande, assure-toi qu'il est installé"; }

print_success "Vérifications initiales OK"
sleep 1

# Étape 1: Installation des dépendances PHP
print_title "📦 ÉTAPE 1/7 - Installation des dépendances PHP"
echo "Installation de Composer..."
composer install --no-interaction
if [ $? -eq 0 ]; then
    print_success "Dépendances PHP installées"
else
    print_error "Erreur lors de l'installation des dépendances PHP"
    exit 1
fi
sleep 1

# Étape 2: Installation des dépendances Node.js
print_title "🎨 ÉTAPE 2/7 - Installation des dépendances Node.js"
echo "Installation de NPM..."
npm install
if [ $? -eq 0 ]; then
    print_success "Dépendances Node.js installées"
else
    print_error "Erreur lors de l'installation des dépendances Node.js"
    exit 1
fi
sleep 1

# Étape 3: Configuration du fichier .env
print_title "🔧 ÉTAPE 3/7 - Configuration du fichier .env"
if [ -f .env ]; then
    print_warning "Le fichier .env existe déjà. Création d'une sauvegarde .env.backup"
    cp .env .env.backup
else
    cp .env.example .env
    print_success "Fichier .env créé depuis .env.example"
fi

# Génération de la clé
php artisan key:generate
print_success "Clé d'application générée"
sleep 1

# Étape 4: Configuration de la base de données
print_title "📊 ÉTAPE 4/7 - Configuration de la base de données"

echo ""
echo "Modifie maintenant le fichier .env avec tes identifiants MySQL :"
echo ""
echo "   DB_DATABASE=laravel_test"
echo "   DB_USERNAME=root"
echo "   DB_PASSWORD=ton_mot_de_passe"
echo ""
read -p "As-tu modifié le fichier .env ? (y/n) " -n 1 -r
echo ""
if [[ ! $REPLY =~ ^[Yy]$ ]]
then
    print_error "Tu dois configurer la base de données avant de continuer"
    exit 1
fi

# Demander si la base de données est créée
read -p "As-tu créé la base de données 'laravel_test' dans MySQL ? (y/n) " -n 1 -r
echo ""
if [[ ! $REPLY =~ ^[Yy]$ ]]
then
    echo ""
    echo "Crée la base de données avec cette commande :"
    echo "   mysql -u root -p -e 'CREATE DATABASE laravel_test;'"
    echo ""
    read -p "Appuie sur Entrée une fois la base créée..." -n 1 -r
fi

print_success "Configuration base de données OK"
sleep 1

# Étape 5: Migrations et seeders
print_title "📦 ÉTAPE 5/7 - Migrations et seeders"
echo "Exécution des migrations..."
php artisan migrate --force
if [ $? -eq 0 ]; then
    print_success "Migrations exécutées"
else
    print_error "Erreur lors des migrations. Vérifie tes identifiants dans .env"
    exit 1
fi

echo "Exécution des seeders..."
php artisan db:seed --force
print_success "Seeders exécutés"
sleep 1

# Étape 6: Compilation des assets
print_title "🎨 ÉTAPE 6/7 - Compilation des assets"
echo "Compilation des assets pour la production..."
npm run build
if [ $? -eq 0 ]; then
    print_success "Assets compilés avec succès"
else
    print_warning "Erreur lors de la compilation, tentative avec npm run dev..."
    npm run dev
fi
sleep 1

# Étape 7: Création de l'utilisateur administrateur
print_title "👤 ÉTAPE 7/7 - Création de l'utilisateur administrateur Filament"
echo "Tu vas maintenant créer un compte administrateur pour accéder à /admin"
echo ""

php artisan make:filament-user

if [ $? -eq 0 ]; then
    print_success "Administrateur créé avec succès"
else
    print_warning "Tu pourras créer un admin plus tard avec : php artisan make:filament-user"
fi

# Optimisation
print_title "⚡ Optimisation du projet"
php artisan config:cache
php artisan route:cache
php artisan view:cache
print_success "Cache optimisé"

# Message final
clear
print_title "✅ INSTALLATION TERMINÉE AVEC SUCCÈS !"

echo -e "${GREEN}"
echo "╔══════════════════════════════════════════════════════════════╗"
echo "║                     PROJET PRÊT À L'EMPLOI                   ║"
echo "╚══════════════════════════════════════════════════════════════╝"
echo -e "${NC}"

echo -e "${BLUE}📌 COMMANDES UTILES :${NC}"
echo ""
echo "  ${GREEN}Lancer le serveur :${NC}"
echo "  php artisan serve"
echo ""
echo "  ${GREEN}Accès :${NC}"
echo "  • Site public : http://127.0.0.1:8000"
echo "  • Administration : http://127.0.0.1:8000/admin"
echo ""
echo "  ${GREEN}Identifiants par défaut :${NC}"
echo "  • Utilisateurs créés via seeder (si tu as des seeders)"
echo "  • Admin : celui que tu viens de créer"
echo ""
echo "  ${GREEN}Si tu veux plus de données de test :${NC}"
echo "  php artisan db:seed"
echo ""
echo -e "${BLUE}═══════════════════════════════════════════════════════════════${NC}"
echo -e "${YELLOW}🚀 Bon développement !${NC}"
echo ""