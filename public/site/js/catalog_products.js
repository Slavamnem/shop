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

    $(document).on("change", "#sorting", function () {
        getFilteredProducts($(this).data('page'));
        scrollToProductsHead();
    });
});



function getFilteredProducts(page = 1) {
    $.ajax({
        url: "/api/get_catalog_data",
        method: 'GET',
        data: {request: getCatalogRequestObject(), page: page, sorting: getSortingType()},
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

function getSortingType() {
    return $('#sorting').val();
}

function getCurrentPage() {
    var regularExpression = /page=(\d)/;
    var matches = regularExpression.exec(location.href);

    return (matches && typeof matches[1] !== 'undefined') ? matches[1] : 1;
}