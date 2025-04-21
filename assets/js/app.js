document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM loaded, initializing .server-ip buttons');
    const buttons = document.querySelectorAll('.server-ip');
    let isAnimating = false;

    buttons.forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();
            if (isAnimating) {
                console.log('Click ignored: animation in progress');
                return;
            }

            console.log('Button clicked, starting copy process');
            isAnimating = true;
            const textToCopy = button.dataset.clipboardText;
            const originalText = button.textContent;
            const copyMessage = button.dataset.copyMessage;

            try {
                await navigator.clipboard.writeText(textToCopy);
                console.log(`Text copied successfully: ${textToCopy}`);
                button.textContent = copyMessage;
            } catch (err) {
                console.error('Copy failed:', err);
                button.textContent = 'Copy error';
            }

            button.style.pointerEvents = 'none';
            console.log('Button disabled (pointerEvents: none)');

            setTimeout(() => {
                button.textContent = originalText;
                button.style.pointerEvents = 'auto';
                isAnimating = false;
                console.log('Button reset: text and interactions restored');
            }, 2000);
        });
    });
});