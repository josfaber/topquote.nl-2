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

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_styles_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/styles.scss */ \"./src/scss/styles.scss\");\n\n/**\n * On body ready\n */\n\ndocument.body.onload = function () {\n  var menucb = document.getElementById('menucb');\n  var main_el = document.getElementsByTagName('main')[0];\n  var setProp = document.documentElement.style.setProperty;\n  var getProp = document.documentElement.style.getPropertyValue; // onchange menucb\n\n  menucb.onchange = function () {\n    return setTimeout(function () {\n      if (menucb.checked) {\n        !main_el || main_el.classList.add('blur');\n      } else {\n        !main_el || main_el.classList.remove('blur');\n      }\n    }, 50);\n  }; // onchange clr \n\n\n  document.querySelectorAll('.clr').forEach(function (el) {\n    return el.addEventListener(\"click\", function (e) {\n      e.preventDefault();\n      console.log('color', clr, getProp(\"--alt-color-\".concat(clr)));\n      var clr = el.getAttribute('data-clr');\n      setProp('--primary-color', getProp(\"--alt-color-\".concat(clr)));\n    });\n  });\n}();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvanMvbWFpbi5qcy5qcyIsIm1hcHBpbmdzIjoiOztBQUFBO0FBRUE7QUFDQTtBQUNBOztBQUNBO0FBRUE7QUFDQTtBQUVBO0FBQ0E7O0FBR0E7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQU5BOzs7QUFTQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUxBO0FBT0EiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly90b3BxdW90ZS1ubC8uL3NyYy9qcy9tYWluLmpzPzkyOTEiXSwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0ICcuLi9zY3NzL3N0eWxlcy5zY3NzJztcblxuLyoqXG4gKiBPbiBib2R5IHJlYWR5XG4gKi9cbmRvY3VtZW50LmJvZHkub25sb2FkID0gKCAoKSA9PiB7XG4gICAgXG4gICAgY29uc3QgbWVudWNiID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ21lbnVjYicpO1xuICAgIGNvbnN0IG1haW5fZWwgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5VGFnTmFtZSgnbWFpbicpWzBdO1xuICAgIFxuICAgIGNvbnN0IHNldFByb3AgPSBkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQuc3R5bGUuc2V0UHJvcGVydHk7XG4gICAgY29uc3QgZ2V0UHJvcCA9IGRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5zdHlsZS5nZXRQcm9wZXJ0eVZhbHVlO1xuICAgIFxuICAgIC8vIG9uY2hhbmdlIG1lbnVjYlxuICAgIG1lbnVjYi5vbmNoYW5nZSA9ICggKCkgPT4gc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGlmIChtZW51Y2IuY2hlY2tlZCkge1xuICAgICAgICAgICAgIW1haW5fZWwgfHwgbWFpbl9lbC5jbGFzc0xpc3QuYWRkKCdibHVyJyk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAhbWFpbl9lbCB8fCBtYWluX2VsLmNsYXNzTGlzdC5yZW1vdmUoJ2JsdXInKTtcbiAgICAgICAgfVxuICAgIH0sIDUwKSApO1xuXG4gICAgLy8gb25jaGFuZ2UgY2xyIFxuICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy5jbHInKS5mb3JFYWNoKCAoZWwpID0+IGVsLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCAoZSkgPT4ge1xuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgIGNvbnNvbGUubG9nKCdjb2xvcicsIGNsciwgZ2V0UHJvcChgLS1hbHQtY29sb3ItJHtjbHJ9YCkpO1xuICAgICAgICBjb25zdCBjbHIgPSBlbC5nZXRBdHRyaWJ1dGUoJ2RhdGEtY2xyJyk7XG4gICAgICAgIHNldFByb3AoJy0tcHJpbWFyeS1jb2xvcicsIGdldFByb3AoYC0tYWx0LWNvbG9yLSR7Y2xyfWApKTtcbiAgICB9KSk7XG5cbn0gKSgpO1xuIl0sIm5hbWVzIjpbXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./src/js/main.js\n");

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