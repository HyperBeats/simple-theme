document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM chargé, initialisation des boutons .server-ip');
    const buttons = document.querySelectorAll('.server-ip');
    let isAnimating = false;

    buttons.forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();
            if (isAnimating) {
                console.log('Clic ignoré : animation en cours');
                return;
            }

            console.log('Clic sur le bouton, début de la copie');
            isAnimating = true;
            const textToCopy = button.dataset.clipboardText;
            const originalText = button.textContent;
            const copyMessage = button.dataset.copyMessage;

            try {
                await navigator.clipboard.writeText(textToCopy);
                console.log(`Texte copié avec succès : ${textToCopy}`);
                button.textContent = copyMessage;
            } catch (err) {
                console.error('Échec de la copie :', err);
                button.textContent = 'Erreur de copie';
            }

            button.style.pointerEvents = 'none';
            console.log('Bouton désactivé (pointerEvents: none)');

            setTimeout(() => {
                button.textContent = originalText;
                button.style.pointerEvents = 'auto';
                isAnimating = false;
                console.log('Bouton réinitialisé : texte et interactions restaurés');
            }, 2000);
        });
    });
});