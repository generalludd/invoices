$(document).on("click", ".create.dialog,.edit.dialog", function (e) {
    e.preventDefault();
    show_popup(this);

});

$(document).on('click', '.checkbox-required :checkbox', function (e) {
    let me = $(this);
    let my_siblings = me.parents(".checkbox-required").children(".checkbox").children("label");
    if (my_siblings.children("input:checked").length > 0) {
        my_siblings.children("input").attr("required", false);
    } else {
        my_siblings.children("input").attr("required", true);

    }
});

$(document).on("click", "input[type='submit'].inline", function (e) {
    e.preventDefault();
    let my_form = $(this).parents('form');
    let my_action = my_form.attr("action");
    let my_parent = $(this).parents(".rows").attr("id");
    let form_data = $($(this).parents('form')).serialize();
    $.ajax({
        method: "post",
        data: form_data + "&ajax=1",
        url: my_action,
        success: function (data) {
            $("#" + my_parent).append(data);
            $(my_form).parents(".row").remove();
            $(".rows .btn.create.inline").fadeIn();
        }

    });
});
$(document).ready(function () {
    $('.delete').on('click', function (e) {
        e.preventDefault();
        delete_entity(this);
    });
});
$(document).on("blur", ".year", function () {
    let my_id = this.id;
    let my_val = Number($(this).val());
    $("#" + my_id + "-next").val(my_val + 1);
});

$(document).on("click", ".po-details", function (e) {
    e.preventDefault();
    let me = this;
    let my_parent = $(me).parents("tr");
    let my_id = my_parent.attr("id").split("_")[1];
    if ($(me).hasClass("hider")) {
        $(me).html("Show Items").removeClass("hider");
        $("#details-row_" + my_id).fadeOut();

    } else {
        $(me).html("Hide Items").addClass("hider");
        $(".details-row").fadeOut();
        $("#details-row_" + my_id).fadeIn();
    }
});

$(document).on("click", ".insert-time", function () {
    let me = $(this);
    let target = false;
    let time = new Date();
    let hours = format_time(time.getHours());
    let minutes = format_time(time.getMinutes());
    console.log(minutes)
    if (me.hasClass("start_time")) {
        target = "#start_time";
    } else if (me.hasClass("end_time")) {
        target = "#end_time";
    }
    if (target) {
        $(target).val(hours + ":" + minutes);
    }
});

/* Insert New Code for Assets */

$(document).on("click", ".create.inline", function (e) {
    e.preventDefault();
    let me = this;

    $(me).fadeOut();
    let my_parent = $(me).parents(".rows").attr("id");
    console.log(my_parent);
    let my_url = $(me).attr("href");
    let form_data = {
        inline: true
    }
    $.ajax({
        type: "get",
        url: my_url,
        data: form_data,
        success: function (data) {
            $("#" + my_parent).append(data);
            $(".new-row input[type='text']").focus();
        }
    });
});

$(document).on("click tap", ".edit.inline", function (e) {
    e.preventDefault();
    let me = $(this);
    let my_url = me.attr("href");
    let form_data = {
        inline: 1
    };
    $.ajax({
        type: "get",
        data: form_data,
        url: my_url,
        success: function (data) {
            me.parent().html(data);
        }
    });


});

$(document).on("change", "select", function () {
    let me = $(this);
    if (me.val() === "other") {
        let my_name = me.attr('name');
        me.parent().html("<input type='text' name='" + my_name + "' class='form-control' value=''/>");
    }
});

$(document).on("blur", "#item_count,#price", function () {
    my_count = Number($("#item_count").val());
    my_total = Number($("#price").val());
    product = my_count * my_total;
    $("#total").val(product);

});


