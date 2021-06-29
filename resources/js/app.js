require("./bootstrap");
require("alpinejs");
// Headroom
import Headroom from "headroom.js";
var myElement = document.getElementById("site-header");
var options = {
  offset: {
    up: 112,
    down: 112
  },
  tolerance: 10,
};
var headroom = new Headroom(myElement, options);
headroom.init();

// Swiper
import Swiper from 'swiper/bundle';
import 'swiper/swiper-bundle.css';
import SwiperCore, { Navigation, Pagination } from 'swiper/core';
SwiperCore.use([Navigation, Pagination]);
const swiper = new Swiper('.swiper-container', {
  loop: true,
  autoplay: {
    delay: 8000,
  },
  pagination: {
    el: '.swiper-pagination',
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

});