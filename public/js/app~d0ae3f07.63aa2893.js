(function(e){function t(t){for(var o,a,c=t[0],l=t[1],s=t[2],u=0,d=[];u<c.length;u++)a=c[u],Object.prototype.hasOwnProperty.call(r,a)&&r[a]&&d.push(r[a][0]),r[a]=0;for(o in l)Object.prototype.hasOwnProperty.call(l,o)&&(e[o]=l[o]);m&&m(t);while(d.length)d.shift()();return i.push.apply(i,s||[]),n()}function n(){for(var e,t=0;t<i.length;t++){for(var n=i[t],o=!0,a=1;a<n.length;a++){var c=n[a];0!==r[c]&&(o=!1)}o&&(i.splice(t--,1),e=l(l.s=n[0]))}return e}var o={},a={"app~d0ae3f07":0},r={"app~d0ae3f07":0},i=[];function c(e){return l.p+"js/"+({"about~6a3582c1":"about~6a3582c1","history~31ecd969":"history~31ecd969","home~login~dde583c9":"home~login~dde583c9","home~b9c7c462":"home~b9c7c462","login~31ecd969":"login~31ecd969","location~31ecd969":"location~31ecd969","notification~31ecd969":"notification~31ecd969","profile~31ecd969":"profile~31ecd969"}[e]||e)+"."+{"about~6a3582c1":"16b67fbc","history~31ecd969":"e394a004","home~login~dde583c9":"9f66510f","home~b9c7c462":"9cd6b103","login~31ecd969":"aad041b4","location~31ecd969":"9cbbd141","notification~31ecd969":"befa53ef","profile~31ecd969":"86d21438"}[e]+".js"}function l(t){if(o[t])return o[t].exports;var n=o[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,l),n.l=!0,n.exports}l.e=function(e){var t=[],n={"history~31ecd969":1,"home~login~dde583c9":1,"login~31ecd969":1,"location~31ecd969":1,"notification~31ecd969":1,"profile~31ecd969":1};a[e]?t.push(a[e]):0!==a[e]&&n[e]&&t.push(a[e]=new Promise((function(t,n){for(var o="css/"+({"about~6a3582c1":"about~6a3582c1","history~31ecd969":"history~31ecd969","home~login~dde583c9":"home~login~dde583c9","home~b9c7c462":"home~b9c7c462","login~31ecd969":"login~31ecd969","location~31ecd969":"location~31ecd969","notification~31ecd969":"notification~31ecd969","profile~31ecd969":"profile~31ecd969"}[e]||e)+"."+{"about~6a3582c1":"31d6cfe0","history~31ecd969":"68e6a77c","home~login~dde583c9":"11f4d815","home~b9c7c462":"31d6cfe0","login~31ecd969":"4df999b2","location~31ecd969":"68e6a77c","notification~31ecd969":"68e6a77c","profile~31ecd969":"68e6a77c"}[e]+".css",r=l.p+o,i=document.getElementsByTagName("link"),c=0;c<i.length;c++){var s=i[c],u=s.getAttribute("data-href")||s.getAttribute("href");if("stylesheet"===s.rel&&(u===o||u===r))return t()}var d=document.getElementsByTagName("style");for(c=0;c<d.length;c++){s=d[c],u=s.getAttribute("data-href");if(u===o||u===r)return t()}var m=document.createElement("link");m.rel="stylesheet",m.type="text/css",m.onload=t,m.onerror=function(t){var o=t&&t.target&&t.target.src||r,i=new Error("Loading CSS chunk "+e+" failed.\n("+o+")");i.code="CSS_CHUNK_LOAD_FAILED",i.request=o,delete a[e],m.parentNode.removeChild(m),n(i)},m.href=r;var p=document.getElementsByTagName("head")[0];p.appendChild(m)})).then((function(){a[e]=0})));var o=r[e];if(0!==o)if(o)t.push(o[2]);else{var i=new Promise((function(t,n){o=r[e]=[t,n]}));t.push(o[2]=i);var s,u=document.createElement("script");u.charset="utf-8",u.timeout=120,l.nc&&u.setAttribute("nonce",l.nc),u.src=c(e);var d=new Error;s=function(t){u.onerror=u.onload=null,clearTimeout(m);var n=r[e];if(0!==n){if(n){var o=t&&("load"===t.type?"missing":t.type),a=t&&t.target&&t.target.src;d.message="Loading chunk "+e+" failed.\n("+o+": "+a+")",d.name="ChunkLoadError",d.type=o,d.request=a,n[1](d)}r[e]=void 0}};var m=setTimeout((function(){s({type:"timeout",target:u})}),12e4);u.onerror=u.onload=s,document.head.appendChild(u)}return Promise.all(t)},l.m=e,l.c=o,l.d=function(e,t,n){l.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},l.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},l.t=function(e,t){if(1&t&&(e=l(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(l.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)l.d(n,o,function(t){return e[t]}.bind(null,o));return n},l.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return l.d(t,"a",t),t},l.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},l.p="/",l.oe=function(e){throw console.error(e),e};var s=window["webpackJsonp"]=window["webpackJsonp"]||[],u=s.push.bind(s);s.push=t,s=s.slice();for(var d=0;d<s.length;d++)t(s[d]);var m=u;i.push([0,"chunk-vendors~81be87c8","chunk-vendors~d939e436","chunk-vendors~fdc6512a","chunk-vendors~b1f96ece","chunk-vendors~d2305125","chunk-vendors~4a7e9e0b","chunk-vendors~ce053847","chunk-vendors~11c2601a","chunk-vendors~0af62350"]),n()})({0:function(e,t,n){e.exports=n("56d7")},"56d7":function(e,t,n){"use strict";n.r(t);n("e260"),n("e6cf"),n("cca6"),n("a79d");var o=n("2b0e"),a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-app",[e.logged?n("v-app-bar",{attrs:{app:"",color:"primary",dark:""}},[n("v-app-bar-nav-icon",{on:{click:function(t){e.drawer=!e.drawer}}}),n("v-toolbar-title",[e._v("Visionet")]),n("v-spacer"),n("v-btn",{attrs:{icon:""},on:{click:function(t){return e.$router.push("/notification")}}},[n("v-icon",[e._v("mdi-bell")])],1),n("v-btn",{attrs:{icon:""},on:{click:function(e){}}},[n("v-icon",[e._v("mdi-logout")])],1)],1):e._e(),e.logged?n("v-navigation-drawer",{attrs:{absolute:"",temporary:""},model:{value:e.drawer,callback:function(t){e.drawer=t},expression:"drawer"}},[n("v-system-bar"),n("v-list",{attrs:{shaped:""}},[n("v-list-item",[n("v-list-item-avatar",{attrs:{size:"80"}},[n("v-img",{attrs:{src:"https://cdn.vuetifyjs.com/images/john.png"},on:{click:function(t){return e.$router.push("/profile")}}})],1)],1),n("v-list",{attrs:{nav:"",dense:""}},[n("v-list-item-group",{attrs:{color:"primary"},model:{value:e.selectedItem,callback:function(t){e.selectedItem=t},expression:"selectedItem"}},e._l(e.items,(function(t,o){return n("v-list-item",{key:o,on:{click:function(n){return e.$router.push(t.link)}}},[n("v-list-item-icon",[n("v-icon",{domProps:{textContent:e._s(t.icon)}})],1),n("v-list-item-content",[n("v-list-item-title",{domProps:{textContent:e._s(t.text)}})],1)],1)})),1)],1)],1)],1):e._e(),n("router-view")],1)},r=[],i=n("7496"),c=n("8336"),l=n("40dc"),s=n("5bc1"),u=n("2a7f"),d=n("2fa4"),m=n("132d"),p=n("f774"),f=n("afd9"),g=n("8860"),h=n("da13"),v=n("8270"),b=n("adda"),y=n("1baa"),k=n("34c3"),V=n("5d23"),L={name:"App",components:{VApp:i["a"],VBtn:c["a"],VAppBar:l["a"],VAppBarNavIcon:s["a"],VToolbarTitle:u["a"],VSpacer:d["a"],VIcon:m["a"],VNavigationDrawer:p["a"],VSystemBar:f["a"],VList:g["a"],VListItem:h["a"],VListItemAvatar:v["a"],VImg:b["a"],VListItemGroup:y["a"],VListItemIcon:k["a"],VListItemContent:V["a"],VListItemTitle:V["c"]},data:function(){return{drawer:null,drawers:{open:!0,clipped:!1,fixed:!0,permanent:!0,mini:!1},selectedItem:0,items:[{text:"Dashboard",icon:"mdi-home",link:"/"},{text:"Location",icon:"mdi-map  ",link:"/location"},{text:"System Log",icon:"mdi-history  ",link:"/history"}]}},computed:{logged:function(){return this.$store.getters["auth/logStatus"]}}},I=L,_=n("2877"),w=n("6544"),S=n.n(w),x=Object(_["a"])(I,a,r,!1,null,null,null),A=x.exports;S()(x,{VApp:i["a"],VAppBar:l["a"],VAppBarNavIcon:s["a"],VBtn:c["a"],VIcon:m["a"],VImg:b["a"],VList:g["a"],VListItem:h["a"],VListItemAvatar:v["a"],VListItemContent:V["a"],VListItemGroup:y["a"],VListItemIcon:k["a"],VListItemTitle:V["c"],VNavigationDrawer:p["a"],VSpacer:d["a"],VSystemBar:f["a"],VToolbarTitle:u["a"]});n("d3b7"),n("3ca3"),n("ddb0"),n("caad");var T=n("8c4f");o["a"].use(T["a"]);var P=[{path:"/",name:"Home",meta:{title:"Home"},component:function(){return Promise.all([n.e("home~login~dde583c9"),n.e("home~b9c7c462")]).then(n.bind(null,"bb51"))}},{path:"/about",name:"About",meta:{title:"About"},component:function(){return n.e("about~6a3582c1").then(n.bind(null,"f820"))}},{path:"/login",name:"Login",meta:{title:"Login"},component:function(){return Promise.all([n.e("home~login~dde583c9"),n.e("login~31ecd969")]).then(n.bind(null,"a55b"))}},{path:"/profile",name:"Profile",meta:{title:"Profile"},component:function(){return n.e("profile~31ecd969").then(n.bind(null,"c66d"))}},{path:"/notification",name:"Notification",meta:{title:"Notification"},component:function(){return n.e("notification~31ecd969").then(n.bind(null,"109a"))}},{path:"/history",name:"History",meta:{title:"History"},component:function(){return n.e("history~31ecd969").then(n.bind(null,"e4bb"))}},{path:"/location",name:"Location",meta:{title:"Location"},component:function(){return n.e("location~31ecd969").then(n.bind(null,"8e3a"))}}],j=new T["a"]({mode:"history",routes:P});j.beforeEach((function(e,t,n){var a=localStorage.getItem("token"),r=localStorage.getItem("type"),i=["/login"],c=!i.includes(e.path),l=null!=a&&null!=r;return o["a"].nextTick((function(){document.title=e.meta.title?e.meta.title:"Home"})),c&&!l?n("/login"):!c&&l?n("/"):n()}));var E=j,O=n("2f62"),B=localStorage.getItem("token"),C=localStorage.getItem("user_type"),N=B?{isLogged:!0,token:B,loading:!1,err_msg:null,user_type:C}:{isLogged:!1,token:null,loading:!1,err_msg:null,user_type:null},H={namespaced:!0,state:N,actions:{},getters:{getError:function(e){return e.err_msg},logStatus:function(e){return e.isLogged},getToken:function(e){return e.token},getUserType:function(e){return e.user_type}},mutations:{saveUser:function(e,t){var n=t.token,o=t.user_type;localStorage.setItem("token",n),localStorage.setItem("user_type",o),e.token=n,e.user_type=o},setLogged:function(e){e.isLogged=!0},setLogout:function(e){localStorage.clear(),e.isLogged=!1,e.token=null,e.user_type=null},setLoading:function(e,t){var n=t.status;e.loading=n},setErrMsg:function(e,t){var n=t.err;e.err_msg=n}}},$={},D={namespaced:!0,state:$,actions:{},getters:{},mutations:{}},M={},U={namespaced:!0,state:M,actions:{},getters:{},mutations:{}},q={},G={namespaced:!0,state:q,actions:{},getters:{},mutations:{}};o["a"].use(O["a"]);var J=new O["a"].Store({modules:{auth:H,asset:D,dashboard:U,location:G}}),z=n("f309");o["a"].use(z["a"]);var F=new z["a"]({});o["a"].config.productionTip=!1,new o["a"]({router:E,store:J,vuetify:F,render:function(e){return e(A)}}).$mount("#app")}});
//# sourceMappingURL=app~d0ae3f07.63aa2893.js.map