$(document).on("keyup", "#order-editor #po", function () {
    me = $(this);
    po = me.val();
    $.ajax({
        type: "get",
        url: base_url + "po/po_exists/" + po,
        success: function (data) {
            if (data) {
                $("#valid-po").addClass("fa-thumbs-down").removeClass("fa-thumbs-up");
                me.addClass("error");
            } else {
                $("#valid-po").removeClass("fa-thumbs-down").addClass("fa-thumbs-up");
                me.removeClass("error");
            }
        }
    });
});

$(document).on('click', '.modify-po', function (e) {
    e.preventDefault();
    let me = $(this);
    let my_id = me.data('id');
    let my_question = confirm('You will be required to ask for approval again for this purchase order. Continue?');
    let form_data = {
        id: my_id
    };
    if (my_question) {
        $.ajax({
            type: 'post',
            url: base_url + 'po/modify',
            data: form_data,
            success: function (data) {
                console.log(data);
                window.location.href = data;
            }
        });
    }

});


$(document).ready(function () {
    $('.complete-po').on('click', function (e) {
        e.preventDefault();
        let me = $(this);
        let my_id = me.data('id');
        let my_question = confirm('Are you sure you want to mark this order as complete? You will be unable to modify it once this has been set');
        if (my_question) {
            let form_data = {
                id: my_id,
            }
            $.ajax({
                type: 'post',
                url: base_url + 'po/complete',
                data: form_data,
                success: function (data) {
                    console.log(data);
                    window.location.href = data;
                }
            })
        }
    });
    // put the footer at the bottom of the window
    move_footer();

    // run test on resize of the window
    $(window).resize(move_footer);
});

$(document).on("click", ".editor .field-envelope .edit-field.editable", function () {
    edit_field(this);
});

function edit_field(my_element) {
    let me = $(my_element);
    let my_type = "text";
    let my_category = me.attr('menu');
    if (me.hasClass("dropdown")) {
        my_type = "dropdown";
    } else if (me.hasClass("checkbox")) {
        my_type = "checkbox";
    } else if (me.hasClass("multiselect")) {
        my_type = "multiselect";
    } else if (me.hasClass("textarea")) {
        my_type = "textarea";
    } else if (me.hasClass("autocomplete")) {
        my_type = "autocomplete";
    }
    let form_data;
    form_data = {
        table: me.data('table'),
        field: me.data('field'),
        id: me.data('id'),
        type: my_type,
        category: my_category,
        value: me.html()
    };
    $.ajax({
        type: "get",
        url: base_url + "variable/edit_value",
        data: form_data,
        success: function (data) {
            me.html(data);
            me.removeClass("edit-field").removeClass("field").addClass("live-field").addClass("text").children('input').focus();
            // $("#" + my_parent + " .live-field input").focus();

        }
    });
}

$(document).on("blur", ".field-envelope .live-field.text input", function () {
    if ($(this).hasClass("ui-autocomplete-input")) {
        update_field(this, "autocomplete");

    } else {
        update_field(this, "text");

    }
    return false;
});
$(document).on("blur", ".field-envelope .live-field input[type='checkbox']", function () {
    update_field(this, "checkbox");
});

$(document).on("blur", ".field-envelope .live-field textarea", function () {
    update_field(this, "textarea");
});
$(document).on("blur", ".field-envelope .live-field.category-dropdown select", function () {
    console.log("here");
    update_field(this, "category-dropdown");
});

$(document).on("blur", ".field-envelope .live-field.subcategory-dropdown select", function () {
    update_field(this, "subcategory-dropdown");
});


$(document).on("blur", ".field-envelope .live-field select", function () {
    update_field(this, "select");
});

//*/

$(document).on("click", ".field-envelope .save-multiselect", function () {
    console.log(this);
    update_field(this, "multiselect");

});

$(document).on('click', '.dropdown-menu li a', function (e) {
    e.preventDefault();
    console.log($(this).html());
});

