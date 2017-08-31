const cart = (($) => {
    $('.add-to-cart').on('click', (event) => {
        let target = $(event.target).closest('button');
        target.prop('disabled', true);

        let productId = target.data("product-id");

        $.ajax({
            url: "/ecommerce/cart/add/" + productId,
            success: (data) => {
                if(target.data("is-singleton")) {
                    target.removeClass('btn-primary');
                    target.addClass('btn-success');
                } else {
                    target.prop('disabled', false);
                }

                showAlert(data.msg, "alert-success");
            },
            error: (result) => {
                let statusText = result.statusText;
                target.prop('disabled', false);
                showAlert(statusText, "alert-danger");
            }
        });
    });

    $('.change-cart').on('click', (event) => {
        let target = $(event.target).closest('a').parent().find('input.productNumber');
        let productId = $(target).attr("name");
        let productNumber = $(target).val();

        $.ajax({
            url: "/ecommerce/cart/change/" + productId + "/" + productNumber,
            success: (data) => {
                showAlert(data.msg, "alert-success");
            }
        });
    });

    const showAlert = (alert, type) => {
        let alertBox = `<div class="alert ${type}">${alert}</div>`;
        $('div#alert-container').append(alertBox);
        setTimeout(() => {
            $('div#alert-container').empty();
        },3000);
    }
})(jQuery);