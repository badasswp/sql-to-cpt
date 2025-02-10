(()=>{"use strict";var t={100:(t,e,n)=>{n.d(e,{A:()=>i});var r=n(354),o=n.n(r),a=n(314),s=n.n(a)()(o());s.push([t.id,"#sql-to-cpt button{color:#fff;padding:11.5px 15px;border-radius:2px;border:none;font-size:13px;font-weight:400 !important;cursor:pointer}#sql-to-cpt button.is-primary{background:#7f54b3}#sql-to-cpt button.is-tertiary{background:#ba7b00}#sql-to-cpt button:hover{background:#1e6ba1}#sql-to-cpt nav{padding:10px 15px;border-left:5px solid orange;background:#fff;margin-top:15px}#sql-to-cpt select{padding:0 28px 0 14px;min-height:40px;top:-1px;position:relative;border-radius:2px}#sql-to-cpt section{display:flex;justify-content:space-between}#sql-to-cpt .sqlt-cpt-progress-bar{margin-top:10px}#sql-to-cpt .sqlt-cpt-progress-bar>div{width:100%;margin-top:20;background-color:#ddd;border-radius:5px;overflow:hidden;height:10px}#sql-to-cpt .sqlt-cpt-progress-bar>div>div{height:100%;background-color:#007cba;transition:width .3s ease}#sql-to-cpt .sqlt-purge{display:flex;gap:10px}","",{version:3,sources:["webpack://./src/styles/app.scss"],names:[],mappings:"AACC,mBACC,UAAA,CACA,mBAAA,CACA,iBAAA,CACA,WAAA,CACA,cAAA,CACA,0BAAA,CACA,cAAA,CAEA,8BACC,kBAAA,CAGD,+BACC,kBAAA,CAGD,yBACC,kBAAA,CAIF,gBACC,iBAAA,CACA,4BAAA,CACA,eAAA,CACA,eAAA,CAGD,mBACC,qBAAA,CACA,eAAA,CACA,QAAA,CACA,iBAAA,CACA,iBAAA,CAGD,oBACC,YAAA,CACA,6BAAA,CAKC,mCACC,eAAA,CAEA,uCACC,UAAA,CACA,aAAA,CACA,qBAAA,CACA,iBAAA,CACA,eAAA,CACA,WAAA,CAEA,2CACC,WAAA,CACA,wBAAA,CACA,yBAAA,CAMJ,wBACC,YAAA,CACA,QAAA",sourcesContent:["#sql-to-cpt {\n\tbutton {\n\t\tcolor: #FFF;\n\t\tpadding: 11.5px 15px;\n\t\tborder-radius: 2px;\n\t\tborder: none;\n\t\tfont-size: 13px;\n\t\tfont-weight: 400 !important;\n\t\tcursor: pointer;\n\n\t\t&.is-primary {\n\t\t\tbackground: #7F54B3;\n\t\t}\n\n\t\t&.is-tertiary {\n\t\t\tbackground: #BA7B00;\n\t\t}\n\n\t\t&:hover {\n\t\t\tbackground: #1e6ba1;\n\t\t}\n\t}\n\n\tnav {\n\t\tpadding: 10px 15px;\n\t\tborder-left: 5px solid orange;\n\t\tbackground: #FFF;\n\t\tmargin-top: 15px;\n\t}\n\n\tselect {\n\t\tpadding: 0 28px 0 14px;\n\t\tmin-height: 40px;\n\t\ttop: -1px;\n\t\tposition: relative;\n\t\tborder-radius: 2px;\n\t}\n\n\tsection {\n\t\tdisplay: flex;\n\t\tjustify-content: space-between;\n\t}\n\n\t.sqlt {\n\t\t&-cpt {\n\t\t\t&-progress-bar {\n\t\t\t\tmargin-top: 10px;\n\n\t\t\t\t& > div {\n\t\t\t\t\twidth: 100%;\n\t\t\t\t\tmargin-top: 20;\n\t\t\t\t\tbackground-color: #DDD;\n\t\t\t\t\tborder-radius: 5px;\n\t\t\t\t\toverflow: hidden;\n\t\t\t\t\theight: 10px;\n\n\t\t\t\t\t& > div {\n\t\t\t\t\t\theight: 100%;\n\t\t\t\t\t\tbackground-color: #007cba;\n\t\t\t\t\t\ttransition: width 0.3s ease;\n\t\t\t\t\t}\n\t\t\t\t}\n\t\t\t}\n\t\t}\n\n\t\t&-purge {\n\t\t\tdisplay: flex;\n\t\t\tgap: 10px;\n\t\t}\n\t}\n}\n"],sourceRoot:""}]);const i=s},314:t=>{t.exports=function(t){var e=[];return e.toString=function(){return this.map((function(e){var n="",r=void 0!==e[5];return e[4]&&(n+="@supports (".concat(e[4],") {")),e[2]&&(n+="@media ".concat(e[2]," {")),r&&(n+="@layer".concat(e[5].length>0?" ".concat(e[5]):""," {")),n+=t(e),r&&(n+="}"),e[2]&&(n+="}"),e[4]&&(n+="}"),n})).join("")},e.i=function(t,n,r,o,a){"string"==typeof t&&(t=[[null,t,void 0]]);var s={};if(r)for(var i=0;i<this.length;i++){var c=this[i][0];null!=c&&(s[c]=!0)}for(var l=0;l<t.length;l++){var p=[].concat(t[l]);r&&s[p[0]]||(void 0!==a&&(void 0===p[5]||(p[1]="@layer".concat(p[5].length>0?" ".concat(p[5]):""," {").concat(p[1],"}")),p[5]=a),n&&(p[2]?(p[1]="@media ".concat(p[2]," {").concat(p[1],"}"),p[2]=n):p[2]=n),o&&(p[4]?(p[1]="@supports (".concat(p[4],") {").concat(p[1],"}"),p[4]=o):p[4]="".concat(o)),e.push(p))}},e}},354:t=>{t.exports=function(t){var e=t[1],n=t[3];if(!n)return e;if("function"==typeof btoa){var r=btoa(unescape(encodeURIComponent(JSON.stringify(n)))),o="sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(r),a="/*# ".concat(o," */");return[e].concat([a]).join("\n")}return[e].join("\n")}},338:(t,e,n)=>{var r=n(795);e.H=r.createRoot,r.hydrateRoot},20:(t,e,n)=>{var r=n(609),o=Symbol.for("react.element"),a=Symbol.for("react.fragment"),s=Object.prototype.hasOwnProperty,i=r.__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED.ReactCurrentOwner,c={key:!0,ref:!0,__self:!0,__source:!0};function l(t,e,n){var r,a={},l=null,p=null;for(r in void 0!==n&&(l=""+n),void 0!==e.key&&(l=""+e.key),void 0!==e.ref&&(p=e.ref),e)s.call(e,r)&&!c.hasOwnProperty(r)&&(a[r]=e[r]);if(t&&t.defaultProps)for(r in e=t.defaultProps)void 0===a[r]&&(a[r]=e[r]);return{$$typeof:o,type:t,key:l,ref:p,props:a,_owner:i.current}}e.Fragment=a,e.jsx=l,e.jsxs=l},848:(t,e,n)=>{t.exports=n(20)},533:(t,e,n)=>{var r=n(72),o=n.n(r),a=n(825),s=n.n(a),i=n(659),c=n.n(i),l=n(56),p=n.n(l),d=n(540),A=n.n(d),u=n(113),f=n.n(u),v=n(100),h={};h.styleTagTransform=f(),h.setAttributes=p(),h.insert=c().bind(null,"head"),h.domAPI=s(),h.insertStyleElement=A(),o()(v.A,h),v.A&&v.A.locals&&v.A.locals},72:t=>{var e=[];function n(t){for(var n=-1,r=0;r<e.length;r++)if(e[r].identifier===t){n=r;break}return n}function r(t,r){for(var a={},s=[],i=0;i<t.length;i++){var c=t[i],l=r.base?c[0]+r.base:c[0],p=a[l]||0,d="".concat(l," ").concat(p);a[l]=p+1;var A=n(d),u={css:c[1],media:c[2],sourceMap:c[3],supports:c[4],layer:c[5]};if(-1!==A)e[A].references++,e[A].updater(u);else{var f=o(u,r);r.byIndex=i,e.splice(i,0,{identifier:d,updater:f,references:1})}s.push(d)}return s}function o(t,e){var n=e.domAPI(e);return n.update(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap&&e.supports===t.supports&&e.layer===t.layer)return;n.update(t=e)}else n.remove()}}t.exports=function(t,o){var a=r(t=t||[],o=o||{});return function(t){t=t||[];for(var s=0;s<a.length;s++){var i=n(a[s]);e[i].references--}for(var c=r(t,o),l=0;l<a.length;l++){var p=n(a[l]);0===e[p].references&&(e[p].updater(),e.splice(p,1))}a=c}}},659:t=>{var e={};t.exports=function(t,n){var r=function(t){if(void 0===e[t]){var n=document.querySelector(t);if(window.HTMLIFrameElement&&n instanceof window.HTMLIFrameElement)try{n=n.contentDocument.head}catch(t){n=null}e[t]=n}return e[t]}(t);if(!r)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");r.appendChild(n)}},540:t=>{t.exports=function(t){var e=document.createElement("style");return t.setAttributes(e,t.attributes),t.insert(e,t.options),e}},56:(t,e,n)=>{t.exports=function(t){var e=n.nc;e&&t.setAttribute("nonce",e)}},825:t=>{t.exports=function(t){if("undefined"==typeof document)return{update:function(){},remove:function(){}};var e=t.insertStyleElement(t);return{update:function(n){!function(t,e,n){var r="";n.supports&&(r+="@supports (".concat(n.supports,") {")),n.media&&(r+="@media ".concat(n.media," {"));var o=void 0!==n.layer;o&&(r+="@layer".concat(n.layer.length>0?" ".concat(n.layer):""," {")),r+=n.css,o&&(r+="}"),n.media&&(r+="}"),n.supports&&(r+="}");var a=n.sourceMap;a&&"undefined"!=typeof btoa&&(r+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(a))))," */")),e.styleTagTransform(r,t,e.options)}(e,t,n)},remove:function(){!function(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t)}(e)}}}},113:t=>{t.exports=function(t,e){if(e.styleSheet)e.styleSheet.cssText=t;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(t))}}},2:(t,e,n)=>{n.d(e,{A:()=>d});var r=n(848),o=n(87),a=n(419),s=n(156),i=n(339),c=n(510),l=n(277),p=n(79);n(533);const d=()=>{const[t,e]=(0,o.useState)(!1),[n,d]=(0,o.useState)(""),[A,u]=(0,o.useState)({tableName:"",tableColumns:[],tableRows:[]});return(0,r.jsxs)("main",{children:[(0,r.jsxs)("section",{children:[(0,r.jsx)(p.A,{parsedSQL:A,setIsLoading:e,setSqlNotice:d,setParsedSQL:u}),(0,r.jsx)(a.A,{setIsLoading:e,setSqlNotice:d})]}),(0,r.jsx)(s.A,{message:n}),(0,r.jsx)(c.A,{isLoading:t}),(0,r.jsx)(i.A,{parsedSQL:A}),(0,r.jsx)(l.A,{parsedSQL:A})]})}},208:(t,e,n)=>{n.d(e,{A:()=>o});var r=n(848);const o=({name:t})=>(0,r.jsx)("p",{children:(0,r.jsx)("input",{type:"text",value:t,disabled:!0})})},79:(t,e,n)=>{n.d(e,{A:()=>p});var r=n(848),o=n(723),a=n(427),s=n(455),i=n.n(s),c=n(900),l=function(t,e,n,r){return new(n||(n=Promise))((function(o,a){function s(t){try{c(r.next(t))}catch(t){a(t)}}function i(t){try{c(r.throw(t))}catch(t){a(t)}}function c(t){var e;t.done?o(t.value):(e=t.value,e instanceof n?e:new n((function(t){t(e)}))).then(s,i)}c((r=r.apply(t,e||[])).next())}))};const p=t=>{const{parsedSQL:e,setIsLoading:n,setSqlNotice:s,setParsedSQL:p}=t;return(0,r.jsx)(r.Fragment,{children:e.tableRows.length<1?(0,r.jsx)(a.Button,{variant:"primary",onClick:()=>{const t=wp.media((0,c.i)());t.on("select",(()=>(t=>l(void 0,void 0,void 0,(function*(){const e=t.state().get("selection").first().toJSON();s(""),p({tableName:"",tableColumns:[],tableRows:[]}),n(!0);try{p(yield i()({path:"/sql-to-cpt/v1/parse",method:"POST",data:Object.assign({},e)})),n(!1)}catch({message:t}){n(!1),s(t)}})))(t))).open()},children:(0,o.__)("Upload SQL File","sql-to-cpt")}):(0,r.jsx)(a.Button,{variant:"primary",onClick:()=>l(void 0,void 0,void 0,(function*(){n(!0);try{const t=yield i()({path:"/sql-to-cpt/v1/import",method:"POST",data:Object.assign({},e)});t&&(window.location.href=`${t}`),n(!1)}catch({message:t}){n(!1),s(t)}})),children:(0,o.__)("Convert to CPT","sql-to-cpt")})})}},156:(t,e,n)=>{n.d(e,{A:()=>o});var r=n(848);const o=({message:t})=>t&&(0,r.jsx)("nav",{children:t})},510:(t,e,n)=>{n.d(e,{A:()=>a});var r=n(848),o=n(87);const a=({isLoading:t})=>{const[e,n]=(0,o.useState)(0);return(0,o.useEffect)((()=>{let e;return t?(n(0),e=setInterval((()=>{n((t=>t<90?t+10:t))}),500)):(n(0),clearInterval(e)),()=>clearInterval(e)}),[t]),(0,r.jsx)(r.Fragment,{children:t&&(0,r.jsxs)("div",{className:"sqlt-cpt-progress-bar",role:"progressbar",children:[(0,r.jsx)("div",{children:(0,r.jsx)("div",{style:{width:`${e}%`}})}),(0,r.jsxs)("p",{children:[e,"%"]})]})})}},419:(t,e,n)=>{n.d(e,{A:()=>l});var r=n(848),o=n(723),a=n(87),s=n(427),i=n(455),c=n.n(i);const l=({setIsLoading:t,setSqlNotice:e})=>{const[n,i]=(0,a.useState)("");return(0,r.jsxs)("div",{className:"sqlt-purge",children:[(0,r.jsxs)("select",{onChange:t=>{i(t.target.value)},children:[(0,r.jsx)("option",{children:"Select CPT"}),sqlt.postTypes.map((t=>(0,r.jsx)("option",{children:t})))]}),(0,r.jsx)(s.Button,{variant:"tertiary",onClick:()=>{return r=void 0,o=void 0,s=function*(){t(!0);try{yield c()({path:"/sql-to-cpt/v1/purge",method:"POST",data:{postType:n}}),t(!1),window.location.reload()}catch({message:n}){t(!1),e(n)}},new((a=void 0)||(a=Promise))((function(t,e){function n(t){try{c(s.next(t))}catch(t){e(t)}}function i(t){try{c(s.throw(t))}catch(t){e(t)}}function c(e){var r;e.done?t(e.value):(r=e.value,r instanceof a?r:new a((function(t){t(r)}))).then(n,i)}c((s=s.apply(r,o||[])).next())}));var r,o,a,s},children:(0,o.__)("Purge CPT","sql-to-cpt")})]})}},277:(t,e,n)=>{n.d(e,{A:()=>s});var r=n(848),o=n(723),a=n(208);const s=({parsedSQL:t})=>(0,r.jsx)(r.Fragment,{children:t.tableColumns.length>0&&(0,r.jsxs)("div",{className:"sqlt-cpt-table-columns",role:"list",children:[(0,r.jsx)("h3",{children:(0,o.__)("Columns","sql-to-cpt")}),t.tableColumns.map(((t,e)=>(0,r.jsx)(a.A,{name:t},e)))]})})},339:(t,e,n)=>{n.d(e,{A:()=>s});var r=n(848),o=n(723),a=n(208);const s=({parsedSQL:t})=>(0,r.jsx)(r.Fragment,{children:t.tableName&&(0,r.jsxs)("div",{className:"sqlt-cpt-table-name",role:"list",children:[(0,r.jsx)("h3",{children:(0,o.__)("Table","sql-to-cpt")}),(0,r.jsx)(a.A,{name:t.tableName})]})})},900:(t,e,n)=>{n.d(e,{Z:()=>o,i:()=>a});var r=n(723);const o=t=>{let e=0;return new Promise(((n,r)=>{const o=setInterval((()=>{e+=25;const a=document.getElementById(t);a&&(clearInterval(o),n(a)),e>250&&(clearInterval(o),r(new Error("Unable to get root container...")))}),25)}))},a=()=>({title:(0,r.__)("Select SQL File","sql-to-cpt"),button:{text:(0,r.__)("Use SQL","sql-to-cpt")},multiple:!1})},609:t=>{t.exports=window.React},795:t=>{t.exports=window.ReactDOM},455:t=>{t.exports=window.wp.apiFetch},427:t=>{t.exports=window.wp.components},87:t=>{t.exports=window.wp.element},723:t=>{t.exports=window.wp.i18n}},e={};function n(r){var o=e[r];if(void 0!==o)return o.exports;var a=e[r]={id:r,exports:{}};return t[r](a,a.exports,n),a.exports}n.n=t=>{var e=t&&t.__esModule?()=>t.default:()=>t;return n.d(e,{a:e}),e},n.d=(t,e)=>{for(var r in e)n.o(e,r)&&!n.o(t,r)&&Object.defineProperty(t,r,{enumerable:!0,get:e[r]})},n.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e),n.nc=void 0;var r,o,a=n(848),s=n(900),i=n(338),c=n(2);o=function*(){try{const t=yield(0,s.Z)("sql-to-cpt");(0,i.H)(t).render((0,a.jsx)(c.A,{}))}catch(t){throw new Error(t)}},new((r=void 0)||(r=Promise))((function(t,e){function n(t){try{s(o.next(t))}catch(t){e(t)}}function a(t){try{s(o.throw(t))}catch(t){e(t)}}function s(e){var o;e.done?t(e.value):(o=e.value,o instanceof r?o:new r((function(t){t(o)}))).then(n,a)}s((o=o.apply(void 0,[])).next())}))})();
//# sourceMappingURL=app.js.map