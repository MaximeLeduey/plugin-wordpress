document.getElementById('select-all').onclick = function() {
    var checkboxes = document.querySelector('.page input');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}