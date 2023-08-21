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

/***/ "./resources/js/device/edit.js":
/*!*************************************!*\
  !*** ./resources/js/device/edit.js ***!
  \*************************************/
/***/ (() => {

eval("var id = \"\";\nvar imageKey = \"\";\n$(document).ready(function () {\n  deleteImage();\n});\n\nfunction deleteImage() {\n  $(\".deleteImage\").click(function () {\n    id = $(this).attr(\"id\").split(\"-\")[1];\n    imageKey = $(this).parent().attr(\"id\").split(\"-\")[1];\n    swal({\n      title: \"Are you sure?\",\n      text: \"Once deleted, you will not be able to recover this data!\",\n      icon: \"warning\",\n      buttons: true,\n      dangerMode: true\n    }).then(function (willDelete) {\n      if (willDelete) {\n        swal(\"Done! Your data has been deleted\", {\n          icon: \"success\"\n        });\n        var data = {\n          id: id,\n          imageKey: imageKey\n        };\n        axios.post(\"/device/delete/image-one-by-one\", data).then(function (response) {\n          location.reload();\n        });\n      } else {\n        swal(\"Your data is now deleted\", {\n          icon: \"error\"\n        });\n      }\n    });\n  });\n}//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvZGV2aWNlL2VkaXQuanM/MTlhNSJdLCJuYW1lcyI6WyJpZCIsImltYWdlS2V5IiwiJCIsImRvY3VtZW50IiwicmVhZHkiLCJkZWxldGVJbWFnZSIsImNsaWNrIiwiYXR0ciIsInNwbGl0IiwicGFyZW50Iiwic3dhbCIsInRpdGxlIiwidGV4dCIsImljb24iLCJidXR0b25zIiwiZGFuZ2VyTW9kZSIsInRoZW4iLCJ3aWxsRGVsZXRlIiwiZGF0YSIsImF4aW9zIiwicG9zdCIsInJlc3BvbnNlIiwibG9jYXRpb24iLCJyZWxvYWQiXSwibWFwcGluZ3MiOiJBQUFBLElBQUlBLEVBQUUsR0FBRyxFQUFUO0FBQ0EsSUFBSUMsUUFBUSxHQUFHLEVBQWY7QUFDQUMsQ0FBQyxDQUFDQyxRQUFELENBQUQsQ0FBWUMsS0FBWixDQUFrQixZQUFZO0FBQzFCQyxFQUFBQSxXQUFXO0FBQ2QsQ0FGRDs7QUFHQSxTQUFTQSxXQUFULEdBQXVCO0FBQ25CSCxFQUFBQSxDQUFDLENBQUMsY0FBRCxDQUFELENBQWtCSSxLQUFsQixDQUF3QixZQUFZO0FBQ2hDTixJQUFBQSxFQUFFLEdBQUdFLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUUssSUFBUixDQUFhLElBQWIsRUFBbUJDLEtBQW5CLENBQXlCLEdBQXpCLEVBQThCLENBQTlCLENBQUw7QUFDQVAsSUFBQUEsUUFBUSxHQUFHQyxDQUFDLENBQUMsSUFBRCxDQUFELENBQVFPLE1BQVIsR0FBaUJGLElBQWpCLENBQXNCLElBQXRCLEVBQTRCQyxLQUE1QixDQUFrQyxHQUFsQyxFQUF1QyxDQUF2QyxDQUFYO0FBRUFFLElBQUFBLElBQUksQ0FBQztBQUNEQyxNQUFBQSxLQUFLLEVBQUUsZUFETjtBQUVEQyxNQUFBQSxJQUFJLEVBQUUsMERBRkw7QUFHREMsTUFBQUEsSUFBSSxFQUFFLFNBSEw7QUFJREMsTUFBQUEsT0FBTyxFQUFFLElBSlI7QUFLREMsTUFBQUEsVUFBVSxFQUFFO0FBTFgsS0FBRCxDQUFKLENBTUdDLElBTkgsQ0FNUSxVQUFDQyxVQUFELEVBQWdCO0FBQ3BCLFVBQUlBLFVBQUosRUFBZ0I7QUFDWlAsUUFBQUEsSUFBSSxDQUFDLGtDQUFELEVBQXFDO0FBQ3JDRyxVQUFBQSxJQUFJLEVBQUU7QUFEK0IsU0FBckMsQ0FBSjtBQUlBLFlBQUlLLElBQUksR0FBRztBQUNQbEIsVUFBQUEsRUFBRSxFQUFFQSxFQURHO0FBRVBDLFVBQUFBLFFBQVEsRUFBRUE7QUFGSCxTQUFYO0FBSUFrQixRQUFBQSxLQUFLLENBQ0FDLElBREwsQ0FDVSxpQ0FEVixFQUM2Q0YsSUFEN0MsRUFFS0YsSUFGTCxDQUVVLFVBQUNLLFFBQUQsRUFBYztBQUNoQkMsVUFBQUEsUUFBUSxDQUFDQyxNQUFUO0FBQ0gsU0FKTDtBQUtILE9BZEQsTUFjTztBQUNIYixRQUFBQSxJQUFJLENBQUMsMEJBQUQsRUFBNkI7QUFDN0JHLFVBQUFBLElBQUksRUFBRTtBQUR1QixTQUE3QixDQUFKO0FBR0g7QUFDSixLQTFCRDtBQTJCSCxHQS9CRDtBQWdDSCIsInNvdXJjZXNDb250ZW50IjpbInZhciBpZCA9IFwiXCI7XG52YXIgaW1hZ2VLZXkgPSBcIlwiO1xuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xuICAgIGRlbGV0ZUltYWdlKCk7XG59KTtcbmZ1bmN0aW9uIGRlbGV0ZUltYWdlKCkge1xuICAgICQoXCIuZGVsZXRlSW1hZ2VcIikuY2xpY2soZnVuY3Rpb24gKCkge1xuICAgICAgICBpZCA9ICQodGhpcykuYXR0cihcImlkXCIpLnNwbGl0KFwiLVwiKVsxXTtcbiAgICAgICAgaW1hZ2VLZXkgPSAkKHRoaXMpLnBhcmVudCgpLmF0dHIoXCJpZFwiKS5zcGxpdChcIi1cIilbMV07XG5cbiAgICAgICAgc3dhbCh7XG4gICAgICAgICAgICB0aXRsZTogXCJBcmUgeW91IHN1cmU/XCIsXG4gICAgICAgICAgICB0ZXh0OiBcIk9uY2UgZGVsZXRlZCwgeW91IHdpbGwgbm90IGJlIGFibGUgdG8gcmVjb3ZlciB0aGlzIGRhdGEhXCIsXG4gICAgICAgICAgICBpY29uOiBcIndhcm5pbmdcIixcbiAgICAgICAgICAgIGJ1dHRvbnM6IHRydWUsXG4gICAgICAgICAgICBkYW5nZXJNb2RlOiB0cnVlLFxuICAgICAgICB9KS50aGVuKCh3aWxsRGVsZXRlKSA9PiB7XG4gICAgICAgICAgICBpZiAod2lsbERlbGV0ZSkge1xuICAgICAgICAgICAgICAgIHN3YWwoXCJEb25lISBZb3VyIGRhdGEgaGFzIGJlZW4gZGVsZXRlZFwiLCB7XG4gICAgICAgICAgICAgICAgICAgIGljb246IFwic3VjY2Vzc1wiLFxuICAgICAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICAgICAgbGV0IGRhdGEgPSB7XG4gICAgICAgICAgICAgICAgICAgIGlkOiBpZCxcbiAgICAgICAgICAgICAgICAgICAgaW1hZ2VLZXk6IGltYWdlS2V5LFxuICAgICAgICAgICAgICAgIH07XG4gICAgICAgICAgICAgICAgYXhpb3NcbiAgICAgICAgICAgICAgICAgICAgLnBvc3QoXCIvZGV2aWNlL2RlbGV0ZS9pbWFnZS1vbmUtYnktb25lXCIsIGRhdGEpXG4gICAgICAgICAgICAgICAgICAgIC50aGVuKChyZXNwb25zZSkgPT4ge1xuICAgICAgICAgICAgICAgICAgICAgICAgbG9jYXRpb24ucmVsb2FkKCk7XG4gICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICBzd2FsKFwiWW91ciBkYXRhIGlzIG5vdyBkZWxldGVkXCIsIHtcbiAgICAgICAgICAgICAgICAgICAgaWNvbjogXCJlcnJvclwiLFxuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcbiAgICB9KTtcbn1cbiJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvZGV2aWNlL2VkaXQuanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/device/edit.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/device/edit.js"]();
/******/ 	
/******/ })()
;