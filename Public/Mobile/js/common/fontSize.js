//适配手机尺寸
function Rem() {
    var docEl = document.documentElement,
        oSize = docEl.clientWidth / 7.5;
    if (oSize > 100) {
        oSize = 100; // 限制rem值 640 / 6.4 =100
    }
    docEl.style.fontSize = oSize + 'px';
}
window.addEventListener('resize', Rem, false);
Rem();