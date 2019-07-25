$( document ).ready(function() {

    $('.cards article, .cards div').on('click', function () {
        let article = $(this);

        if (article.hasClass('most-popular-card_small_isfront')) {
            article.removeClass('most-popular-card_small_isfront').addClass('most-popular-card_small_isback');
            article.find('.most-popular-card-front').hide();
            article.find('.most-popular-card-back').show();

        } else if(article.hasClass('most-popular-card_small_isback')) {
            article.removeClass('most-popular-card_small_isback').addClass('most-popular-card_small_isfront');
            article.find('.most-popular-card-back').hide();
            article.find('.most-popular-card-front').show();
        }

    });

});

/* Open when someone clicks on the span element */
function openAsideNav() {
    $(".aside-nav__search").hide();
    $(".aside-nav__content").show();
    $(".aside-nav").addClass('aside-active');
}

function openAsideSearch() {
    // Удаление данных из формы поиска
    $(".aside-nav__search")[0].reset();
    $(".aside-nav__search").show();
    $(".aside-nav__content").hide();
    $(".aside-nav").addClass('aside-active');
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeAsideNav() {
    $(".aside-nav").removeClass('aside-active');
}

let modal = document.getElementById('aside-nav');

window.onclick = function (event) {
    if (event.target == modal) {
        closeAsideNav();
    }
};