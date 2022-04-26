/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/main.js":
/*!************************!*\
  !*** ./src/js/main.js ***!
  \************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_styles_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/styles.scss */ \"./src/scss/styles.scss\");\n\n\nvar updateColor = function updateColor(c) {\n  // set doc's primary color\n  var altClr = getComputedStyle(document.documentElement).getPropertyValue(\"--alt-color-\".concat(c));\n  document.documentElement.style.setProperty('--primary-color', altClr); // update active \n\n  var el_active = document.querySelector('.clr.active');\n  !el_active || el_active.classList.remove('active');\n  var el_new = document.querySelector(\".clr[data-c=\\\"\".concat(c, \"\\\"]\"));\n  !el_new || el_new.classList.add('active');\n}; // update color \n\n\nvar tqcnum = window.localStorage.getItem('topquote-color-num');\n\nif (tqcnum) {\n  var color_transition_time = getComputedStyle(document.documentElement).getPropertyValue('--color-transition-time');\n  document.documentElement.style.setProperty('--color-transition-time', '0ms');\n  setTimeout(function () {\n    return updateColor(tqcnum);\n  }, 20);\n  setTimeout(function () {\n    return document.documentElement.style.setProperty('--color-transition-time', \"\".concat(color_transition_time));\n  }, 40);\n}\n/**\n * On body ready\n */\n\n\ndocument.body.onload = function () {\n  var menucb = document.getElementById('menucb');\n  var main_el = document.getElementsByTagName('main')[0]; // onchange menucb\n\n  menucb.onchange = function () {\n    return setTimeout(function () {\n      if (menucb.checked) {\n        !main_el || main_el.classList.add('blur');\n      } else {\n        !main_el || main_el.classList.remove('blur');\n      }\n    }, 50);\n  }; // onchange clr \n\n\n  document.querySelectorAll('.clr').forEach(function (el) {\n    return el.addEventListener(\"click\", function (e) {\n      e.preventDefault();\n      var c = el.dataset.c;\n      !c || updateColor(c); // update storage \n\n      window.localStorage.setItem('topquote-color-num', c);\n    });\n  }); // if in large mode, check for sayer height \n\n  console.log(window.innerWidth);\n\n  if (window.innerWidth >= 1024) {}\n}();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvanMvbWFpbi5qcy5qcyIsIm1hcHBpbmdzIjoiOztBQUFBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7OztBQUdBOztBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQUE7QUFBQTtBQUNBO0FBQUE7QUFBQTtBQUNBO0FBRUE7QUFDQTtBQUNBOzs7QUFDQTtBQUVBO0FBQ0E7O0FBR0E7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQU5BOzs7QUFTQTtBQUFBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFOQTs7QUFTQTs7QUFDQTtBQUdBIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vdG9wcXVvdGUtbmwvLi9zcmMvanMvbWFpbi5qcz85MjkxIl0sInNvdXJjZXNDb250ZW50IjpbImltcG9ydCAnLi4vc2Nzcy9zdHlsZXMuc2Nzcyc7XG5cbmNvbnN0IHVwZGF0ZUNvbG9yID0gKGMpID0+IHtcbiAgICAvLyBzZXQgZG9jJ3MgcHJpbWFyeSBjb2xvclxuICAgIGxldCBhbHRDbHIgPSBnZXRDb21wdXRlZFN0eWxlKGRvY3VtZW50LmRvY3VtZW50RWxlbWVudCkuZ2V0UHJvcGVydHlWYWx1ZShgLS1hbHQtY29sb3ItJHtjfWApO1xuICAgIGRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5zdHlsZS5zZXRQcm9wZXJ0eSgnLS1wcmltYXJ5LWNvbG9yJywgYWx0Q2xyKTtcbiAgICAvLyB1cGRhdGUgYWN0aXZlIFxuICAgIGNvbnN0IGVsX2FjdGl2ZSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5jbHIuYWN0aXZlJylcbiAgICAhZWxfYWN0aXZlIHx8IGVsX2FjdGl2ZS5jbGFzc0xpc3QucmVtb3ZlKCdhY3RpdmUnKTtcbiAgICBjb25zdCBlbF9uZXcgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKGAuY2xyW2RhdGEtYz1cIiR7Y31cIl1gKTtcbiAgICAhZWxfbmV3IHx8IGVsX25ldy5jbGFzc0xpc3QuYWRkKCdhY3RpdmUnKTtcbn1cblxuLy8gdXBkYXRlIGNvbG9yIFxuY29uc3QgdHFjbnVtID0gd2luZG93LmxvY2FsU3RvcmFnZS5nZXRJdGVtKCd0b3BxdW90ZS1jb2xvci1udW0nKTtcbmlmICh0cWNudW0pIHtcbiAgICBcbiAgICBsZXQgY29sb3JfdHJhbnNpdGlvbl90aW1lID0gZ2V0Q29tcHV0ZWRTdHlsZShkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQpLmdldFByb3BlcnR5VmFsdWUoJy0tY29sb3ItdHJhbnNpdGlvbi10aW1lJyk7XG4gICAgZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LnN0eWxlLnNldFByb3BlcnR5KCctLWNvbG9yLXRyYW5zaXRpb24tdGltZScsICcwbXMnKTtcbiAgICBzZXRUaW1lb3V0KCAoKSA9PiB1cGRhdGVDb2xvcih0cWNudW0pLCAyMCk7XG4gICAgc2V0VGltZW91dCggKCkgPT4gZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LnN0eWxlLnNldFByb3BlcnR5KCctLWNvbG9yLXRyYW5zaXRpb24tdGltZScsIGAke2NvbG9yX3RyYW5zaXRpb25fdGltZX1gKSwgNDApO1xufVxuXG4vKipcbiAqIE9uIGJvZHkgcmVhZHlcbiAqL1xuZG9jdW1lbnQuYm9keS5vbmxvYWQgPSAoICgpID0+IHtcbiAgICBcbiAgICBjb25zdCBtZW51Y2IgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbWVudWNiJyk7XG4gICAgY29uc3QgbWFpbl9lbCA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlUYWdOYW1lKCdtYWluJylbMF07XG4gICAgXG4gICAgLy8gb25jaGFuZ2UgbWVudWNiXG4gICAgbWVudWNiLm9uY2hhbmdlID0gKCAoKSA9PiBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgaWYgKG1lbnVjYi5jaGVja2VkKSB7XG4gICAgICAgICAgICAhbWFpbl9lbCB8fCBtYWluX2VsLmNsYXNzTGlzdC5hZGQoJ2JsdXInKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICFtYWluX2VsIHx8IG1haW5fZWwuY2xhc3NMaXN0LnJlbW92ZSgnYmx1cicpO1xuICAgICAgICB9XG4gICAgfSwgNTApICk7XG5cbiAgICAvLyBvbmNoYW5nZSBjbHIgXG4gICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLmNscicpLmZvckVhY2goIChlbCkgPT4gZWwuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIChlKSA9PiB7XG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgbGV0IGMgPSBlbC5kYXRhc2V0LmM7XG4gICAgICAgICFjIHx8IHVwZGF0ZUNvbG9yKGMpO1xuICAgICAgICAvLyB1cGRhdGUgc3RvcmFnZSBcbiAgICAgICAgd2luZG93LmxvY2FsU3RvcmFnZS5zZXRJdGVtKCd0b3BxdW90ZS1jb2xvci1udW0nLCBjKTtcbiAgICB9KSk7XG5cbiAgICAvLyBpZiBpbiBsYXJnZSBtb2RlLCBjaGVjayBmb3Igc2F5ZXIgaGVpZ2h0IFxuICAgIGNvbnNvbGUubG9nKHdpbmRvdy5pbm5lcldpZHRoKTtcbiAgICBpZiAod2luZG93LmlubmVyV2lkdGggPj0gMTAyNCkge1xuICAgIH1cblxufSApKCk7XG4iXSwibmFtZXMiOltdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./src/js/main.js\n");

/***/ }),

/***/ "./src/scss/styles.scss":
/*!******************************!*\
  !*** ./src/scss/styles.scss ***!
  \******************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvc2Nzcy9zdHlsZXMuc2Nzcy5qcyIsIm1hcHBpbmdzIjoiO0FBQUEiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly90b3BxdW90ZS1ubC8uL3NyYy9zY3NzL3N0eWxlcy5zY3NzPzQ5ZTgiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307Il0sIm5hbWVzIjpbXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./src/scss/styles.scss\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./src/js/main.js");
/******/ 	
/******/ })()
;