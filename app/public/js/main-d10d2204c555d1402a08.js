/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/main.js":
/*!************************!*\
  !*** ./src/js/main.js ***!
  \************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_styles_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/styles.scss */ \"./src/scss/styles.scss\");\n\n\nvar updateColor = function updateColor(c) {\n  // set doc's primary color\n  var altClr = getComputedStyle(document.documentElement).getPropertyValue(\"--alt-color-\".concat(c));\n  document.documentElement.style.setProperty('--primary-color', altClr); // update active \n\n  var el_active = document.querySelector('.clr.active');\n  !el_active || el_active.classList.remove('active');\n  var el_new = document.querySelector(\".clr[data-c=\\\"\".concat(c, \"\\\"]\"));\n  !el_new || el_new.classList.add('active');\n}; // update color \n\n\nvar tqcnum = window.localStorage.getItem('topquote-color-num');\n\nif (tqcnum) {\n  var color_transition_time = getComputedStyle(document.documentElement).getPropertyValue('--color-transition-time');\n  document.documentElement.style.setProperty('--color-transition-time', '0ms');\n  setTimeout(function () {\n    return updateColor(tqcnum);\n  }, 20);\n  setTimeout(function () {\n    return document.documentElement.style.setProperty('--color-transition-time', \"\".concat(color_transition_time));\n  }, 40);\n}\n/**\n * On body ready\n */\n\n\ndocument.body.onload = function () {\n  var menucb = document.getElementById('menucb');\n  var main_el = document.getElementsByTagName('main')[0]; // onchange menucb\n\n  menucb.onchange = function () {\n    return setTimeout(function () {\n      if (menucb.checked) {\n        !main_el || main_el.classList.add('blur');\n      } else {\n        !main_el || main_el.classList.remove('blur');\n      }\n    }, 50);\n  }; // onchange clr \n\n\n  document.querySelectorAll('.clr').forEach(function (el) {\n    return el.addEventListener(\"click\", function (e) {\n      e.preventDefault();\n      var c = el.dataset.c;\n      !c || updateColor(c); // update storage \n\n      window.localStorage.setItem('topquote-color-num', c);\n    });\n  }); // if in large mode, check for sayer height \n  // console.log(window.innerWidth);\n\n  if (window.innerWidth >= 1024) {\n    // for every blockquote \n    document.querySelectorAll('blockquote').forEach(function (el) {\n      var sayer_el = el.querySelector('.sayer');\n      var meta_el = el.querySelector('.meta');\n      if (!sayer_el || !meta_el) return;\n      var sayer_top = sayer_el.getBoundingClientRect().top;\n      var sayer_height = sayer_el.offsetHeight;\n      meta_el.style.top = \"\".concat(4 + sayer_height, \"px\");\n    });\n  }\n}();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvanMvbWFpbi5qcy5qcyIsIm1hcHBpbmdzIjoiOztBQUFBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7OztBQUdBOztBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQUE7QUFBQTtBQUNBO0FBQUE7QUFBQTtBQUNBO0FBRUE7QUFDQTtBQUNBOzs7QUFDQTtBQUVBO0FBQ0E7O0FBR0E7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQU5BOzs7QUFTQTtBQUFBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFOQTtBQVNBOztBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQSIsInNvdXJjZXMiOlsid2VicGFjazovL3RvcHF1b3RlLW5sLy4vc3JjL2pzL21haW4uanM/OTI5MSJdLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgJy4uL3Njc3Mvc3R5bGVzLnNjc3MnO1xuXG5jb25zdCB1cGRhdGVDb2xvciA9IChjKSA9PiB7XG4gICAgLy8gc2V0IGRvYydzIHByaW1hcnkgY29sb3JcbiAgICBsZXQgYWx0Q2xyID0gZ2V0Q29tcHV0ZWRTdHlsZShkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQpLmdldFByb3BlcnR5VmFsdWUoYC0tYWx0LWNvbG9yLSR7Y31gKTtcbiAgICBkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQuc3R5bGUuc2V0UHJvcGVydHkoJy0tcHJpbWFyeS1jb2xvcicsIGFsdENscik7XG4gICAgLy8gdXBkYXRlIGFjdGl2ZSBcbiAgICBjb25zdCBlbF9hY3RpdmUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuY2xyLmFjdGl2ZScpXG4gICAgIWVsX2FjdGl2ZSB8fCBlbF9hY3RpdmUuY2xhc3NMaXN0LnJlbW92ZSgnYWN0aXZlJyk7XG4gICAgY29uc3QgZWxfbmV3ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihgLmNscltkYXRhLWM9XCIke2N9XCJdYCk7XG4gICAgIWVsX25ldyB8fCBlbF9uZXcuY2xhc3NMaXN0LmFkZCgnYWN0aXZlJyk7XG59XG5cbi8vIHVwZGF0ZSBjb2xvciBcbmNvbnN0IHRxY251bSA9IHdpbmRvdy5sb2NhbFN0b3JhZ2UuZ2V0SXRlbSgndG9wcXVvdGUtY29sb3ItbnVtJyk7XG5pZiAodHFjbnVtKSB7XG4gICAgXG4gICAgbGV0IGNvbG9yX3RyYW5zaXRpb25fdGltZSA9IGdldENvbXB1dGVkU3R5bGUoZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50KS5nZXRQcm9wZXJ0eVZhbHVlKCctLWNvbG9yLXRyYW5zaXRpb24tdGltZScpO1xuICAgIGRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5zdHlsZS5zZXRQcm9wZXJ0eSgnLS1jb2xvci10cmFuc2l0aW9uLXRpbWUnLCAnMG1zJyk7XG4gICAgc2V0VGltZW91dCggKCkgPT4gdXBkYXRlQ29sb3IodHFjbnVtKSwgMjApO1xuICAgIHNldFRpbWVvdXQoICgpID0+IGRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5zdHlsZS5zZXRQcm9wZXJ0eSgnLS1jb2xvci10cmFuc2l0aW9uLXRpbWUnLCBgJHtjb2xvcl90cmFuc2l0aW9uX3RpbWV9YCksIDQwKTtcbn1cblxuLyoqXG4gKiBPbiBib2R5IHJlYWR5XG4gKi9cbmRvY3VtZW50LmJvZHkub25sb2FkID0gKCAoKSA9PiB7XG4gICAgXG4gICAgY29uc3QgbWVudWNiID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ21lbnVjYicpO1xuICAgIGNvbnN0IG1haW5fZWwgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5VGFnTmFtZSgnbWFpbicpWzBdO1xuICAgIFxuICAgIC8vIG9uY2hhbmdlIG1lbnVjYlxuICAgIG1lbnVjYi5vbmNoYW5nZSA9ICggKCkgPT4gc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGlmIChtZW51Y2IuY2hlY2tlZCkge1xuICAgICAgICAgICAgIW1haW5fZWwgfHwgbWFpbl9lbC5jbGFzc0xpc3QuYWRkKCdibHVyJyk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAhbWFpbl9lbCB8fCBtYWluX2VsLmNsYXNzTGlzdC5yZW1vdmUoJ2JsdXInKTtcbiAgICAgICAgfVxuICAgIH0sIDUwKSApO1xuXG4gICAgLy8gb25jaGFuZ2UgY2xyIFxuICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy5jbHInKS5mb3JFYWNoKCAoZWwpID0+IGVsLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCAoZSkgPT4ge1xuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgIGxldCBjID0gZWwuZGF0YXNldC5jO1xuICAgICAgICAhYyB8fCB1cGRhdGVDb2xvcihjKTtcbiAgICAgICAgLy8gdXBkYXRlIHN0b3JhZ2UgXG4gICAgICAgIHdpbmRvdy5sb2NhbFN0b3JhZ2Uuc2V0SXRlbSgndG9wcXVvdGUtY29sb3ItbnVtJywgYyk7XG4gICAgfSkpO1xuXG4gICAgLy8gaWYgaW4gbGFyZ2UgbW9kZSwgY2hlY2sgZm9yIHNheWVyIGhlaWdodCBcbiAgICAvLyBjb25zb2xlLmxvZyh3aW5kb3cuaW5uZXJXaWR0aCk7XG4gICAgaWYgKHdpbmRvdy5pbm5lcldpZHRoID49IDEwMjQpIHtcbiAgICAgICAgLy8gZm9yIGV2ZXJ5IGJsb2NrcXVvdGUgXG4gICAgICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJ2Jsb2NrcXVvdGUnKS5mb3JFYWNoKCAoZWwpID0+IHtcbiAgICAgICAgICAgIGxldCBzYXllcl9lbCA9IGVsLnF1ZXJ5U2VsZWN0b3IoJy5zYXllcicpO1xuICAgICAgICAgICAgbGV0IG1ldGFfZWwgPSBlbC5xdWVyeVNlbGVjdG9yKCcubWV0YScpO1xuICAgICAgICAgICAgaWYgKCFzYXllcl9lbCB8fCAhbWV0YV9lbCkgcmV0dXJuO1xuICAgICAgICAgICAgbGV0IHNheWVyX3RvcCA9IHNheWVyX2VsLmdldEJvdW5kaW5nQ2xpZW50UmVjdCgpLnRvcDtcbiAgICAgICAgICAgIGxldCBzYXllcl9oZWlnaHQgPSBzYXllcl9lbC5vZmZzZXRIZWlnaHQ7XG4gICAgICAgICAgICBtZXRhX2VsLnN0eWxlLnRvcCA9IGAkezQgKyBzYXllcl9oZWlnaHR9cHhgO1xuICAgICAgICB9KTtcbiAgICB9XG5cbn0gKSgpO1xuIl0sIm5hbWVzIjpbXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./src/js/main.js\n");

