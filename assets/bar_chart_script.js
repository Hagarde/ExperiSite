$(document).ready(function(){
    var Input_region_global = $('#region_global_bar')
    var Input_region_1 = $('#region1_bar')
    var Input_region_2 = $('#region2_bar')
    console.log(Input_region_global)
    })

var value_bar_global = $('#region_global_bar').slider("option", "value");
var value_bar_1 = $('#region1_bar').slider("option", "value");
var value_bar_2 = $('#region2_bar').slider("option", "value");

var value_region1 = (100 - value_bar_global)*(value_bar_1/10000);
var value_region2 = (100- value_bar_global)*((100-value_bar_1)/10000);
var value_region3 = value_bar_global*(value_bar_2/10000);
var value_region4 = (value_bar_global)*((100-value_bar_2))/10000;
console.log('je suis bien arrivé au sript')
$(value_global).change(function(){
    console.log('Je susi activé ')
    $("#mask > rect1").attr('width' , );
})
