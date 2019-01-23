$.post("php/sessionAPI.php", { req: "get", var: "currentTimeout" }, function(timeoutId) {
  clearTimeout(timeoutId);
}, "json");
