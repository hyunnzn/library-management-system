document.addEventListener('DOMContentLoaded', () => {
    const panel = document.getElementById('addBookPanel');
    const show = document.getElementById('showAddForm');
    const hide = document.getElementById('hideAddForm');
    if (panel && show && hide) {
        show.addEventListener('click', () => {
            panel.hidden = false;
            panel.scrollIntoView({behavior: 'smooth', block: 'center'});
            panel.querySelector('input[name="title"]')?.focus();
        });
        hide.addEventListener('click', () => { panel.hidden = true; });
    }
});
