# hypnosEvaluation
Pour un déploiement local:
J'ai utilisé VSCODE pour la rédaction des lignes de code, Laragon pour un serveur local Apache et un serveur de base de données MySQL, 
j'ai également ajouté à Laragon l'extension Xdebug pour la debogage de PHP sur VSCODE.
J'ai mis à jour PHP initialement en 7.4 sur Laragon vers la version 8.1.
Mon fichier hypnos.sql contient les scripts de création de la base de données nécessaire à l'application.
Ce même fichier sql a été épuré des scripts de correction tels que DROP TABLE ou encore ALTER TABLE afin d'être plus lisible.

Pour le déploiement en ligne il a été réalisé grâce à Heroku pour les scripts de l'application web et sont extension JawsDB MySQL pour le lien avec la base de données. J'ai créé un profil pour chacun rôle afin de pouvoir effectuer des tests facilement: par sécurié puisque le lien GitHub est public je l'ai ajouté à ma copie Studi.
