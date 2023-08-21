/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/issue/logs.js":
/*!************************************!*\
  !*** ./resources/js/issue/logs.js ***!
  \************************************/
/***/ (() => {

eval("var selected = \" \";\nvar table = \"\";\n$(document).ready(function () {\n  multiDeleteIssueLogs();\n  handleTable();\n});\n\nfunction handleTable() {\n  table = $(\"#issueHistoryLogId\").DataTable();\n}\n\nfunction multiDeleteIssueLogs() {\n  $(\".issueLogsApplyBtn\").on(\"click\", function () {\n    selected = $(\".issueLogsActionSelect\").val();\n\n    if (selected == \"delete\") {\n      var issueLogsIds = [];\n      table.$('input[type=\"checkbox\"]').each(function () {\n        if (this.checked) {\n          issueLogsIds.push($(this).closest(\"tr\").attr(\"id\"));\n        }\n      });\n      axios.post(\"/issue/logs/multiple/delete\", {\n        issueLogsIds: issueLogsIds\n      }).then(function (response) {\n        location.reload();\n      });\n    }\n  });\n}//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvaXNzdWUvbG9ncy5qcz8xYjk0Il0sIm5hbWVzIjpbInNlbGVjdGVkIiwidGFibGUiLCIkIiwiZG9jdW1lbnQiLCJyZWFkeSIsIm11bHRpRGVsZXRlSXNzdWVMb2dzIiwiaGFuZGxlVGFibGUiLCJEYXRhVGFibGUiLCJvbiIsInZhbCIsImlzc3VlTG9nc0lkcyIsImVhY2giLCJjaGVja2VkIiwicHVzaCIsImNsb3Nlc3QiLCJhdHRyIiwiYXhpb3MiLCJwb3N0IiwidGhlbiIsInJlc3BvbnNlIiwibG9jYXRpb24iLCJyZWxvYWQiXSwibWFwcGluZ3MiOiJBQUFBLElBQUlBLFFBQVEsR0FBRyxHQUFmO0FBQ0EsSUFBSUMsS0FBSyxHQUFHLEVBQVo7QUFDQUMsQ0FBQyxDQUFDQyxRQUFELENBQUQsQ0FBWUMsS0FBWixDQUFrQixZQUFZO0FBQzFCQyxFQUFBQSxvQkFBb0I7QUFDcEJDLEVBQUFBLFdBQVc7QUFDZCxDQUhEOztBQUlBLFNBQVNBLFdBQVQsR0FBdUI7QUFDbkJMLEVBQUFBLEtBQUssR0FBR0MsQ0FBQyxDQUFDLG9CQUFELENBQUQsQ0FBd0JLLFNBQXhCLEVBQVI7QUFDSDs7QUFDRCxTQUFTRixvQkFBVCxHQUFnQztBQUM1QkgsRUFBQUEsQ0FBQyxDQUFDLG9CQUFELENBQUQsQ0FBd0JNLEVBQXhCLENBQTJCLE9BQTNCLEVBQW9DLFlBQVk7QUFDNUNSLElBQUFBLFFBQVEsR0FBR0UsQ0FBQyxDQUFDLHdCQUFELENBQUQsQ0FBNEJPLEdBQTVCLEVBQVg7O0FBQ0EsUUFBSVQsUUFBUSxJQUFJLFFBQWhCLEVBQTBCO0FBQ3RCLFVBQUlVLFlBQVksR0FBRyxFQUFuQjtBQUNBVCxNQUFBQSxLQUFLLENBQUNDLENBQU4sQ0FBUSx3QkFBUixFQUFrQ1MsSUFBbEMsQ0FBdUMsWUFBWTtBQUMvQyxZQUFJLEtBQUtDLE9BQVQsRUFBa0I7QUFDZEYsVUFBQUEsWUFBWSxDQUFDRyxJQUFiLENBQWtCWCxDQUFDLENBQUMsSUFBRCxDQUFELENBQVFZLE9BQVIsQ0FBZ0IsSUFBaEIsRUFBc0JDLElBQXRCLENBQTJCLElBQTNCLENBQWxCO0FBQ0g7QUFDSixPQUpEO0FBTUFDLE1BQUFBLEtBQUssQ0FDQUMsSUFETCxDQUNVLDZCQURWLEVBQ3lDO0FBQ2pDUCxRQUFBQSxZQUFZLEVBQUVBO0FBRG1CLE9BRHpDLEVBSUtRLElBSkwsQ0FJVSxVQUFVQyxRQUFWLEVBQW9CO0FBQ3RCQyxRQUFBQSxRQUFRLENBQUNDLE1BQVQ7QUFDSCxPQU5MO0FBT0g7QUFDSixHQWxCRDtBQW1CSCIsInNvdXJjZXNDb250ZW50IjpbInZhciBzZWxlY3RlZCA9IFwiIFwiO1xudmFyIHRhYmxlID0gXCJcIjtcbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uICgpIHtcbiAgICBtdWx0aURlbGV0ZUlzc3VlTG9ncygpO1xuICAgIGhhbmRsZVRhYmxlKCk7XG59KTtcbmZ1bmN0aW9uIGhhbmRsZVRhYmxlKCkge1xuICAgIHRhYmxlID0gJChcIiNpc3N1ZUhpc3RvcnlMb2dJZFwiKS5EYXRhVGFibGUoKTtcbn1cbmZ1bmN0aW9uIG11bHRpRGVsZXRlSXNzdWVMb2dzKCkge1xuICAgICQoXCIuaXNzdWVMb2dzQXBwbHlCdG5cIikub24oXCJjbGlja1wiLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgIHNlbGVjdGVkID0gJChcIi5pc3N1ZUxvZ3NBY3Rpb25TZWxlY3RcIikudmFsKCk7XG4gICAgICAgIGlmIChzZWxlY3RlZCA9PSBcImRlbGV0ZVwiKSB7XG4gICAgICAgICAgICB2YXIgaXNzdWVMb2dzSWRzID0gW107XG4gICAgICAgICAgICB0YWJsZS4kKCdpbnB1dFt0eXBlPVwiY2hlY2tib3hcIl0nKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICBpZiAodGhpcy5jaGVja2VkKSB7XG4gICAgICAgICAgICAgICAgICAgIGlzc3VlTG9nc0lkcy5wdXNoKCQodGhpcykuY2xvc2VzdChcInRyXCIpLmF0dHIoXCJpZFwiKSk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgIGF4aW9zXG4gICAgICAgICAgICAgICAgLnBvc3QoXCIvaXNzdWUvbG9ncy9tdWx0aXBsZS9kZWxldGVcIiwge1xuICAgICAgICAgICAgICAgICAgICBpc3N1ZUxvZ3NJZHM6IGlzc3VlTG9nc0lkcyxcbiAgICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgICAgIC50aGVuKGZ1bmN0aW9uIChyZXNwb25zZSkge1xuICAgICAgICAgICAgICAgICAgICBsb2NhdGlvbi5yZWxvYWQoKTtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuICAgIH0pO1xufVxuIl0sImZpbGUiOiIuL3Jlc291cmNlcy9qcy9pc3N1ZS9sb2dzLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/issue/logs.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/issue/logs.js"]();
/******/ 	
/******/ })()
;