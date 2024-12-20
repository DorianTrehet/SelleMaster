# Makefile

.PHONY: start stop db-init db-reset fixtures

# Lancer le serveur Symfony
start:
	@symfony serve

# Arrêter le serveur Symfony
stop:
	@echo "Arrêt du serveur Symfony..."
	@kill -9 $(shell lsof -t -i:8000) || true

# Initialiser la base de données (création et mise à jour du schéma)
db-init:
	@symfony console doctrine:database:create --if-not-exists
	@symfony console doctrine:schema:update --force

# Réinitialiser la base de données (supprimer et recréer)
db-reset:
	@symfony console doctrine:database:drop --force --if-exists
	@symfony console doctrine:database:create --if-not-exists
	@symfony console doctrine:schema:update --force

# Importer les fixtures
fixtures:
	@symfony console doctrine:fixtures:load --no-interaction

