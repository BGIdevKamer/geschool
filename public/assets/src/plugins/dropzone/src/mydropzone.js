const dropArea = document.querySelector('.myDrop-section');
const listSection = document.querySelector('.myListe-section');
const listContainer = document.querySelector('.myListe');
const fileSelector = document.querySelector('.myFile-selector');
const fileSelectorInput = document.querySelector('.myFile-selector-input');
const btn = document.getElementById('sendPieces');
const filesToUpload = [];
// Gestion du clic sur le bouton de sélection de fichier
fileSelector.onclick = (e) => {
    e.preventDefault();
    fileSelectorInput.click();
}

// Gestion du changement de fichier dans l'input
fileSelectorInput.onchange = () => {
    [...fileSelectorInput.files].forEach((file) => {
        if (typeValidation(file.type)) {
            filesToUpload.push(file); // Ajouter le fichier au tableau
            uploadFile(file); // Appel de la fonction pour gérer le fichier
        }
    })
}

// Gestion du survol de la zone de dépôt
dropArea.ondragover = (e) => {
    e.preventDefault(); // Empêche le comportement par défaut du navigateur
    [...e.dataTransfer.items].forEach((item) => {
        if (typeValidation(item.type)) {
            dropArea.classList.add('drag-over-effect'); // Ajoute la classe CSS pour le survol
        }
    });
}

// Gestion du départ de la zone de dépôt
dropArea.ondragleave = () => {
    dropArea.classList.remove('drag-over-effect'); // Supprime la classe CSS pour le survol
}

// Gestion du dépôt des fichiers
dropArea.ondrop = (e) => {
    e.preventDefault();
    dropArea.classList.remove('drag-over-effect');
    if (e.dataTransfer.items) {
        [...e.dataTransfer.items].forEach((item) => {
            if (item.kind === 'file') {
                const file = item.getAsFile();
                if (typeValidation(file.type)) {
                    filesToUpload.push(file); // Ajouter le fichier au tableau
                    uploadFile(file);
                }
            }
        })
    } else {
        [...e.dataTransfer.files].forEach((file) => {
            if (typeValidation(file.type)) {
                filesToUpload.push(file); // Ajouter le fichier au tableau
                uploadFile(file);
            }
        })
    }
}

// Validation du type de fichier
function typeValidation(type) {
    const splitType = type.split('/')[0];
    return (type === 'application/pdf' || splitType === 'image' || type === 'application/csv');
}

// Fonction pour gérer le téléchargement du fichier
function uploadFile(file) {
    listSection.style.display = 'block';
    var li = document.createElement('li');
    li.classList.add('myIn-prog');
    li.innerHTML = `
        <div class="myCol">
            <img src="${iconSelector(file.type)}" alt="">
        </div>
        <div class="myCol">
            <div class="myFile-name">
                <div class="myName">${file.name}</div>
                <span class="progress-percent">0%</span> </div>
            <div class="myFile-progress">
                <span class="progress-bar"></span>
            </div>
            <div class="myFile-size">${(file.size / (1024 * 1024)).toFixed(2)} Mo</div>
        </div>
        <div class="myCol">
            <i class="icon-copy fa fa-close" aria-hidden="true"></i>
            <i class="icon-copy fa fa-check" aria-hidden="true"></i>
        </div>
    `;
    listContainer.prepend(li);



    // Créer un lecteur de fichier pour la progression
    const reader = new FileReader();

    // Fonction à exécuter lors de la lecture du fichier
    reader.onload = (e) => {
        // Mettre à jour la barre de progression
        const percent_complete = (e.loaded / e.total) * 100;
        li.querySelector('.progress-percent').textContent = Math.round(percent_complete) + '%';
        li.querySelector('.progress-bar').style.width = percent_complete + '%';
    };
    // Lancer la lecture du fichier
    reader.readAsDataURL(file);
    btn.click();
}


function iconSelector(type) {
    var splitType = (type.split('/')[0] == 'application') ? type.split('/')[1] : type.split('/')[0];
    // console.log(`assets/vendors/images/${splitType}.PNG`);
    return `assets/vendors/images/${splitType}.PNG`;
}
