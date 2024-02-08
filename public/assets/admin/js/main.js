document.getElementById('language').addEventListener('change', function() {
    var languageId = this.value;
    var rows = document.querySelectorAll('#blogTableBody tr');
    rows.forEach(function(row) {
        if (languageId === '') {
            row.style.display = 'table-row';
        } else {
            var langClass = 'language-' + languageId;
            if (row.classList.contains(langClass)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        }
    });
});
