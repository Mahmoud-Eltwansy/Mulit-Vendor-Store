(function ($) {
    $(".item-quantity").on("change", function (e) {
        var $subtotalElement = $(this)
            .closest(".cart-single-list")
            .find(".item-subtotal");
        var pricePerItem = parseFloat($(this).closest('.cart-single-list').data('price'));
        $.ajax({
            url: "/cart/" + $(this).data("id"), // get attribute data-id
            method: "put",
            data: {
                quantity: $(this).val(),
                _token: csrf_token,
            },
            success:  response => {
                // Update the subtotal in the DOM
                $(this).closest('.cart-single-list').find(".item-subtotal").text(pricePerItem * $(this).val());

                console.log("Cart updated successfully.");
            },
        });
    });


    $(".remove-item").on("click", function (e) {
        let id = $(this).data("id");
        $.ajax({
            url: "/cart/" + id, // get attribute data-id
            method: "delete",
            data: {
                _token: csrf_token,
            },
            success: (response) => {
                $(`#${id}`).remove();
            },
        });
    });

    // $(document).on('change', '.item-quantity', function (e) {
    //     // your code here
    // });
})(jQuery);




