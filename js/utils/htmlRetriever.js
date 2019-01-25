function retrieveTemplate(className) {
  return $("." + className).html();
}

function bindArgs(template, ...args) {
  args.forEach(function(e) {
    template = template.replace("?", e);
  });
  return template;
}

function retrieveAndBind(className, ...args) {
  return bindArgs(retrieveTemplate(className), args);
}
