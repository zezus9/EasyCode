function carousel() {
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        stagePadding: 20,
        margin: 10,
        responsive: {
            0: {
                items: 1,
            },
            550: {
                items: 2,
            },
            790: {
                items: 3,
            },
            1190: {
                items: 4,
            }
        }
    })
}