

jQuery(document).ready(function($){
      $('.product-items-view').slick({
      lazyLoad: 'ondemand',
 
  slidesToScroll: 1,
  autoplay: false,
  autoplaySpeed: 200,
  dots: false,
  infinite: false,
  arrows: true,
  appendArrows: $(".news_slider"),
  slidesToShow: 5,
  
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
      });
    });
    
    
   
    
    jQuery("#toggle-update-address").click(function(){
      if(jQuery(this).hasClass("disabled")) {
        return false;
      } else {
        jQuery("#div-update-address").toggleClass("toggle-div-update-address");
        jQuery("#iframe-card-details").height(jQuery("#iframe-card-details").contents().find('body').height());
      }
    });
   
    