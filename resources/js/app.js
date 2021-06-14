require("./bootstrap");
require("alpinejs");
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