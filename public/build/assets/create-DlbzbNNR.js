import{T as d,o as i,c as l,w as t,a as e,b as n,g as c,u as r,j as u}from"./app-BQgYAhJH.js";import{_ as m}from"./WunjoLayout-CJsZa75K.js";import{_ as h}from"./Form-B1dIG1f0.js";import"./NavLink-BVLb242L.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./FormSection-zkfVidHw.js";import"./InputError-B_p1FYnf.js";import"./InputLabel-F5bEEBsd.js";import"./PrimaryButton-DCNZSmSW.js";import"./TextInput-C93mbjTo.js";const f={class:"w-[90%] mx-auto rounded-lg border border-gray-200 p-5 m-5"},p={class:"flex justify-between mb-5"},_=e("h1",{class:"flex font-semibold text-xl text-gray-700 leading-tigh"}," Formulario Sede ",-1),b=e("svg",{class:"h-6 w-6 text-white",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[e("path",{stroke:"none",d:"M0 0h24v24H0z"}),e("path",{d:"M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"}),e("path",{d:"M20 12h-13l3 -3m0 6l-3 -3"})],-1),g={class:""},x={class:"relative bg-white rounded-lg shadow dark:bg-gray-700"},v=e("div",{class:"flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"},null,-1),w={name:"BanchesCreate",data(){return{addBranch:!1}},methods:{}},q=Object.assign(w,{props:{branches:{type:Object,required:!0}},setup(k){const o=d({name:"",address:"",email:"",phone:"",description:"",status:!1});return(s,a)=>(i(),l(m,null,{header:t(()=>[]),default:t(()=>[e("div",f,[e("div",p,[_,n(r(u),{href:s.route("branches.index"),class:"w-full inline-flex mx-3 items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"},{default:t(()=>[b,c(" Volver ")]),_:1},8,["href"])]),e("div",g,[e("div",x,[v,n(h,{form:r(o),onSubmit:a[0]||(a[0]=y=>r(o).post(s.route("branches.store")))},null,8,["form"])])])])]),_:1}))}});export{q as default};
