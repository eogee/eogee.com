// 移动端树形导航转换为横向导航
function mobileNavTree(){
    if (window.innerWidth < 850) {
        document.querySelectorAll('.layui-nav-tree').forEach(function(element) {
            element.classList.remove('layui-nav-tree'); // 移除旧的class
        });
    }
}
// 移动端只显示简称
function mobileAbbreName(){
    if (window.innerWidth < 850) {
        document.querySelectorAll('.abbreName').forEach(function(element) {
            element.classList.remove('layui-hide'); // 隐藏中文名
        });
        document.querySelectorAll('.fullName').forEach(function(element) {
            element.classList.add('layui-hide'); // 隐藏中文名
        });
    }
}

// 轮播图
if (window.innerWidth < 850) {
    var carouselHeight = '270px';
}else{
    var carouselHeight = '400px';
}
function carousel(elem){
    layui.use(function() {
        var carousel = layui.carousel;
        carousel.render({
            elem: '#'+elem,
            width: 'auto',
            height: carouselHeight,
            indicator: 'none' //不显示指示器
        });
    });
}
// 移动端菜单栏操作 
function mobileNav(){
    var navLeft = document.getElementById("navLeft");
    var navRight = document.getElementById("navRight");
    var iconRight = document.getElementById("iconRight");
    var iconLeft = document.getElementById("iconLeft");
    // 移动端菜单栏弹出
    navLeft.addEventListener("click", function() {
        document.body.classList.add('eog-nav-show','eog-shade-show');
        iconLeft.classList.remove('layui-hide');
        iconRight.classList.add('layui-hide');
    });
    // 移动端菜单栏收起
    var shade = document.getElementById("shade");
    shade.addEventListener("click", function() {
        document.body.classList.remove('eog-nav-show','eog-shade-show');
        iconRight.classList.remove('layui-hide');
        iconLeft.classList.add('layui-hide');
    });
    navRight.addEventListener("click", function() {
        document.body.classList.remove('eog-nav-show','eog-shade-show');
        iconRight.classList.remove('layui-hide');
        iconLeft.classList.add('layui-hide');
    });
}

// 移动端侧边栏
function monbileSideNav(){
    /* 弹出侧边栏 */
    var sideNav = document.querySelector('.eog-side-nav');
    var menuBar = document.querySelector('.eog-menu-bar');
    if(sideNav !== null && menuBar !== null){
        menuBar.addEventListener('click', function() {
            // 获取计算后的样式
            var style = window.getComputedStyle(sideNav);
            // 获取 left 属性值
            var leftValue = style.left;
            if (leftValue == '-240px') {            
                document.body.classList.add('eog-shade-show');
                sideNav.style.left = '0px';
            }else{
                sideNav.style.left = '-240px';
                document.body.classList.remove('eog-shade-show');
            }
        }); 
    
        /* 侧边栏收起 */
        var shade = document.getElementById("shade");
        shade.addEventListener("click", function() {        
            sideNav.style.left = '-240px';
            document.body.classList.remove('eog-shade-show');
        });
    }else{
        return;
    }
    
}

// 首页自定义 选项卡
function tabIndex(markName){
    layui.use(function(){
        var element = layui.element;
        element.tab({
            headerElem: '#tabHeader'+markName+'>.layui-nav-item',
            bodyElem: '#tabBody'+markName+'>div'
        });
    });
}
// 固定条渲染
function bars(){
    layui.use(function(){
        var util = layui.util;
        util.fixbar({
            bars : [
                {
                    type: 'index',
                    icon: 'layui-icon-home'
                }
                , 
                {
                    type: 'support',
                    icon: 'layui-icon-question'
                }
                , {
                    type: 'top',
                    icon: 'layui-icon-up'
                }
            ]
            ,default : false
            ,bgcolor : '#16baaa'
            ,css : {opacity: 0.5}//设置透明度
            ,on: {// 点击事件                
                click: function(type){
                    if(type == 'index' || type == 'support'){
                        window.location.href='/'+type;
                    }                    
                }
            }
        });
    });
}



