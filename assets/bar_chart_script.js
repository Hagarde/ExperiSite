
require('bootstrap');
// On initialise les sélection des élèments car ceux ci seront permanents 
rect1 = document.getElementById('rect1');
rect2 = document.getElementById('rect2');
rect3 = document.getElementById('rect3');
rect4 = document.getElementById('rect4');

sliderregions = document.getElementById('region_global_bar');
sliderregion1 = document.getElementById('region1_bar');
sliderregion2 = document.getElementById('region2_bar');

document.addEventListener('DOMContentLoad',function(){
    document.querySelector('select[name=""]').onchange=actualisationvalue;
},false)

console.log('Le lien est fait ! ')
console.log(sliderregion1)
console.log(sliderregion1.value)
function actualisationvalue (event){
    sliderregions = document.getElementById('region_global_bar');
    // on récupère la valeur de chaque slider 
    valueregions = sliderregions.value ;
    valueregion1 = sliderregion1.value;
    valueregion2 = sliderregion2.value;
    // On calcule ce que ce la représente pour les rectangles 
    region11 = (100- valueregions) * valueregion1 / 10000;
    region12 = (100- valueregions) *(100- valueregion1)/ 10000;
    region21 = valueregions * valueregion2 / 10000;
    region22 = valueregions * (100-valueregion2) / 10000;

    rect1.style.height = toString(region11) + '  %' ; 
    rect2.style.height = toString(region12) + '  %' ; 
    rect3.style.height = toString(region21) + '  %' ; 
    rect4.style.height = toString(region22) + '  %' ; 
}







// On initialise les sélection des élèments car ceux ci seront permanents 
rect1 = document.getElementById('rectangle1');
rect2 = document.getElementById('rect2');
rect3 = document.getElementById('rect3');
rect4 = document.getElementById('rect4');


sliderregions = document.getElementById('form_Test11');
sliderregion1 = document.getElementById('form_Test12');
sliderregion2 = document.getElementById('form_Test21');

document.addEventListener('DOMContentLoad',function(){
    document.querySelector('select[name="form[Test11]"]').onchange=actualisationvalue;
},false)

document.addEventListener('DOMContentLoad',function(){
    document.querySelector('select[name="form[Test12]"]').onchange=actualisationvalue;
},false)

document.addEventListener('DOMContentLoad',function(){
    document.querySelector('select[name="form[Test21]"]').onchange=actualisationvalue;
},false)

function actualisationvalue (event){
    console.log('des trucs ont changé non ? ')
    sliderregions = document.getElementById('region_global_bar');
    // on récupère la valeur de chaque slider 
    valueregions = sliderregions.value ;
    valueregion1 = sliderregion1.value;
    valueregion2 = sliderregion2.value;
    // On calcule ce que ce la représente pour les rectangles 
    region11 = (100- valueregions) * valueregion1 / 10000;
    region12 = (100- valueregions) *(100- valueregion1)/ 10000;
    region21 = valueregions * valueregion2 / 10000;
    region22 = valueregions * (100-valueregion2) / 10000;

    rect1.style.height = toString(region11) + '  %' ; 
    rect2.style.height = toString(region12) + '  %' ; 
    rect3.style.height = toString(region21) + '  %' ; 
    rect4.style.height = toString(region22) + '  %' ; 
}