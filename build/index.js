/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/modules/Like.js":
/*!*****************************!*\
  !*** ./src/modules/Like.js ***!
  \*****************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);

class Like {
  constructor() {
    this.events();
  }
  events() {
    jquery__WEBPACK_IMPORTED_MODULE_0___default()(".likebox").on("click", this.clickDispatcher.bind(this));
  }
  clickDispatcher(e) {
    var currentLikeBox = jquery__WEBPACK_IMPORTED_MODULE_0___default()(e.target).closest(".likebox");
    if (currentLikeBox.attr('data-exists') == 'yes') {
      this.deleteLike(currentLikeBox);
    } else {
      this.createLike(currentLikeBox);
    }
  }
  createLike(clb) {
    jquery__WEBPACK_IMPORTED_MODULE_0___default().ajax({
      url: siteData.root_url + '/wp-json/testForGrandma/v1/manageLike',
      type: 'POST',
      data: {
        'postID': clb.data('post')
      },
      success: response => {
        clb.attr('data-exists', 'yes');
        var likeCount = parseInt(clb.find(".likecount").html(), 10);
        likeCount++;
        clb.find(".likecount").html(likeCount);
        clb.attr("data-like", response);
        console.log(response);
      },
      error: response => {
        console.log(response);
      },
      beforeSend: xhr => {
        xhr.setRequestHeader('X-WP-Nonce', siteData.nonce);
      }
    });
  }
  deleteLike(clb) {
    jquery__WEBPACK_IMPORTED_MODULE_0___default().ajax({
      url: siteData.root_url + '/wp-json/testForGrandma/v1/manageLike',
      data: {
        'like': clb.attr('data-like')
      },
      type: 'DELETE',
      success: response => {
        clb.attr('data-exists', 'no');
        var likeCount = parseInt(clb.find(".likecount").html(), 10);
        likeCount--;
        clb.find(".likecount").html(likeCount);
        clb.attr("data-like", '');
        console.log(response);
      },
      error: response => {
        console.log(response);
      },
      beforeSend: xhr => {
        xhr.setRequestHeader('X-WP-Nonce', siteData.nonce);
      }
    });
  }
}
/* harmony default export */ __webpack_exports__["default"] = (Like);

/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ (function(module) {

module.exports = window["jQuery"];

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
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
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
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_Like__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/Like */ "./src/modules/Like.js");

var like = new _modules_Like__WEBPACK_IMPORTED_MODULE_0__["default"]();
}();
/******/ })()
;
//# sourceMappingURL=index.js.map