function update_field(me, my_type) {
    let my_table = $(me).data('table');
    let my_field = $(me).attr('name');
    let my_id = $(me).data('id');
    let my_value = "";
    let my_category = false;
    if (my_type === "autocomplete") {
        my_value = $(me).val();

    } else if (my_type === "multiselect") {
        my_value = $(me).val();
    } else if (my_type === "checkbox") {
        my_category = "checkbox";
        if ($(me).attr("checked") === true) {
            my_value = 1;
        } else {
            my_value = 0;
        }
    } else {
        my_value = $(me).val();
    }

    let is_persistent = $(me).hasClass("persistent");

    //don't do anything if the value is empty and it is a persistent field
    if (is_persistent && my_value === "") {
        return false;
    }
    let my_header = $(me).parents("div.entity").children(".header").attr("id");
    let my_wrapper = $(me).parents(".details");
    let form_data = {
        table: my_table,
        field: my_field,
        id: my_id,
        value: my_value,
        category: my_category
    };

    $.ajax({
        type: "post",
        dataType: "json",
        url: base_url + my_table + "/update_value",
        data: form_data,
        success: function (data) {
            if (!is_persistent) {
                if (my_table === "asset") {
                    $("#" + my_header + " a").html(data['title']);
                    if (data['extra']) {
                        $(my_wrapper).append(data['extra']);
                    }
                }
                $(me).parents('span').data('value', my_id).html(my_value).removeClass('live-field').addClass('edit-field').addClass('field').removeClass('text');
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}

//function to put the footer always at the bottom of the page no matter how big the document contents are. 
function move_footer() {
    let win_height = $(window).height();
    let doc_height = $(document).height();
    let height = 0;
    if (win_height > doc_height) {
        height = win_height;
    } else if (doc_height > win_height) {
        height = doc_height;
    } else {
        height = win_height;
    }
    $("footer").css("top", height - 25 + "px").addClass("js-positioning");

}

function show_popup(me) {
    let target = $(me).attr("href");
    let form_data = {
        ajax: 1
    };
    $.ajax({
        type: "get",
        data: form_data,
        url: target,
        success: function (data) {
            $("#popup").html(data);
            $("#my_dialog").modal("show");
            //on larger screens, shrink the dialog to a more friendly size
//			if(window_width > 768){
//				my_content = $(".modal-body form").css("max-width");
//				$(".modal-dialog").css("width",my_content);
//			}

        }
    });
}


function delete_entity(me) {
    let target = $(me).attr("href");
    let my_id = me.id.split("_")[1];
    let my_parent = $(me).parents(".row").attr("id");
    let question = confirm("Are you sure you want to delete this? This cannot be undone!");
    if (question) {

        let form_data = {
            ajax: 1,
            id: my_id
        }
        $.ajax({
            type: "post",
            data: form_data,
            url: target,
            success: function (data) {
                console.log(data);

                if ($(me).hasClass("inline")) {
                    $("#" + my_parent).remove();
                } else if ($(me).hasClass("redirect")) {
                    window.location.href = data;
                } else {
                    $("#popup").html(data);
                    $("#my_dialog").modal("show");
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}


$(document).on('blur', '.view-inline', function () {
    $(this).removeClass("active");
});

$(document).on("click | focus", ".view-inline", function (e) {
    e.preventDefault();
    $(".view-inline.active").removeClass("active");
    let me = $(this);
    let my_url = me.attr("href");
    if (!me.hasClass("active")) {
        me.addClass("active");
        let form_data = {
            ajax: 1
        };
        $.ajax({
            type: "get",
            url: my_url,
            data: form_data,
            success: function (data) {
                let details_block = $(".details-block");
                details_block.html(data).css("position", "relative").css("width", "auto");
                me.parent("li").append(details_block);
                details_block.fadeIn();
                document.location = "#asset-header_" + me.parent("li").attr("id").split("_")[1];
                me.addClass("active");
            }
        });
    }
});

function format_time(t) {
    if (t < 10) {
        return "0" + t;
    } else {
        return t;
    }

}