$( document ).ready(function() {

    getFilteredProducts();

    $(document).on("input", ".facet-form-trigger", function () {
        getFilteredProducts();
        scrollToProductsHead();
    });

    $(document).on("click", ".page-item", function () {
        getFilteredProducts($(this).data('page'));
        scrollToProductsHead();
    });
});



function getFilteredProducts(page = 1) {
    $.ajax({
        url: "/api/test_get_filtered_products",
        method: 'GET',
        data: {request: getCatalogRequestObject(), page: page},
        success: function (res) {
            if (res) {
                $('#products-block').html(res.products);
                $('#facet-form').html(res.facet);
            }
        },
        error: function () {
            alert("Ошибка");
        }
    });
}

function scrollToProductsHead()
{
    $('html, body').animate({
        scrollTop: $("#total-products-block").offset().top
    }, 1000);
}

function getCatalogRequestObject()
{
    return $('#facet-form').serialize();
    // var request = {
    //     'minPrice': $('#minPrice').val(),
    //     'maxPrice': $('#maxPrice').val(),
    //     'form'    : $('#facet-form').serialize()
    // };
    //
    // return request;
}

function getCurrentPage() {
    var regularExpression = /page=(\d)/;
    var matches = regularExpression.exec(location.href);

    return (matches && typeof matches[1] !== 'undefined') ? matches[1] : 1;
}