jQuery(function ($) {
  $(document).ready(function () {
    $(".slider-videos").slick({
      dots: false,
      arrows: false,
      infinite: true,
      speed: 300,
      slidesToShow: 7,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 3,
            infinite: false,
            //slidesToScroll: 2
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            // slidesToScroll: 1
            infinite: false,
          },
        },
      ],
    });
  });
});
