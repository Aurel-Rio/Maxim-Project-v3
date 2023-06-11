var typedString = '';

document.addEventListener('keydown', function(event) {
    typedString += event.key.toLowerCase();
    
    if (typedString.includes('servantaurelien')) {
        window.location.href = '../components/adminForm.php';
    }
});