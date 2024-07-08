import{T as l,o as u,c,w as s,a as t,b as d,g as m,u as a,j as h}from"./app-BQgYAhJH.js";import{_ as p}from"./WunjoLayout-CJsZa75K.js";import{_ as f}from"./Form-C21OszB6.js";import"./NavLink-BVLb242L.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./FormSection-zkfVidHw.js";import"./InputError-B_p1FYnf.js";import"./InputLabel-F5bEEBsd.js";import"./PrimaryButton-DCNZSmSW.js";const b={class:"w-[90%] mx-auto rounded-lg border border-gray-200 p-5 m-5"},g={class:"flex justify-between mb-5"},_=t("h1",{class:"flex font-semibold text-xl text-gray-700 leading-tigh"}," Editar Consulta ",-1),y=t("svg",{class:"h-6 w-6 text-white",width:"24",height:"24",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"},[t("path",{stroke:"none",d:"M0 0h24v24H0z"}),t("path",{d:"M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"}),t("path",{d:"M20 12h-13l3 -3m0 6l-3 -3"})],-1),x={class:""},w={class:"relative bg-white rounded-lg shadow dark:bg-gray-700"},v=t("div",{class:"flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"},[t("h3",{class:"text-lg font-semibold text-gray-900 dark:text-white"})],-1),k={name:"ConsultationsEdit",data(){return{}},methods:{}},T=Object.assign(k,{props:{consultation:{type:Object,required:!0},patients:{type:Object,required:!0},employees:{type:Object,required:!0},branches:{type:Object,required:!0},updating:{type:Boolean,required:!1,default:!1}},setup(o){const e=o,r=l({date:e.consultation.date,hour:e.consultation.hour,patient_id:e.consultation.patient_id,employee_id:e.consultation.employee_id,branch_id:e.consultation.branch_id,status_payment:e.consultation.status_payment,status:e.consultation.status});return(n,i)=>(u(),c(p,null,{header:s(()=>[]),default:s(()=>[t("div",b,[t("div",g,[_,d(a(h),{href:n.route("consultations.index"),class:"w-full inline-flex mx-3 items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"},{default:s(()=>[y,m(" Volver ")]),_:1},8,["href"])]),t("div",x,[t("div",w,[v,d(f,{updating:!0,branches:o.branches,patients:o.patients,employees:o.employees,form:a(r),onSubmit:i[0]||(i[0]=j=>a(r).put(n.route("consultations.update",o.consultation)))},null,8,["branches","patients","employees","form"])])])])]),_:1}))}});export{T as default};
