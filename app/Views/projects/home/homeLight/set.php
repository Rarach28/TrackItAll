SET

<div id="A_picker"></div>


<div id="L_picker"></div>

<div id="R_picker"></div>




<script>


var L_colorPicker = new iro.ColorPicker("#L_picker", {
  color: "rgb(<?=$data["LR"].",".$data["LG"].",".$data["LB"]?>)",
  borderWidth: 1,
  layout: [
    {
      component: iro.ui.Wheel,
    },
  ]
});

var R_colorPicker = new iro.ColorPicker("#R_picker", {
  color: "rgb(<?=$data["RR"].",".$data["RG"].",".$data["RB"]?>)",
  borderWidth: 1,
  layout: [
    {
      component: iro.ui.Wheel,
    },
  ]
});


var A_picker = new iro.ColorPicker("#A_picker", {
  width: 250,
  color: "rgb(255, 255, 255)",
  borderWidth: 1,
  borderColor: "#fff",
  layoutDirection: 'horizontal',
  layout: [
    {
      component: iro.ui.Slider,
      options: {
        sliderType: 'value',
        sliderSize: 40,
      }
    },
  ]
});

</script>