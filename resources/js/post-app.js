import '../css/post.css';
import '../css/formulario.css';


$(".owl-carousel").owlCarousel({
    margin:10,
    nav:true,
    dots:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:2,
        },
        1000:{
            items:4,
        }
    }
});