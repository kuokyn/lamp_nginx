//----------------Drop-down-menu-------------------//
const menuBtn = document.querySelector('.menu-btn');
const menuList = document.querySelector('.menu-list');
let menuOpen = false;
menuBtn.addEventListener('click', ()=> {
    if(!menuOpen){
        menuBtn.classList.add('open');
        menuList.classList.add('open');
        menuOpen = true;
    } else{
        menuBtn.classList.remove('open');
        menuList.classList.remove('open');
        menuOpen = false;
    }
});

//-------------animation-on-scroll----------------//
// у каждого объекта, у которого есть класс animItems
// при достижении скроллом 1/4 высоты окна браузера
// ему добавляется класс active
// если недокрутили или перекрутили, класс active отбирается

const animItems = document.querySelectorAll('.anim-items');
if (animItems.length > 0) {
    window.addEventListener('scroll', animOnScroll);
    function animOnScroll(){
        for (let index = 0; index < animItems.length; index++){
            const animItem = animItems[index];
            const animItemHeight = animItem.offsetHeight;
            const animItemOffset = offset(animItem).top;
            const animStart = 4;

            let animItemPoint = window.innerHeight - animItemHeight / animStart;

            if (animItemHeight > window.innerHeight) {
                animItemPoint = window.innerHeight - window.innerHeight / animStart;
            }

            if ((pageYOffset > animItemOffset - animItemPoint) && pageYOffset < (animItemOffset + animItemHeight)) {
                animItem.classList.add('active');
            } else{
                animItem.classList.remove('active');
            }
        }
    }
    function offset(el){
        const rect = el.getBoundingClientRect(),
            scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
            scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        return {top: rect.top + scrollTop, left: rect.left + scrollLeft}
        
    }
    animOnScroll();
}
