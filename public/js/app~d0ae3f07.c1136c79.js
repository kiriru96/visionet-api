(function(t){function e(e){for(var o,i,c=e[0],s=e[1],l=e[2],u=0,p=[];u<c.length;u++)i=c[u],Object.prototype.hasOwnProperty.call(a,i)&&a[i]&&p.push(a[i][0]),a[i]=0;for(o in s)Object.prototype.hasOwnProperty.call(s,o)&&(t[o]=s[o]);d&&d(e);while(p.length)p.shift()();return r.push.apply(r,l||[]),n()}function n(){for(var t,e=0;e<r.length;e++){for(var n=r[e],o=!0,i=1;i<n.length;i++){var s=n[i];0!==a[s]&&(o=!1)}o&&(r.splice(e--,1),t=c(c.s=n[0]))}return t}var o={},a={"app~d0ae3f07":0},r=[];function i(t){return c.p+"js/"+({"about~6a3582c1":"about~6a3582c1","history~24a8645b":"history~24a8645b","home~b9c7c462":"home~b9c7c462","location~4d9898df":"location~4d9898df","login~face4f69":"login~face4f69","notification~f96028be":"notification~f96028be","profile~6191c4d9":"profile~6191c4d9"}[t]||t)+"."+{"about~6a3582c1":"c6bcadc3","history~24a8645b":"5e078678","home~b9c7c462":"4ee2d60e","location~4d9898df":"5e806d1a","login~face4f69":"06a9bb8a","notification~f96028be":"6e889c2c","profile~6191c4d9":"3469fbf0"}[t]+".js"}function c(e){if(o[e])return o[e].exports;var n=o[e]={i:e,l:!1,exports:{}};return t[e].call(n.exports,n,n.exports,c),n.l=!0,n.exports}c.e=function(t){var e=[],n=a[t];if(0!==n)if(n)e.push(n[2]);else{var o=new Promise((function(e,o){n=a[t]=[e,o]}));e.push(n[2]=o);var r,s=document.createElement("script");s.charset="utf-8",s.timeout=120,c.nc&&s.setAttribute("nonce",c.nc),s.src=i(t);var l=new Error;r=function(e){s.onerror=s.onload=null,clearTimeout(u);var n=a[t];if(0!==n){if(n){var o=e&&("load"===e.type?"missing":e.type),r=e&&e.target&&e.target.src;l.message="Loading chunk "+t+" failed.\n("+o+": "+r+")",l.name="ChunkLoadError",l.type=o,l.request=r,n[1](l)}a[t]=void 0}};var u=setTimeout((function(){r({type:"timeout",target:s})}),12e4);s.onerror=s.onload=r,document.head.appendChild(s)}return Promise.all(e)},c.m=t,c.c=o,c.d=function(t,e,n){c.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},c.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},c.t=function(t,e){if(1&e&&(t=c(t)),8&e)return t;if(4&e&&"object"===typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(c.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)c.d(n,o,function(e){return t[e]}.bind(null,o));return n},c.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return c.d(e,"a",e),e},c.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},c.p="/",c.oe=function(t){throw console.error(t),t};var s=window["webpackJsonp"]=window["webpackJsonp"]||[],l=s.push.bind(s);s.push=e,s=s.slice();for(var u=0;u<s.length;u++)e(s[u]);var d=l;r.push([0,"chunk-vendors~81be87c8","chunk-vendors~d939e436","chunk-vendors~fdc6512a","chunk-vendors~b1f96ece","chunk-vendors~d2305125","chunk-vendors~4a7e9e0b","chunk-vendors~793fb972","chunk-vendors~85da75cb","chunk-vendors~ce053847","chunk-vendors~11c2601a","chunk-vendors~7f1069ae"]),n()})({0:function(t,e,n){t.exports=n("56d7")},"56d7":function(t,e,n){"use strict";n.r(e);n("e260"),n("e6cf"),n("cca6"),n("a79d");var o=n("2b0e"),a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-app",[t.logged?n("v-app-bar",{attrs:{app:"",color:"primary",dark:""}},[n("v-app-bar-nav-icon",{on:{click:function(e){t.drawer=!t.drawer}}}),n("v-toolbar-title",[t._v("Visionet")]),n("v-spacer"),n("v-btn",{attrs:{icon:""},on:{click:function(e){return t.$router.push("/notification")}}},[n("v-icon",[t._v("mdi-bell")])],1),n("v-btn",{attrs:{icon:""},on:{click:function(t){}}},[n("v-icon",[t._v("mdi-logout")])],1)],1):t._e(),t.logged?n("v-navigation-drawer",{attrs:{absolute:"",temporary:""},model:{value:t.drawer,callback:function(e){t.drawer=e},expression:"drawer"}},[n("v-system-bar"),n("v-list",{attrs:{shaped:""}},[n("v-list-item",[n("v-list-item-avatar",{attrs:{size:"80"}},[n("v-img",{attrs:{src:"https://cdn.vuetifyjs.com/images/john.png"},on:{click:function(e){return t.$router.push("/profile")}}})],1)],1),n("v-list",{attrs:{nav:"",dense:""}},[n("v-list-item-group",{attrs:{color:"primary"},model:{value:t.selectedItem,callback:function(e){t.selectedItem=e},expression:"selectedItem"}},t._l(t.items,(function(e,o){return n("v-list-item",{key:o,on:{click:function(n){return t.$router.push(e.link)}}},[n("v-list-item-icon",[n("v-icon",{domProps:{textContent:t._s(e.icon)}})],1),n("v-list-item-content",[n("v-list-item-title",{domProps:{textContent:t._s(e.text)}})],1)],1)})),1)],1)],1)],1):t._e(),n("router-view")],1)},r=[],i=n("7496"),c=n("8336"),s=n("40dc"),l=n("5bc1"),u=n("2a7f"),d=n("2fa4"),p=n("132d"),m=n("f774"),f=n("afd9"),v=n("8860"),g=n("da13"),b=n("8270"),h=n("adda"),V=n("1baa"),y=n("34c3"),I=n("5d23"),L={name:"App",components:{VApp:i["a"],VBtn:c["a"],VAppBar:s["a"],VAppBarNavIcon:l["a"],VToolbarTitle:u["a"],VSpacer:d["a"],VIcon:p["a"],VNavigationDrawer:m["a"],VSystemBar:f["a"],VList:v["a"],VListItem:g["a"],VListItemAvatar:b["a"],VImg:h["a"],VListItemGroup:V["a"],VListItemIcon:y["a"],VListItemContent:I["a"],VListItemTitle:I["c"]},data:function(){return{drawer:null,drawers:{open:!0,clipped:!1,fixed:!0,permanent:!0,mini:!1},selectedItem:0,items:[{text:"Dashboard",icon:"mdi-home",link:"/"},{text:"Location",icon:"mdi-map  ",link:"/location"},{text:"System Log",icon:"mdi-history  ",link:"/history"}]}},computed:{logged:function(){return this.$store.getters["auth/logStatus"]}}},k=L,w=n("2877"),_=n("6544"),S=n.n(_),x=Object(w["a"])(k,a,r,!1,null,null,null),T=x.exports;S()(x,{VApp:i["a"],VAppBar:s["a"],VAppBarNavIcon:l["a"],VBtn:c["a"],VIcon:p["a"],VImg:h["a"],VList:v["a"],VListItem:g["a"],VListItemAvatar:b["a"],VListItemContent:I["a"],VListItemGroup:V["a"],VListItemIcon:y["a"],VListItemTitle:I["c"],VNavigationDrawer:m["a"],VSpacer:d["a"],VSystemBar:f["a"],VToolbarTitle:u["a"]});n("d3b7"),n("3ca3"),n("ddb0"),n("caad");var A=n("8c4f");o["a"].use(A["a"]);var j=[{path:"/",name:"Home",meta:{title:"Home"},component:function(){return n.e("home~b9c7c462").then(n.bind(null,"bb51"))}},{path:"/about",name:"About",meta:{title:"About"},component:function(){return n.e("about~6a3582c1").then(n.bind(null,"f820"))}},{path:"/login",name:"Login",meta:{title:"Login"},component:function(){return n.e("login~face4f69").then(n.bind(null,"a55b"))}},{path:"/profile",name:"Profile",meta:{title:"Profile"},component:function(){return n.e("profile~6191c4d9").then(n.bind(null,"c66d"))}},{path:"/notification",name:"Notification",meta:{title:"Notification"},component:function(){return n.e("notification~f96028be").then(n.bind(null,"109a"))}},{path:"/history",name:"History",meta:{title:"History"},component:function(){return n.e("history~24a8645b").then(n.bind(null,"e4bb"))}},{path:"/location",name:"Location",meta:{title:"Location"},component:function(){return n.e("location~4d9898df").then(n.bind(null,"8e3a"))}}],P=new A["a"]({mode:"history",routes:j});P.beforeEach((function(t,e,n){var o=localStorage.getItem("token"),a=localStorage.getItem("type"),r=["/login"],i=!r.includes(t.path),c=null!=o&&null!=a;return document.title=t.meta.title?t.meta.title:"Home",i&&!c?n("/login"):!i&&c?n("/"):n()}));var B=P,O=n("2f62"),C=localStorage.getItem("token"),N=localStorage.getItem("user_type"),E=C?{isLogged:!0,token:C,loading:!1,err_msg:null,user_type:N}:{isLogged:!1,token:null,loading:!1,err_msg:null,user_type:null},M={namespaced:!0,state:E,actions:{},getters:{getError:function(t){return t.err_msg},logStatus:function(t){return t.isLogged},getToken:function(t){return t.token},getUserType:function(t){return t.user_type}},mutations:{saveUser:function(t,e){var n=e.token,o=e.user_type;localStorage.setItem("token",n),localStorage.setItem("user_type",o),t.token=n,t.user_type=o},setLogged:function(t){t.isLogged=!0},setLogout:function(t){localStorage.clear(),t.isLogged=!1,t.token=null,t.user_type=null},setLoading:function(t,e){var n=e.status;t.loading=n},setErrMsg:function(t,e){var n=e.err;t.err_msg=n}}},$={},H={namespaced:!0,state:$,actions:{},getters:{},mutations:{}},D={},F={namespaced:!0,state:D,actions:{},getters:{},mutations:{}},G={},J={namespaced:!0,state:G,actions:{},getters:{},mutations:{}};o["a"].use(O["a"]);var U=new O["a"].Store({modules:{auth:M,asset:H,dashboard:F,location:J}}),q=n("f309"),z=n("f6c4"),R=n("a523"),K=n("a722"),Q=n("0e8f"),W=n("b0af"),X=n("71d9"),Y=n("99d9"),Z=n("4bd4"),tt=n("8654"),et=n("b974"),nt=n("5607");o["a"].use(q["a"],{components:{VApp:i["a"],VBtn:c["a"],VAppBar:s["a"],VAppBarNavIcon:l["a"],VToolbarTitle:u["a"],VSpacer:d["a"],VIcon:p["a"],VNavigationDrawer:m["a"],VSystemBar:f["a"],VList:v["a"],VListItem:g["a"],VListItemAvatar:b["a"],VImg:h["a"],VListItemGroup:V["a"],VListItemIcon:y["a"],VListItemContent:I["a"],VListItemTitle:I["c"],VMain:z["a"],VContainer:R["a"],VLayout:K["a"],VFlex:Q["a"],VCard:W["a"],VToolbar:X["a"],VCardText:Y["b"],VForm:Z["a"],VTextField:tt["a"],VSelect:et["a"],VCardActions:Y["a"],VListItemSubtitle:I["b"]},directives:{Ripple:nt["a"]}});var ot=new q["a"]({});o["a"].config.productionTip=!1,new o["a"]({router:B,store:U,vuetify:ot,render:function(t){return t(T)}}).$mount("#app")}});
//# sourceMappingURL=app~d0ae3f07.c1136c79.js.map