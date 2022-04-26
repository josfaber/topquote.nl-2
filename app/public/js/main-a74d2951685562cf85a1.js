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

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_styles_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/styles.scss */ \"./src/scss/styles.scss\");\n\n\nvar updateColor = function updateColor(c) {\n  // set doc's primary color\n  var altClr = getComputedStyle(document.documentElement).getPropertyValue(\"--alt-color-\".concat(c));\n  document.documentElement.style.setProperty('--primary-color', altClr); // update active \n\n  var el_active = document.querySelector('.clr.active');\n  !el_active || el_active.classList.remove('active');\n  var el_new = document.querySelector(\".clr[data-c=\\\"\".concat(c, \"\\\"]\"));\n  !el_new || el_new.classList.add('active');\n}; // update color \n\n\nvar tqcnum = window.localStorage.getItem('topquote-color-num');\nconsole.log(tqcnum);\n!tqcnum || updateColor(tqcnum);\n/**\n * On body ready\n */\n\ndocument.body.onload = function () {\n  var menucb = document.getElementById('menucb');\n  var main_el = document.getElementsByTagName('main')[0]; // onchange menucb\n\n  menucb.onchange = function () {\n    return setTimeout(function () {\n      if (menucb.checked) {\n        !main_el || main_el.classList.add('blur');\n      } else {\n        !main_el || main_el.classList.remove('blur');\n      }\n    }, 50);\n  }; // onchange clr \n\n\n  document.querySelectorAll('.clr').forEach(function (el) {\n    return el.addEventListener(\"click\", function (e) {\n      e.preventDefault();\n      var c = el.dataset.c;\n      !c || updateColor(c); // update storage \n\n      window.localStorage.setItem('topquote-color-num', c);\n    });\n  });\n}();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvanMvbWFpbi5qcy5qcyIsIm1hcHBpbmdzIjoiOztBQUFBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7OztBQUdBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTs7QUFDQTtBQUVBO0FBQ0E7O0FBR0E7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQU5BOzs7QUFTQTtBQUFBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFOQTtBQVFBIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vdG9wcXVvdGUtbmwvLi9zcmMvanMvbWFpbi5qcz85MjkxIl0sInNvdXJjZXNDb250ZW50IjpbImltcG9ydCAnLi4vc2Nzcy9zdHlsZXMuc2Nzcyc7XG5cbmNvbnN0IHVwZGF0ZUNvbG9yID0gKGMpID0+IHtcbiAgICAvLyBzZXQgZG9jJ3MgcHJpbWFyeSBjb2xvclxuICAgIGxldCBhbHRDbHIgPSBnZXRDb21wdXRlZFN0eWxlKGRvY3VtZW50LmRvY3VtZW50RWxlbWVudCkuZ2V0UHJvcGVydHlWYWx1ZShgLS1hbHQtY29sb3ItJHtjfWApO1xuICAgIGRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5zdHlsZS5zZXRQcm9wZXJ0eSgnLS1wcmltYXJ5LWNvbG9yJywgYWx0Q2xyKTtcbiAgICAvLyB1cGRhdGUgYWN0aXZlIFxuICAgIGNvbnN0IGVsX2FjdGl2ZSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5jbHIuYWN0aXZlJylcbiAgICAhZWxfYWN0aXZlIHx8IGVsX2FjdGl2ZS5jbGFzc0xpc3QucmVtb3ZlKCdhY3RpdmUnKTtcbiAgICBjb25zdCBlbF9uZXcgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKGAuY2xyW2RhdGEtYz1cIiR7Y31cIl1gKTtcbiAgICAhZWxfbmV3IHx8IGVsX25ldy5jbGFzc0xpc3QuYWRkKCdhY3RpdmUnKTtcbn1cblxuLy8gdXBkYXRlIGNvbG9yIFxuY29uc3QgdHFjbnVtID0gd2luZG93LmxvY2FsU3RvcmFnZS5nZXRJdGVtKCd0b3BxdW90ZS1jb2xvci1udW0nKTtcbmNvbnNvbGUubG9nKHRxY251bSk7XG4hdHFjbnVtIHx8IHVwZGF0ZUNvbG9yKHRxY251bSk7XG5cbi8qKlxuICogT24gYm9keSByZWFkeVxuICovXG5kb2N1bWVudC5ib2R5Lm9ubG9hZCA9ICggKCkgPT4ge1xuICAgIFxuICAgIGNvbnN0IG1lbnVjYiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdtZW51Y2InKTtcbiAgICBjb25zdCBtYWluX2VsID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeVRhZ05hbWUoJ21haW4nKVswXTtcbiAgICBcbiAgICAvLyBvbmNoYW5nZSBtZW51Y2JcbiAgICBtZW51Y2Iub25jaGFuZ2UgPSAoICgpID0+IHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBpZiAobWVudWNiLmNoZWNrZWQpIHtcbiAgICAgICAgICAgICFtYWluX2VsIHx8IG1haW5fZWwuY2xhc3NMaXN0LmFkZCgnYmx1cicpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgIW1haW5fZWwgfHwgbWFpbl9lbC5jbGFzc0xpc3QucmVtb3ZlKCdibHVyJyk7XG4gICAgICAgIH1cbiAgICB9LCA1MCkgKTtcblxuICAgIC8vIG9uY2hhbmdlIGNsciBcbiAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcuY2xyJykuZm9yRWFjaCggKGVsKSA9PiBlbC5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgKGUpID0+IHtcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICBsZXQgYyA9IGVsLmRhdGFzZXQuYztcbiAgICAgICAgIWMgfHwgdXBkYXRlQ29sb3IoYyk7XG4gICAgICAgIC8vIHVwZGF0ZSBzdG9yYWdlIFxuICAgICAgICB3aW5kb3cubG9jYWxTdG9yYWdlLnNldEl0ZW0oJ3RvcHF1b3RlLWNvbG9yLW51bScsIGMpO1xuICAgIH0pKTtcblxufSApKCk7XG4iXSwibmFtZXMiOltdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./src/js/main.js\n");

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