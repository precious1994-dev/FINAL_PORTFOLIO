/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

import AOS from 'aos';
import 'aos/dist/aos.css'; // You can also use <link> for styles
// ..
AOS.init({
    offset:400,
    duration:1200
});

import Typed from 'typed.js';

var options = {
    strings: ['<i>Developeur</i>', ' Integrateur Junior'],
    typeSpeed: 40,
    backSpeed: 40,
    loop:true,
};

var typed = new Typed('.animate', options);

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.

import $ from 'jquery';

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
