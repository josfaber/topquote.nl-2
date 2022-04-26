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

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_styles_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/styles.scss */ \"./src/scss/styles.scss\");\n\n\nvar updateColor = function updateColor(c) {\n  // set doc's primary color\n  var altClr = getComputedStyle(document.documentElement).getPropertyValue(\"--alt-color-\".concat(c));\n  document.documentElement.style.setProperty('--primary-color', altClr); // update active \n\n  var el_active = document.querySelector('.clr.active');\n  !el_active || el_active.classList.remove('active');\n  var el_new = document.querySelector(\".clr[data-c=\\\"\".concat(c, \"\\\"]\"));\n  !el_new || el_new.classList.add('active');\n}; // update color \n\n\nvar tqcnum = window.localStorage.getItem('topquote-color-num');\n\nif (tqcnum) {\n  var color_transition_time = getComputedStyle(document.documentElement).getPropertyValue('--color-transition-time');\n  document.documentElement.style.setProperty('--color-transition-time', '0ms');\n  setTimeout(function () {\n    return updateColor(tqcnum);\n  }, 20);\n  setTimeout(function () {\n    return document.documentElement.style.setProperty('--color-transition-time', \"\".concat(color_transition_time));\n  }, 40);\n}\n/**\n * On body ready\n */\n\n\ndocument.body.onload = function () {\n  var menucb = document.getElementById('menucb');\n  var main_el = document.getElementsByTagName('main')[0]; // onchange menucb\n\n  menucb.onchange = function () {\n    return setTimeout(function () {\n      if (menucb.checked) {\n        !main_el || main_el.classList.add('blur');\n      } else {\n        !main_el || main_el.classList.remove('blur');\n      }\n    }, 50);\n  }; // onchange clr \n\n\n  document.querySelectorAll('.clr').forEach(function (el) {\n    return el.addEventListener(\"click\", function (e) {\n      e.preventDefault();\n      var c = el.dataset.c;\n      !c || updateColor(c); // update storage \n\n      window.localStorage.setItem('topquote-color-num', c);\n    });\n  }); // if in large mode, check for sayer height \n\n  console.log(window.innerWidth);\n\n  if (window.innerWidth >= 1024) {\n    // for every blockquote \n    document.querySelectorAll('blockquote').forEach(function (el) {\n      console.log(el);\n    });\n  }\n}();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvanMvbWFpbi5qcy5qcyIsIm1hcHBpbmdzIjoiOztBQUFBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7OztBQUdBOztBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQUE7QUFBQTtBQUNBO0FBQUE7QUFBQTtBQUNBO0FBRUE7QUFDQTtBQUNBOzs7QUFDQTtBQUVBO0FBQ0E7O0FBR0E7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQU5BOzs7QUFTQTtBQUFBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFOQTs7QUFTQTs7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQSIsInNvdXJjZXMiOlsid2VicGFjazovL3RvcHF1b3RlLW5sLy4vc3JjL2pzL21haW4uanM/OTI5MSJdLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgJy4uL3Njc3Mvc3R5bGVzLnNjc3MnO1xuXG5jb25zdCB1cGRhdGVDb2xvciA9IChjKSA9PiB7XG4gICAgLy8gc2V0IGRvYydzIHByaW1hcnkgY29sb3JcbiAgICBsZXQgYWx0Q2xyID0gZ2V0Q29tcHV0ZWRTdHlsZShkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQpLmdldFByb3BlcnR5VmFsdWUoYC0tYWx0LWNvbG9yLSR7Y31gKTtcbiAgICBkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQuc3R5bGUuc2V0UHJvcGVydHkoJy0tcHJpbWFyeS1jb2xvcicsIGFsdENscik7XG4gICAgLy8gdXBkYXRlIGFjdGl2ZSBcbiAgICBjb25zdCBlbF9hY3RpdmUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuY2xyLmFjdGl2ZScpXG4gICAgIWVsX2FjdGl2ZSB8fCBlbF9hY3RpdmUuY2xhc3NMaXN0LnJlbW92ZSgnYWN0aXZlJyk7XG4gICAgY29uc3QgZWxfbmV3ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihgLmNscltkYXRhLWM9XCIke2N9XCJdYCk7XG4gICAgIWVsX25ldyB8fCBlbF9uZXcuY2xhc3NMaXN0LmFkZCgnYWN0aXZlJyk7XG59XG5cbi8vIHVwZGF0ZSBjb2xvciBcbmNvbnN0IHRxY251bSA9IHdpbmRvdy5sb2NhbFN0b3JhZ2UuZ2V0SXRlbSgndG9wcXVvdGUtY29sb3ItbnVtJyk7XG5pZiAodHFjbnVtKSB7XG4gICAgXG4gICAgbGV0IGNvbG9yX3RyYW5zaXRpb25fdGltZSA9IGdldENvbXB1dGVkU3R5bGUoZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50KS5nZXRQcm9wZXJ0eVZhbHVlKCctLWNvbG9yLXRyYW5zaXRpb24tdGltZScpO1xuICAgIGRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5zdHlsZS5zZXRQcm9wZXJ0eSgnLS1jb2xvci10cmFuc2l0aW9uLXRpbWUnLCAnMG1zJyk7XG4gICAgc2V0VGltZW91dCggKCkgPT4gdXBkYXRlQ29sb3IodHFjbnVtKSwgMjApO1xuICAgIHNldFRpbWVvdXQoICgpID0+IGRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5zdHlsZS5zZXRQcm9wZXJ0eSgnLS1jb2xvci10cmFuc2l0aW9uLXRpbWUnLCBgJHtjb2xvcl90cmFuc2l0aW9uX3RpbWV9YCksIDQwKTtcbn1cblxuLyoqXG4gKiBPbiBib2R5IHJlYWR5XG4gKi9cbmRvY3VtZW50LmJvZHkub25sb2FkID0gKCAoKSA9PiB7XG4gICAgXG4gICAgY29uc3QgbWVudWNiID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ21lbnVjYicpO1xuICAgIGNvbnN0IG1haW5fZWwgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5VGFnTmFtZSgnbWFpbicpWzBdO1xuICAgIFxuICAgIC8vIG9uY2hhbmdlIG1lbnVjYlxuICAgIG1lbnVjYi5vbmNoYW5nZSA9ICggKCkgPT4gc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGlmIChtZW51Y2IuY2hlY2tlZCkge1xuICAgICAgICAgICAgIW1haW5fZWwgfHwgbWFpbl9lbC5jbGFzc0xpc3QuYWRkKCdibHVyJyk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAhbWFpbl9lbCB8fCBtYWluX2VsLmNsYXNzTGlzdC5yZW1vdmUoJ2JsdXInKTtcbiAgICAgICAgfVxuICAgIH0sIDUwKSApO1xuXG4gICAgLy8gb25jaGFuZ2UgY2xyIFxuICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy5jbHInKS5mb3JFYWNoKCAoZWwpID0+IGVsLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCAoZSkgPT4ge1xuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgIGxldCBjID0gZWwuZGF0YXNldC5jO1xuICAgICAgICAhYyB8fCB1cGRhdGVDb2xvcihjKTtcbiAgICAgICAgLy8gdXBkYXRlIHN0b3JhZ2UgXG4gICAgICAgIHdpbmRvdy5sb2NhbFN0b3JhZ2Uuc2V0SXRlbSgndG9wcXVvdGUtY29sb3ItbnVtJywgYyk7XG4gICAgfSkpO1xuXG4gICAgLy8gaWYgaW4gbGFyZ2UgbW9kZSwgY2hlY2sgZm9yIHNheWVyIGhlaWdodCBcbiAgICBjb25zb2xlLmxvZyh3aW5kb3cuaW5uZXJXaWR0aCk7XG4gICAgaWYgKHdpbmRvdy5pbm5lcldpZHRoID49IDEwMjQpIHtcbiAgICAgICAgLy8gZm9yIGV2ZXJ5IGJsb2NrcXVvdGUgXG4gICAgICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJ2Jsb2NrcXVvdGUnKS5mb3JFYWNoKCAoZWwpID0+IHtcbiAgICAgICAgICAgIGNvbnNvbGUubG9nKGVsKVxuICAgICAgICB9KTtcbiAgICB9XG5cbn0gKSgpO1xuIl0sIm5hbWVzIjpbXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./src/js/main.js\n");

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