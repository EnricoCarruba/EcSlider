$(document).ready(function () {

    $('.next').on('click', function () {
        console.log('clicked');
        var currentImg = $('.active');
        var nextImg = currentImg.next();

        if (nextImg.length == 5) {
            currentImg.removeClass('active');
            nextImg.addClass('active');
            console.log(nextImg.length);
        }

    });

    $('.prev').on('click', function () {
        var currentImg = $('.active');
        var prevImg = currentImg.prev();

        if (prevImg.length == 5) {
            currentImg.removeClass('active');
            prevImg.addClass('active');
            console.log(prevImg.length);
        }

    });

});
