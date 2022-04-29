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

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_styles_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/styles.scss */ \"./src/scss/styles.scss\");\n\n\nvar updateColor = function updateColor(c) {\n  // set doc's primary color\n  var altClr = getComputedStyle(document.documentElement).getPropertyValue(\"--alt-color-\".concat(c));\n  document.documentElement.style.setProperty('--primary-color', altClr); // update active \n\n  var el_active = document.querySelector('.clr.active');\n  !el_active || el_active.classList.remove('active');\n  var el_new = document.querySelector(\".clr[data-c=\\\"\".concat(c, \"\\\"]\"));\n  !el_new || el_new.classList.add('active');\n}; // update color \n\n\nvar tqcnum = window.localStorage.getItem('topquote-color-num');\nvar transitionTimeoutTime = tqcnum ? 100 : 5;\n\nif (!tqcnum) {\n  tqcnum = 0;\n  window.localStorage.setItem('topquote-color-num', tqcnum);\n}\n\nvar color_transition_time = getComputedStyle(document.documentElement).getPropertyValue('--color-transition-time');\ndocument.documentElement.style.setProperty('--color-transition-time', '0ms');\nsetTimeout(function () {\n  return updateColor(tqcnum);\n}, 20);\nsetTimeout(function () {\n  return document.documentElement.style.setProperty('--color-transition-time', \"\".concat(color_transition_time));\n}, transitionTimeoutTime);\n\nvar scaleDownQuote = function scaleDownQuote(el) {\n  var fontSizeRem = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 3.6;\n  var minFontSizeRem = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 1;\n  if (!el) return;\n  el.style.fontSize = \"\".concat(fontSizeRem, \"rem\");\n  var elHeight = el.offsetHeight;\n  var winHeight = window.innerHeight;\n  if (elHeight > minFontSizeRem && elHeight > 0.8 * winHeight) scaleDownQuote(el, fontSizeRem - 0.1, minFontSizeRem);\n};\n/**\n * On body ready\n */\n\n\ndocument.body.onload = function () {\n  var menucb = document.getElementById('menucb');\n  var main_el = document.getElementsByTagName('main')[0];\n\n  var bodyClickHandler = function bodyClickHandler(e) {\n    !main_el || main_el.removeEventListener('click', bodyClickHandler);\n    !main_el || main_el.classList.remove('blur');\n    menucb.checked = false;\n  }; // onchange menucb\n\n\n  menucb.onchange = function () {\n    return setTimeout(function () {\n      if (menucb.checked) {\n        !main_el || main_el.classList.add('blur');\n        !main_el || main_el.addEventListener('click', bodyClickHandler);\n      } else {\n        !main_el || main_el.classList.remove('blur');\n        !main_el || main_el.removeEventListener('click', bodyClickHandler);\n      }\n    }, 50);\n  }; // onchange clr \n\n\n  document.querySelectorAll('.clr').forEach(function (el) {\n    return el.addEventListener(\"click\", function (e) {\n      e.preventDefault();\n      var c = el.dataset.c;\n      !c || updateColor(c); // update storage \n\n      window.localStorage.setItem('topquote-color-num', c);\n    });\n  }); // if in large mode, check for sayer height \n  // console.log(window.innerWidth);\n\n  if (window.innerWidth >= 1024) {\n    // for every blockquote \n    document.querySelectorAll('blockquote').forEach(function (el) {\n      var sayer_el = el.querySelector('.sayer');\n      var meta_el = el.querySelector('.meta');\n      if (!sayer_el || !meta_el) return;\n      var sayer_top = sayer_el.getBoundingClientRect().top;\n      var sayer_height = sayer_el.offsetHeight;\n      meta_el.style.top = \"\".concat(4 + sayer_height, \"px\");\n    });\n  } // handle add form \n\n\n  var addForm = document.getElementById('addForm');\n\n  if (addForm) {\n    addForm.addEventListener('submit', function (e) {\n      e.preventDefault();\n      grecaptcha.ready(function () {\n        grecaptcha.execute(window.tqd.rsk, {\n          action: 'submit'\n        }).then(function (token) {\n          document.getElementById('rtoken').value = token;\n          e.target.submit();\n        });\n      });\n    });\n  } // single quote\n\n\n  if (document.body.classList.contains(\"single-quote\")) {\n    scaleDownQuote(document.querySelector('blockquote .quote'));\n  } // hide title on home no scroll \n\n\n  if (document.body.classList.contains(\"home\")) {\n    var title_el = document.getElementById('title');\n\n    window.onscroll = function () {\n      var scrollPos = window.pageYOffset;\n\n      if (scrollPos > 160 && !title_el.classList.contains('active')) {\n        title_el.classList.add('active');\n      } else if (scrollPos <= 160 && title_el.classList.contains('active')) {\n        title_el.classList.remove('active');\n      }\n    };\n  }\n}();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvanMvbWFpbi5qcy5qcyIsIm1hcHBpbmdzIjoiOztBQUFBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7OztBQUdBO0FBQ0E7O0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBQ0E7QUFDQTtBQUNBO0FBQUE7QUFBQTtBQUNBO0FBQUE7QUFBQTs7QUFFQTtBQUFBO0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7OztBQUNBO0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7QUFHQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQVJBOzs7QUFXQTtBQUFBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFOQTtBQVNBOztBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7OztBQUdBOztBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFBQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7QUFHQTtBQUNBO0FBQ0E7OztBQUVBO0FBQ0E7O0FBQ0E7QUFDQTs7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vdG9wcXVvdGUtbmwvLi9zcmMvanMvbWFpbi5qcz85MjkxIl0sInNvdXJjZXNDb250ZW50IjpbImltcG9ydCAnLi4vc2Nzcy9zdHlsZXMuc2Nzcyc7XG5cbmNvbnN0IHVwZGF0ZUNvbG9yID0gKGMpID0+IHtcbiAgICAvLyBzZXQgZG9jJ3MgcHJpbWFyeSBjb2xvclxuICAgIGxldCBhbHRDbHIgPSBnZXRDb21wdXRlZFN0eWxlKGRvY3VtZW50LmRvY3VtZW50RWxlbWVudCkuZ2V0UHJvcGVydHlWYWx1ZShgLS1hbHQtY29sb3ItJHtjfWApO1xuICAgIGRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5zdHlsZS5zZXRQcm9wZXJ0eSgnLS1wcmltYXJ5LWNvbG9yJywgYWx0Q2xyKTtcbiAgICAvLyB1cGRhdGUgYWN0aXZlIFxuICAgIGNvbnN0IGVsX2FjdGl2ZSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5jbHIuYWN0aXZlJylcbiAgICAhZWxfYWN0aXZlIHx8IGVsX2FjdGl2ZS5jbGFzc0xpc3QucmVtb3ZlKCdhY3RpdmUnKTtcbiAgICBjb25zdCBlbF9uZXcgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKGAuY2xyW2RhdGEtYz1cIiR7Y31cIl1gKTtcbiAgICAhZWxfbmV3IHx8IGVsX25ldy5jbGFzc0xpc3QuYWRkKCdhY3RpdmUnKTtcbn1cblxuLy8gdXBkYXRlIGNvbG9yIFxubGV0IHRxY251bSA9IHdpbmRvdy5sb2NhbFN0b3JhZ2UuZ2V0SXRlbSgndG9wcXVvdGUtY29sb3ItbnVtJyk7XG5jb25zdCB0cmFuc2l0aW9uVGltZW91dFRpbWUgPSB0cWNudW0gPyAxMDAgOiA1O1xuaWYgKCF0cWNudW0pIHtcbiAgICB0cWNudW0gPSAwO1xuICAgIHdpbmRvdy5sb2NhbFN0b3JhZ2Uuc2V0SXRlbSgndG9wcXVvdGUtY29sb3ItbnVtJywgdHFjbnVtKTtcbn1cbmxldCBjb2xvcl90cmFuc2l0aW9uX3RpbWUgPSBnZXRDb21wdXRlZFN0eWxlKGRvY3VtZW50LmRvY3VtZW50RWxlbWVudCkuZ2V0UHJvcGVydHlWYWx1ZSgnLS1jb2xvci10cmFuc2l0aW9uLXRpbWUnKTtcbmRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5zdHlsZS5zZXRQcm9wZXJ0eSgnLS1jb2xvci10cmFuc2l0aW9uLXRpbWUnLCAnMG1zJyk7XG5zZXRUaW1lb3V0KCAoKSA9PiB1cGRhdGVDb2xvcih0cWNudW0pLCAyMCk7XG5zZXRUaW1lb3V0KCAoKSA9PiBkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQuc3R5bGUuc2V0UHJvcGVydHkoJy0tY29sb3ItdHJhbnNpdGlvbi10aW1lJywgYCR7Y29sb3JfdHJhbnNpdGlvbl90aW1lfWApLCB0cmFuc2l0aW9uVGltZW91dFRpbWUpO1xuXG5jb25zdCBzY2FsZURvd25RdW90ZSA9IChlbCwgZm9udFNpemVSZW0gPSAzLjYsIG1pbkZvbnRTaXplUmVtID0gMSkgPT4ge1xuICAgIGlmICghZWwpIHJldHVybjtcbiAgICBlbC5zdHlsZS5mb250U2l6ZSA9IGAke2ZvbnRTaXplUmVtfXJlbWA7XG4gICAgY29uc3QgZWxIZWlnaHQgPSBlbC5vZmZzZXRIZWlnaHQ7XG4gICAgY29uc3Qgd2luSGVpZ2h0ID0gd2luZG93LmlubmVySGVpZ2h0O1xuICAgIGlmIChlbEhlaWdodCA+IG1pbkZvbnRTaXplUmVtICYmIGVsSGVpZ2h0ID4gMC44ICogd2luSGVpZ2h0KSBzY2FsZURvd25RdW90ZShlbCwgZm9udFNpemVSZW0gLSAwLjEsIG1pbkZvbnRTaXplUmVtKTtcbn07XG5cbi8qKlxuICogT24gYm9keSByZWFkeVxuICovXG5kb2N1bWVudC5ib2R5Lm9ubG9hZCA9ICggKCkgPT4ge1xuICAgIFxuICAgIGNvbnN0IG1lbnVjYiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdtZW51Y2InKTtcbiAgICBjb25zdCBtYWluX2VsID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeVRhZ05hbWUoJ21haW4nKVswXTtcbiAgICBcbiAgICBjb25zdCBib2R5Q2xpY2tIYW5kbGVyID0gKGUpID0+IHtcbiAgICAgICAgIW1haW5fZWwgfHwgbWFpbl9lbC5yZW1vdmVFdmVudExpc3RlbmVyKCdjbGljaycsIGJvZHlDbGlja0hhbmRsZXIpO1xuICAgICAgICAhbWFpbl9lbCB8fCBtYWluX2VsLmNsYXNzTGlzdC5yZW1vdmUoJ2JsdXInKTtcbiAgICAgICAgbWVudWNiLmNoZWNrZWQgPSBmYWxzZTtcbiAgICB9XG5cbiAgICAvLyBvbmNoYW5nZSBtZW51Y2JcbiAgICBtZW51Y2Iub25jaGFuZ2UgPSAoICgpID0+IHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBpZiAobWVudWNiLmNoZWNrZWQpIHtcbiAgICAgICAgICAgICFtYWluX2VsIHx8IG1haW5fZWwuY2xhc3NMaXN0LmFkZCgnYmx1cicpO1xuICAgICAgICAgICAgIW1haW5fZWwgfHwgbWFpbl9lbC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGJvZHlDbGlja0hhbmRsZXIpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgIW1haW5fZWwgfHwgbWFpbl9lbC5jbGFzc0xpc3QucmVtb3ZlKCdibHVyJyk7XG4gICAgICAgICAgICAhbWFpbl9lbCB8fCBtYWluX2VsLnJlbW92ZUV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgYm9keUNsaWNrSGFuZGxlcik7XG4gICAgICAgIH1cbiAgICB9LCA1MCkgKTtcblxuICAgIC8vIG9uY2hhbmdlIGNsciBcbiAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcuY2xyJykuZm9yRWFjaCggKGVsKSA9PiBlbC5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgKGUpID0+IHtcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICBsZXQgYyA9IGVsLmRhdGFzZXQuYztcbiAgICAgICAgIWMgfHwgdXBkYXRlQ29sb3IoYyk7XG4gICAgICAgIC8vIHVwZGF0ZSBzdG9yYWdlIFxuICAgICAgICB3aW5kb3cubG9jYWxTdG9yYWdlLnNldEl0ZW0oJ3RvcHF1b3RlLWNvbG9yLW51bScsIGMpO1xuICAgIH0pKTtcblxuICAgIC8vIGlmIGluIGxhcmdlIG1vZGUsIGNoZWNrIGZvciBzYXllciBoZWlnaHQgXG4gICAgLy8gY29uc29sZS5sb2cod2luZG93LmlubmVyV2lkdGgpO1xuICAgIGlmICh3aW5kb3cuaW5uZXJXaWR0aCA+PSAxMDI0KSB7XG4gICAgICAgIC8vIGZvciBldmVyeSBibG9ja3F1b3RlIFxuICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCdibG9ja3F1b3RlJykuZm9yRWFjaCggKGVsKSA9PiB7XG4gICAgICAgICAgICBsZXQgc2F5ZXJfZWwgPSBlbC5xdWVyeVNlbGVjdG9yKCcuc2F5ZXInKTtcbiAgICAgICAgICAgIGxldCBtZXRhX2VsID0gZWwucXVlcnlTZWxlY3RvcignLm1ldGEnKTtcbiAgICAgICAgICAgIGlmICghc2F5ZXJfZWwgfHwgIW1ldGFfZWwpIHJldHVybjtcbiAgICAgICAgICAgIGxldCBzYXllcl90b3AgPSBzYXllcl9lbC5nZXRCb3VuZGluZ0NsaWVudFJlY3QoKS50b3A7XG4gICAgICAgICAgICBsZXQgc2F5ZXJfaGVpZ2h0ID0gc2F5ZXJfZWwub2Zmc2V0SGVpZ2h0O1xuICAgICAgICAgICAgbWV0YV9lbC5zdHlsZS50b3AgPSBgJHs0ICsgc2F5ZXJfaGVpZ2h0fXB4YDtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgLy8gaGFuZGxlIGFkZCBmb3JtIFxuICAgIGNvbnN0IGFkZEZvcm0gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnYWRkRm9ybScpO1xuICAgIGlmIChhZGRGb3JtKSB7XG4gICAgICAgIGFkZEZvcm0uYWRkRXZlbnRMaXN0ZW5lcignc3VibWl0JywgKGUpID0+IHtcbiAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgICAgIGdyZWNhcHRjaGEucmVhZHkoZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICAgIGdyZWNhcHRjaGEuZXhlY3V0ZSh3aW5kb3cudHFkLnJzaywge2FjdGlvbjogJ3N1Ym1pdCd9KS50aGVuKCh0b2tlbikgPT4ge1xuICAgICAgICAgICAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3J0b2tlbicpLnZhbHVlID0gdG9rZW47XG4gICAgICAgICAgICAgICAgICBlLnRhcmdldC5zdWJtaXQoKTtcbiAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgLy8gc2luZ2xlIHF1b3RlXG4gICAgaWYgKGRvY3VtZW50LmJvZHkuY2xhc3NMaXN0LmNvbnRhaW5zKFwic2luZ2xlLXF1b3RlXCIpKSB7XG4gICAgICAgIHNjYWxlRG93blF1b3RlKGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ2Jsb2NrcXVvdGUgLnF1b3RlJykpO1xuICAgIH1cbiAgICAvLyBoaWRlIHRpdGxlIG9uIGhvbWUgbm8gc2Nyb2xsIFxuICAgIGlmIChkb2N1bWVudC5ib2R5LmNsYXNzTGlzdC5jb250YWlucyhcImhvbWVcIikpIHtcbiAgICAgICAgY29uc3QgdGl0bGVfZWwgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgndGl0bGUnKTtcbiAgICAgICAgd2luZG93Lm9uc2Nyb2xsID0gKCAoKSA9PiB7XG4gICAgICAgICAgICBsZXQgc2Nyb2xsUG9zID0gd2luZG93LnBhZ2VZT2Zmc2V0O1xuICAgICAgICAgICAgaWYgKHNjcm9sbFBvcyA+IDE2MCAmJiAhdGl0bGVfZWwuY2xhc3NMaXN0LmNvbnRhaW5zKCdhY3RpdmUnKSkge1xuICAgICAgICAgICAgICAgIHRpdGxlX2VsLmNsYXNzTGlzdC5hZGQoJ2FjdGl2ZScpO1xuICAgICAgICAgICAgfSBlbHNlIGlmIChzY3JvbGxQb3MgPD0gMTYwICYmIHRpdGxlX2VsLmNsYXNzTGlzdC5jb250YWlucygnYWN0aXZlJykpIHtcbiAgICAgICAgICAgICAgICB0aXRsZV9lbC5jbGFzc0xpc3QucmVtb3ZlKCdhY3RpdmUnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSApO1xuICAgIH1cblxufSApKCk7XG4iXSwibmFtZXMiOltdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./src/js/main.js\n");

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