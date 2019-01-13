function retrieveTemplate(className) {
  return $("." + className).html();
}

function bindArgs(template, ...args) {
  args.forEach(function(e) {
    template = template.replace("?", e);
  });
  return template;
}

function retrieveAndBind(id, ...args) {
  return bindArgs(retrieveTemplate(id), args);
}
