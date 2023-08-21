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

/***/ "./resources/js/worker-ot/index.js":
/*!*****************************************!*\
  !*** ./resources/js/worker-ot/index.js ***!
  \*****************************************/
/***/ (() => {

eval("$(document).ready(function () {\n  autoTimeSelect();\n});\n\nfunction autoTimeSelect() {\n  var now = new Date();\n  var year = now.getFullYear();\n  var month = now.getMonth() + 1;\n  var day = now.getDate();\n  var hour = now.getHours();\n  var localDatetime = year + \"-\" + (month < 10 ? \"0\" + month.toString() : month) + \"-\" + (day < 10 ? \"0\" + day.toString() : day) + \"T\" + (hour < 10 ? \"0\" + hour.toString() : hour) + \":\" + \"00\" + \":\" + \"00\";\n  $(\"#start_date_time\").val(localDatetime);\n  $(\"#end_date_time\").val(localDatetime);\n}//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvd29ya2VyLW90L2luZGV4LmpzPzRkNTMiXSwibmFtZXMiOlsiJCIsImRvY3VtZW50IiwicmVhZHkiLCJhdXRvVGltZVNlbGVjdCIsIm5vdyIsIkRhdGUiLCJ5ZWFyIiwiZ2V0RnVsbFllYXIiLCJtb250aCIsImdldE1vbnRoIiwiZGF5IiwiZ2V0RGF0ZSIsImhvdXIiLCJnZXRIb3VycyIsImxvY2FsRGF0ZXRpbWUiLCJ0b1N0cmluZyIsInZhbCJdLCJtYXBwaW5ncyI6IkFBQUFBLENBQUMsQ0FBQ0MsUUFBRCxDQUFELENBQVlDLEtBQVosQ0FBa0IsWUFBWTtBQUMxQkMsRUFBQUEsY0FBYztBQUNqQixDQUZEOztBQUdBLFNBQVNBLGNBQVQsR0FBMEI7QUFDdEIsTUFBSUMsR0FBRyxHQUFHLElBQUlDLElBQUosRUFBVjtBQUNBLE1BQUlDLElBQUksR0FBR0YsR0FBRyxDQUFDRyxXQUFKLEVBQVg7QUFDQSxNQUFJQyxLQUFLLEdBQUdKLEdBQUcsQ0FBQ0ssUUFBSixLQUFpQixDQUE3QjtBQUNBLE1BQUlDLEdBQUcsR0FBR04sR0FBRyxDQUFDTyxPQUFKLEVBQVY7QUFDQSxNQUFJQyxJQUFJLEdBQUdSLEdBQUcsQ0FBQ1MsUUFBSixFQUFYO0FBQ0EsTUFBSUMsYUFBYSxHQUNiUixJQUFJLEdBQ0osR0FEQSxJQUVDRSxLQUFLLEdBQUcsRUFBUixHQUFhLE1BQU1BLEtBQUssQ0FBQ08sUUFBTixFQUFuQixHQUFzQ1AsS0FGdkMsSUFHQSxHQUhBLElBSUNFLEdBQUcsR0FBRyxFQUFOLEdBQVcsTUFBTUEsR0FBRyxDQUFDSyxRQUFKLEVBQWpCLEdBQWtDTCxHQUpuQyxJQUtBLEdBTEEsSUFNQ0UsSUFBSSxHQUFHLEVBQVAsR0FBWSxNQUFNQSxJQUFJLENBQUNHLFFBQUwsRUFBbEIsR0FBb0NILElBTnJDLElBT0EsR0FQQSxHQVFBLElBUkEsR0FTQSxHQVRBLEdBVUEsSUFYSjtBQVlBWixFQUFBQSxDQUFDLENBQUMsa0JBQUQsQ0FBRCxDQUFzQmdCLEdBQXRCLENBQTBCRixhQUExQjtBQUNBZCxFQUFBQSxDQUFDLENBQUMsZ0JBQUQsQ0FBRCxDQUFvQmdCLEdBQXBCLENBQXdCRixhQUF4QjtBQUNIIiwic291cmNlc0NvbnRlbnQiOlsiJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xuICAgIGF1dG9UaW1lU2VsZWN0KCk7XG59KTtcbmZ1bmN0aW9uIGF1dG9UaW1lU2VsZWN0KCkge1xuICAgIHZhciBub3cgPSBuZXcgRGF0ZSgpO1xuICAgIHZhciB5ZWFyID0gbm93LmdldEZ1bGxZZWFyKCk7XG4gICAgdmFyIG1vbnRoID0gbm93LmdldE1vbnRoKCkgKyAxO1xuICAgIHZhciBkYXkgPSBub3cuZ2V0RGF0ZSgpO1xuICAgIHZhciBob3VyID0gbm93LmdldEhvdXJzKCk7XG4gICAgdmFyIGxvY2FsRGF0ZXRpbWUgPVxuICAgICAgICB5ZWFyICtcbiAgICAgICAgXCItXCIgK1xuICAgICAgICAobW9udGggPCAxMCA/IFwiMFwiICsgbW9udGgudG9TdHJpbmcoKSA6IG1vbnRoKSArXG4gICAgICAgIFwiLVwiICtcbiAgICAgICAgKGRheSA8IDEwID8gXCIwXCIgKyBkYXkudG9TdHJpbmcoKSA6IGRheSkgK1xuICAgICAgICBcIlRcIiArXG4gICAgICAgIChob3VyIDwgMTAgPyBcIjBcIiArIGhvdXIudG9TdHJpbmcoKSA6IGhvdXIpICtcbiAgICAgICAgXCI6XCIgK1xuICAgICAgICBcIjAwXCIgK1xuICAgICAgICBcIjpcIiArXG4gICAgICAgIFwiMDBcIjtcbiAgICAkKFwiI3N0YXJ0X2RhdGVfdGltZVwiKS52YWwobG9jYWxEYXRldGltZSk7XG4gICAgJChcIiNlbmRfZGF0ZV90aW1lXCIpLnZhbChsb2NhbERhdGV0aW1lKTtcbn1cbiJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvd29ya2VyLW90L2luZGV4LmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/worker-ot/index.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/worker-ot/index.js"]();
/******/ 	
/******/ })()
;