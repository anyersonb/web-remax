(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{176:function(t,e,n){},177:function(t,e,n){},180:function(t,e,n){},181:function(t,e,n){},190:function(t,e,n){"use strict";var o={data:function(){return{abierto:!1,formatos:[{nombre:"pdf",titulo:"Archivo PDF"},{nombre:"img",titulo:"Imagen"}]}},methods:{exportar:function(t){this.abierto=!1,this.$emit("accion","exportar:".concat(t))}}},r=(n(210),n(20)),c=Object(r.a)(o,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"accion-exportar"}},[n("button",{on:{click:function(e){t.abierto=!t.abierto}}},[t._v("Exportar")]),n("div",{directives:[{name:"show",rawName:"v-show",value:t.abierto,expression:"abierto"}],staticClass:"lista"},t._l(t.formatos,(function(e){return n("button",{attrs:{type:"button"},on:{click:function(n){return t.exportar(e.nombre)}}},[n("span",[t._v(t._s(e.titulo))])])})),0)])}),[],!1,null,null,null).exports,l=(n(71),n(29),n(21),n(13),n(55),n(17),n(2)),h=n(40),f=n(56);function d(object,t){var e=Object.keys(object);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(object);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(object,t).enumerable}))),e.push.apply(e,n)}return e}function v(t){for(var i=1;i<arguments.length;i++){var source=null!=arguments[i]?arguments[i]:{};i%2?d(Object(source),!0).forEach((function(e){Object(h.a)(t,e,source[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(source)):d(Object(source)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(source,e))}))}return t}var m,O={computed:v({},Object(f.e)(["nombre"])),methods:v({guardar:(m=Object(l.a)(regeneratorRuntime.mark((function t(){var e,n;return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:if(this.nombre){t.next=6;break}return t.next=3,this.$swal.fire({title:"Guardar diseño",text:"Nombre del diseño",input:"text",showCancelButton:!0,confirmButtonText:"Guardar"});case 3:e=t.sent,(n=e.value)&&this.establecerNombre(n);case 6:this.$emit("accion","guardar");case 7:case"end":return t.stop()}}),t,this)}))),function(){return m.apply(this,arguments)})},Object(f.d)(["establecerNombre"]),{},Object(f.b)(["guardarDiseño"]))},w={components:{Exportar:c,Guardar:Object(r.a)(O,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{attrs:{id:"accion-guardar"}},[e("button",{attrs:{type:"button"},on:{click:this.guardar}},[this._v("Guardar")])])}),[],!1,null,null,null).exports}},y=(n(211),Object(r.a)(w,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"acciones"}},[n("Exportar",{staticClass:"accion",on:{accion:function(e){return t.$emit("accion",e)}}}),n("Guardar",{staticClass:"accion",on:{accion:function(e){return t.$emit("accion",e,arguments[1])}}}),n("button",{staticClass:"accion",on:{click:function(e){return t.$emit("accion","volver")}}},[t._v("Volver")])],1)}),[],!1,null,null,null));e.a=y.exports},191:function(t,e,n){"use strict";n(71),n(13),n(55);var o=n(40),r=(n(73),n(58),n(29),n(21),n(193),n(196)),c=n.n(r),l=n(198);function h(object,t){var e=Object.keys(object);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(object);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(object,t).enumerable}))),e.push.apply(e,n)}return e}function f(t){for(var i=1;i<arguments.length;i++){var source=null!=arguments[i]?arguments[i]:{};i%2?h(Object(source),!0).forEach((function(e){Object(o.a)(t,e,source[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(source)):h(Object(source)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(source,e))}))}return t}for(var d in l.fabric)l.fabric.hasOwnProperty(d);var v={"":["drop","dragover","dragenter","dragleave"],object:["moving","scaling","rotating","skewing","moved","scalec","rotated","skewed","modified","selected","added","removed"],selection:["created","cleared","updated"],mouse:["up","down","move","dblclick","wheel","over","out"]},m={props:{ancho:{type:Number,default:320},alto:{type:Number,default:240},escala:{type:Number,default:1}},data:function(){return{lienzo:null}},computed:{opciones:function(){return{id:"objeto"+this.lienzo.getObjects().length,cornerStrokeColor:"white",cornerColor:"black",cornerStyle:"circle",hasControls:!1,hasBorders:!0,lockMovementX:!0,lockMovementY:!0,scaleX:1,scaleY:1}}},mounted:function(){var t=this;if(null==this.lienzo)for(var e in this.lienzo=new l.fabric.Canvas(this.$refs.lienzo,{preserveObjectStacking:!0}),this.lienzo.backgroundColor="white",this.actualizar(),v){var n=!0,o=!1,r=void 0;try{for(var c,h=function(){var n=c.value,o=e.length?"".concat(e,":").concat(n):n;t.lienzo.on(o,(function(e){t.$emit(o.replace(":","-"),e)}))},f=v[e][Symbol.iterator]();!(n=(c=f.next()).done);n=!0)h()}catch(t){o=!0,r=t}finally{try{n||null==f.return||f.return()}finally{if(o)throw r}}}},methods:{activo:function(){return this.lienzo.getActiveObject()},actualizar:function(){this.lienzo.setWidth(this.ancho*this.escala),this.lienzo.setHeight(this.alto*this.escala),this.lienzo.setZoom(this.escala),this.lienzo.calcOffset(),this.lienzo.requestRenderAll()},rectangulo:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},e={width:100,height:100,fill:"#0099FF",left:0,top:0},rect=new l.fabric.Rect(f({},this.opciones,{},e,{},t));this.lienzo.add(rect),this.actualizar()},imagen:function(t){var e=this,n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};l.fabric.Image.fromURL(t,(function(img){var t=img.width,o=img.height,r={id:"imagen"+e.lienzo.getObjects().length,left:.5*e.ancho,top:.5*e.alto,originX:"left",originY:"top"};(c.a.has(n,"ancho")||c.a.has(n,"alto"))&&("number"==typeof n.ancho&&(t=n.ancho,"auto"===n.alto&&(o=img.height/img.width*t)),"number"==typeof n.alto&&(o=n.alto,"auto"===n.ancho&&(t=img.width/img.height*o))),r.scaleX=t/img.width,r.scaleY=o/img.height,img.set(f({},e.opciones,{},r,{},n)),e.lienzo.add(img),c.a.has(n,"zindex")&&img.moveTo(n.zindex),e.actualizar()}))},actualizarImagen:function(t,e){var n=this,o=t.width,r=t.height;t.setSrc(e,(function(t){t.set({width:o,height:r}),n.actualizar()}))},titulo:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n={id:"titulo"+this.lienzo.getObjects().length,left:10,top:10,fontFamily:"Roboto"},o=new l.fabric.IText(t,f({},this.opciones,{},n,{},e));this.lienzo.add(o),c.a.has(e,"zindex")&&o.moveTo(e.zindex),this.actualizar()},parrafo:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n={id:"parrafo"+this.lienzo.getObjects().length,left:10,top:10,width:300,fontFamily:"Roboto"},o=new l.fabric.Textbox(t,f({},this.opciones,{},n,{},e));this.lienzo.add(o),c.a.has(o,"zindex")&&o.moveTo(o.zindex),this.actualizar()},cargar:function(t){this.lienzo.clear(),this.lienzo.backgroundColor=t.fondo||"white";var e=!0,n=!1,o=void 0;try{for(var r,c=t.objetos[Symbol.iterator]();!(e=(r=c.next()).done);e=!0){var l=r.value;switch(l.tipo){case"rectangulo":this.rectangulo(l.opciones);break;case"imagen":this.imagen(l.ruta,l.opciones);break;case"titulo":this.titulo(l.texto,l.opciones);break;case"parrafo":this.parrafo(l.texto,l.opciones)}}}catch(t){n=!0,o=t}finally{try{e||null==c.return||c.return()}finally{if(n)throw o}}this.actualizar()},json:function(){return this.lienzo.toJSON()},obtenerImagen:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:1;return this.lienzo.toDataURL({format:t,multiplier:e})},obtenerSVG:function(t){return this.lienzo.toSVG(t)}}},O=(n(206),n(20)),component=Object(O.a)(m,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"fabric",attrs:{id:"fabric"}},[e("div",{staticClass:"contenedor"},[e("canvas",{ref:"lienzo",attrs:{width:this.ancho,height:this.alto}})])])}),[],!1,null,"691987ce",null);e.a=component.exports},192:function(t,e,n){"use strict";var o={props:{objeto:{default:null,type:Object}},computed:{modo:function(){return this.objeto?this.objeto.get("type"):null}},methods:{propiedad:function(t){return null},seleccionaImagen:function(){this.$refs.inputImagen.click()},inputImagenChange:function(){var input=this.$refs.inputImagen;if(input.files&&input.files[0]){var t=new FileReader,e=this;t.onload=function(t){console.log("Imagen Cargada","opciones"),e.$emit("imagen-cargada",t.target.result)},t.readAsDataURL(input.files[0])}}}},r=(n(207),n(20)),component=Object(r.a)(o,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{attrs:{id:"opciones"}},["image"==this.modo?e("div",{staticClass:"panel"},[e("div",{staticClass:"grupo"},[e("input",{ref:"inputImagen",staticClass:"oculto",attrs:{type:"file"},on:{change:this.inputImagenChange}}),e("button",{attrs:{type:"button"},on:{click:this.seleccionaImagen}},[this._v("Subir imagen ...")])])]):this._e()])}),[],!1,null,"0f505e40",null);e.a=component.exports},203:function(t,e){},204:function(t,e){},205:function(t,e){},206:function(t,e,n){"use strict";var o=n(176);n.n(o).a},207:function(t,e,n){"use strict";var o=n(177);n.n(o).a},210:function(t,e,n){"use strict";var o=n(180);n.n(o).a},211:function(t,e,n){"use strict";var o=n(181);n.n(o).a}}]);