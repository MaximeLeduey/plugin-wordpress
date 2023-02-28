const select = document.getElementById('select-all');

select.addEventListener("click", function() {
    var checkboxes = document.getElementsByClassName('page');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
});