(function(t){function e(e){for(var a,i,l=e[0],s=e[1],c=e[2],u=0,d=[];u<l.length;u++)i=l[u],Object.prototype.hasOwnProperty.call(o,i)&&o[i]&&d.push(o[i][0]),o[i]=0;for(a in s)Object.prototype.hasOwnProperty.call(s,a)&&(t[a]=s[a]);m&&m(e);while(d.length)d.shift()();return r.push.apply(r,c||[]),n()}function n(){for(var t,e=0;e<r.length;e++){for(var n=r[e],a=!0,i=1;i<n.length;i++){var l=n[i];0!==o[l]&&(a=!1)}a&&(r.splice(e--,1),t=s(s.s=n[0]))}return t}var a={},i={"app~d0ae3f07":0},o={"app~d0ae3f07":0},r=[];function l(t){return s.p+"js/"+({"about~6a3582c1":"about~6a3582c1","history~24a8645b":"history~24a8645b","location~4d9898df":"location~4d9898df","login~31ecd969":"login~31ecd969","notification~b2f971be":"notification~b2f971be","profile~6ec8cc44":"profile~6ec8cc44"}[t]||t)+"-legacy."+{"about~6a3582c1":"16b67fbc","history~24a8645b":"5fa7993b","location~4d9898df":"70944c96","login~31ecd969":"aad041b4","notification~b2f971be":"971a6885","profile~6ec8cc44":"e74709fb"}[t]+".js"}function s(e){if(a[e])return a[e].exports;var n=a[e]={i:e,l:!1,exports:{}};return t[e].call(n.exports,n,n.exports,s),n.l=!0,n.exports}s.e=function(t){var e=[],n={"login~31ecd969":1};i[t]?e.push(i[t]):0!==i[t]&&n[t]&&e.push(i[t]=new Promise((function(e,n){for(var a="css/"+({"about~6a3582c1":"about~6a3582c1","history~24a8645b":"history~24a8645b","location~4d9898df":"location~4d9898df","login~31ecd969":"login~31ecd969","notification~b2f971be":"notification~b2f971be","profile~6ec8cc44":"profile~6ec8cc44"}[t]||t)+"."+{"about~6a3582c1":"31d6cfe0","history~24a8645b":"31d6cfe0","location~4d9898df":"31d6cfe0","login~31ecd969":"4df999b2","notification~b2f971be":"31d6cfe0","profile~6ec8cc44":"31d6cfe0"}[t]+".css",o=s.p+a,r=document.getElementsByTagName("link"),l=0;l<r.length;l++){var c=r[l],u=c.getAttribute("data-href")||c.getAttribute("href");if("stylesheet"===c.rel&&(u===a||u===o))return e()}var d=document.getElementsByTagName("style");for(l=0;l<d.length;l++){c=d[l],u=c.getAttribute("data-href");if(u===a||u===o)return e()}var m=document.createElement("link");m.rel="stylesheet",m.type="text/css",m.onload=e,m.onerror=function(e){var a=e&&e.target&&e.target.src||o,r=new Error("Loading CSS chunk "+t+" failed.\n("+a+")");r.code="CSS_CHUNK_LOAD_FAILED",r.request=a,delete i[t],m.parentNode.removeChild(m),n(r)},m.href=o;var v=document.getElementsByTagName("head")[0];v.appendChild(m)})).then((function(){i[t]=0})));var a=o[t];if(0!==a)if(a)e.push(a[2]);else{var r=new Promise((function(e,n){a=o[t]=[e,n]}));e.push(a[2]=r);var c,u=document.createElement("script");u.charset="utf-8",u.timeout=120,s.nc&&u.setAttribute("nonce",s.nc),u.src=l(t);var d=new Error;c=function(e){u.onerror=u.onload=null,clearTimeout(m);var n=o[t];if(0!==n){if(n){var a=e&&("load"===e.type?"missing":e.type),i=e&&e.target&&e.target.src;d.message="Loading chunk "+t+" failed.\n("+a+": "+i+")",d.name="ChunkLoadError",d.type=a,d.request=i,n[1](d)}o[t]=void 0}};var m=setTimeout((function(){c({type:"timeout",target:u})}),12e4);u.onerror=u.onload=c,document.head.appendChild(u)}return Promise.all(e)},s.m=t,s.c=a,s.d=function(t,e,n){s.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},s.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},s.t=function(t,e){if(1&e&&(t=s(t)),8&e)return t;if(4&e&&"object"===typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(s.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var a in t)s.d(n,a,function(e){return t[e]}.bind(null,a));return n},s.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return s.d(e,"a",e),e},s.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},s.p="/",s.oe=function(t){throw console.error(t),t};var c=window["webpackJsonp"]=window["webpackJsonp"]||[],u=c.push.bind(c);c.push=e,c=c.slice();for(var d=0;d<c.length;d++)e(c[d]);var m=u;r.push([0,"chunk-vendors~81be87c8","chunk-vendors~d939e436","chunk-vendors~fdc6512a","chunk-vendors~b1f96ece","chunk-vendors~d2305125","chunk-vendors~4a7e9e0b","chunk-vendors~ce053847","chunk-vendors~11c2601a","chunk-vendors~0af62350"]),n()})({0:function(t,e,n){t.exports=n("56d7")},"56d7":function(t,e,n){"use strict";n.r(e);n("e260"),n("e6cf"),n("cca6"),n("a79d");var a=n("2b0e"),i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-app",[t.logged?n("v-app-bar",{attrs:{app:"",color:"primary",dark:""}},[n("v-app-bar-nav-icon",{on:{click:function(e){t.drawer=!t.drawer}}}),n("v-toolbar-title",[t._v("Visionet")]),n("v-spacer"),n("v-btn",{attrs:{icon:""},on:{click:function(e){return t.$router.push("/notification")}}},[n("v-icon",[t._v("mdi-bell")])],1),n("v-btn",{attrs:{icon:""},on:{click:function(t){}}},[n("v-icon",[t._v("mdi-logout")])],1)],1):t._e(),t.logged?n("v-navigation-drawer",{attrs:{absolute:"",temporary:""},model:{value:t.drawer,callback:function(e){t.drawer=e},expression:"drawer"}},[n("v-system-bar"),n("v-list",{attrs:{shaped:""}},[n("v-list-item",[n("v-list-item-avatar",{attrs:{size:"80"}},[n("v-img",{attrs:{src:"https://cdn.vuetifyjs.com/images/john.png"},on:{click:function(e){return t.$router.push("/profile")}}})],1)],1),n("v-list",{attrs:{nav:"",dense:""}},[n("v-list-item-group",{attrs:{color:"primary"},model:{value:t.selectedItem,callback:function(e){t.selectedItem=e},expression:"selectedItem"}},t._l(t.items,(function(e,a){return n("v-list-item",{key:a,on:{click:function(n){return t.$router.push(e.link)}}},[n("v-list-item-icon",[n("v-icon",{domProps:{textContent:t._s(e.icon)}})],1),n("v-list-item-content",[n("v-list-item-title",{domProps:{textContent:t._s(e.text)}})],1)],1)})),1)],1)],1)],1):t._e(),n("router-view")],1)},o=[],r=n("7496"),l=n("8336"),s=n("40dc"),c=n("5bc1"),u=n("2a7f"),d=n("2fa4"),m=n("132d"),v=n("f774"),f=n("afd9"),p=n("8860"),b=n("da13"),g=n("8270"),h=n("adda"),y=n("1baa"),V=n("34c3"),_=n("5d23"),w={name:"App",components:{VApp:r["a"],VBtn:l["a"],VAppBar:s["a"],VAppBarNavIcon:c["a"],VToolbarTitle:u["a"],VSpacer:d["a"],VIcon:m["a"],VNavigationDrawer:v["a"],VSystemBar:f["a"],VList:p["a"],VListItem:b["a"],VListItemAvatar:g["a"],VImg:h["a"],VListItemGroup:y["a"],VListItemIcon:V["a"],VListItemContent:_["a"],VListItemTitle:_["c"]},data:function(){return{drawer:null,drawers:{open:!0,clipped:!1,fixed:!0,permanent:!0,mini:!1},selectedItem:0,items:[{text:"Dashboard",icon:"mdi-home",link:"/"},{text:"Location",icon:"mdi-map  ",link:"/location"},{text:"System Log",icon:"mdi-history  ",link:"/history"}]}},computed:{logged:function(){return this.$store.getters["auth/logStatus"]}}},I=w,L=n("2877"),k=n("6544"),x=n.n(k),C=Object(L["a"])(I,i,o,!1,null,null,null),S=C.exports;x()(C,{VApp:r["a"],VAppBar:s["a"],VAppBarNavIcon:c["a"],VBtn:l["a"],VIcon:m["a"],VImg:h["a"],VList:p["a"],VListItem:b["a"],VListItemAvatar:g["a"],VListItemContent:_["a"],VListItemGroup:y["a"],VListItemIcon:V["a"],VListItemTitle:_["c"],VNavigationDrawer:v["a"],VSpacer:d["a"],VSystemBar:f["a"],VToolbarTitle:u["a"]});n("d3b7"),n("3ca3"),n("ddb0"),n("caad");var E=n("8c4f"),A=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-main",[n("v-container",{staticClass:"d-flex justify-center flex-wrap"},[n("v-card",{staticClass:"pa-2",staticStyle:{margin:"10px"},attrs:{"max-width":"344",outlined:""}},[n("v-list-item",{attrs:{"three-line":""}},[n("v-list-item-content",[n("div",{staticClass:"overline mb-4"},[t._v(" OVERLINE ")]),n("v-list-item-title",{staticClass:"headline mb-1"},[t._v(" Headline 5 ")]),n("v-list-item-subtitle",[t._v("Greyhound divisely hello coldly fonwderfully")])],1),n("v-list-item-avatar",{attrs:{tile:"",size:"80",color:"grey"}})],1),n("v-card-actions",[n("v-btn",{attrs:{outlined:"",rounded:"",text:""}},[t._v(" View Detail ")])],1)],1),n("v-card",{staticClass:"pa-2",staticStyle:{margin:"10px"},attrs:{"max-width":"344",outlined:""}},[n("v-list-item",{attrs:{"three-line":""}},[n("v-list-item-content",[n("div",{staticClass:"overline mb-4"},[t._v(" OVERLINE ")]),n("v-list-item-title",{staticClass:"headline mb-1"},[t._v(" Headline 5 ")]),n("v-list-item-subtitle",[t._v("Greyhound divisely hello coldly fonwderfully")])],1),n("v-list-item-avatar",{attrs:{tile:"",size:"80",color:"grey"}})],1),n("v-card-actions",[n("v-btn",{attrs:{outlined:"",rounded:"",text:""}},[t._v(" View Detail ")])],1)],1),n("v-card",{staticClass:"pa-2",staticStyle:{margin:"10px"},attrs:{"max-width":"344",outlined:""}},[n("v-list-item",{attrs:{"three-line":""}},[n("v-list-item-content",[n("div",{staticClass:"overline mb-4"},[t._v(" OVERLINE ")]),n("v-list-item-title",{staticClass:"headline mb-1"},[t._v(" Headline 5 ")]),n("v-list-item-subtitle",[t._v("Greyhound divisely hello coldly fonwderfully")])],1),n("v-list-item-avatar",{attrs:{tile:"",size:"80",color:"grey"}})],1),n("v-card-actions",[n("v-btn",{attrs:{outlined:"",rounded:"",text:""}},[t._v(" View Detail ")])],1)],1),n("v-card",{staticClass:"pa-2",staticStyle:{margin:"10px"},attrs:{"max-width":"344",outlined:""}},[n("v-list-item",{attrs:{"three-line":""}},[n("v-list-item-content",[n("div",{staticClass:"overline mb-4"},[t._v(" OVERLINE ")]),n("v-list-item-title",{staticClass:"headline mb-1"},[t._v(" Headline 5 ")]),n("v-list-item-subtitle",[t._v("Greyhound divisely hello coldly fonwderfully")])],1),n("v-list-item-avatar",{attrs:{tile:"",size:"80",color:"grey"}})],1),n("v-card-actions",[n("v-btn",{attrs:{outlined:"",rounded:"",text:""}},[t._v(" View Detail ")])],1)],1),n("v-card",{staticClass:"pa-2",staticStyle:{margin:"10px"},attrs:{"max-width":"344",outlined:""}},[n("v-list-item",{attrs:{"three-line":""}},[n("v-list-item-content",[n("div",{staticClass:"overline mb-4"},[t._v(" OVERLINE ")]),n("v-list-item-title",{staticClass:"headline mb-1"},[t._v(" Headline 5 ")]),n("v-list-item-subtitle",[t._v("Greyhound divisely hello coldly fonwderfully")])],1),n("v-list-item-avatar",{attrs:{tile:"",size:"80",color:"grey"}})],1),n("v-card-actions",[n("v-btn",{attrs:{outlined:"",rounded:"",text:""}},[t._v(" View Detail ")])],1)],1),n("v-card",{staticClass:"pa-2",staticStyle:{margin:"10px"},attrs:{"max-width":"344",outlined:""}},[n("v-list-item",{attrs:{"three-line":""}},[n("v-list-item-content",[n("div",{staticClass:"overline mb-4"},[t._v(" OVERLINE ")]),n("v-list-item-title",{staticClass:"headline mb-1"},[t._v(" Headline 5 ")]),n("v-list-item-subtitle",[t._v("Greyhound divisely hello coldly fonwderfully")])],1),n("v-icon",{attrs:{size:"80"}},[t._v(" mdi-monitor ")])],1),n("v-card-actions",[n("v-btn",{attrs:{outlined:"",rounded:"",text:""}},[t._v(" View Detail ")])],1)],1)],1)],1)},O=[],T=n("f6c4"),N=n("a523"),j=n("b0af"),P=n("99d9"),B={name:"Home",components:{VMain:T["a"],VContainer:N["a"],VCard:j["a"],VCardActions:P["a"],VBtn:l["a"],VIcon:m["a"],VListItemContent:_["a"],VListItem:b["a"],VListItemTitle:_["c"],VListItemSubtitle:_["b"]}},H=B,D=Object(L["a"])(H,A,O,!1,null,null,null),G=D.exports;x()(D,{VBtn:l["a"],VCard:j["a"],VCardActions:P["a"],VContainer:N["a"],VIcon:m["a"],VListItem:b["a"],VListItemAvatar:g["a"],VListItemContent:_["a"],VListItemSubtitle:_["b"],VListItemTitle:_["c"],VMain:T["a"]}),a["a"].use(E["a"]);var z=[{path:"/",name:"Home",meta:{title:"Home"},component:G},{path:"/about",name:"About",meta:{title:"About"},component:function(){return n.e("about~6a3582c1").then(n.bind(null,"f820"))}},{path:"/login",name:"Login",meta:{title:"Login"},component:function(){return n.e("login~31ecd969").then(n.bind(null,"a55b"))}},{path:"/profile",name:"Profile",meta:{title:"Profile"},component:function(){return n.e("profile~6ec8cc44").then(n.bind(null,"c66d"))}},{path:"/notification",name:"Notification",meta:{title:"Notification"},component:function(){return n.e("notification~b2f971be").then(n.bind(null,"109a"))}},{path:"/history",name:"History",meta:{title:"History"},component:function(){return n.e("history~24a8645b").then(n.bind(null,"e4bb"))}},{path:"/location",name:"Location",meta:{title:"Location"},component:function(){return n.e("location~4d9898df").then(n.bind(null,"8e3a"))}}],M=new E["a"]({mode:"history",routes:z});M.beforeEach((function(t,e,n){var i=localStorage.getItem("token"),o=localStorage.getItem("type"),r=["/login"],l=!r.includes(t.path),s=null!=i&&null!=o;return a["a"].nextTick((function(){document.title=t.meta.title?t.meta.title:"Home"})),l&&!s?n("/login"):!l&&s?n("/"):n()}));var $=M,R=n("2f62"),U=localStorage.getItem("token"),q=localStorage.getItem("user_type"),J=U?{isLogged:!0,token:U,loading:!1,err_msg:null,user_type:q}:{isLogged:!1,token:null,loading:!1,err_msg:null,user_type:null},F={namespaced:!0,state:J,actions:{},getters:{getError:function(t){return t.err_msg},logStatus:function(t){return t.isLogged},getToken:function(t){return t.token},getUserType:function(t){return t.user_type}},mutations:{saveUser:function(t,e){var n=e.token,a=e.user_type;localStorage.setItem("token",n),localStorage.setItem("user_type",a),t.token=n,t.user_type=a},setLogged:function(t){t.isLogged=!0},setLogout:function(t){localStorage.clear(),t.isLogged=!1,t.token=null,t.user_type=null},setLoading:function(t,e){var n=e.status;t.loading=n},setErrMsg:function(t,e){var n=e.err;t.err_msg=n}}},K={},Q={namespaced:!0,state:K,actions:{},getters:{},mutations:{}},W={},X={namespaced:!0,state:W,actions:{},getters:{},mutations:{}},Y={},Z={namespaced:!0,state:Y,actions:{},getters:{},mutations:{}};a["a"].use(R["a"]);var tt=new R["a"].Store({modules:{auth:F,asset:Q,dashboard:X,location:Z}}),et=n("f309");a["a"].use(et["a"]);var nt=new et["a"]({});a["a"].config.productionTip=!1,new a["a"]({router:$,store:tt,vuetify:nt,render:function(t){return t(S)}}).$mount("#app")}});
//# sourceMappingURL=app~d0ae3f07-legacy.020b9f5e.js.map