describe("", function() {
  var rootEl;
  beforeEach(function() {
    rootEl = browser.rootEl;
    browser.get("build/docs/examples/example-module-suggested-layout/index-jquery-3.2.1.html");
  });
  
it('should add Hello to the name', function() {
  expect(element(by.binding("greeting")).getText()).toEqual('Bonjour World!');
});
});