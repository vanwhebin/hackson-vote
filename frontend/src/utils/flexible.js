// export const flexible = (function flexible (window, document) {
//   var dpr, rem, scale
//   var docEl = document.documentElement;
//   var fontEl = document.createElement('style');
//   var metaEl = document.querySelector('meta[name="viewport"]');
//   var dpr = window.devicePixelRatio || 1;
//   var rem = docEl.clientWidth * dpr / 10;
//   var scale = 1 / dpr;

//   //set viewport to reach high definition on page resize
//   metaEl.setAttribute('content', 'width=' + dpr * docEl.clientWidth +', initial-scale=' + scale + ', maximum-scale='+ scale +',' + ', minimum-scale='+ scale +', user-scalable=no');
//   //set data-dpr attribute to css hack to use
//   docEl.setAttribute('data-dpr', dpr);
//   //donamic to add the style to head
//   docEl.firstElementChild.appendChild(fontEl);
//   fontEl.innerHTML = 'html{font-size:'+rem+'px !important}';
  
//   window.rem2px = function(v) {
//     v = parseFloat(v);
//     return v * rem;
//   };
//   window.px2rem = function(v) {
//     v = parseFloat(v);
//     return v / rem
//   };
//   window.dpr = dpr;
//   window.rem = rem;
// }(window, document))


export const flexible = !(function(doc, win) {
  var docEle = doc.documentElement,
      evt = "onorientationchange" in window ? "orientationchange" : "resize",
      fn = function() {
          var width = docEle.clientWidth;
          width && (docEle.style.fontSize = 20 * (width / 320) + "px");
      };

  win.addEventListener(evt, fn, false);
  doc.addEventListener("DOMContentLoaded", fn, false);

}(document, window));
