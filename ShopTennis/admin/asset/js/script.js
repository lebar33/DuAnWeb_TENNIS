const menuLi = document.querySelectorAll('.Admin-Sidebar-Content > ul > li > a ')
const subMenu = document.querySelectorAll('.Sub-Menu')
for (let index = 0; index < menuLi.length; index++) {
    menuLi[index].addEventListener('click',(e)=>{
        e.preventDefault()
        //menuLi[index].parentNode.querySelector('ul').classList.toggle('active')
        //console.log(menuLi[index].parentNode.querySelector('ul'))
        for (let i = 0; i < subMenu.length; i++) {
            subMenu[i].setAttribute("style", "height: 0px")

        }
        const subMenuHeight = menuLi[index].parentNode.querySelector('ul .Sub-Menu-Items').offsetHeight
        menuLi[index].parentNode.querySelector('ul').setAttribute("style", "height:"+subMenuHeight+"px");
    })


}