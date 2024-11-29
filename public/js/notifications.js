/******/ (() => { // webpackBootstrap
/*!***************************************!*\
  !*** ./resources/js/notifications.js ***!
  \***************************************/
function showNotifications(message) {
  var type = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'success';
  var notificationColor = type === 'error' ? 'red' : 'green';
  var notification = document.createElement('div');
  notification.style.position = 'fixed';
  notification.style.top = '20px';
  notification.style.left = '50%';
  notification.style.transform = 'translateX(-50%)';
  notification.style.padding = '10px 20px';
  notification.style.backgroundColor = notificationColor;
  notification.style.color = 'white';
  notification.style.borderRadius = '5px';
  notification.style.zIndex = '1000';
  notification.style.message = message;
  document.body.appendChild(notification);
  setTimeout(function () {
    notification.remove();
  }, 3000);
}
/******/ })()
;