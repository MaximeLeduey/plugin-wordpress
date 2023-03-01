const select = document.getElementById('select-all'),
  page = document.getElementsByClassName('page');

console.log(select);

select.addEventListener("click", function () {
  var checkboxes = page;
  for (var checkbox of checkboxes) {
    checkbox.checked = this.checked;
  }
});

jQuery(document).ready(function () {

  var updateOutput = function () {
    $('#nestable-output').val(JSON.stringify($('#nestable').nestable('serialize')));
  };

  $('#nestable').nestable().on('change', updateOutput);

  updateOutput();

  $("#add-item").submit(function (e) {
    e.preventDefault();
    id = Date.now();
    let checkboxes = page;
    for (var checkbox of checkboxes) {
      if (checkbox.checked) {
        console.log("check");
        var label = checkbox.name;
        console.log(label);
        if ((label == "")) return;
        var item =
          '<li class="dd-item dd3-item" data-id="' + id + '" data-label="' + label + '">' +
          '<div class="dd-handle dd3-handle">Drag</div>' +
          '<div class="dd3-content">' +
          '<span>' + label + '</span>' +
          '<div class="item-edit">Edit</div>' +
          '</div>' +
          '<div class="item-settings d-none">' +
          '<p><label for="">Navigation Label<br><input type="text" name="navigation_label" value="' + label + '"></label></p>' +
          '<p><a class="item-delete" href="javascript:;">Remove</a> |' +
          '<a class="item-close" href="javascript:;">Close</a></p>' +
          '</div>' +
          '</li>';
        $("#nestable > .dd-list").append(item);
        $("#nestable").find('.dd-empty').remove();
        $("#add-item > [name='name']").val('');
        $("#add-item > [name='url']").val('');
        updateOutput();
        checkbox.checked = false;
        if (select.checked)
        {
          select.checked = false
        }
      } else {
        console.log("pas check");
      }
    }
  });

  $("body").delegate(".item-delete", "click", function (e) {
    $(this).closest(".dd-item").remove();
    updateOutput();
  });


  $("body").delegate(".item-edit, .item-close", "click", function (e) {
    var item_setting = $(this).closest(".dd-item").find(".item-settings");
    if (item_setting.hasClass("d-none")) {
      item_setting.removeClass("d-none");
    } else {
      item_setting.addClass("d-none");
    }
  });

  $("body").delegate("input[name='navigation_label']", "change paste keyup", function (e) {
    $(this).closest(".dd-item").data("label", $(this).val());
    $(this).closest(".dd-item").find(".dd3-content span").text($(this).val());
  });
});