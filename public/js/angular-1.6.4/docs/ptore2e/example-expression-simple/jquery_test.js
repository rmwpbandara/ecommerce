describe("", function() {
  var rootEl;
  beforeEach(function() {
    rootEl = browser.rootEl;
    browser.get("build/docs/examples/example-expression-simple/index-jquery-3.2.1.html");
  });
  
it('should calculate expression in binding', function() {
  expect(element(by.binding('1+2')).getText()).toEqual('1+2=3');
});
});