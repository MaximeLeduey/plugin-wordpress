const select = document.getElementById('select-all'),
    pages = document.getElementsByClassName('page');


select.addEventListener("click", function () {
    var checkboxes = pages;
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
        let checkboxes = pages;
        for (var checkbox of checkboxes) {
            if (checkbox.checked) {

                var checkId = checkbox.id;
                var label = checkbox.name;
                var url = $(`#${checkId}`).data("url");

                if ((label == "")) return;
                var item =
                    '<li class="dd-item dd3-item" data-id="' + checkId + '" data-label="' + label + '" data-url="' + url + '">' +
                    '<div class="dd-handle dd3-handle" > Drag</div>' +
                    '<div class="dd3-content"><span>' + label + '</span>' +
                    '<div class="item-edit">Edit</div>' +
                    '</div>' +
                    '<div class="item-settings d-none">' +
                    '<p><label for="">Navigation Label<br><input type="text" name="navigation_label" value="' + label + '"></label></p>' +
                    '<p><label for="">Navigation Url<br><input type="text" name="navigation_url" value="' + url + '"></label></p>' +
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
                if (select.checked) {
                    select.checked = false
                }
            }
        }
    });

    $("#add-menu").submit(function (e) {
        e.preventDefault();
        // $("#result").remove();

        id = Date.now();
        var menu = $("#add-menu > [name='menu']").serialize();
        console.log(menu)

        $.ajax({
            url: 'http://gestionplugin.test/wp-content/plugins/plugin-wordpress/menu.php',
            method: 'POST',
            data: menu,
            success: function (response) {
                $('#result').fadeIn().text("Vous avez enregistré le menu").delay(2000).fadeOut();
            },
            error: function (response) {
                console.log('Erreur…');
            }
        });
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
    $(this).closest(".dd-item").remove();
    $('.dd-list').bind('DOMSubtreeModified', function () {
        if ($('.dd-list').is(':empty')) {
            $('.is-empty').addClass('d-none');
        }
        else {
            $('.is-empty').removeClass('d-none');
        }
    });

    $("#sup").submit(function (e) {
        e.preventDefault();
        var div = '<div class="dd-empty"></div>';
        $(".dd-list").children().closest(".dd-item").remove();
        $("#nestable").prepend(div);
    });
});