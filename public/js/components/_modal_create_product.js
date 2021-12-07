$(document).ready(function () {
    $("#product-create-form").submit(function (e) {
        loading(true);
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function (data) {
                console.log(data);
                loading(false);
                if (data.success) {
                    $('#btns-wrapper').addClass('d-none');
                    location.reload();
                } else {
                    $('#transaction-error').removeClass('d-none');
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                loading(false);
                if (XMLHttpRequest.status === 422) {
                    handleErrors(XMLHttpRequest.responseJSON);
                } else {
                    $('#transaction-error').removeClass('d-none');
                }
            }
        });
    });
});

$("#modal-create-product").on("hidden.bs.modal", function () {
    clearErrors();
});

$(".product-create").click(function () {
    clearForm();
    $('.modal-title').find('h2').text('Nuevo producto');
});

$(".product-edit").click(function () {
    clearForm();
    var product = $(this).data('product');
    $('#productId').val(product.id);
    $('#name').val(product.name);
    $('#price').val(parseFloat(product.price).toFixed(2));

    $('.modal-title').find('h2').text('Actualizar producto');
});

function loading(show) {
    if (show) {
        $('#spinner-wrapper').removeClass('d-none');
        $("#product-create-form").addClass('d-none');
    } else {
        $('#spinner-wrapper').addClass('d-none');
        $("#product-create-form").removeClass('d-none');
    }

    clearErrors();
}

function handleErrors(responseJSON) {
    $.each(responseJSON.errors, function (field, error) {
        $('#product-create-form').find("#" + field).parent().append("<span class='invalid-feedback' role='alert'><strong>" + error + "</strong></span>");
        $('#product-create-form').find("#" + field).addClass("is-invalid");
    });
}

function clearErrors() {
    $('#transaction-error').addClass('d-none');
    $('#product-create-form').find(".form-group").each(function () {
        $(this).find(".invalid-feedback").remove();
        $(this).find(".form-control").removeClass("is-invalid");
    });
}

function clearForm() {
    $('#productId').val('');
    $('#name').val('');
    $('#price').val('');
}