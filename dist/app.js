(()=>{"use strict";var t={100:(t,e,n)=>{n.d(e,{A:()=>i});var r=n(354),o=n.n(r),a=n(314),s=n.n(a)()(o());s.push([t.id,"#sql-to-cpt button{color:#fff;background:#7f54b3;padding:11.5px 15px;border-radius:2px;border:none;font-size:13px;font-weight:400 !important;cursor:pointer}#sql-to-cpt button:hover{background:#1e6ba1}#sql-to-cpt nav{padding:10px 15px;border-left:5px solid orange;background:#fff;margin-top:15px}#sql-to-cpt .sqlt-cpt-progress-bar{margin-top:10px}#sql-to-cpt .sqlt-cpt-progress-bar>div{width:100%;margin-top:20;background-color:#ddd;border-radius:5px;overflow:hidden;height:10px}#sql-to-cpt .sqlt-cpt-progress-bar>div>div{height:100%;background-color:#007cba;transition:width .3s ease}","",{version:3,sources:["webpack://./src/styles/app.scss"],names:[],mappings:"AACC,mBACC,UAAA,CACA,kBAAA,CACA,mBAAA,CACA,iBAAA,CACA,WAAA,CACA,cAAA,CACA,0BAAA,CACA,cAAA,CAEA,yBACC,kBAAA,CAIF,gBACC,iBAAA,CACA,4BAAA,CACA,eAAA,CACA,eAAA,CAIA,mCACC,eAAA,CAEA,uCACC,UAAA,CACA,aAAA,CACA,qBAAA,CACA,iBAAA,CACA,eAAA,CACA,WAAA,CAEA,2CACC,WAAA,CACA,wBAAA,CACA,yBAAA",sourcesContent:["#sql-to-cpt {\n\tbutton {\n\t\tcolor: #FFF;\n\t\tbackground: #7F54B3;\n\t\tpadding: 11.5px 15px;\n\t\tborder-radius: 2px;\n\t\tborder: none;\n\t\tfont-size: 13px;\n\t\tfont-weight: 400 !important;\n\t\tcursor: pointer;\n\n\t\t&:hover {\n\t\t\tbackground: #1e6ba1;\n\t\t}\n\t}\n\n\tnav {\n\t\tpadding: 10px 15px;\n\t\tborder-left: 5px solid orange;\n\t\tbackground: #FFF;\n\t\tmargin-top: 15px;\n\t}\n\n\t.sqlt-cpt {\n\t\t&-progress-bar {\n\t\t\tmargin-top: 10px;\n\n\t\t\t& > div {\n\t\t\t\twidth: 100%;\n\t\t\t\tmargin-top: 20;\n\t\t\t\tbackground-color: #DDD;\n\t\t\t\tborder-radius: 5px;\n\t\t\t\toverflow: hidden;\n\t\t\t\theight: 10px;\n\n\t\t\t\t& > div {\n\t\t\t\t\theight: 100%;\n\t\t\t\t\tbackground-color: #007cba;\n\t\t\t\t\ttransition: width 0.3s ease;\n\t\t\t\t}\n\t\t\t}\n\t\t}\n\t}\n}\n"],sourceRoot:""}]);const i=s},314:t=>{t.exports=function(t){var e=[];return e.toString=function(){return this.map((function(e){var n="",r=void 0!==e[5];return e[4]&&(n+="@supports (".concat(e[4],") {")),e[2]&&(n+="@media ".concat(e[2]," {")),r&&(n+="@layer".concat(e[5].length>0?" ".concat(e[5]):""," {")),n+=t(e),r&&(n+="}"),e[2]&&(n+="}"),e[4]&&(n+="}"),n})).join("")},e.i=function(t,n,r,o,a){"string"==typeof t&&(t=[[null,t,void 0]]);var s={};if(r)for(var i=0;i<this.length;i++){var c=this[i][0];null!=c&&(s[c]=!0)}for(var l=0;l<t.length;l++){var p=[].concat(t[l]);r&&s[p[0]]||(void 0!==a&&(void 0===p[5]||(p[1]="@layer".concat(p[5].length>0?" ".concat(p[5]):""," {").concat(p[1],"}")),p[5]=a),n&&(p[2]?(p[1]="@media ".concat(p[2]," {").concat(p[1],"}"),p[2]=n):p[2]=n),o&&(p[4]?(p[1]="@supports (".concat(p[4],") {").concat(p[1],"}"),p[4]=o):p[4]="".concat(o)),e.push(p))}},e}},354:t=>{t.exports=function(t){var e=t[1],n=t[3];if(!n)return e;if("function"==typeof btoa){var r=btoa(unescape(encodeURIComponent(JSON.stringify(n)))),o="sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(r),a="/*# ".concat(o," */");return[e].concat([a]).join("\n")}return[e].join("\n")}},338:(t,e,n)=>{var r=n(795);e.H=r.createRoot,r.hydrateRoot},20:(t,e,n)=>{var r=n(609),o=Symbol.for("react.element"),a=Symbol.for("react.fragment"),s=Object.prototype.hasOwnProperty,i=r.__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED.ReactCurrentOwner,c={key:!0,ref:!0,__self:!0,__source:!0};function l(t,e,n){var r,a={},l=null,p=null;for(r in void 0!==n&&(l=""+n),void 0!==e.key&&(l=""+e.key),void 0!==e.ref&&(p=e.ref),e)s.call(e,r)&&!c.hasOwnProperty(r)&&(a[r]=e[r]);if(t&&t.defaultProps)for(r in e=t.defaultProps)void 0===a[r]&&(a[r]=e[r]);return{$$typeof:o,type:t,key:l,ref:p,props:a,_owner:i.current}}e.Fragment=a,e.jsx=l,e.jsxs=l},848:(t,e,n)=>{t.exports=n(20)},533:(t,e,n)=>{var r=n(72),o=n.n(r),a=n(825),s=n.n(a),i=n(659),c=n.n(i),l=n(56),p=n.n(l),d=n(540),u=n.n(d),A=n(113),f=n.n(A),v=n(100),h={};h.styleTagTransform=f(),h.setAttributes=p(),h.insert=c().bind(null,"head"),h.domAPI=s(),h.insertStyleElement=u(),o()(v.A,h),v.A&&v.A.locals&&v.A.locals},72:t=>{var e=[];function n(t){for(var n=-1,r=0;r<e.length;r++)if(e[r].identifier===t){n=r;break}return n}function r(t,r){for(var a={},s=[],i=0;i<t.length;i++){var c=t[i],l=r.base?c[0]+r.base:c[0],p=a[l]||0,d="".concat(l," ").concat(p);a[l]=p+1;var u=n(d),A={css:c[1],media:c[2],sourceMap:c[3],supports:c[4],layer:c[5]};if(-1!==u)e[u].references++,e[u].updater(A);else{var f=o(A,r);r.byIndex=i,e.splice(i,0,{identifier:d,updater:f,references:1})}s.push(d)}return s}function o(t,e){var n=e.domAPI(e);return n.update(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap&&e.supports===t.supports&&e.layer===t.layer)return;n.update(t=e)}else n.remove()}}t.exports=function(t,o){var a=r(t=t||[],o=o||{});return function(t){t=t||[];for(var s=0;s<a.length;s++){var i=n(a[s]);e[i].references--}for(var c=r(t,o),l=0;l<a.length;l++){var p=n(a[l]);0===e[p].references&&(e[p].updater(),e.splice(p,1))}a=c}}},659:t=>{var e={};t.exports=function(t,n){var r=function(t){if(void 0===e[t]){var n=document.querySelector(t);if(window.HTMLIFrameElement&&n instanceof window.HTMLIFrameElement)try{n=n.contentDocument.head}catch(t){n=null}e[t]=n}return e[t]}(t);if(!r)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");r.appendChild(n)}},540:t=>{t.exports=function(t){var e=document.createElement("style");return t.setAttributes(e,t.attributes),t.insert(e,t.options),e}},56:(t,e,n)=>{t.exports=function(t){var e=n.nc;e&&t.setAttribute("nonce",e)}},825:t=>{t.exports=function(t){if("undefined"==typeof document)return{update:function(){},remove:function(){}};var e=t.insertStyleElement(t);return{update:function(n){!function(t,e,n){var r="";n.supports&&(r+="@supports (".concat(n.supports,") {")),n.media&&(r+="@media ".concat(n.media," {"));var o=void 0!==n.layer;o&&(r+="@layer".concat(n.layer.length>0?" ".concat(n.layer):""," {")),r+=n.css,o&&(r+="}"),n.media&&(r+="}"),n.supports&&(r+="}");var a=n.sourceMap;a&&"undefined"!=typeof btoa&&(r+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(a))))," */")),e.styleTagTransform(r,t,e.options)}(e,t,n)},remove:function(){!function(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t)}(e)}}}},113:t=>{t.exports=function(t,e){if(e.styleSheet)e.styleSheet.cssText=t;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(t))}}},2:(t,e,n)=>{n.d(e,{A:()=>f});var r=n(848),o=n(455),a=n.n(o),s=n(87),i=n(156),c=n(510),l=n(79),p=n(339),d=n(277),u=n(900),A=(n(533),function(t,e,n,r){return new(n||(n=Promise))((function(o,a){function s(t){try{c(r.next(t))}catch(t){a(t)}}function i(t){try{c(r.throw(t))}catch(t){a(t)}}function c(t){var e;t.done?o(t.value):(e=t.value,e instanceof n?e:new n((function(t){t(e)}))).then(s,i)}c((r=r.apply(t,e||[])).next())}))});const f=()=>{const[t,e]=(0,s.useState)(0),[n,o]=(0,s.useState)(!1),[f,v]=(0,s.useState)(""),[h,m]=(0,s.useState)({tableName:"",tableColumns:[],tableRows:[]});return(0,r.jsxs)("main",{children:[(0,r.jsx)(l.A,{parsedSQL:h,handleImport:()=>A(void 0,void 0,void 0,(function*(){e(0),o(!0);try{const t=setInterval((()=>{e((t=>t<90?t+10:t))}),500),n=yield a()({path:"/sql-to-cpt/v1/import",method:"POST",data:Object.assign({},h)});clearInterval(t),e(100),n&&(window.location.href=`${n}`)}catch({message:t}){v(t)}})),handleUpload:()=>{const t=wp.media((0,u.i)());t.on("select",(()=>(t=>A(void 0,void 0,void 0,(function*(){const e=t.state().get("selection").first().toJSON();v(""),m({tableName:"",tableColumns:[],tableRows:[]});try{m(yield a()({path:"/sql-to-cpt/v1/parse",method:"POST",data:Object.assign({},e)}))}catch({message:t}){v(t)}})))(t))).open()}}),(0,r.jsx)(i.A,{message:f}),(0,r.jsx)(c.A,{progress:t,isLoading:n}),(0,r.jsx)(p.A,{parsedSQL:h}),(0,r.jsx)(d.A,{parsedSQL:h})]})}},208:(t,e,n)=>{n.d(e,{A:()=>o});var r=n(848);const o=({name:t})=>(0,r.jsx)("p",{children:(0,r.jsx)("input",{type:"text",value:t,disabled:!0})})},79:(t,e,n)=>{n.d(e,{A:()=>s});var r=n(848),o=n(723),a=n(427);const s=({parsedSQL:t,handleUpload:e,handleImport:n})=>(0,r.jsx)(r.Fragment,{children:t.tableRows.length<1?(0,r.jsx)(a.Button,{variant:"primary",onClick:e,children:(0,o.__)("Upload SQL File","sql-to-cpt")}):(0,r.jsx)(a.Button,{variant:"primary",onClick:n,children:(0,o.__)("Convert to CPT","sql-to-cpt")})})},156:(t,e,n)=>{n.d(e,{A:()=>o});var r=n(848);const o=({message:t})=>t&&(0,r.jsx)("nav",{children:t})},510:(t,e,n)=>{n.d(e,{A:()=>o});var r=n(848);const o=({isLoading:t,progress:e})=>(0,r.jsx)(r.Fragment,{children:t&&(0,r.jsxs)("div",{className:"sqlt-cpt-progress-bar",role:"progressbar",children:[(0,r.jsx)("div",{children:(0,r.jsx)("div",{style:{width:`${e}%`}})}),(0,r.jsxs)("p",{children:[e,"%"]})]})})},277:(t,e,n)=>{n.d(e,{A:()=>s});var r=n(848),o=n(723),a=n(208);const s=({parsedSQL:t})=>(0,r.jsx)(r.Fragment,{children:t.tableColumns.length>0&&(0,r.jsxs)("div",{className:"sqlt-cpt-table-columns",role:"list",children:[(0,r.jsx)("h3",{children:(0,o.__)("Columns","sql-to-cpt")}),t.tableColumns.map(((t,e)=>(0,r.jsx)(a.A,{name:t},e)))]})})},339:(t,e,n)=>{n.d(e,{A:()=>s});var r=n(848),o=n(723),a=n(208);const s=({parsedSQL:t})=>(0,r.jsx)(r.Fragment,{children:t.tableName&&(0,r.jsxs)("div",{className:"sqlt-cpt-table-name",role:"list",children:[(0,r.jsx)("h3",{children:(0,o.__)("Table","sql-to-cpt")}),(0,r.jsx)(a.A,{name:t.tableName})]})})},900:(t,e,n)=>{n.d(e,{Z:()=>o,i:()=>a});var r=n(723);const o=t=>{let e=0;return new Promise(((n,r)=>{const o=setInterval((()=>{e+=25;const a=document.getElementById(t);a&&(clearInterval(o),n(a)),e>250&&(clearInterval(o),r(new Error("Unable to get root container...")))}),25)}))},a=()=>({title:(0,r.__)("Select SQL File","sql-to-cpt"),button:{text:(0,r.__)("Use SQL","sql-to-cpt")},multiple:!1})},609:t=>{t.exports=window.React},795:t=>{t.exports=window.ReactDOM},455:t=>{t.exports=window.wp.apiFetch},427:t=>{t.exports=window.wp.components},87:t=>{t.exports=window.wp.element},723:t=>{t.exports=window.wp.i18n}},e={};function n(r){var o=e[r];if(void 0!==o)return o.exports;var a=e[r]={id:r,exports:{}};return t[r](a,a.exports,n),a.exports}n.n=t=>{var e=t&&t.__esModule?()=>t.default:()=>t;return n.d(e,{a:e}),e},n.d=(t,e)=>{for(var r in e)n.o(e,r)&&!n.o(t,r)&&Object.defineProperty(t,r,{enumerable:!0,get:e[r]})},n.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e),n.nc=void 0;var r,o,a=n(848),s=n(900),i=n(338),c=n(2);o=function*(){try{const t=yield(0,s.Z)("sql-to-cpt");(0,i.H)(t).render((0,a.jsx)(c.A,{}))}catch(t){throw new Error(t)}},new((r=void 0)||(r=Promise))((function(t,e){function n(t){try{s(o.next(t))}catch(t){e(t)}}function a(t){try{s(o.throw(t))}catch(t){e(t)}}function s(e){var o;e.done?t(e.value):(o=e.value,o instanceof r?o:new r((function(t){t(o)}))).then(n,a)}s((o=o.apply(void 0,[])).next())}))})();
//# sourceMappingURL=app.js.map