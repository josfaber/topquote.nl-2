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
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_styles_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/styles.scss */ \"./src/scss/styles.scss\");\n\n/**\n * On body ready\n */\n\ndocument.body.onload = function () {\n  var menucb = document.getElementById('menucb');\n  var main_el = document.getElementsByTagName('main')[0]; // onchange menucb\n\n  menucb.onchange = function () {\n    return setTimeout(function () {\n      if (menucb.checked) {\n        !main_el || main_el.classList.add('blur');\n      } else {\n        !main_el || main_el.classList.remove('blur');\n      }\n    }, 50);\n  };\n}();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvanMvbWFpbi5qcy5qcyIsIm1hcHBpbmdzIjoiOztBQUFBO0FBRUE7QUFDQTtBQUNBOztBQUNBO0FBRUE7QUFDQTs7QUFHQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBTkE7QUFRQSIsInNvdXJjZXMiOlsid2VicGFjazovL3RvcHF1b3RlLW5sLy4vc3JjL2pzL21haW4uanM/OTI5MSJdLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgJy4uL3Njc3Mvc3R5bGVzLnNjc3MnO1xuXG4vKipcbiAqIE9uIGJvZHkgcmVhZHlcbiAqL1xuZG9jdW1lbnQuYm9keS5vbmxvYWQgPSAoICgpID0+IHtcblxuICAgIGNvbnN0IG1lbnVjYiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdtZW51Y2InKTtcbiAgICBjb25zdCBtYWluX2VsID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeVRhZ05hbWUoJ21haW4nKVswXTtcblxuICAgIC8vIG9uY2hhbmdlIG1lbnVjYlxuICAgIG1lbnVjYi5vbmNoYW5nZSA9ICggKCkgPT4gc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGlmIChtZW51Y2IuY2hlY2tlZCkge1xuICAgICAgICAgICAgIW1haW5fZWwgfHwgbWFpbl9lbC5jbGFzc0xpc3QuYWRkKCdibHVyJyk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAhbWFpbl9lbCB8fCBtYWluX2VsLmNsYXNzTGlzdC5yZW1vdmUoJ2JsdXInKTtcbiAgICAgICAgfVxuICAgIH0sIDUwKSApO1xuXG59ICkoKTtcbiJdLCJuYW1lcyI6W10sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/js/main.js\n");

/***/ }),

/***/ "./src/scss/styles.scss":
/*!******************************!*\
  !*** ./src/scss/styles.scss ***!
  \******************************/
/***/ (function() {

throw new Error("Module build failed (from ./node_modules/mini-css-extract-plugin/dist/loader.js):\nHookWebpackError: Module build failed (from ./node_modules/sass-loader/dist/cjs.js):\nSassError: property \"l\" must be followed by a ':'\n        on line 5 of src/scss/partials/quotes.scss\n        from line 5 of src/scss/styles.scss\n>>     color: $white;l\n\n   ------------------^\n\n    at tryRunOrWebpackError (/Users/jos/workspace/topquote.nl/node_modules/webpack/lib/HookWebpackError.js:88:9)\n    at __webpack_require_module__ (/Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:5051:12)\n    at __webpack_require__ (/Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:5008:18)\n    at /Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:5079:20\n    at symbolIterator (/Users/jos/workspace/topquote.nl/node_modules/neo-async/async.js:3485:9)\n    at done (/Users/jos/workspace/topquote.nl/node_modules/neo-async/async.js:3527:9)\n    at Hook.eval [as callAsync] (eval at create (/Users/jos/workspace/topquote.nl/node_modules/tapable/lib/HookCodeFactory.js:33:10), <anonymous>:15:1)\n    at Hook.CALL_ASYNC_DELEGATE [as _callAsync] (/Users/jos/workspace/topquote.nl/node_modules/tapable/lib/Hook.js:18:14)\n    at /Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:4986:43\n    at symbolIterator (/Users/jos/workspace/topquote.nl/node_modules/neo-async/async.js:3482:9)\n-- inner error --\nError: Module build failed (from ./node_modules/sass-loader/dist/cjs.js):\nSassError: property \"l\" must be followed by a ':'\n        on line 5 of src/scss/partials/quotes.scss\n        from line 5 of src/scss/styles.scss\n>>     color: $white;l\n\n   ------------------^\n\n    at Object.<anonymous> (/Users/jos/workspace/topquote.nl/node_modules/css-loader/dist/cjs.js!/Users/jos/workspace/topquote.nl/node_modules/resolve-url-loader/index.js??ruleSet[1].rules[1].use[2]!/Users/jos/workspace/topquote.nl/node_modules/sass-loader/dist/cjs.js??ruleSet[1].rules[1].use[3]!/Users/jos/workspace/topquote.nl/src/scss/styles.scss:1:7)\n    at /Users/jos/workspace/topquote.nl/node_modules/webpack/lib/javascript/JavascriptModulesPlugin.js:441:11\n    at Hook.eval [as call] (eval at create (/Users/jos/workspace/topquote.nl/node_modules/tapable/lib/HookCodeFactory.js:19:10), <anonymous>:7:1)\n    at Hook.CALL_DELEGATE [as _call] (/Users/jos/workspace/topquote.nl/node_modules/tapable/lib/Hook.js:14:14)\n    at /Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:5053:39\n    at tryRunOrWebpackError (/Users/jos/workspace/topquote.nl/node_modules/webpack/lib/HookWebpackError.js:83:7)\n    at __webpack_require_module__ (/Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:5051:12)\n    at __webpack_require__ (/Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:5008:18)\n    at /Users/jos/workspace/topquote.nl/node_modules/webpack/lib/Compilation.js:5079:20\n    at symbolIterator (/Users/jos/workspace/topquote.nl/node_modules/neo-async/async.js:3485:9)\n\nGenerated code for /Users/jos/workspace/topquote.nl/node_modules/css-loader/dist/cjs.js!/Users/jos/workspace/topquote.nl/node_modules/resolve-url-loader/index.js??ruleSet[1].rules[1].use[2]!/Users/jos/workspace/topquote.nl/node_modules/sass-loader/dist/cjs.js??ruleSet[1].rules[1].use[3]!/Users/jos/workspace/topquote.nl/src/scss/styles.scss\n1 | throw new Error(\"Module build failed (from ./node_modules/sass-loader/dist/cjs.js):\\nSassError: property \\\"l\\\" must be followed by a ':'\\n        on line 5 of src/scss/partials/quotes.scss\\n        from line 5 of src/scss/styles.scss\\n>>     color: $white;l\\n\\n   ------------------^\\n\");");

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