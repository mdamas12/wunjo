import{T as d,o as l,c as u,w as t,a as e,b as n,g as c,u as r,j as m}from"./app-BQgYAhJH.js";import{_ as h}from"./WunjoLayout-CJsZa75K.js";import{_ as f}from"./Form-gRuZpFsE.js";import"./NavLink-BVLb242L.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./FormSection-zkfVidHw.js";import"./InputError-B_p1FYnf.js";import"./InputLabel-F5bEEBsd.js";import"./PrimaryButton-DCNZSmSW.js";import"./TextInput-C93mbjTo.js";const b={class:"w-[90%] mx-auto rounded-lg border border-gray-200 p-5 m-5"},p={class:"flex justify-between mb-5"},g=e("h1",{class:"flex font-semibold text-xl text-gray-700 leading-tigh"}," Formulario Usuario ",-1),_=e("svg",{class:"h-6 w-6 text-white",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[e("path",{stroke:"none",d:"M0 0h24v24H0z"}),e("path",{d:"M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"}),e("path",{d:"M20 12h-13l3 -3m0 6l-3 -3"})],-1),x={class:""},w={class:"relative bg-white rounded-lg shadow dark:bg-gray-700"},v=e("div",{class:"flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"},null,-1),k={name:"UsersCreate",data(){return{}},methods:{}},T=Object.assign(k,{props:{roles:{type:Object,required:!0},branches:{type:Object,required:!0}},setup(s){const o=d({name:"",email:"",password:"",status:!0,userBranches:[],UserRole:""});return(a,i)=>(l(),u(h,null,{header:t(()=>[]),default:t(()=>[e("div",b,[e("div",p,[g,n(r(m),{href:a.route("users.index"),class:"w-full inline-flex mx-3 items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"},{default:t(()=>[_,c(" Volver ")]),_:1},8,["href"])]),e("div",x,[e("div",w,[v,n(f,{form:r(o),roles:s.roles,branches:s.branches,onSubmit:i[0]||(i[0]=y=>r(o).post(a.route("users.store")))},null,8,["form","roles","branches"])])])])]),_:1}))}});export{T as default};
