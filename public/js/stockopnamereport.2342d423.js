(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["stockopnamereport"],{"3a2f":function(t,e,i){"use strict";i("9734");var s=i("4ad4"),o=i("a9ad"),n=i("16b7"),a=i("b848"),r=i("f573"),h=i("f2e7"),c=i("80d2"),l=i("d9bd"),d=i("58df");e["a"]=Object(d["a"])(o["a"],n["a"],a["a"],r["a"],h["a"]).extend({name:"v-tooltip",props:{closeDelay:{type:[Number,String],default:0},disabled:Boolean,fixed:{type:Boolean,default:!0},openDelay:{type:[Number,String],default:0},openOnHover:{type:Boolean,default:!0},tag:{type:String,default:"span"},transition:String},data:()=>({calculatedMinWidth:0,closeDependents:!1}),computed:{calculatedLeft(){const{activator:t,content:e}=this.dimensions,i=!this.bottom&&!this.left&&!this.top&&!this.right,s=!1!==this.attach?t.offsetLeft:t.left;let o=0;return this.top||this.bottom||i?o=s+t.width/2-e.width/2:(this.left||this.right)&&(o=s+(this.right?t.width:-e.width)+(this.right?10:-10)),this.nudgeLeft&&(o-=parseInt(this.nudgeLeft)),this.nudgeRight&&(o+=parseInt(this.nudgeRight)),this.calcXOverflow(o,this.dimensions.content.width)+"px"},calculatedTop(){const{activator:t,content:e}=this.dimensions,i=!1!==this.attach?t.offsetTop:t.top;let s=0;return this.top||this.bottom?s=i+(this.bottom?t.height:-e.height)+(this.bottom?10:-10):(this.left||this.right)&&(s=i+t.height/2-e.height/2),this.nudgeTop&&(s-=parseInt(this.nudgeTop)),this.nudgeBottom&&(s+=parseInt(this.nudgeBottom)),this.calcYOverflow(s+this.pageYOffset)+"px"},classes(){return{"v-tooltip--top":this.top,"v-tooltip--right":this.right,"v-tooltip--bottom":this.bottom,"v-tooltip--left":this.left,"v-tooltip--attached":""===this.attach||!0===this.attach||"attach"===this.attach}},computedTransition(){return this.transition?this.transition:this.isActive?"scale-transition":"fade-transition"},offsetY(){return this.top||this.bottom},offsetX(){return this.left||this.right},styles(){return{left:this.calculatedLeft,maxWidth:Object(c["g"])(this.maxWidth),minWidth:Object(c["g"])(this.minWidth),opacity:this.isActive?.9:0,top:this.calculatedTop,zIndex:this.zIndex||this.activeZIndex}}},beforeMount(){this.$nextTick(()=>{this.value&&this.callActivate()})},mounted(){"v-slot"===Object(c["t"])(this,"activator",!0)&&Object(l["b"])("v-tooltip's activator slot must be bound, try '<template #activator=\"data\"><v-btn v-on=\"data.on>'",this)},methods:{activate(){this.updateDimensions(),requestAnimationFrame(this.startTransition)},deactivate(){this.runDelay("close")},genActivatorListeners(){const t=s["a"].options.methods.genActivatorListeners.call(this);return t.focus=t=>{this.getActivator(t),this.runDelay("open")},t.blur=t=>{this.getActivator(t),this.runDelay("close")},t.keydown=t=>{t.keyCode===c["x"].esc&&(this.getActivator(t),this.runDelay("close"))},t},genActivatorAttributes(){return{"aria-haspopup":!0,"aria-expanded":String(this.isActive)}},genTransition(){const t=this.genContent();return this.computedTransition?this.$createElement("transition",{props:{name:this.computedTransition}},[t]):t},genContent(){return this.$createElement("div",this.setBackgroundColor(this.color,{staticClass:"v-tooltip__content",class:{[this.contentClass]:!0,menuable__content__active:this.isActive,"v-tooltip__content--fixed":this.activatorFixed},style:this.styles,attrs:this.getScopeIdAttrs(),directives:[{name:"show",value:this.isContentActive}],ref:"content"}),this.getContentSlot())}},render(t){return t(this.tag,{staticClass:"v-tooltip",class:this.classes},[this.showLazyContent(()=>[this.genTransition()]),this.genActivator()])}})},"3f63":function(t,e,i){"use strict";i.r(e);var s=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-main",[i("v-container",{attrs:{"fill-width":""}},[i("v-data-table",{staticClass:"elevation-1",attrs:{headers:t.headers,items:t.listHistory,options:t.options,"server-items-length":t.lentable,loading:t.isLoading},on:{"update:options":function(e){t.options=e}},scopedSlots:t._u([{key:"item.actions",fn:function(e){var s=e.item;return[i("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var o=e.on;return[i("v-icon",t._g({staticClass:"mr-3",attrs:{small:""},on:{click:function(e){return t.printStockOpname(s.id,s.date)}}},o),[t._v(" mdi-printer ")])]}}],null,!0)},[i("span",[t._v("Print Stock Opname")])])]}}],null,!0)})],1)],1)},o=[],n=i("5530"),a=(i("841c"),i("ac1f"),i("99af"),{data:function(){return{headers:[{text:"Date",value:"date",sortable:!1},{text:"Actions",value:"actions",sortable:!1}],options:{}}},methods:{getListAPI:function(){if(!this.isLoading){var t=this.$store.dispatch,e=this.options,i=e.sortBy,s=e.sortDesc,o=e.page,n=e.itemsPerPage;i.length>0&&(this.sortbylast=i),1===s.length&&(this.sorting=s[0]?"DESC":"ASC"),t("stockopname/reqListHistory",{index:o,rows:n,search:this.search,sortby:this.sortbylast,sort:this.sorting})}},printStockOpname:function(t,e){window.open("http://localhost/visionet-api/report/stockopname?id=".concat(t,"&date=").concat(e))}},computed:{lentable:function(){return this.$store.getters["stockopname/getLenHistory"]},isLoading:function(){return this.$store.getters["stockopname/getLoadingHistory"]},listHistory:function(){return this.$store.getters["stockopname/getListHistory"]},params:function(){return Object(n["a"])(Object(n["a"])({},this.options),{},{query:this.search})}},watch:{params:{handler:function(t){this.getListAPI()},deep:!0},options:{handler:function(t){this.getListAPI()},deep:!0}}}),r=a,h=i("2877"),c=i("6544"),l=i.n(c),d=i("a523"),p=i("8fea"),u=i("132d"),f=i("f6c4"),g=i("3a2f"),v=Object(h["a"])(r,s,o,!1,null,null,null);e["default"]=v.exports;l()(v,{VContainer:d["a"],VDataTable:p["a"],VIcon:u["a"],VMain:f["a"],VTooltip:g["a"]})},9734:function(t,e,i){}}]);
//# sourceMappingURL=stockopnamereport.2342d423.js.map