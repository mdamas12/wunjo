import{T as m,d,o as c,e as p,b as o,u as e,w as r,F as u,Z as f,a,n as _,g as w,i as g}from"./app-bIbIT4Ru.js";import{A as b}from"./AuthenticationCard-28uihzE-.js";import{_ as h}from"./AuthenticationCardLogo-D338INSf.js";import{_ as x}from"./InputError-BzSO3uI0.js";import{_ as v}from"./InputLabel-B6Z70Kjb.js";import{_ as y}from"./PrimaryButton-Bf9J-dDQ.js";import{_ as V}from"./TextInput-DBSGjYLR.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const C=a("div",{class:"mb-4 text-sm text-gray-600"}," This is a secure area of the application. Please confirm your password before continuing. ",-1),$={class:"flex justify-end mt-4"},q={__name:"ConfirmPassword",setup(k){const s=m({password:""}),t=d(null),n=()=>{s.post(route("password.confirm"),{onFinish:()=>{s.reset(),t.value.focus()}})};return(A,i)=>(c(),p(u,null,[o(e(f),{title:"Secure Area"}),o(b,null,{logo:r(()=>[o(h)]),default:r(()=>[C,a("form",{onSubmit:g(n,["prevent"])},[a("div",null,[o(v,{for:"password",value:"Password"}),o(V,{id:"password",ref_key:"passwordInput",ref:t,modelValue:e(s).password,"onUpdate:modelValue":i[0]||(i[0]=l=>e(s).password=l),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),o(x,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),a("div",$,[o(y,{class:_(["ms-4",{"opacity-25":e(s).processing}]),disabled:e(s).processing},{default:r(()=>[w(" Confirm ")]),_:1},8,["class","disabled"])])],32)]),_:1})],64))}};export{q as default};
