const fileInput = document.getElementById('fileInput');
    const nameFile = document.getElementById('nameFile');
    const customLabel = document.querySelector('.custom-file-label');
    const errorMessage = document.getElementById('errorMessage'); // Ajouter un élément pour afficher l'erreur

    // Types d'images autorisés
    const allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp'];

    fileInput.addEventListener('change', function () {
        if (this.files.length > 0) {
            const file = this.files[0];
            const fileName = file.name;
            const fileType = file.type;

            // Vérifier si le fichier est une image
            if (allowedImageTypes.includes(fileType)) {
                nameFile.textContent = fileName; // Afficher le nom du fichier
                customLabel.textContent = `Fichier sélectionné: ${fileName}`; // Mettre à jour le label
                errorMessage.textContent = ''; // Réinitialiser le message d'erreur s'il y en avait un
            } else {
                nameFile.textContent = 'Aucun fichier choisi'; // Message par défaut
                customLabel.textContent = 'Choisir un fichier'; // Réinitialiser le label
                errorMessage.textContent = 'Veuillez sélectionner une image valide (JPG, PNG, GIF, BMP, WEBP).'; // Afficher l'erreur
            }
        } else {
            nameFile.textContent = 'Aucun fichier choisi'; // Message par défaut si aucun fichier n'est sélectionné
            customLabel.textContent = 'Choisir un fichier'; // Réinitialiser le label
            errorMessage.textContent = ''; // Réinitialiser le message d'erreur
        }
    });
