const select = document.getElementById('select-all');

console.log(select);

select.addEventListener("click", function() {
    var checkboxes = document.getElementsByClassName('page');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
});