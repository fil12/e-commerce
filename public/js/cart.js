$(document).ready(function () {
    $(".cart-in").click(function () {
        var id = $(this).data("id");
        console.log(id);
        $.get("/cart-add/" + id, function (data) {
            var counter = $(".cart-counter").text();
            counter++;
            $(".cart-counter").text(counter);
            console.log(data);
        });
    });

    $(".cart-add").click(function () {
        var id = $(this).data("id");
        var price = Number($(this).data("price"));
        console.log(price);
        $.get("/cart-add/" + id, function (data) {
            var counter = $(".cart-counter").text();
            counter++;
            $(".cart-counter").text(counter);
            var counter = $(".counter-total").text();
            counter++;
            $(".counter-total").text(counter);
            var countProd = $(".count-" + id).text();
            countProd++;
            $(".count-" + id).text(countProd);
            var total = Number($(".total-" + id).text());
            total = (total + price);
            $(".total-" + id).text(total);
        });
    });

    $(".cart-delete").click(function () {
        var id = $(this).data("id");
        var price = Number($(this).data("price"));
        var total = Number($(".total-" + id).text());

        if (total > 0) {
            $.get("/cart-delete/" + id, function (data) {
                var counter = $(".cart-counter").text();
                counter--;
                var counter = $(".counter-total").text();
                counter--;
                $(".counter-total").text(counter);
                $(".cart-counter").text(counter);
                var countProd = $(".count-" + id).text();
                countProd--;
                $(".count-" + id).text(countProd);

                total = (total - price);
                $(".total-" + id).text(total);

            });
        }

    });

    $(".cart-clean").click(function () {

        $.get("/cart-clean/", function (data) {
           // $("heaer.cart-counter").text(0);
            history.go(-1);
           // $(".cartProducts").html("<h2 class='text-lg-center text-warning'>Cart is empty!</h2>")
        });

    });

});



