(window.webpackJsonp=window.webpackJsonp||[]).push([[4],{171:function(t,e,o){},172:function(t,e,o){},173:function(t,e,o){},174:function(t,e,o){},175:function(t,e,o){},179:function(t){t.exports=JSON.parse('{"fondo":"#12237F","objetos":[{"tipo":"rectangulo","opciones":{"fill":"#2446FE","top":440,"width":50,"height":50}},{"tipo":"imagen","ruta":"/recursos/imagenes/remax.png","opciones":{"ancho":220,"alto":"auto","top":97,"left":83}},{"tipo":"parrafo","texto":"Titulo de la\\npresentación","opciones":{"fill":"#FFFFFF","top":430,"left":90,"width":1280,"fontSize":85,"fontWeight":"bold"}},{"tipo":"parrafo","texto":"Una breve descripción de la casa breve descripción de la casa.Una breve descripción de la casa breve descripción de la casa.","opciones":{"fill":"#FFFFFF","width":512,"top":708,"left":90,"fontSize":20}},{"tipo":"rectangulo","opciones":{"fill":"#FFFFFF","top":930,"left":95,"width":50,"height":50}},{"tipo":"imagen","ruta":"/recursos/imagenes/whatsapp-azul.svg","opciones":{"ancho":32,"alto":"auto","top":955,"left":120,"originX":"center","originY":"center"}},{"tipo":"parrafo","texto":"REMAX LIMA PERÚ\\nT. 999 999 999","opciones":{"fill":"#FFFFFF","width":200,"top":940,"left":170,"fontSize":12,"fontWeight":"bold"}},{"tipo":"rectangulo","opciones":{"fill":"#FFFFFF","top":100,"left":1420,"width":420,"height":360}},{"tipo":"rectangulo","opciones":{"fill":"#CD1318 ","top":460,"left":1420,"width":420,"height":516}},{"tipo":"imagen","ruta":"/recursos/imagenes/imagen01.png","opciones":{"ancho":420,"alto":"auto","top":100,"left":1420}},{"tipo":"parrafo","texto":"LUIS ARAGORN LEGOLAS","opciones":{"fill":"#FFFFFF","width":340,"top":600,"left":1630,"fontSize":40,"fontWeight":"bold","lineHeight":1,"charSpacing":100,"textAlign":"center","originX":"center","originY":"bottom"}},{"tipo":"parrafo","texto":"EJECUTIVO REMAX","opciones":{"fill":"#FF7478","width":340,"top":610,"left":1630,"fontSize":20,"charSpacing":180,"fontWeight":"bold","textAlign":"center","originX":"center"}},{"tipo":"imagen","ruta":"/recursos/imagenes/telephone-inverso.svg","opciones":{"ancho":54,"alto":"auto","top":740,"left":1490,"opacity":0.5,"originY":"center"}},{"tipo":"imagen","ruta":"/recursos/imagenes/whatsapp-inverso.svg","opciones":{"ancho":54,"alto":"auto","top":820,"left":1490,"opacity":0.3,"originY":"center"}},{"tipo":"parrafo","texto":"01 486 62012","opciones":{"fill":"#FFFFFF","fontWeight":"bold","top":740,"left":1560,"originY":"center"}},{"tipo":"parrafo","texto":"949 766 114","opciones":{"fill":"#FFFFFF","fontWeight":"bold","top":820,"left":1560,"originY":"center"}}]}')},190:function(t,e){},191:function(t,e){},192:function(t,e){},193:function(t,e,o){"use strict";var n=o(171);o.n(n).a},194:function(t,e,o){"use strict";var n=o(172);o.n(n).a},195:function(t,e,o){"use strict";var n=o(173);o.n(n).a},196:function(t,e,o){"use strict";var n=o(174);o.n(n).a},197:function(t,e,o){"use strict";var n=o(175);o.n(n).a},200:function(t,e,o){"use strict";o.r(e);var n=o(177),r=o.n(n),c=o(178),l=o.n(c),h=o(179),f=(o(72),o(13),o(57),o(49)),d=(o(70),o(55),o(29),o(22),o(180),o(183)),m=o.n(d),v=o(185);function F(object,t){var e=Object.keys(object);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(object);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(object,t).enumerable}))),e.push.apply(e,o)}return e}function w(t){for(var i=1;i<arguments.length;i++){var source=null!=arguments[i]?arguments[i]:{};i%2?F(Object(source),!0).forEach((function(e){Object(f.a)(t,e,source[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(source)):F(Object(source)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(source,e))}))}return t}for(var x in v.fabric)v.fabric.hasOwnProperty(x);var z={"":["drop","dragover","dragenter","dragleave"],object:["moving","scaling","rotating","skewing","moved","scalec","rotated","skewed","modified","selected","added","removed"],selection:["created","cleared","updated"],mouse:["up","down","move","dblclick","wheel","over","out"]},y={props:{ancho:{type:Number,default:320},alto:{type:Number,default:240},escala:{type:Number,default:1}},data:function(){return{lienzo:null}},mounted:function(){var t=this;if(null==this.lienzo)for(var e in this.lienzo=new v.fabric.Canvas(this.$refs.lienzo,{preserveObjectStacking:!0}),this.lienzo.backgroundColor="white",this.actualizar(),console.debug(this.lienzo),z){var o=!0,n=!1,r=void 0;try{for(var c,l=function(){var o=c.value,n=e.length?"".concat(e,":").concat(o):o;t.lienzo.on(n,(function(e){t.$emit(n.replace(":","-"),e)}))},h=z[e][Symbol.iterator]();!(o=(c=h.next()).done);o=!0)l()}catch(t){n=!0,r=t}finally{try{o||null==h.return||h.return()}finally{if(n)throw r}}}},computed:{opciones:function(){return{id:"objeto"+this.lienzo.getObjects().length,cornerStrokeColor:"white",cornerColor:"black",cornerStyle:"circle",hasControls:!1,hasBorders:!0,lockMovementX:!0,lockMovementY:!0,scaleX:1,scaleY:1}}},methods:{activo:function(){return this.lienzo.getActiveObject()},actualizar:function(){this.lienzo.setWidth(this.ancho*this.escala),this.lienzo.setHeight(this.alto*this.escala),this.lienzo.setZoom(this.escala),this.lienzo.calcOffset(),this.lienzo.requestRenderAll()},rectangulo:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},e={width:100,height:100,fill:"#0099FF",left:0,top:0},rect=new v.fabric.Rect(w({},this.opciones,{},e,{},t));this.lienzo.add(rect),this.actualizar()},imagen:function(t){var e=this,o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};v.fabric.Image.fromURL(t,(function(img){var t=img.width,n=img.height,r={id:"imagen"+e.lienzo.getObjects().length,left:.5*e.ancho,top:.5*e.alto,originX:"left",originY:"top"};(m.a.has(o,"ancho")||m.a.has(o,"alto"))&&("number"==typeof o.ancho&&(t=o.ancho,"auto"===o.alto&&(n=img.height/img.width*t)),"number"==typeof o.alto&&(n=o.alto,"auto"===o.ancho&&(t=img.width/img.height*n))),r.scaleX=t/img.width,r.scaleY=n/img.height,img.set(w({},e.opciones,{},r,{},o)),e.lienzo.add(img),m.a.has(o,"zindex")&&img.moveTo(o.zindex),e.actualizar()}))},actualizarImagen:function(t,e){var o=this,n=t.width,r=t.height;t.setSrc(e,(function(t){t.set({width:n,height:r}),o.actualizar()}))},titulo:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},o={id:"titulo"+this.lienzo.getObjects().length,left:10,top:10,fontFamily:"Roboto"},n=new v.fabric.IText(t,w({},this.opciones,{},o,{},e));this.lienzo.add(n),m.a.has(e,"zindex")&&n.moveTo(e.zindex),this.actualizar()},parrafo:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},o={id:"parrafo"+this.lienzo.getObjects().length,left:10,top:10,width:300,fontFamily:"Roboto"},n=new v.fabric.Textbox(t,w({},this.opciones,{},o,{},e));this.lienzo.add(n),m.a.has(n,"zindex")&&n.moveTo(n.zindex),this.actualizar()},cargar:function(t){console.log("cargar",t),this.lienzo.backgroundColor=t.fondo||"white";var e=!0,o=!1,n=void 0;try{for(var r,c=t.objetos[Symbol.iterator]();!(e=(r=c.next()).done);e=!0){var l=r.value;switch(console.log(l),l.tipo){case"rectangulo":this.rectangulo(l.opciones);break;case"imagen":this.imagen(l.ruta,l.opciones);break;case"titulo":this.titulo(l.texto,l.opciones);break;case"parrafo":this.parrafo(l.texto,l.opciones)}}}catch(t){o=!0,n=t}finally{try{e||null==c.return||c.return()}finally{if(o)throw n}}this.actualizar()},json:function(){var t=this.lienzo.toJSON();return t},obtenerImagen:function(t){return this.lienzo.toDataURL()}}},j=(o(193),o(19)),O=Object(j.a)(y,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"fabric",attrs:{id:"fabric"}},[e("div",{staticClass:"contenedor"},[e("canvas",{ref:"lienzo",attrs:{width:this.ancho,height:this.alto}})])])}),[],!1,null,"de781530",null).exports,S={props:{objeto:{default:null,type:Object}},computed:{modo:function(){return this.objeto?this.objeto.get("type"):null}},methods:{propiedad:function(t){return null},seleccionaImagen:function(){this.$refs.inputImagen.click()},inputImagenChange:function(){var input=this.$refs.inputImagen;if(input.files&&input.files[0]){var t=new FileReader,e=this;t.onload=function(t){console.log("Imagen Cargada","opciones"),e.$emit("imagen-cargada",t.target.result)},t.readAsDataURL(input.files[0])}}}},C=(o(194),Object(j.a)(S,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{attrs:{id:"opciones"}},["image"==this.modo?e("div",{staticClass:"panel"},[e("div",{staticClass:"grupo"},[e("input",{ref:"inputImagen",staticClass:"oculto",attrs:{type:"file"},on:{change:this.inputImagenChange}}),e("button",{attrs:{type:"button"},on:{click:this.seleccionaImagen}},[this._v("Seleccionar imagen ...")])])]):this._e()])}),[],!1,null,"146d22b4",null).exports),k={data:function(){return{formatos:[{nombre:"img",titulo:"Imagen"}]}}},I=(o(195),{components:{Exportar:Object(j.a)(k,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{attrs:{id:"herramienta-exportar"}},[o("div",{staticClass:"lista"},t._l(t.formatos,(function(e){return o("button",{attrs:{type:"button"},on:{click:function(o){return t.$emit("evento","exportar:"+e.nombre)}}},[o("span",[t._v(t._s(e.titulo))])])})),0)])}),[],!1,null,null,null).exports},data:function(){return{herramienta:"exportar"}},methods:{}}),E=(o(196),{components:{Fabric:O,Opciones:C,Herramientas:Object(j.a)(I,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{attrs:{id:"herramientas"}},[o("div",{staticClass:"botones"},[o("button",{class:{actual:"exportar"==t.herramienta},attrs:{type:"button"},on:{click:function(e){t.herramienta="exportar"}}},[o("svg",{class:"icono",attrs:{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512","svg-inline":"",role:"presentation",focusable:"false",tabindex:"-1"}},[o("path",{attrs:{d:"M436 161V0H114.787L46 68.787V512h390V391h-30v91H76V90h60V30h270v131z"}}),o("path",{attrs:{d:"M346 191v-41.213L219.787 276 346 402.213V361h120V191H346zm90 140H317.213l-55-55 55-55H436v110z"}})]),o("span",[t._v("Exportar")])])]),null!=t.herramienta?o("div",{staticClass:"herramienta"},[o("Exportar",{on:{evento:function(e){return t.$emit("evento",e)}}})],1):t._e()])}),[],!1,null,null,null).exports},data:function(){return{escala:.65,fabric:null,objeto:null}},mounted:function(){var t=this;this.fabric=this.$refs.fabric,this.fabric.cargar(h),r.a.bind("4",(function(e){t.fabric.rectangulo({top:200,fill:"fuchsia"})}))},methods:{herramientasEvento:function(t){switch(t){case"exportar:pdf":this.exportarPdf();break;case"exportar:img":this.exportarImagen()}},fabricSelectionCleared:function(t){this.objeto=null},fabricSelection:function(t){this.objeto=t.target},opcionesImagenCargada:function(t){this.fabric.actualizarImagen(this.objeto,t)},exportarPdf:function(){var t=this,e=this.fabric.json();console.debug(e);var o=new l.a({unit:"mm",format:"a4",compress:!0});e.objects.forEach((function(e){switch(e.type){case"image":console.log(e.src);break;case"text":case"i-text":case"textbox":o.setFont("times"),o.setFontSize(e.fontSize),o.text(e.left/t.escala,e.top/t.escala,e.text)}})),o.save("doc.pdf")},exportarImagen:function(){var img=this.fabric.obtenerImagen("png"),t=document.createElement("a");t.href=img,t.target="_blank",t.download=img,document.body.appendChild(t),t.click(),document.body.removeChild(t)}}}),_=(o(197),Object(j.a)(E,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{attrs:{id:"pagina-editor"}},[e("opciones",{ref:"opciones",attrs:{objeto:this.objeto},on:{"imagen-cargada":this.opcionesImagenCargada}}),e("fabric",{ref:"fabric",attrs:{ancho:1920,alto:1080,escala:this.escala},on:{"selection-updated":this.fabricSelection,"selection-created":this.fabricSelection,"selection-cleared":this.fabricSelectionCleared}}),e("herramientas",{on:{evento:this.herramientasEvento}})],1)}),[],!1,null,"4515fbb2",null));e.default=_.exports}}]);