// Ajout de commentaires détaillés en français pour expliquer chaque section du code

// Sélectionne le bouton permettant de basculer entre le mode sombre et le mode clair
const toggleBtn = document.getElementById('toggleDarkMode');

// Fonction exécutée lorsque la page est complètement chargée
window.onload = function () {
    // Récupère la valeur du cookie "dark_mode" pour déterminer si le mode sombre est activé
    const darkModeCookie = getCookie('dark_mode');

    // Si le cookie indique que le mode sombre est activé
    if (darkModeCookie === 'true') {
        // Ajoute la classe "dark-mode" au corps du document pour activer le mode sombre
        document.body.classList.add('dark-mode');
        // Met à jour l'icône du bouton pour refléter l'état actuel (mode sombre activé)
        updateToggleIcon(true);
    } else {
        // Supprime la classe "dark-mode" pour désactiver le mode sombre
        document.body.classList.remove('dark-mode');
        // Met à jour l'icône du bouton pour refléter l'état actuel (mode sombre désactivé)
        updateToggleIcon(false);
    }
};

// Fonction pour récupérer la valeur d'un cookie spécifique
function getCookie(name) {
    // Ajoute un point-virgule au début pour éviter les correspondances partielles
    const value = `; ${document.cookie}`;
    // Divise la chaîne de cookies pour trouver le cookie correspondant au nom donné
    const parts = value.split(`; ${name}=`);
    // Si le cookie existe, retourne sa valeur, sinon retourne null
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}

// Fonction pour définir un cookie avec un nom, une valeur et une durée en jours
function setCookie(name, value, days) {
    // Crée un objet Date pour calculer la date d'expiration
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    // Formate la date d'expiration en chaîne de caractères
    const expires = "expires=" + date.toUTCString();
    // Définit le cookie avec le nom, la valeur, la date d'expiration et le chemin
    document.cookie = `${name}=${value}; ${expires}; path=/`;
}

// Fonction pour mettre à jour l'icône du bouton de basculement en fonction de l'état du mode sombre
function updateToggleIcon(isDark) {
    // Si le bouton n'existe pas, ne fait rien
    if (!toggleBtn) return;
    // Change la classe de l'icône pour afficher un soleil (mode sombre activé) ou une lune (mode sombre désactivé)
    toggleBtn.querySelector('i').className = isDark ? 'fas fa-sun' : 'fas fa-moon';
}

// Ajoute un gestionnaire d'événements au bouton de basculement si celui-ci existe
if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
        // Bascule la classe "dark-mode" sur le corps du document
        document.body.classList.toggle('dark-mode');
        // Vérifie si le mode sombre est activé après le basculement
        const isDark = document.body.classList.contains('dark-mode');
        // Met à jour le cookie "dark_mode" pour enregistrer l'état actuel
        setCookie('dark_mode', isDark, 30);
        // Met à jour l'icône du bouton pour refléter l'état actuel
        updateToggleIcon(isDark);
    });
}