/***/ }),

/***/ "./src/scss/styles.scss":
/*!******************************!*\
  !*** ./src/scss/styles.scss ***!
  \******************************/
/***/ (function() {

throw new Error("Module build failed (from ./node_modules/mini-css-extract-plugin/dist/loader.js):\nHookWebpackError: Module build failed (from ./node_modules/sass-loader/dist/cjs.js):\nSassError: argument `$color` of `darken($color, $amount)` must be a color\n        on line 116 of src/scss/partials/base.scss, in function `darken`\n        from line 116 of src/scss/partials/base.scss\n        from line 3 of src/scss/styles.scss\n>>     border-bottom: 6px solid darken(var(--primary-color), 10%);\n\n   -----------------------------^\n\n    at tryRunOrWebpackError (/Users/jos/workspace/topquote.nl/node_modules/webpack/lib/HookWebpackError.js:88:9)\n    at __webpack_require_module__ (/Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:5051:12)\n    at __webpack_require__ (/Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:5008:18)\n    at /Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:5079:20\n    at symbolIterator (/Users/jos/workspace/topquote.nl/node_modules/neo-async/async.js:3485:9)\n    at done (/Users/jos/workspace/topquote.nl/node_modules/neo-async/async.js:3527:9)\n    at Hook.eval [as callAsync] (eval at create (/Users/jos/workspace/topquote.nl/node_modules/tapable/lib/HookCodeFactory.js:33:10), <anonymous>:15:1)\n    at Hook.CALL_ASYNC_DELEGATE [as _callAsync] (/Users/jos/workspace/topquote.nl/node_modules/tapable/lib/Hook.js:18:14)\n    at /Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:4986:43\n    at symbolIterator (/Users/jos/workspace/topquote.nl/node_modules/neo-async/async.js:3482:9)\n-- inner error --\nError: Module build failed (from ./node_modules/sass-loader/dist/cjs.js):\nSassError: argument `$color` of `darken($color, $amount)` must be a color\n        on line 116 of src/scss/partials/base.scss, in function `darken`\n        from line 116 of src/scss/partials/base.scss\n        from line 3 of src/scss/styles.scss\n>>     border-bottom: 6px solid darken(var(--primary-color), 10%);\n\n   -----------------------------^\n\n    at Object.<anonymous> (/Users/jos/workspace/topquote.nl/node_modules/css-loader/dist/cjs.js!/Users/jos/workspace/topquote.nl/node_modules/resolve-url-loader/index.js??ruleSet[1].rules[1].use[2]!/Users/jos/workspace/topquote.nl/node_modules/sass-loader/dist/cjs.js??ruleSet[1].rules[1].use[3]!/Users/jos/workspace/topquote.nl/src/scss/styles.scss:1:7)\n    at /Users/jos/workspace/topquote.nl/node_modules/webpack/lib/javascript/JavascriptModulesPlugin.js:441:11\n    at Hook.eval [as call] (eval at create (/Users/jos/workspace/topquote.nl/node_modules/tapable/lib/HookCodeFactory.js:19:10), <anonymous>:7:1)\n    at Hook.CALL_DELEGATE [as _call] (/Users/jos/workspace/topquote.nl/node_modules/tapable/lib/Hook.js:14:14)\n    at /Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:5053:39\n    at tryRunOrWebpackError (/Users/jos/workspace/topquote.nl/node_modules/webpack/lib/HookWebpackError.js:83:7)\n    at __webpack_require_module__ (/Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:5051:12)\n    at __webpack_require__ (/Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:5008:18)\n    at /Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:5079:20\n    at symbolIterator (/Users/jos/workspace/topquote.nl/node_modules/neo-async/async.js:3485:9)\n\nGenerated code for /Users/jos/workspace/topquote.nl/node_modules/css-loader/dist/cjs.js!/Users/jos/workspace/topquote.nl/node_modules/resolve-url-loader/index.js??ruleSet[1].rules[1].use[2]!/Users/jos/workspace/topquote.nl/node_modules/sass-loader/dist/cjs.js??ruleSet[1].rules[1].use[3]!/Users/jos/workspace/topquote.nl/src/scss/styles.scss\n1 | throw new Error(\"Module build failed (from ./node_modules/sass-loader/dist/cjs.js):\\nSassError: argument `$color` of `darken($color, $amount)` must be a color\\n        on line 116 of src/scss/partials/base.scss, in function `darken`\\n        from line 116 of src/scss/partials/base.scss\\n        from line 3 of src/scss/styles.scss\\n>>     border-bottom: 6px solid darken(var(--primary-color), 10%);\\n\\n   -----------------------------^\\n\");");

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