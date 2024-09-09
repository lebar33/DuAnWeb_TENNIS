const SliderItem = document.querySelectorAll('.slider-item')
for (let index = 0; index < SliderItem.length; index++) {
   
    SliderItem[index].style.left = index * 100 + "%"  
}

const SliderItems = document.querySelector('.slider-items')
const Arrowright = document.querySelector('.ri-arrow-right-s-line')
const Arrowleft = document.querySelector('.ri-arrow-left-s-line')

let i = 0 
if( Arrowright != null && Arrowleft != null )
{
    Arrowright.addEventListener('click',()=>{
    
        if(i < SliderItem.length - 1) {
            i++
            sliderMove(i)
        }  
        else {
            return false
        }
    })
    Arrowleft.addEventListener('click',()=>{
        if(i <= 0) {
            return false
        }
        {
            i--
            sliderMove(i)
        }
    })
}


function sliderMove(i) {
    SliderItems.style.left = -i*100+"%"
}
/*function autoSlider() {
    if(i<SliderItem.length - 1) {
        i++
        sliderMove(i)
    
    }
    else {
        i=0
        sliderMove(i)
    }
}
    
setInterval(autoSlider,5000)
*/

/* Responsive____Menubar */ 
const Menubar = document.querySelector('.header-bar-icon')
const Headernav = document.querySelector('.header-nav')

Menubar.addEventListener('click', ()=>{
    Headernav.classList.toggle('active')
})

//Sticky Header 
window.addEventListener('scroll', ()=>{
    if(screenY>50){
        document.querySelector('#header').classList.add('active')
    }   
    else {
        document.querySelector('#header').classList.remove('active')
    }

}) 

//Click Product Detail Image 
const ImageSmall = document.querySelectorAll('.product-detail-items img')
const ImageMain = document.querySelector('.Main-Detail-Image')
for (let index = 0; index < ImageSmall.length; index++) {
    ImageSmall[index].addEventListener('click',()=>{
        for (let a =0; a < ImageSmall.length; a++) {
            ImageSmall[a].classList.remove('active')
        }
        ImageMain.src = ImageSmall[index].src
        
        ImageSmall[index].classList.add('active')
    })
}


