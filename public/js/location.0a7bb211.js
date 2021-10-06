(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["location"],{"169a":function(t,e,i){"use strict";i("368e");var s=i("480e"),n=i("4ad4"),o=i("b848"),a=i("75eb"),r=i("e707"),c=i("e4d3"),l=i("21be"),h=i("f2e7"),d=i("a293"),u=i("58df"),v=i("d9bd"),m=i("80d2");const p=Object(u["a"])(n["a"],o["a"],a["a"],r["a"],c["a"],l["a"],h["a"]);e["a"]=p.extend({name:"v-dialog",directives:{ClickOutside:d["a"]},props:{dark:Boolean,disabled:Boolean,fullscreen:Boolean,light:Boolean,maxWidth:{type:[String,Number],default:"none"},noClickAnimation:Boolean,origin:{type:String,default:"center center"},persistent:Boolean,retainFocus:{type:Boolean,default:!0},scrollable:Boolean,transition:{type:[String,Boolean],default:"dialog-transition"},width:{type:[String,Number],default:"auto"}},data(){return{activatedBy:null,animate:!1,animateTimeout:-1,isActive:!!this.value,stackMinZIndex:200,previousActiveElement:null}},computed:{classes(){return{[("v-dialog "+this.contentClass).trim()]:!0,"v-dialog--active":this.isActive,"v-dialog--persistent":this.persistent,"v-dialog--fullscreen":this.fullscreen,"v-dialog--scrollable":this.scrollable,"v-dialog--animated":this.animate}},contentClasses(){return{"v-dialog__content":!0,"v-dialog__content--active":this.isActive}},hasActivator(){return Boolean(!!this.$slots.activator||!!this.$scopedSlots.activator)}},watch:{isActive(t){var e;t?(this.show(),this.hideScroll()):(this.removeOverlay(),this.unbind(),null==(e=this.previousActiveElement)||e.focus())},fullscreen(t){this.isActive&&(t?(this.hideScroll(),this.removeOverlay(!1)):(this.showScroll(),this.genOverlay()))}},created(){this.$attrs.hasOwnProperty("full-width")&&Object(v["e"])("full-width",this)},beforeMount(){this.$nextTick(()=>{this.isBooted=this.isActive,this.isActive&&this.show()})},beforeDestroy(){"undefined"!==typeof window&&this.unbind()},methods:{animateClick(){this.animate=!1,this.$nextTick(()=>{this.animate=!0,window.clearTimeout(this.animateTimeout),this.animateTimeout=window.setTimeout(()=>this.animate=!1,150)})},closeConditional(t){const e=t.target;return!(this._isDestroyed||!this.isActive||this.$refs.content.contains(e)||this.overlay&&e&&!this.overlay.$el.contains(e))&&this.activeZIndex>=this.getMaxZIndex()},hideScroll(){this.fullscreen?document.documentElement.classList.add("overflow-y-hidden"):r["a"].options.methods.hideScroll.call(this)},show(){!this.fullscreen&&!this.hideOverlay&&this.genOverlay(),this.$nextTick(()=>{this.$nextTick(()=>{this.previousActiveElement=document.activeElement,this.$refs.content.focus(),this.bind()})})},bind(){window.addEventListener("focusin",this.onFocusin)},unbind(){window.removeEventListener("focusin",this.onFocusin)},onClickOutside(t){this.$emit("click:outside",t),this.persistent?this.noClickAnimation||this.animateClick():this.isActive=!1},onKeydown(t){if(t.keyCode===m["x"].esc&&!this.getOpenDependents().length)if(this.persistent)this.noClickAnimation||this.animateClick();else{this.isActive=!1;const t=this.getActivator();this.$nextTick(()=>t&&t.focus())}this.$emit("keydown",t)},onFocusin(t){if(!t||!this.retainFocus)return;const e=t.target;if(e&&![document,this.$refs.content].includes(e)&&!this.$refs.content.contains(e)&&this.activeZIndex>=this.getMaxZIndex()&&!this.getOpenDependentElements().some(t=>t.contains(e))){const t=this.$refs.content.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),e=[...t].find(t=>!t.hasAttribute("disabled"));e&&e.focus()}},genContent(){return this.showLazyContent(()=>[this.$createElement(s["a"],{props:{root:!0,light:this.light,dark:this.dark}},[this.$createElement("div",{class:this.contentClasses,attrs:{role:"document",tabindex:this.isActive?0:void 0,...this.getScopeIdAttrs()},on:{keydown:this.onKeydown},style:{zIndex:this.activeZIndex},ref:"content"},[this.genTransition()])])])},genTransition(){const t=this.genInnerContent();return this.transition?this.$createElement("transition",{props:{name:this.transition,origin:this.origin,appear:!0}},[t]):t},genInnerContent(){const t={class:this.classes,ref:"dialog",directives:[{name:"click-outside",value:{handler:this.onClickOutside,closeConditional:this.closeConditional,include:this.getOpenDependentElements}},{name:"show",value:this.isActive}],style:{transformOrigin:this.origin}};return this.fullscreen||(t.style={...t.style,maxWidth:"none"===this.maxWidth?void 0:Object(m["g"])(this.maxWidth),width:"auto"===this.width?void 0:Object(m["g"])(this.width)}),this.$createElement("div",t,this.getContentSlot())}},render(t){return t("div",{staticClass:"v-dialog__container",class:{"v-dialog__container--attached":""===this.attach||!0===this.attach||"attach"===this.attach},attrs:{role:"dialog"}},[this.genActivator(),this.genContent()])}})},"2d61":function(t,e,i){"use strict";i.r(e);var s=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-main",[i("v-container",{attrs:{"fill-width":""}},[i("v-dialog",{attrs:{persistent:"","max-width":"500px"},model:{value:t.dialogStatus,callback:function(e){t.dialogStatus=e},expression:"dialogStatus"}},[i("v-card",[i("v-card-title",[i("span",{staticClass:"headline"},[t._v(t._s(t.formTitle))])]),i("v-card-text",[i("SubmitPanel",{ref:"submitpanel",attrs:{forminput:t.forminput}})],1),i("v-card-actions",[i("v-spacer"),i("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:t.closeDialog}},[t._v("Cancel")]),i("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:t.save}},[t._v("Save")])],1)],1)],1),i("Dialog",{attrs:{dialog:t.alert,title:"Delete",text:"Are you sure delete this?"},on:{ok:t.OkButton,no:t.NoButton}}),i("v-data-table",{staticClass:"elevation-1",attrs:{headers:t.headers,items:t.table,options:t.options,"server-items-length":t.lentable,loading:t.isLoading},on:{"update:options":function(e){t.options=e}},scopedSlots:t._u([{key:"top",fn:function(){return[i("v-toolbar",{attrs:{flat:""}},[i("v-text-field",{attrs:{"append-icon":"mdi-magnify",label:"Search","single-line":"","hide-details":""},on:{keyup:t.searchAction},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}}),i("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var s=e.on;return[i("v-btn",t._g({staticClass:"mx-2",attrs:{color:"primary",dark:""},on:{click:t.addAction}},s),[i("v-icon",[t._v("mdi-plus")])],1)]}}])},[i("span",[t._v("Create New Location")])])],1)]},proxy:!0},{key:"item.actions",fn:function(e){var s=e.item;return[i("v-icon",{staticClass:"mr-2",attrs:{small:""},on:{click:function(e){return t.editAction(s)}}},[t._v(" mdi-pencil ")]),i("v-icon",{staticClass:"mr-2",attrs:{small:""},on:{click:function(e){return t.deleteAction(s)}}},[t._v(" mdi-delete ")])]}}],null,!0),model:{value:t.selected,callback:function(e){t.selected=e},expression:"selected"}}),i("v-snackbar",{attrs:{value:t.responseMsg,color:t.color,timeout:t.timeout}},[t._v(" "+t._s(t.responseMsg)+" "),i("v-btn",{attrs:{dark:"",text:""},on:{click:function(e){return t.removeError()}}},[t._v(" Close ")])],1),i("v-snackbar",{attrs:{value:t.errorMsg,color:t.color,timeout:t.timeout}},[t._v(" "+t._s(t.errorMsg)+" "),i("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),i("v-btn",{attrs:{dark:"",text:""},on:{click:function(e){return t.removeError()}}},[t._v(" Close ")])],1)],1)],1)},n=[],o=i("5530"),a=(i("d3b7"),i("3ca3"),i("ddb0"),i("b0c0"),i("841c"),i("ac1f"),{components:{SubmitPanel:function(){return i.e("chunk-1c1400ea").then(i.bind(null,"d99a"))},Dialog:function(){return i.e("chunk-2d0c55d3").then(i.bind(null,"3f7a"))}},data:function(){return{forminput:{id:-1,name:"",submit:"brand",type:1},selected:[],alert:!1,idselected:-1,search:"",headers:[{text:"Name",value:"name",sortable:!1},{text:"Actions",value:"actions",sortable:!1}],sortbylast:null,sorting:"ASC",editedIndex:-1,formInput:{id:-1,name:""},formTitle:"Location",hidden:!1,options:{},timeout:6e3,color:"",mode:""}},created:function(){window.addEventListener("scroll",this.handleScroll)},destroyed:function(){window.removeEventListener("scroll",this.handleScroll)},methods:{searchAction:function(){},removeError:function(){var t=this.$store.dispatch;t("location/removeError")},removeMsg:function(){var t=this.$store.dispatch;t("location/removeMsg")},handleScroll:function(){this.currentY=window.top.scrollY,this.currentY>this.lastY?this.hidden=!0:this.hidden=!1,this.lastY=this.currentY},addAction:function(){var t=this.$store.dispatch;this.idselected=-1,this.formTitle="Add Location",t("location/removeError"),t("location/openDialog")},editAction:function(t){var e=t.id,i=t.name;this.editedIndex=-1,this.idselected=this.table.indexOf(t),this.forminput={id:e,name:i},this.formTitle="Edit Location";var s=this.$store.dispatch;s("location/openDialog")},deleteAction:function(t){var e=this.table.indexOf(t);this.alert=!0,this.idselected=e},closeDialog:function(){var t=this.$store.dispatch;t("location/closeDialog"),this.$refs.submitpanel.resetForm()},save:function(){-1===this.idselected?this.submitAPI():this.editAPI(),this.$refs.submitpanel.resetForm()},OkButton:function(){var t=this.$store.dispatch;t("location/deleteList",this.table[this.idselected].id),this.alert=!1,this.idselected=-1},NoButton:function(){this.alert=!1},close:function(){this.dialog=!1},getDataFromAPI:function(){if(!this.isLoading){var t=this.$store.dispatch,e=this.options,i=e.sortBy,s=e.sortDesc,n=e.page,o=e.itemsPerPage;i.length>0&&(this.sortbylast=i),1===s.length&&(this.sorting=s[0]?"DESC":"ASC"),t("location/reqList",{index:n,rows:o,search:this.search,sortby:this.sortbylast,sort:this.sorting})}},submitAPI:function(){var t=this;if(!this.isLoading){var e=this.$store.dispatch;if(this.$refs.submitpanel.isValid()){var i={name:this.forminput.name};e("location/insertList",i)}e("location/closeDialog"),setTimeout((function(){t.getDataFromAPI()}),1e3)}},editAPI:function(){var t=this;if(!this.isLoading){var e=this.$store.dispatch;if(this.$refs.submitpanel.isValid()){var i={id:this.forminput.id,name:this.forminput.name};e("location/updateList",i)}e("location/closeDialog"),this.idselected=-1,setTimeout((function(){t.getDataFromAPI()}),1e3)}}},computed:{updateStat:function(){return this.$store.getters["location/getUpdate"]},table:function(){return this.$store.getters["location/getAllItems"]},isLoading:function(){return this.$store.getters["location/getLoading"]},lentable:function(){return this.$store.getters["location/getLenItems"]},errorMsg:function(){return this.$store.getters["location/getError"]},dialogStatus:function(){return this.$store.getters["location/getDialog"]},responseMsg:function(){return this.$store.getters["location/getMessage"]},params:function(){return Object(o["a"])(Object(o["a"])({},this.options),{},{query:this.search})}},watch:{options:{handler:function(t){this.getDataFromAPI()},deep:!0},updateStat:{handler:function(t){t&&this.getDataFromAPI()},deep:!0},params:{handler:function(t){this.getDataFromAPI()},deep:!0}}}),r=a,c=i("2877"),l=i("6544"),h=i.n(l),d=i("8336"),u=i("b0af"),v=i("99d9"),m=i("a523"),p=i("8fea"),g=i("169a"),f=i("ce7e"),b=i("132d"),k=i("f6c4"),y=i("2db4"),A=i("2fa4"),x=i("8654"),w=i("71d9"),C=i("3a2f"),_=Object(c["a"])(r,s,n,!1,null,null,null);e["default"]=_.exports;h()(_,{VBtn:d["a"],VCard:u["a"],VCardActions:v["a"],VCardText:v["c"],VCardTitle:v["d"],VContainer:m["a"],VDataTable:p["a"],VDialog:g["a"],VDivider:f["a"],VIcon:b["a"],VMain:k["a"],VSnackbar:y["a"],VSpacer:A["a"],VTextField:x["a"],VToolbar:w["a"],VTooltip:C["a"]})},"2db4":function(t,e,i){"use strict";i("ca71");var s=i("8dd9"),n=i("a9ad"),o=i("7560"),a=i("f2e7"),r=i("fe6c"),c=i("58df"),l=i("80d2"),h=i("d9bd");e["a"]=Object(c["a"])(s["a"],n["a"],a["a"],Object(r["b"])(["absolute","bottom","left","right","top"])).extend({name:"v-snackbar",props:{app:Boolean,centered:Boolean,contentClass:{type:String,default:""},multiLine:Boolean,text:Boolean,timeout:{type:[Number,String],default:5e3},transition:{type:[Boolean,String],default:"v-snack-transition",validator:t=>"string"===typeof t||!1===t},vertical:Boolean},data:()=>({activeTimeout:-1}),computed:{classes(){return{"v-snack--absolute":this.absolute,"v-snack--active":this.isActive,"v-snack--bottom":this.bottom||!this.top,"v-snack--centered":this.centered,"v-snack--has-background":this.hasBackground,"v-snack--left":this.left,"v-snack--multi-line":this.multiLine&&!this.vertical,"v-snack--right":this.right,"v-snack--text":this.text,"v-snack--top":this.top,"v-snack--vertical":this.vertical}},hasBackground(){return!this.text&&!this.outlined},isDark(){return this.hasBackground?!this.light:o["a"].options.computed.isDark.call(this)},styles(){if(this.absolute)return{};const{bar:t,bottom:e,footer:i,insetFooter:s,left:n,right:o,top:a}=this.$vuetify.application;return{paddingBottom:Object(l["g"])(e+i+s),paddingLeft:this.app?Object(l["g"])(n):void 0,paddingRight:this.app?Object(l["g"])(o):void 0,paddingTop:Object(l["g"])(t+a)}}},watch:{isActive:"setTimeout",timeout:"setTimeout"},mounted(){this.isActive&&this.setTimeout()},created(){this.$attrs.hasOwnProperty("auto-height")&&Object(h["e"])("auto-height",this),0==this.timeout&&Object(h["d"])('timeout="0"',"-1",this)},methods:{genActions(){return this.$createElement("div",{staticClass:"v-snack__action "},[Object(l["s"])(this,"action",{attrs:{class:"v-snack__btn"}})])},genContent(){return this.$createElement("div",{staticClass:"v-snack__content",class:{[this.contentClass]:!0},attrs:{role:"status","aria-live":"polite"}},[Object(l["s"])(this)])},genWrapper(){const t=this.hasBackground?this.setBackgroundColor:this.setTextColor,e=t(this.color,{staticClass:"v-snack__wrapper",class:s["a"].options.computed.classes.call(this),style:s["a"].options.computed.styles.call(this),directives:[{name:"show",value:this.isActive}],on:{mouseenter:()=>window.clearTimeout(this.activeTimeout),mouseleave:this.setTimeout}});return this.$createElement("div",e,[this.genContent(),this.genActions()])},genTransition(){return this.$createElement("transition",{props:{name:this.transition}},[this.genWrapper()])},setTimeout(){window.clearTimeout(this.activeTimeout);const t=Number(this.timeout);this.isActive&&![0,-1].includes(t)&&(this.activeTimeout=window.setTimeout(()=>{this.isActive=!1},t))}},render(t){return t("div",{staticClass:"v-snack",class:this.classes,style:this.styles},[!1!==this.transition?this.genTransition():this.genWrapper()])}})},"368e":function(t,e,i){},"3a2f":function(t,e,i){"use strict";i("9734");var s=i("4ad4"),n=i("a9ad"),o=i("16b7"),a=i("b848"),r=i("f573"),c=i("f2e7"),l=i("80d2"),h=i("d9bd"),d=i("58df");e["a"]=Object(d["a"])(n["a"],o["a"],a["a"],r["a"],c["a"]).extend({name:"v-tooltip",props:{closeDelay:{type:[Number,String],default:0},disabled:Boolean,fixed:{type:Boolean,default:!0},openDelay:{type:[Number,String],default:0},openOnHover:{type:Boolean,default:!0},tag:{type:String,default:"span"},transition:String},data:()=>({calculatedMinWidth:0,closeDependents:!1}),computed:{calculatedLeft(){const{activator:t,content:e}=this.dimensions,i=!this.bottom&&!this.left&&!this.top&&!this.right,s=!1!==this.attach?t.offsetLeft:t.left;let n=0;return this.top||this.bottom||i?n=s+t.width/2-e.width/2:(this.left||this.right)&&(n=s+(this.right?t.width:-e.width)+(this.right?10:-10)),this.nudgeLeft&&(n-=parseInt(this.nudgeLeft)),this.nudgeRight&&(n+=parseInt(this.nudgeRight)),this.calcXOverflow(n,this.dimensions.content.width)+"px"},calculatedTop(){const{activator:t,content:e}=this.dimensions,i=!1!==this.attach?t.offsetTop:t.top;let s=0;return this.top||this.bottom?s=i+(this.bottom?t.height:-e.height)+(this.bottom?10:-10):(this.left||this.right)&&(s=i+t.height/2-e.height/2),this.nudgeTop&&(s-=parseInt(this.nudgeTop)),this.nudgeBottom&&(s+=parseInt(this.nudgeBottom)),this.calcYOverflow(s+this.pageYOffset)+"px"},classes(){return{"v-tooltip--top":this.top,"v-tooltip--right":this.right,"v-tooltip--bottom":this.bottom,"v-tooltip--left":this.left,"v-tooltip--attached":""===this.attach||!0===this.attach||"attach"===this.attach}},computedTransition(){return this.transition?this.transition:this.isActive?"scale-transition":"fade-transition"},offsetY(){return this.top||this.bottom},offsetX(){return this.left||this.right},styles(){return{left:this.calculatedLeft,maxWidth:Object(l["g"])(this.maxWidth),minWidth:Object(l["g"])(this.minWidth),opacity:this.isActive?.9:0,top:this.calculatedTop,zIndex:this.zIndex||this.activeZIndex}}},beforeMount(){this.$nextTick(()=>{this.value&&this.callActivate()})},mounted(){"v-slot"===Object(l["t"])(this,"activator",!0)&&Object(h["b"])("v-tooltip's activator slot must be bound, try '<template #activator=\"data\"><v-btn v-on=\"data.on>'",this)},methods:{activate(){this.updateDimensions(),requestAnimationFrame(this.startTransition)},deactivate(){this.runDelay("close")},genActivatorListeners(){const t=s["a"].options.methods.genActivatorListeners.call(this);return t.focus=t=>{this.getActivator(t),this.runDelay("open")},t.blur=t=>{this.getActivator(t),this.runDelay("close")},t.keydown=t=>{t.keyCode===l["x"].esc&&(this.getActivator(t),this.runDelay("close"))},t},genActivatorAttributes(){return{"aria-haspopup":!0,"aria-expanded":String(this.isActive)}},genTransition(){const t=this.genContent();return this.computedTransition?this.$createElement("transition",{props:{name:this.computedTransition}},[t]):t},genContent(){return this.$createElement("div",this.setBackgroundColor(this.color,{staticClass:"v-tooltip__content",class:{[this.contentClass]:!0,menuable__content__active:this.isActive,"v-tooltip__content--fixed":this.activatorFixed},style:this.styles,attrs:this.getScopeIdAttrs(),directives:[{name:"show",value:this.isContentActive}],ref:"content"}),this.getContentSlot())}},render(t){return t(this.tag,{staticClass:"v-tooltip",class:this.classes},[this.showLazyContent(()=>[this.genTransition()]),this.genActivator()])}})},"615b":function(t,e,i){},9734:function(t,e,i){},"99d9":function(t,e,i){"use strict";i.d(e,"a",(function(){return o})),i.d(e,"b",(function(){return a})),i.d(e,"c",(function(){return r})),i.d(e,"d",(function(){return c}));var s=i("b0af"),n=i("80d2");const o=Object(n["i"])("v-card__actions"),a=Object(n["i"])("v-card__subtitle"),r=Object(n["i"])("v-card__text"),c=Object(n["i"])("v-card__title");s["a"]},b0af:function(t,e,i){"use strict";i("615b");var s=i("10d2"),n=i("297c"),o=i("1c87"),a=i("58df");e["a"]=Object(a["a"])(n["a"],o["a"],s["a"]).extend({name:"v-card",props:{flat:Boolean,hover:Boolean,img:String,link:Boolean,loaderHeight:{type:[Number,String],default:4},raised:Boolean},computed:{classes(){return{"v-card":!0,...o["a"].options.computed.classes.call(this),"v-card--flat":this.flat,"v-card--hover":this.hover,"v-card--link":this.isClickable,"v-card--loading":this.loading,"v-card--disabled":this.disabled,"v-card--raised":this.raised,...s["a"].options.computed.classes.call(this)}},styles(){const t={...s["a"].options.computed.styles.call(this)};return this.img&&(t.background=`url("${this.img}") center center / cover no-repeat`),t}},methods:{genProgress(){const t=n["a"].options.methods.genProgress.call(this);return t?this.$createElement("div",{staticClass:"v-card__progress",key:"progress"},[t]):null}},render(t){const{tag:e,data:i}=this.generateRouteLink();return i.style=this.styles,this.isClickable&&(i.attrs=i.attrs||{},i.attrs.tabindex=0),t(e,this.setBackgroundColor(this.color,i),[this.genProgress(),this.$slots.default])}})},ca71:function(t,e,i){}}]);
//# sourceMappingURL=location.0a7bb211.js.map