import{o as f,c as p,w as s,a as e,b as r,g as l,l as m,p as u,q as c,t as y}from"./app-bIbIT4Ru.js";import{_ as b}from"./FormSection-VXiMShzk.js";import{_ as i}from"./InputError-BzSO3uI0.js";import{_ as n}from"./InputLabel-B6Z70Kjb.js";import{_ as k}from"./PrimaryButton-Bf9J-dDQ.js";import{_ as g}from"./TextInput-DBSGjYLR.js";const h={class:"col-span-6"},x={class:"col-span-6"},v={class:"col-span-6"},w={class:"col-span-6"},V={class:"col-span-6"},$={class:"col-span-6"},_={class:"col-span-6"},q=e("option",{selected:""},"Selecciona un estado",-1),N=e("option",{value:"true"},"Activo",-1),U=e("option",{value:"false"},"Inactivo",-1),B=[q,N,U],S=e("svg",{class:"me-1 -ms-1 w-5 h-5",fill:"currentColor",viewBox:"0 0 20 20",xmlns:"http://www.w3.org/2000/svg"},[e("path",{"fill-rule":"evenodd",d:"M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z","clip-rule":"evenodd"})],-1),A={name:"PatientsForm"},E=Object.assign(A,{props:{form:{type:Object,required:!0},updating:{type:Boolean,required:!1,default:!1}},emits:["submit"],setup(o){return(t,a)=>(f(),p(b,{onSubmitted:a[7]||(a[7]=d=>t.$emit("submit")),class:"w-full"},{form:s(()=>[e("div",h,[r(n,{for:"name"},{default:s(()=>[l("Nombre")]),_:1}),r(g,{type:"text",class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500",modelValue:o.form.fist_name,"onUpdate:modelValue":a[0]||(a[0]=d=>o.form.fist_name=d),id:"fist_name",placeholder:"Nombre del paciente",required:""},null,8,["modelValue"]),r(i,{message:t.$page.props.errors.first_name},null,8,["message"])]),e("div",x,[r(n,{for:"name"},{default:s(()=>[l("Apellido")]),_:1}),r(g,{type:"text",class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500",modelValue:o.form.last_name,"onUpdate:modelValue":a[1]||(a[1]=d=>o.form.last_name=d),id:"address",placeholder:"Apellido del paciente",required:""},null,8,["modelValue"]),r(i,{message:t.$page.props.errors.last_name},null,8,["message"])]),e("div",v,[r(n,{for:"name"},{default:s(()=>[l("Identificacion")]),_:1}),m(e("input",{type:"text",class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500","onUpdate:modelValue":a[2]||(a[2]=d=>o.form.identification=d),id:"identification",placeholder:"identificacion del paciente",required:""},null,512),[[u,o.form.identification]]),r(i,{message:t.$page.props.errors.identification},null,8,["message"])]),e("div",w,[r(n,{for:"name"},{default:s(()=>[l("Telefono")]),_:1}),m(e("input",{type:"text",class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500","onUpdate:modelValue":a[3]||(a[3]=d=>o.form.phone=d),id:"phone",placeholder:"Numero de telefono",required:""},null,512),[[u,o.form.phone]]),r(i,{message:t.$page.props.errors.phone},null,8,["message"])]),e("div",V,[r(n,{for:"name"},{default:s(()=>[l("Email")]),_:1}),m(e("input",{type:"email",class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500","onUpdate:modelValue":a[4]||(a[4]=d=>o.form.email=d),id:"email",placeholder:"Email del paciente",required:""},null,512),[[u,o.form.email]]),r(i,{message:t.$page.props.errors.email},null,8,["message"])]),e("div",$,[r(n,{for:"name"},{default:s(()=>[l("Direccion")]),_:1}),m(e("input",{type:"text",class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500","onUpdate:modelValue":a[5]||(a[5]=d=>o.form.address=d),id:"address",placeholder:"Direccion del paciente",required:""},null,512),[[u,o.form.address]]),r(i,{message:t.$page.props.errors.address},null,8,["message"])]),e("div",_,[r(n,{for:"status"},{default:s(()=>[l("Status")]),_:1}),m(e("select",{id:"status","onUpdate:modelValue":a[6]||(a[6]=d=>o.form.status=d),class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"},B,512),[[c,o.form.status]]),r(i,{message:t.$page.props.errors.status},null,8,["message"])])]),actions:s(()=>[r(k,{class:"text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"},{default:s(()=>[S,l(" "+y(o.updating?"Actualizar":"Crear Nueva"),1)]),_:1})]),_:1}))}});export{E as _};
