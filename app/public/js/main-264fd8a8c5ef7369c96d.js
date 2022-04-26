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

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_styles_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/styles.scss */ \"./src/scss/styles.scss\");\n\n\nvar updateColor = function updateColor(c) {\n  var el_active = document.querySelector('.clr.active');\n  !el_active || el_active.classList.remove('active');\n  var el_new = document.querySelector(\".clr[data-c=\\\"\".concat(c, \"\\\"]\"));\n  !el_new || el_new.classList.add('active');\n};\n/**\n * On body ready\n */\n\n\ndocument.body.onload = function () {\n  var menucb = document.getElementById('menucb');\n  var main_el = document.getElementsByTagName('main')[0]; // onchange menucb\n\n  menucb.onchange = function () {\n    return setTimeout(function () {\n      if (menucb.checked) {\n        !main_el || main_el.classList.add('blur');\n      } else {\n        !main_el || main_el.classList.remove('blur');\n      }\n    }, 50);\n  }; // onchange clr \n\n\n  document.querySelectorAll('.clr').forEach(function (el) {\n    return el.addEventListener(\"click\", function (e) {\n      e.preventDefault();\n      var c = el.dataset.c;\n      var altClr = getComputedStyle(document.documentElement).getPropertyValue(\"--alt-color-\".concat(c)); // set doc's primary color\n\n      document.documentElement.style.setProperty('--primary-color', altClr); // update active \n\n      updateColor(c); // update storage \n\n      window.localStorage.setItem('topquote-color-num', c);\n    });\n  }); // update color \n\n  var tqcnum = window.localStorage.getItem('topquote-color-num');\n  !tqcnum || updateColor(tqcnum);\n}();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvanMvbWFpbi5qcy5qcyIsIm1hcHBpbmdzIjoiOztBQUFBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTs7O0FBQ0E7QUFFQTtBQUNBOztBQUdBO0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFOQTs7O0FBU0E7QUFBQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTs7QUFFQTs7QUFFQTtBQUNBO0FBVkE7O0FBYUE7QUFDQTtBQUVBIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vdG9wcXVvdGUtbmwvLi9zcmMvanMvbWFpbi5qcz85MjkxIl0sInNvdXJjZXNDb250ZW50IjpbImltcG9ydCAnLi4vc2Nzcy9zdHlsZXMuc2Nzcyc7XG5cbmNvbnN0IHVwZGF0ZUNvbG9yID0gKGMpID0+IHtcbiAgICBjb25zdCBlbF9hY3RpdmUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuY2xyLmFjdGl2ZScpXG4gICAgIWVsX2FjdGl2ZSB8fCBlbF9hY3RpdmUuY2xhc3NMaXN0LnJlbW92ZSgnYWN0aXZlJyk7XG4gICAgY29uc3QgZWxfbmV3ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihgLmNscltkYXRhLWM9XCIke2N9XCJdYCk7XG4gICAgIWVsX25ldyB8fCBlbF9uZXcuY2xhc3NMaXN0LmFkZCgnYWN0aXZlJyk7XG59XG5cbi8qKlxuICogT24gYm9keSByZWFkeVxuICovXG5kb2N1bWVudC5ib2R5Lm9ubG9hZCA9ICggKCkgPT4ge1xuICAgIFxuICAgIGNvbnN0IG1lbnVjYiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdtZW51Y2InKTtcbiAgICBjb25zdCBtYWluX2VsID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeVRhZ05hbWUoJ21haW4nKVswXTtcbiAgICBcbiAgICAvLyBvbmNoYW5nZSBtZW51Y2JcbiAgICBtZW51Y2Iub25jaGFuZ2UgPSAoICgpID0+IHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBpZiAobWVudWNiLmNoZWNrZWQpIHtcbiAgICAgICAgICAgICFtYWluX2VsIHx8IG1haW5fZWwuY2xhc3NMaXN0LmFkZCgnYmx1cicpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgIW1haW5fZWwgfHwgbWFpbl9lbC5jbGFzc0xpc3QucmVtb3ZlKCdibHVyJyk7XG4gICAgICAgIH1cbiAgICB9LCA1MCkgKTtcblxuICAgIC8vIG9uY2hhbmdlIGNsciBcbiAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcuY2xyJykuZm9yRWFjaCggKGVsKSA9PiBlbC5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgKGUpID0+IHtcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICBsZXQgYyA9IGVsLmRhdGFzZXQuYztcbiAgICAgICAgbGV0IGFsdENsciA9IGdldENvbXB1dGVkU3R5bGUoZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50KS5nZXRQcm9wZXJ0eVZhbHVlKGAtLWFsdC1jb2xvci0ke2N9YCk7XG4gICAgICAgIC8vIHNldCBkb2MncyBwcmltYXJ5IGNvbG9yXG4gICAgICAgIGRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5zdHlsZS5zZXRQcm9wZXJ0eSgnLS1wcmltYXJ5LWNvbG9yJywgYWx0Q2xyKTtcbiAgICAgICAgLy8gdXBkYXRlIGFjdGl2ZSBcbiAgICAgICAgdXBkYXRlQ29sb3IoYyk7XG4gICAgICAgIC8vIHVwZGF0ZSBzdG9yYWdlIFxuICAgICAgICB3aW5kb3cubG9jYWxTdG9yYWdlLnNldEl0ZW0oJ3RvcHF1b3RlLWNvbG9yLW51bScsIGMpO1xuICAgIH0pKTtcblxuICAgIC8vIHVwZGF0ZSBjb2xvciBcbiAgICBjb25zdCB0cWNudW0gPSB3aW5kb3cubG9jYWxTdG9yYWdlLmdldEl0ZW0oJ3RvcHF1b3RlLWNvbG9yLW51bScpO1xuICAgICF0cWNudW0gfHwgdXBkYXRlQ29sb3IodHFjbnVtKTtcblxufSApKCk7XG4iXSwibmFtZXMiOltdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./src/js/main.js\n");

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