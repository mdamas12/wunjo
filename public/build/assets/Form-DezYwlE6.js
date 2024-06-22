import{o as c,c as p,w as d,a as e,b as r,g as t,l as n,p as m,q as f,t as y}from"./app-bIbIT4Ru.js";import{_ as b}from"./FormSection-VXiMShzk.js";import{_ as i}from"./InputError-BzSO3uI0.js";import{_ as u}from"./InputLabel-B6Z70Kjb.js";import{_ as k}from"./PrimaryButton-Bf9J-dDQ.js";import{_ as g}from"./TextInput-DBSGjYLR.js";const h={class:"col-span-6"},x={class:"col-span-6"},v={class:"col-span-6"},w={class:"col-span-6"},V={class:"col-span-6"},$=e("option",{selected:""},"Selecciona un estado",-1),_=e("option",{value:"true"},"Activo",-1),q=e("option",{value:"false"},"Inactivo",-1),N=[$,_,q],B={class:"col-span-6"},D=e("svg",{class:"me-1 -ms-1 w-5 h-5",fill:"currentColor",viewBox:"0 0 20 20",xmlns:"http://www.w3.org/2000/svg"},[e("path",{"fill-rule":"evenodd",d:"M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z","clip-rule":"evenodd"})],-1),S={name:"BranchesForm"},A=Object.assign(S,{props:{form:{type:Object,required:!0},updating:{type:Boolean,required:!1,default:!1}},emits:["submit"],setup(o){return(l,a)=>(c(),p(b,{onSubmitted:a[6]||(a[6]=s=>l.$emit("submit")),class:"w-full"},{form:d(()=>[e("div",h,[r(u,{for:"name"},{default:d(()=>[t("Nombre")]),_:1}),r(g,{type:"text",class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500",modelValue:o.form.name,"onUpdate:modelValue":a[0]||(a[0]=s=>o.form.name=s),id:"name",placeholder:"Nombre de la Sucursal",required:""},null,8,["modelValue"]),r(i,{message:l.$page.props.errors.name},null,8,["message"])]),e("div",x,[r(u,{for:"name"},{default:d(()=>[t("Direccion")]),_:1}),r(g,{type:"text",class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500",modelValue:o.form.address,"onUpdate:modelValue":a[1]||(a[1]=s=>o.form.address=s),id:"address",placeholder:"Direccion de la sucursal",required:""},null,8,["modelValue"]),r(i,{message:l.$page.props.errors.address},null,8,["message"])]),e("div",v,[r(u,{for:"name"},{default:d(()=>[t("email")]),_:1}),n(e("input",{type:"email",class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500","onUpdate:modelValue":a[2]||(a[2]=s=>o.form.email=s),id:"email",placeholder:"Email de la sucursal",required:""},null,512),[[m,o.form.email]]),r(i,{message:l.$page.props.errors.email},null,8,["message"])]),e("div",w,[r(u,{for:"name"},{default:d(()=>[t("Telefono")]),_:1}),n(e("input",{type:"text",class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500","onUpdate:modelValue":a[3]||(a[3]=s=>o.form.phone=s),id:"phone",placeholder:"Numero de telefono",required:""},null,512),[[m,o.form.phone]]),r(i,{message:l.$page.props.errors.phone},null,8,["message"])]),e("div",V,[r(u,{for:"status"},{default:d(()=>[t("Status")]),_:1}),n(e("select",{id:"status","onUpdate:modelValue":a[4]||(a[4]=s=>o.form.status=s),class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"},N,512),[[f,o.form.status]]),r(i,{message:l.$page.props.errors.status},null,8,["message"])]),e("div",B,[r(u,{for:"description"},{default:d(()=>[t("Descripcion")]),_:1}),n(e("textarea",{id:"description",class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500","onUpdate:modelValue":a[5]||(a[5]=s=>o.form.description=s),rows:"4",placeholder:"Descripcion de la nueva sucursal"},null,512),[[m,o.form.description]]),r(i,{message:l.$page.props.errors.description},null,8,["message"])])]),actions:d(()=>[r(k,{class:"text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"},{default:d(()=>[D,t(" "+y(o.updating?"Actualizar":"Crear Nueva"),1)]),_:1})]),_:1}))}});export{A as _};