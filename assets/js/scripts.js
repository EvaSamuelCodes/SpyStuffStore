var utilities = {
    variantDetails: {},
    currentPrice: function (variant) {
        // console.log("Heya!")
        // console.log($("#variants").val())
        this.variantDetails = $.parseJSON($.base64.decode($("#variants").val()));
        if (parseInt(this.variantDetails.variant_price) !== 0) {
            $('#price').html('$' + this.variantDetails.variant_price);
        }
    }
}

$(document).ready(function () {

    $("#variants").on("change", function () {
        console.log(this.value);
        utilities.currentPrice($("#variants").val());
    });

    utilities.currentPrice($("#variants").val());
});