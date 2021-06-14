(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["asset"],{"159b":function(t,e,i){var s=i("da84"),n=i("fdbc"),a=i("17c2"),o=i("9112");for(var r in n){var c=s[r],l=c&&c.prototype;if(l&&l.forEach!==a)try{o(l,"forEach",a)}catch(d){l.forEach=a}}},"169a":function(t,e,i){"use strict";i("368e");var s=i("480e"),n=i("4ad4"),a=i("b848"),o=i("75eb"),r=i("e707"),c=i("e4d3"),l=i("21be"),d=i("f2e7"),h=i("a293"),u=i("58df"),m=i("d9bd"),v=i("80d2");const f=Object(u["a"])(n["a"],a["a"],o["a"],r["a"],c["a"],l["a"],d["a"]);e["a"]=f.extend({name:"v-dialog",directives:{ClickOutside:h["a"]},props:{dark:Boolean,disabled:Boolean,fullscreen:Boolean,light:Boolean,maxWidth:{type:[String,Number],default:"none"},noClickAnimation:Boolean,origin:{type:String,default:"center center"},persistent:Boolean,retainFocus:{type:Boolean,default:!0},scrollable:Boolean,transition:{type:[String,Boolean],default:"dialog-transition"},width:{type:[String,Number],default:"auto"}},data(){return{activatedBy:null,animate:!1,animateTimeout:-1,isActive:!!this.value,stackMinZIndex:200,previousActiveElement:null}},computed:{classes(){return{[("v-dialog "+this.contentClass).trim()]:!0,"v-dialog--active":this.isActive,"v-dialog--persistent":this.persistent,"v-dialog--fullscreen":this.fullscreen,"v-dialog--scrollable":this.scrollable,"v-dialog--animated":this.animate}},contentClasses(){return{"v-dialog__content":!0,"v-dialog__content--active":this.isActive}},hasActivator(){return Boolean(!!this.$slots.activator||!!this.$scopedSlots.activator)}},watch:{isActive(t){var e;t?(this.show(),this.hideScroll()):(this.removeOverlay(),this.unbind(),null==(e=this.previousActiveElement)||e.focus())},fullscreen(t){this.isActive&&(t?(this.hideScroll(),this.removeOverlay(!1)):(this.showScroll(),this.genOverlay()))}},created(){this.$attrs.hasOwnProperty("full-width")&&Object(m["e"])("full-width",this)},beforeMount(){this.$nextTick(()=>{this.isBooted=this.isActive,this.isActive&&this.show()})},beforeDestroy(){"undefined"!==typeof window&&this.unbind()},methods:{animateClick(){this.animate=!1,this.$nextTick(()=>{this.animate=!0,window.clearTimeout(this.animateTimeout),this.animateTimeout=window.setTimeout(()=>this.animate=!1,150)})},closeConditional(t){const e=t.target;return!(this._isDestroyed||!this.isActive||this.$refs.content.contains(e)||this.overlay&&e&&!this.overlay.$el.contains(e))&&this.activeZIndex>=this.getMaxZIndex()},hideScroll(){this.fullscreen?document.documentElement.classList.add("overflow-y-hidden"):r["a"].options.methods.hideScroll.call(this)},show(){!this.fullscreen&&!this.hideOverlay&&this.genOverlay(),this.$nextTick(()=>{this.$nextTick(()=>{this.previousActiveElement=document.activeElement,this.$refs.content.focus(),this.bind()})})},bind(){window.addEventListener("focusin",this.onFocusin)},unbind(){window.removeEventListener("focusin",this.onFocusin)},onClickOutside(t){this.$emit("click:outside",t),this.persistent?this.noClickAnimation||this.animateClick():this.isActive=!1},onKeydown(t){if(t.keyCode===v["x"].esc&&!this.getOpenDependents().length)if(this.persistent)this.noClickAnimation||this.animateClick();else{this.isActive=!1;const t=this.getActivator();this.$nextTick(()=>t&&t.focus())}this.$emit("keydown",t)},onFocusin(t){if(!t||!this.retainFocus)return;const e=t.target;if(e&&![document,this.$refs.content].includes(e)&&!this.$refs.content.contains(e)&&this.activeZIndex>=this.getMaxZIndex()&&!this.getOpenDependentElements().some(t=>t.contains(e))){const t=this.$refs.content.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),e=[...t].find(t=>!t.hasAttribute("disabled"));e&&e.focus()}},genContent(){return this.showLazyContent(()=>[this.$createElement(s["a"],{props:{root:!0,light:this.light,dark:this.dark}},[this.$createElement("div",{class:this.contentClasses,attrs:{role:"document",tabindex:this.isActive?0:void 0,...this.getScopeIdAttrs()},on:{keydown:this.onKeydown},style:{zIndex:this.activeZIndex},ref:"content"},[this.genTransition()])])])},genTransition(){const t=this.genInnerContent();return this.transition?this.$createElement("transition",{props:{name:this.transition,origin:this.origin,appear:!0}},[t]):t},genInnerContent(){const t={class:this.classes,ref:"dialog",directives:[{name:"click-outside",value:{handler:this.onClickOutside,closeConditional:this.closeConditional,include:this.getOpenDependentElements}},{name:"show",value:this.isActive}],style:{transformOrigin:this.origin}};return this.fullscreen||(t.style={...t.style,maxWidth:"none"===this.maxWidth?void 0:Object(v["g"])(this.maxWidth),width:"auto"===this.width?void 0:Object(v["g"])(this.width)}),this.$createElement("div",t,this.getContentSlot())}},render(t){return t("div",{staticClass:"v-dialog__container",class:{"v-dialog__container--attached":""===this.attach||!0===this.attach||"attach"===this.attach},attrs:{role:"dialog"}},[this.genActivator(),this.genContent()])}})},"17c2":function(t,e,i){"use strict";var s=i("b727").forEach,n=i("a640"),a=n("forEach");t.exports=a?[].forEach:function(t){return s(this,t,arguments.length>1?arguments[1]:void 0)}},"1e58":function(t,e,i){"use strict";i.r(e);var s=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-main",[i("v-container",{attrs:{"fill-width":""}},[i("v-dialog",{attrs:{persistent:"","max-width":"500px"},model:{value:t.dialogStat,callback:function(e){t.dialogStat=e},expression:"dialogStat"}},[i("v-card",[i("v-card-title",[i("span",{staticClass:"headline"},[t._v(t._s(t.formTitle))])]),t.wo?i("v-card-text",[i("WorkOrderInput",{ref:"workorderinput",attrs:{edit:!1,forminputWO:t.forminputWO}})],1):i("v-card-text",[i("AssetInput",{ref:"submitpanel",attrs:{forminput:t.forminput}})],1),i("v-card-actions",[i("v-spacer"),i("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:t.closeDialog}},[t._v("Cancel")]),i("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:t.save}},[t._v("Save")])],1)],1)],1),i("v-spacer"),i("v-fab-transition",[i("v-btn",{directives:[{name:"show",rawName:"v-show",value:!t.hidden,expression:"!hidden"}],staticClass:"mb-2",attrs:{color:"primary",fab:"",dark:"",small:"",fixed:"",bottom:"",right:""},on:{click:t.addAction}},[i("v-icon",[t._v("mdi-plus")])],1)],1),i("Dialog",{attrs:{dialog:t.alert,title:"Delete",text:"Are you sure delete this?"},on:{ok:t.OkButton,no:t.NoButton}}),i("v-data-table",{staticClass:"elevation-1",attrs:{headers:t.headers,items:t.table,options:t.options,"server-items-length":t.lentable,loading:t.isLoading},on:{"update:options":function(e){t.options=e}},scopedSlots:t._u([{key:"top",fn:function(){return[i("v-toolbar",{attrs:{flat:""}},[i("v-text-field",{staticClass:"mx-12",attrs:{"append-icon":"mdi-magnify",label:"Search","single-line":"","hide-details":""},on:{keyup:t.searchAction},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}}),i("v-btn",{staticClass:"mb-2",attrs:{color:"primary",dark:""}},[i("v-icon",[t._v("mdi-printer")])],1)],1)]},proxy:!0},{key:"item.actions",fn:function(e){var s=e.item;return[i("v-icon",{staticClass:"mr-3",attrs:{small:""},on:{click:function(e){return t.editAction(s)}}},[t._v("\n                    mdi-pencil\n                ")]),i("v-icon",{staticClass:"mr-3",attrs:{small:""},on:{click:function(e){return t.deleteAction(s)}}},[t._v("\n                    mdi-delete\n                ")]),null===s.workorder_id?i("v-icon",{staticClass:"mr-3",attrs:{small:""},on:{click:function(e){return t.woAction(s)}}},[t._v("\n                    mdi-upload\n                ")]):t._e()]}}],null,!0)}),i("v-snackbar",{attrs:{value:t.errorMsg,color:t.color,"multi-line":"multi-line"===t.mode,timeout:t.timeout,vertical:"vertical"===t.mode}},[t._v("\n            "+t._s(t.errorMsg)+"\n            "),i("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),i("v-btn",{attrs:{dark:"",text:""},on:{click:function(e){return t.removeError()}}},[t._v("\n                Close\n            ")])],1)],1)],1)},n=[],a=i("5530"),o=(i("d3b7"),i("3ca3"),i("ddb0"),i("a4d3"),i("e01a"),i("841c"),i("ac1f"),i("b0c0"),{components:{Dialog:function(){return i.e("chunk-2d0c55d3").then(i.bind(null,"3f7a"))},AssetInput:function(){return i.e("chunk-7c6ffc99").then(i.bind(null,"87e9"))},WorkOrderInput:function(){return i.e("chunk-3aa366c8").then(i.bind(null,"c63f"))}},data:function(){return{wo:!1,formTitle:"",forminput:{device_name:null,device_brand:null,model:"",serial_number:"",status:{id:0,name:""},description:"",warehouse:null,id:0},forminputWO:{asset_id:-1,customer:{id:-1,name:""},location:{id:-1,name:""},device_name:"",brand_name:"",model:"",serial_number:""},edit:!1,options:{},selected:[],alert:!1,search:"",headers:[{text:"ID",value:"id",sortable:!1},{text:"Device",value:"devicename",sortable:!1},{text:"Brand",value:"brandname",sortable:!1},{text:"Model",value:"model",sortable:!1},{text:"Serial Number",value:"serial_number",sortable:!1},{text:"Condition",value:"conditionstatus",sortable:!1},{text:"Description",value:"description",sortable:!1},{text:"Warehouse",value:"warehousename",sortable:!1},{text:"Date In",value:"date_in",sortable:!1},{text:"Date Out",value:"date_out",sortable:!1},{text:"Actions",value:"actions",sortable:!1}],idselected:-1,items:[],currentY:0,lastY:0,hidden:!1,timeout:6e3,color:"",mode:""}},created:function(){window.addEventListener("scroll",this.handleScroll)},destroyed:function(){window.removeEventListener("scroll",this.handleScroll)},methods:{handleScroll:function(){this.currentY=window.top.scrollY,this.currentY>this.lastY?this.hidden=!0:this.hidden=!1,this.lastY=this.currentY},searchAction:function(){},editAction:function(t){this.edit=!0,this.wo=!1,this.formTitle="Edit Asset",this.forminput={id:t.id,device_name:{id:t.device_id,name:t.devicename},device_brand:{id:t.brand_id,name:t.brandname},model:t.model,serial_number:t.serial_number,status:{id:t.condition_id,name:t.conditionstatus},description:t.description,warehouse:{id:t.warehouse_id,name:t.warehousename}},this.idselected=this.table.indexOf(t);var e=this.$store.dispatch;e("asset/openDialog")},woAction:function(t){this.wo=!0,this.formTitle="Add Work Order",this.forminputWO.asset_id=t.id,this.forminputWO.device_name=t.devicename,this.forminputWO.brand_name=t.brandname,this.forminputWO.model=t.model,this.forminputWO.serial_number=t.serial_number;var e=this.$store.dispatch;e("asset/openDialog")},deleteAction:function(t){this.items.indexOf(t);this.alert=!0},closeDialog:function(){var t=this.$store.dispatch;t("asset/closeDialog"),this.$refs.submitpanel&&this.$refs.submitpanel.resetForm(),this.$refs.workorderinput&&this.$refs.workorderinput.resetForm()},save:function(){this.wo?this.submitWorkOrderAPI():this.edit?this.updateAPI():this.submitAPI()},removeError:function(){var t=this.$store.dispatch;t("asset/")},OkButton:function(){this.$store.dispatch;this.alert=!1,this.idselected=-1},NoButton:function(){this.alert=!1},addAction:function(){this.wo=!1,this.edit=!1,this.formTitle="Add Asset";var t=this.$store.dispatch;t("asset/openDialog")},getDataFromAPI:function(){if(!this.isLoading){var t=this.$store.dispatch,e=this.options,i=e.sortBy,s=e.sortDesc,n=e.page,a=e.itemsPerPage;i.length>0&&(this.sortbylast=i),1===s.length&&(this.sorting=s[0]?"DESC":"ASC"),t("asset/reqList",{index:n,rows:a,search:this.search,sortby:this.sortbylast,sort:this.sorting})}},submitWorkOrderAPI:function(){if(!this.isLoading){var t={asset:this.forminputWO.asset_id,customer:this.forminputWO.customer.id,location:this.forminputWO.location.id},e=this.$store.dispatch;e("asset/insertWorkOrder",t),e("asset/closeDialog"),this.$refs.workorderinput&&this.$refs.workorderinput.resetForm()}},submitAPI:function(){var t=this;if(!this.isLoading&&(!this.$refs.submitpanel||this.$refs.submitpanel.isValid())){var e={device_id:this.forminput.device_name.id,brand_id:this.forminput.device_brand.id,model:this.forminput.model,serial_number:this.forminput.serial_number,condition_id:this.forminput.status.id,condition_name:this.forminput.status.name,description:this.forminput.description,warehouse_id:this.forminput.warehouse.id},i=this.$store.dispatch;i("asset/insertAsset",e),i("asset/closeDialog"),this.$refs.submitpanel&&this.$refs.submitpanel.resetForm(),setTimeout((function(){t.getDataFromAPI()}),1e3)}},updateAPI:function(){var t=this;if(!this.isLoading){var e={id:this.forminput.id,device_id:this.forminput.device_name.id,brand_id:this.forminput.device_brand.id,model:this.forminput.model,serial_number:this.forminput.serial_number,condition_id:this.forminput.status.id,condition_name:this.forminput.status.name,description:this.forminput.description,warehouse_id:this.forminput.warehouse.id},i=this.$store.dispatch;i("asset/updateAsset",e),i("asset/closeDialog"),this.$refs.submitpanel&&this.$refs.submitpanel.resetForm(),setTimeout((function(){t.getDataFromAPI()}),1e3)}},deleteAPI:function(){this.isLoading}},computed:{table:function(){return this.$store.getters["asset/getList"]},lentable:function(){return this.$store.getters["asset/getTotalItems"]},dialogStat:function(){return this.$store.getters["asset/getDialog"]},isLoading:function(){return this.$store.getters["customer/getLoading"]},errorMsg:function(){return this.$store.getters["customer/getError"]},params:function(){return Object(a["a"])(Object(a["a"])({},this.options),{},{query:this.search})}},watch:{options:{handler:function(t){this.getDataFromAPI()},deep:!0},params:{handler:function(t){this.getDataFromAPI()},deep:!0}}}),r=o,c=i("2877"),l=i("6544"),d=i.n(l),h=i("8336"),u=i("b0af"),m=i("99d9"),v=i("a523"),f=i("8fea"),p=i("169a"),b=i("ce7e"),g=i("0789"),k=i("132d"),w=i("f6c4"),_=i("2db4"),O=i("2fa4"),y=i("8654"),x=i("71d9"),A=Object(c["a"])(r,s,n,!1,null,null,null);e["default"]=A.exports;d()(A,{VBtn:h["a"],VCard:u["a"],VCardActions:m["a"],VCardText:m["c"],VCardTitle:m["d"],VContainer:v["a"],VDataTable:f["a"],VDialog:p["a"],VDivider:b["a"],VFabTransition:g["c"],VIcon:k["a"],VMain:w["a"],VSnackbar:_["a"],VSpacer:O["a"],VTextField:y["a"],VToolbar:x["a"]})},"2db4":function(t,e,i){"use strict";i("ca71");var s=i("8dd9"),n=i("a9ad"),a=i("7560"),o=i("f2e7"),r=i("fe6c"),c=i("58df"),l=i("80d2"),d=i("d9bd");e["a"]=Object(c["a"])(s["a"],n["a"],o["a"],Object(r["b"])(["absolute","bottom","left","right","top"])).extend({name:"v-snackbar",props:{app:Boolean,centered:Boolean,contentClass:{type:String,default:""},multiLine:Boolean,text:Boolean,timeout:{type:[Number,String],default:5e3},transition:{type:[Boolean,String],default:"v-snack-transition",validator:t=>"string"===typeof t||!1===t},vertical:Boolean},data:()=>({activeTimeout:-1}),computed:{classes(){return{"v-snack--absolute":this.absolute,"v-snack--active":this.isActive,"v-snack--bottom":this.bottom||!this.top,"v-snack--centered":this.centered,"v-snack--has-background":this.hasBackground,"v-snack--left":this.left,"v-snack--multi-line":this.multiLine&&!this.vertical,"v-snack--right":this.right,"v-snack--text":this.text,"v-snack--top":this.top,"v-snack--vertical":this.vertical}},hasBackground(){return!this.text&&!this.outlined},isDark(){return this.hasBackground?!this.light:a["a"].options.computed.isDark.call(this)},styles(){if(this.absolute)return{};const{bar:t,bottom:e,footer:i,insetFooter:s,left:n,right:a,top:o}=this.$vuetify.application;return{paddingBottom:Object(l["g"])(e+i+s),paddingLeft:this.app?Object(l["g"])(n):void 0,paddingRight:this.app?Object(l["g"])(a):void 0,paddingTop:Object(l["g"])(t+o)}}},watch:{isActive:"setTimeout",timeout:"setTimeout"},mounted(){this.isActive&&this.setTimeout()},created(){this.$attrs.hasOwnProperty("auto-height")&&Object(d["e"])("auto-height",this),0==this.timeout&&Object(d["d"])('timeout="0"',"-1",this)},methods:{genActions(){return this.$createElement("div",{staticClass:"v-snack__action "},[Object(l["s"])(this,"action",{attrs:{class:"v-snack__btn"}})])},genContent(){return this.$createElement("div",{staticClass:"v-snack__content",class:{[this.contentClass]:!0},attrs:{role:"status","aria-live":"polite"}},[Object(l["s"])(this)])},genWrapper(){const t=this.hasBackground?this.setBackgroundColor:this.setTextColor,e=t(this.color,{staticClass:"v-snack__wrapper",class:s["a"].options.computed.classes.call(this),style:s["a"].options.computed.styles.call(this),directives:[{name:"show",value:this.isActive}],on:{mouseenter:()=>window.clearTimeout(this.activeTimeout),mouseleave:this.setTimeout}});return this.$createElement("div",e,[this.genContent(),this.genActions()])},genTransition(){return this.$createElement("transition",{props:{name:this.transition}},[this.genWrapper()])},setTimeout(){window.clearTimeout(this.activeTimeout);const t=Number(this.timeout);this.isActive&&![0,-1].includes(t)&&(this.activeTimeout=window.setTimeout(()=>{this.isActive=!1},t))}},render(t){return t("div",{staticClass:"v-snack",class:this.classes,style:this.styles},[!1!==this.transition?this.genTransition():this.genWrapper()])}})},"368e":function(t,e,i){},"4de4":function(t,e,i){"use strict";var s=i("23e7"),n=i("b727").filter,a=i("1dde"),o=a("filter");s({target:"Array",proto:!0,forced:!o},{filter:function(t){return n(this,t,arguments.length>1?arguments[1]:void 0)}})},5530:function(t,e,i){"use strict";i.d(e,"a",(function(){return a}));i("b64b"),i("a4d3"),i("4de4"),i("e439"),i("159b"),i("dbb4");var s=i("ade3");function n(t,e){var i=Object.keys(t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(t);e&&(s=s.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),i.push.apply(i,s)}return i}function a(t){for(var e=1;e<arguments.length;e++){var i=null!=arguments[e]?arguments[e]:{};e%2?n(Object(i),!0).forEach((function(e){Object(s["a"])(t,e,i[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(i)):n(Object(i)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(i,e))}))}return t}},"615b":function(t,e,i){},"99d9":function(t,e,i){"use strict";i.d(e,"a",(function(){return a})),i.d(e,"b",(function(){return o})),i.d(e,"c",(function(){return r})),i.d(e,"d",(function(){return c}));var s=i("b0af"),n=i("80d2");const a=Object(n["i"])("v-card__actions"),o=Object(n["i"])("v-card__subtitle"),r=Object(n["i"])("v-card__text"),c=Object(n["i"])("v-card__title");s["a"]},b0af:function(t,e,i){"use strict";i("615b");var s=i("10d2"),n=i("297c"),a=i("1c87"),o=i("58df");e["a"]=Object(o["a"])(n["a"],a["a"],s["a"]).extend({name:"v-card",props:{flat:Boolean,hover:Boolean,img:String,link:Boolean,loaderHeight:{type:[Number,String],default:4},raised:Boolean},computed:{classes(){return{"v-card":!0,...a["a"].options.computed.classes.call(this),"v-card--flat":this.flat,"v-card--hover":this.hover,"v-card--link":this.isClickable,"v-card--loading":this.loading,"v-card--disabled":this.disabled,"v-card--raised":this.raised,...s["a"].options.computed.classes.call(this)}},styles(){const t={...s["a"].options.computed.styles.call(this)};return this.img&&(t.background=`url("${this.img}") center center / cover no-repeat`),t}},methods:{genProgress(){const t=n["a"].options.methods.genProgress.call(this);return t?this.$createElement("div",{staticClass:"v-card__progress",key:"progress"},[t]):null}},render(t){const{tag:e,data:i}=this.generateRouteLink();return i.style=this.styles,this.isClickable&&(i.attrs=i.attrs||{},i.attrs.tabindex=0),t(e,this.setBackgroundColor(this.color,i),[this.genProgress(),this.$slots.default])}})},b0c0:function(t,e,i){var s=i("83ab"),n=i("9bf2").f,a=Function.prototype,o=a.toString,r=/^\s*function ([^ (]*)/,c="name";s&&!(c in a)&&n(a,c,{configurable:!0,get:function(){try{return o.call(this).match(r)[1]}catch(t){return""}}})},ca71:function(t,e,i){},dbb4:function(t,e,i){var s=i("23e7"),n=i("83ab"),a=i("56ef"),o=i("fc6a"),r=i("06cf"),c=i("8418");s({target:"Object",stat:!0,sham:!n},{getOwnPropertyDescriptors:function(t){var e,i,s=o(t),n=r.f,l=a(s),d={},h=0;while(l.length>h)i=n(s,e=l[h++]),void 0!==i&&c(d,e,i);return d}})},e439:function(t,e,i){var s=i("23e7"),n=i("d039"),a=i("fc6a"),o=i("06cf").f,r=i("83ab"),c=n((function(){o(1)})),l=!r||c;s({target:"Object",stat:!0,forced:l,sham:!r},{getOwnPropertyDescriptor:function(t,e){return o(a(t),e)}})}}]);
//# sourceMappingURL=asset.58db6e26.js.map