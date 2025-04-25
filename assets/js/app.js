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

document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.navbar-nav');
    if (navbar && navbar.querySelectorAll('li').length === 7) {
        navbar.classList.add('has-7-items');
    }
});
document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.navbar-nav');
    if (navbar && navbar.querySelectorAll('li').length === 8) {
        navbar.classList.add('has-8-items');
    }
});
document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.navbar-nav');
    if (navbar && navbar.querySelectorAll('li').length === 9) {
        navbar.classList.add('has-9-items');
    }
});