import{_ as d}from"./AppLayout-Dcv0nTZt.js";import{T as l,o as m,c,w as t,b as i,u as o,j as p,a as e}from"./app-bIbIT4Ru.js";import{_ as h}from"./Form-D6eJFbAr.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./FormSection-VXiMShzk.js";import"./InputError-BzSO3uI0.js";import"./InputLabel-B6Z70Kjb.js";import"./PrimaryButton-Bf9J-dDQ.js";import"./TextInput-DBSGjYLR.js";const u=e("h1",{class:"font-semibold text-xl text-gray-800 leading-tigh"}," Nuevo Empleado ",-1),f=e("svg",{class:"h-10 w-10 text-cyan-700",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[e("path",{stroke:"none",d:"M0 0h24v24H0z"}),e("path",{d:"M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"})],-1),_={class:"w-[60%] mx-auto rounded-lg border border-gray-200 p-5 m-5"},g={class:""},b={class:"relative bg-white rounded-lg shadow dark:bg-gray-700"},y=e("div",{class:"flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"},[e("h3",{class:"text-lg font-semibold text-gray-900 dark:text-white"}," Formulario Empleado ")],-1),x={name:"EmployeesCreate",data(){return{addBranch:!1}},methods:{}},q=Object.assign(x,{props:{employees:{type:Object,required:!0},positions:{type:Object,required:!0}},setup(n){const r=l({fist_name:"",last_name:"",identification:"",position_id:"",phone:"",email:"",contract:"",mount:"",description:"",status:!1});return(s,a)=>(m(),c(d,null,{header:t(()=>[u,i(o(p),{class:"text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white",href:s.route("employees.index")},{default:t(()=>[f]),_:1},8,["href"])]),default:t(()=>[e("div",_,[e("div",g,[e("div",b,[y,i(h,{form:o(r),positions:n.positions,onSubmit:a[0]||(a[0]=v=>o(r).post(s.route("employees.store")))},null,8,["form","positions"])])])])]),_:1}))}});export{q as default};