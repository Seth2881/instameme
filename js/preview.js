function previewImage() {
  const fileInput = document.getElementById('file'); // doit correspondre à l'id dans le HTML
  const imagePreviewContainer = document.getElementById('previewImageContainer');

  if (!fileInput || !imagePreviewContainer) {
    console.error('Élément manquant : vérifie les IDs "file" et "previewImageContainer".');
    return;
  }

  imagePreviewContainer.innerHTML = ''; // vide le conteneur

  const file = fileInput.files && fileInput.files[0];
  if (!file) return; // aucun fichier sélectionné

  if (!file.type.startsWith('image/')) {
    imagePreviewContainer.textContent = "Le fichier sélectionné n'est pas une image.";
    return;
  }

  const img = document.createElement('img');
  img.alt = file.name || 'aperçu image';
  img.id = 'previewimg';

  // URL.createObjectURL est rapide ; on révoque l'URL après chargement
  img.src = URL.createObjectURL(file);
  img.onload = () => URL.revokeObjectURL(img.src);

  imagePreviewContainer.appendChild(img);
}
