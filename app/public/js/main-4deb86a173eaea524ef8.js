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

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_styles_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/styles.scss */ \"./src/scss/styles.scss\");\n\n\nvar updateColor = function updateColor(c) {\n  // set doc's primary color\n  var altClr = getComputedStyle(document.documentElement).getPropertyValue(\"--alt-color-\".concat(c));\n  document.documentElement.style.setProperty('--primary-color', altClr); // update active \n\n  var el_active = document.querySelector('.clr.active');\n  !el_active || el_active.classList.remove('active');\n  var el_new = document.querySelector(\".clr[data-c=\\\"\".concat(c, \"\\\"]\"));\n  !el_new || el_new.classList.add('active');\n}; // update color \n\n\nvar tqcnum = window.localStorage.getItem('topquote-color-num');\n\nif (tqcnum) {\n  var color_transition_time = getComputedStyle(document.documentElement).getPropertyValue('--color-transition-time');\n  document.documentElement.style.setProperty('--color-transition-time', '0ms');\n  setTimeout(function () {\n    return updateColor(tqcnum);\n  }, 20);\n  setTimeout(function () {\n    return document.documentElement.style.setProperty('--color-transition-time', \"\".concat(color_transition_time));\n  }, 40);\n}\n/**\n * On body ready\n */\n\n\ndocument.body.onload = function () {\n  var menucb = document.getElementById('menucb');\n  var main_el = document.getElementsByTagName('main')[0];\n\n  var bodyClickHandler = function bodyClickHandler(e) {\n    !main_el || main_el.removeEventListener('click', bodyClickHandler);\n    !main_el || main_el.classList.remove('blur');\n    menucb.checked = false;\n  }; // onchange menucb\n\n\n  menucb.onchange = function () {\n    return setTimeout(function () {\n      if (menucb.checked) {\n        !main_el || main_el.classList.add('blur');\n        !main_el || main_el.addEventListener('click', bodyClickHandler);\n      } else {\n        !main_el || main_el.classList.remove('blur');\n        !main_el || main_el.removeEventListener('click', bodyClickHandler);\n      }\n    }, 50);\n  }; // onchange clr \n\n\n  document.querySelectorAll('.clr').forEach(function (el) {\n    return el.addEventListener(\"click\", function (e) {\n      e.preventDefault();\n      var c = el.dataset.c;\n      !c || updateColor(c); // update storage \n\n      window.localStorage.setItem('topquote-color-num', c);\n    });\n  }); // if in large mode, check for sayer height \n  // console.log(window.innerWidth);\n\n  if (window.innerWidth >= 1024) {\n    // for every blockquote \n    document.querySelectorAll('blockquote').forEach(function (el) {\n      var sayer_el = el.querySelector('.sayer');\n      var meta_el = el.querySelector('.meta');\n      if (!sayer_el || !meta_el) return;\n      var sayer_top = sayer_el.getBoundingClientRect().top;\n      var sayer_height = sayer_el.offsetHeight;\n      meta_el.style.top = \"\".concat(4 + sayer_height, \"px\");\n    });\n  }\n}();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvanMvbWFpbi5qcy5qcyIsIm1hcHBpbmdzIjoiOztBQUFBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7OztBQUdBOztBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQUE7QUFBQTtBQUNBO0FBQUE7QUFBQTtBQUNBO0FBRUE7QUFDQTtBQUNBOzs7QUFDQTtBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7O0FBR0E7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFSQTs7O0FBV0E7QUFBQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBTkE7QUFTQTs7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUEiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly90b3BxdW90ZS1ubC8uL3NyYy9qcy9tYWluLmpzPzkyOTEiXSwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0ICcuLi9zY3NzL3N0eWxlcy5zY3NzJztcblxuY29uc3QgdXBkYXRlQ29sb3IgPSAoYykgPT4ge1xuICAgIC8vIHNldCBkb2MncyBwcmltYXJ5IGNvbG9yXG4gICAgbGV0IGFsdENsciA9IGdldENvbXB1dGVkU3R5bGUoZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50KS5nZXRQcm9wZXJ0eVZhbHVlKGAtLWFsdC1jb2xvci0ke2N9YCk7XG4gICAgZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LnN0eWxlLnNldFByb3BlcnR5KCctLXByaW1hcnktY29sb3InLCBhbHRDbHIpO1xuICAgIC8vIHVwZGF0ZSBhY3RpdmUgXG4gICAgY29uc3QgZWxfYWN0aXZlID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLmNsci5hY3RpdmUnKVxuICAgICFlbF9hY3RpdmUgfHwgZWxfYWN0aXZlLmNsYXNzTGlzdC5yZW1vdmUoJ2FjdGl2ZScpO1xuICAgIGNvbnN0IGVsX25ldyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoYC5jbHJbZGF0YS1jPVwiJHtjfVwiXWApO1xuICAgICFlbF9uZXcgfHwgZWxfbmV3LmNsYXNzTGlzdC5hZGQoJ2FjdGl2ZScpO1xufVxuXG4vLyB1cGRhdGUgY29sb3IgXG5jb25zdCB0cWNudW0gPSB3aW5kb3cubG9jYWxTdG9yYWdlLmdldEl0ZW0oJ3RvcHF1b3RlLWNvbG9yLW51bScpO1xuaWYgKHRxY251bSkge1xuICAgIFxuICAgIGxldCBjb2xvcl90cmFuc2l0aW9uX3RpbWUgPSBnZXRDb21wdXRlZFN0eWxlKGRvY3VtZW50LmRvY3VtZW50RWxlbWVudCkuZ2V0UHJvcGVydHlWYWx1ZSgnLS1jb2xvci10cmFuc2l0aW9uLXRpbWUnKTtcbiAgICBkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQuc3R5bGUuc2V0UHJvcGVydHkoJy0tY29sb3ItdHJhbnNpdGlvbi10aW1lJywgJzBtcycpO1xuICAgIHNldFRpbWVvdXQoICgpID0+IHVwZGF0ZUNvbG9yKHRxY251bSksIDIwKTtcbiAgICBzZXRUaW1lb3V0KCAoKSA9PiBkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQuc3R5bGUuc2V0UHJvcGVydHkoJy0tY29sb3ItdHJhbnNpdGlvbi10aW1lJywgYCR7Y29sb3JfdHJhbnNpdGlvbl90aW1lfWApLCA0MCk7XG59XG5cbi8qKlxuICogT24gYm9keSByZWFkeVxuICovXG5kb2N1bWVudC5ib2R5Lm9ubG9hZCA9ICggKCkgPT4ge1xuICAgIFxuICAgIGNvbnN0IG1lbnVjYiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdtZW51Y2InKTtcbiAgICBjb25zdCBtYWluX2VsID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeVRhZ05hbWUoJ21haW4nKVswXTtcbiAgICBcbiAgICBjb25zdCBib2R5Q2xpY2tIYW5kbGVyID0gKGUpID0+IHtcbiAgICAgICAgIW1haW5fZWwgfHwgbWFpbl9lbC5yZW1vdmVFdmVudExpc3RlbmVyKCdjbGljaycsIGJvZHlDbGlja0hhbmRsZXIpO1xuICAgICAgICAhbWFpbl9lbCB8fCBtYWluX2VsLmNsYXNzTGlzdC5yZW1vdmUoJ2JsdXInKTtcbiAgICAgICAgbWVudWNiLmNoZWNrZWQgPSBmYWxzZTtcbiAgICB9XG5cbiAgICAvLyBvbmNoYW5nZSBtZW51Y2JcbiAgICBtZW51Y2Iub25jaGFuZ2UgPSAoICgpID0+IHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBpZiAobWVudWNiLmNoZWNrZWQpIHtcbiAgICAgICAgICAgICFtYWluX2VsIHx8IG1haW5fZWwuY2xhc3NMaXN0LmFkZCgnYmx1cicpO1xuICAgICAgICAgICAgIW1haW5fZWwgfHwgbWFpbl9lbC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGJvZHlDbGlja0hhbmRsZXIpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgIW1haW5fZWwgfHwgbWFpbl9lbC5jbGFzc0xpc3QucmVtb3ZlKCdibHVyJyk7XG4gICAgICAgICAgICAhbWFpbl9lbCB8fCBtYWluX2VsLnJlbW92ZUV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgYm9keUNsaWNrSGFuZGxlcik7XG4gICAgICAgIH1cbiAgICB9LCA1MCkgKTtcblxuICAgIC8vIG9uY2hhbmdlIGNsciBcbiAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcuY2xyJykuZm9yRWFjaCggKGVsKSA9PiBlbC5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgKGUpID0+IHtcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICBsZXQgYyA9IGVsLmRhdGFzZXQuYztcbiAgICAgICAgIWMgfHwgdXBkYXRlQ29sb3IoYyk7XG4gICAgICAgIC8vIHVwZGF0ZSBzdG9yYWdlIFxuICAgICAgICB3aW5kb3cubG9jYWxTdG9yYWdlLnNldEl0ZW0oJ3RvcHF1b3RlLWNvbG9yLW51bScsIGMpO1xuICAgIH0pKTtcblxuICAgIC8vIGlmIGluIGxhcmdlIG1vZGUsIGNoZWNrIGZvciBzYXllciBoZWlnaHQgXG4gICAgLy8gY29uc29sZS5sb2cod2luZG93LmlubmVyV2lkdGgpO1xuICAgIGlmICh3aW5kb3cuaW5uZXJXaWR0aCA+PSAxMDI0KSB7XG4gICAgICAgIC8vIGZvciBldmVyeSBibG9ja3F1b3RlIFxuICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCdibG9ja3F1b3RlJykuZm9yRWFjaCggKGVsKSA9PiB7XG4gICAgICAgICAgICBsZXQgc2F5ZXJfZWwgPSBlbC5xdWVyeVNlbGVjdG9yKCcuc2F5ZXInKTtcbiAgICAgICAgICAgIGxldCBtZXRhX2VsID0gZWwucXVlcnlTZWxlY3RvcignLm1ldGEnKTtcbiAgICAgICAgICAgIGlmICghc2F5ZXJfZWwgfHwgIW1ldGFfZWwpIHJldHVybjtcbiAgICAgICAgICAgIGxldCBzYXllcl90b3AgPSBzYXllcl9lbC5nZXRCb3VuZGluZ0NsaWVudFJlY3QoKS50b3A7XG4gICAgICAgICAgICBsZXQgc2F5ZXJfaGVpZ2h0ID0gc2F5ZXJfZWwub2Zmc2V0SGVpZ2h0O1xuICAgICAgICAgICAgbWV0YV9lbC5zdHlsZS50b3AgPSBgJHs0ICsgc2F5ZXJfaGVpZ2h0fXB4YDtcbiAgICAgICAgfSk7XG4gICAgfVxuXG59ICkoKTtcbiJdLCJuYW1lcyI6W10sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/js/main.js\n");

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