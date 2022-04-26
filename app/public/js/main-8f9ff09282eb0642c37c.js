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

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_styles_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/styles.scss */ \"./src/scss/styles.scss\");\n\n/**\n * On body ready\n */\n\ndocument.body.onload = function () {\n  var menucb = document.getElementById('menucb');\n  var main_el = document.getElementsByTagName('main')[0];\n  var setProp = document.documentElement.style.setProperty;\n  var getProp = document.documentElement.style.getPropertyValue; // onchange menucb\n\n  menucb.onchange = function () {\n    return setTimeout(function () {\n      if (menucb.checked) {\n        !main_el || main_el.classList.add('blur');\n      } else {\n        !main_el || main_el.classList.remove('blur');\n      }\n    }, 50);\n  }; // onchange clr \n\n\n  document.querySelectorAll('.clr').forEach(function (el) {\n    return el.addEventListener(\"click\", function () {\n      var clr = el.getAttribute('data-clr');\n      setProp('--primary-color', getProp(\"--alt-color-\".concat(clr)));\n    });\n  });\n}();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvanMvbWFpbi5qcy5qcyIsIm1hcHBpbmdzIjoiOztBQUFBO0FBRUE7QUFDQTtBQUNBOztBQUNBO0FBRUE7QUFDQTtBQUVBO0FBQ0E7O0FBR0E7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQU5BOzs7QUFTQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBSEE7QUFLQSIsInNvdXJjZXMiOlsid2VicGFjazovL3RvcHF1b3RlLW5sLy4vc3JjL2pzL21haW4uanM/OTI5MSJdLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgJy4uL3Njc3Mvc3R5bGVzLnNjc3MnO1xuXG4vKipcbiAqIE9uIGJvZHkgcmVhZHlcbiAqL1xuZG9jdW1lbnQuYm9keS5vbmxvYWQgPSAoICgpID0+IHtcbiAgICBcbiAgICBjb25zdCBtZW51Y2IgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbWVudWNiJyk7XG4gICAgY29uc3QgbWFpbl9lbCA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlUYWdOYW1lKCdtYWluJylbMF07XG4gICAgXG4gICAgY29uc3Qgc2V0UHJvcCA9IGRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5zdHlsZS5zZXRQcm9wZXJ0eTtcbiAgICBjb25zdCBnZXRQcm9wID0gZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LnN0eWxlLmdldFByb3BlcnR5VmFsdWU7XG4gICAgXG4gICAgLy8gb25jaGFuZ2UgbWVudWNiXG4gICAgbWVudWNiLm9uY2hhbmdlID0gKCAoKSA9PiBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgaWYgKG1lbnVjYi5jaGVja2VkKSB7XG4gICAgICAgICAgICAhbWFpbl9lbCB8fCBtYWluX2VsLmNsYXNzTGlzdC5hZGQoJ2JsdXInKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICFtYWluX2VsIHx8IG1haW5fZWwuY2xhc3NMaXN0LnJlbW92ZSgnYmx1cicpO1xuICAgICAgICB9XG4gICAgfSwgNTApICk7XG5cbiAgICAvLyBvbmNoYW5nZSBjbHIgXG4gICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLmNscicpLmZvckVhY2goIChlbCkgPT4gZWwuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsICgpID0+IHtcbiAgICAgICAgY29uc3QgY2xyID0gZWwuZ2V0QXR0cmlidXRlKCdkYXRhLWNscicpO1xuICAgICAgICBzZXRQcm9wKCctLXByaW1hcnktY29sb3InLCBnZXRQcm9wKGAtLWFsdC1jb2xvci0ke2Nscn1gKSk7XG4gICAgfSkpO1xuXG59ICkoKTtcbiJdLCJuYW1lcyI6W10sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/js/main.js\n");

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