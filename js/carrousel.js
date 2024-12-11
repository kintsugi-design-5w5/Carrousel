(function () {
    // Sélectionner les éléments HTML nécessaires
    const carrousel = document.querySelector(".carrousel"); // Conteneur du carrousel
    if (carrousel) {
        const carrouselX = document.querySelector(".carrousel__x"); // Bouton de fermeture du carrousel
        const galerie = document.querySelector(".galerie"); // Conteneur des images de la galerie
        const carrouselFigure = document.querySelector(".carrousel__figure"); // Conteneur des images du carrousel
        const galerieImages = galerie.querySelectorAll(".projet-image img"); // Sélectionner toutes les images dans la galerie
        const fondNoir = document.querySelector(".fond"); // Fond sombre pour la superposition
        const centreur = document.querySelector(".centreur"); // Fond sombre pour la superposition
        const body = document.body; // Le corps de la page, utilisé pour empêcher le défilement lors de l'ouverture du carrousel
        let indexCarrousel = 0; // L'index de l'image actuellement affichée dans le carrousel

        // Créer les images dans le carrousel à partir des images de la galerie
        galerieImages.forEach((elm, index) => {
            creerImageCarrousel(index, elm); // Appeler la fonction pour créer chaque image
        });

        // Fonction pour créer les images du carrousel à partir des images de la galerie
        function creerImageCarrousel(index, elm) {
            const carrouselImg = document.createElement("img"); // Créer une nouvelle image pour le carrousel
            carrouselImg.classList.add("carrousel__img"); // Ajouter la classe pour les styles du carrousel
            carrouselImg.dataset.index = index; // Définir l'index de l'image pour la navigation
            elm.dataset.index = index; // Ajouter l'index à l'image dans la galerie pour la synchronisation
            carrouselImg.src = elm.src; // Assigner la source de l'image
            centreur.appendChild(carrouselImg); // Ajouter l'image au conteneur du carrousel

            // Ajouter un événement de clic à chaque image de la galerie pour ouvrir le carrousel
            elm.addEventListener("click", ouvrirCarrousel);
        }

        // Fonction pour ouvrir le carrousel et afficher l'image sélectionnée
        function ouvrirCarrousel(e) {
            indexCarrousel = parseInt(e.target.dataset.index);
            afficherImage(indexCarrousel);
            carrousel.classList.add("carrousel--ouvert");
            setTimeout(() => carrouselFigure.classList.add("carrousel--ouvrir"), 50);
            fondNoir.classList.add("fond__afficher");
            body.style.overflowY = "hidden";
        }

        // Fonction pour afficher l'image correspondant à l'index actuel
        function afficherImage(index) {
            document.querySelectorAll(".carrousel__img").forEach((img, i) => {
                img.classList.toggle("img--afficher", i === index); // Afficher l'image correspondant à l'index
                img.classList.remove("img--gauche", "img--droite", "img--transition"); // Retirer les classes de transition
            });
        }

        // Ajouter un événement de clic sur le fond sombre pour fermer le carrousel
        fondNoir.addEventListener("click", fermerCarrousel);
        // Ajouter un événement de clic sur le bouton de fermeture pour fermer le carrousel
        carrouselX.addEventListener("mousedown", fermerCarrousel);

        // Fonction pour fermer le carrousel
        function fermerCarrousel() {
            carrouselFigure.classList.remove("carrousel--ouvrir");
            setTimeout(() => {
                fondNoir.classList.remove("fond__afficher");
                carrousel.classList.remove("carrousel--ouvert");
                body.style.overflowY = "auto";
            }, 250);
        }

        // Sélectionner les boutons de navigation (flèches)
        const sectionGauche = document.querySelector(".avant"); // Flèche gauche (précédente)
        const sectionDroite = document.querySelector(".apres"); // Flèche droite (suivante)

        //selon la largeur de l'image, on la coupe en deux et on l'applique ax deux

        // Ajouter un événement de clic pour naviguer à gauche
        sectionGauche.addEventListener("click", () => {
            indexCarrousel = indexCarrousel > 0 ? indexCarrousel - 1 : galerieImages.length - 1; // Décrémenter l'index ou revenir à la dernière image
            afficherImageParFleche(indexCarrousel, "gauche"); // Afficher l'image correspondante
        });

        // Ajouter un événement de clic pour naviguer à droite
        sectionDroite.addEventListener("click", () => {
            indexCarrousel = indexCarrousel < galerieImages.length - 1 ? indexCarrousel + 1 : 0; // Incrémenter l'index ou revenir à la première image
            afficherImageParFleche(indexCarrousel, "droite"); // Afficher l'image correspondante
        });

        // Fonction pour afficher l'image en fonction de la direction de la flèche (gauche ou droite)
        function afficherImageParFleche(index, direction) {
            document.querySelectorAll(".carrousel__img").forEach((img, i) => {
                img.classList.remove("img--gauche", "img--droite", "img--transition", "img--afficher"); // Retirer toutes les classes de transition

                if (i === index) {
                    img.classList.add("img--transition", "img--afficher"); // Ajouter des classes pour l'animation
                } else if (img.classList.contains("img--afficher")) {
                    img.classList.add("img--" + direction); // Ajouter la classe de direction (gauche ou droite)
                }
            });
        }

        // Initialiser le carrousel avec l'image par défaut affichée
        afficherImage(indexCarrousel);
    }
})();
