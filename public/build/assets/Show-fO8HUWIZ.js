import{o,c as p,w as s,a as r,e as a,b as e,f as i}from"./app-BJOG9bys.js";import{S as m}from"./SectionBorder-DB8WH-JO.js";import n from"./UpdatePasswordForm-dqmek3hE.js";import c from"./UpdateProfileInformationForm-CLjYrOZ9.js";import{_ as l}from"./WunjoLayout-DFe1lN8a.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ActionMessage-D_hygwe5.js";import"./FormSection-2vuET-xT.js";import"./InputError-Dcl8-r1v.js";import"./InputLabel-hx10P8Dl.js";import"./PrimaryButton-BERJt-vl.js";import"./TextInput-C1XQvs18.js";import"./SecondaryButton-BQq2vEWp.js";import"./NavLink-C6vHIAsw.js";const d=r("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Perfil del usuario ",-1),_={class:"w-full mx-auto py-10 sm:px-6 lg:px-8"},f={key:0},u={key:1},C={__name:"Show",props:{confirmsTwoFactorAuthentication:Boolean,sessions:Array},setup(h){return(t,g)=>(o(),p(l,{title:"Profile"},{header:s(()=>[d]),default:s(()=>[r("div",null,[r("div",_,[t.$page.props.jetstream.canUpdateProfileInformation?(o(),a("div",f,[e(c,{user:t.$page.props.auth.user},null,8,["user"]),e(m)])):i("",!0),t.$page.props.jetstream.canUpdatePassword?(o(),a("div",u,[e(n,{class:"mt-10 sm:mt-0"}),e(m)])):i("",!0)])])]),_:1}))}};export{C as default};
