import{_ as g}from"./AppLayout-Dcv0nTZt.js";import{o as n,e as a,a as e,t,F as l,h as d,j as u,D as i,b as m,w as h}from"./app-bIbIT4Ru.js";import"./index-DKJrmZEC.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const _={class:"grid grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-2 p-5"},p={class:"bg-white overflow-hidden shadow-xl sm:rounded-lg px-10"},x={class:"bg-white border-b border-gray-200"},b=e("h1",{class:"mt-1 font-medium text-gray-900 :sm text-xs"}," Consultas Pendientes para hoy: ",-1),y={class:"overflow-x-auto rounded-t-lg p-t-50"},f={class:"w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"},v=e("thead",{class:"lg:text-md md:text-md sm:text-sm text-white text-center"},[e("tr",{class:"bg-cyan-600 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0 px-2"},[e("th",null,"Sede"),e("th",null,"Fecha"),e("th",null,"Hora"),e("th",null,"Paciente"),e("th",null,"Asignado A")])],-1),w={class:"flex-1 sm:flex-none"},P={class:"flex flex-col flex-no sm:table-row mb-2 sm:mb-0 text-center"},S={class:"xl:text-sm md:text-sm sm:text-sm border-grey-light border hover:bg-gray-100 truncate"},$={class:"xl:text-md md:text-md sm:text-sm border-grey-light border hover:bg-gray-100 truncate"},q={class:"xl:text-sm md:text-sm sm:text-sm border-grey-light border hover:bg-gray-100 truncate"},C={class:"xl:text-md md:text-md sm:text-sm border-grey-light border hover:bg-gray-100 truncate"},j={class:"xl:text-md md:text-md sm:text-sm border-grey-light border hover:bg-gray-100 truncate"},D={class:"bg-white overflow-hidden shadow-xl sm:rounded-lg px-10"},L={class:"bg-white border-b border-gray-200"},B=e("h1",{class:"mt-1 font-medium text-gray-700 :sm text-xs"}," Consultas Pendientes por Cancelar: ",-1),F={class:"overflow-x-auto rounded-t-lg p-t-50"},V={class:"w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5"},k=e("thead",{class:"lg:text-md md:text-md sm:text-sm text-white text-center"},[e("tr",{class:"bg-cyan-600 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0 px-2"},[e("th",null,"Sede"),e("th",null,"Fecha"),e("th",null,"Paciente"),e("th",null,"Asignado A"),e("th",null,"Monto")])],-1),O={class:"flex-1 sm:flex-none text-center"},A={class:"flex flex-col flex-no sm:table-row mb-2 sm:mb-0"},N={class:"xl:text-sm md:text-sm sm:text-sm border-grey-light border hover:bg-gray-100 truncate"},R={class:"xl:text-md md:text-md sm:text-sm border-grey-light border hover:bg-gray-100 truncate"},E={class:"xl:text-md md:text-md sm:text-sm border-grey-light border hover:bg-gray-100 truncate"},H={class:"xl:text-md md:text-md sm:text-sm border-grey-light border hover:bg-gray-100 truncate"},M={class:"xl:text-md md:text-md sm:text-sm border-grey-light border hover:bg-gray-100 truncate"},W={name:"DashboarWolcome",data(){return{modalDetail:!1,consultations:[],pendinglist:[],position_name:"",msg_consultList:"",msg_pending:"",userRole:[],userSede:[]}},components:{Link:u},async mounted(){this.userRole=this.$page.props.auth.user.roles[0].name,this.userSede=this.$page.props.auth.user.id,i.visit("consultations/loadlist",{method:"post",preserveState:!0,preserveScroll:!0,onSuccess:r=>{this.consultations=r.props.jetstream.flash.ConsultationsList,this.consultations.length==0&&(this.msg_consultList="No hay consultas registradas para el dia de hoy"),i.visit("consultations/pendingpay",{method:"post",preserveState:!0,preserveScroll:!0,onSuccess:s=>{this.pendinglist=s.props.jetstream.flash.pendinglist,this.pendinglist.length==0&&(this.msg_pending="No hay consultas pendientepor cancelar")},onError:s=>{console.log("erros")}})},onError:r=>{console.log("erros")}})},methods:{changeFormat(r){let s=r.split("-");return s[2]+"/"+s[1]+"/"+s[0]}}},z=Object.assign(W,{props:{canLogin:{type:Boolean,required:!1},canRegister:{type:Boolean,required:!1},laravelVersion:{type:String,required:!1},phpVersion:{type:String,required:!1},ConsultationsPending:{type:Object,required:!1},PaymentPending:{type:Object,required:!1}},setup(r){return(s,c)=>(n(),a("div",_,[e("div",p,[e("div",x,[b,e("p",null,t(s.msg_consultList),1)]),e("div",y,[e("table",f,[v,(n(!0),a(l,null,d(s.consultations,o=>(n(),a("tbody",w,[e("tr",P,[e("td",S,t(o.branch.name),1),e("td",$,t(s.changeFormat(o.date)),1),e("td",q,t(o.hour),1),e("td",C,t(o.patient.fist_name)+" "+t(o.patient.last_name),1),e("td",j,t(o.employee.fist_name)+" "+t(o.employee.last_name),1)])]))),256))])])]),e("div",D,[e("div",L,[B,e("p",null,t(s.msg_pending),1)]),e("div",F,[e("table",V,[k,(n(!0),a(l,null,d(s.pendinglist,o=>(n(),a("tbody",O,[e("tr",A,[e("td",N,t(o.branch.name),1),e("td",R,t(s.changeFormat(o.date)),1),e("td",E,t(o.patient.fist_name)+" "+t(o.patient.last_name),1),e("td",H,t(o.employee.fist_name)+" "+t(o.employee.last_name),1),e("td",M,t(o.amount),1)])]))),256))])])])]))}}),G={key:0},I=e("span",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Dashboard ",-1),J={class:"mx-auto sm:px-6 lg:px-8"},K={class:""},Q={key:1},T=e("h1",null,"hola no hay sesion abierta",-1),U=[T],te={__name:"Dashboard",props:{canLogin:{type:Boolean},canRegister:{type:Boolean},laravelVersion:{type:String,required:!1},phpVersion:{type:String,required:!1},ConsultationsPending:{type:Object,required:!1},PaymentPending:{type:Object,required:!1}},setup(r){return(s,c)=>s.$page.props.auth.user?(n(),a("div",G,[m(g,{title:"Dashboard"},{header:h(()=>[I]),default:h(()=>[e("div",null,[e("div",J,[e("div",K,[m(z,{ConsultationsPending:r.ConsultationsPending,PaymentPending:r.PaymentPending},null,8,["ConsultationsPending","PaymentPending"])])])])]),_:1})])):(n(),a("div",Q,U))}};export{te as default};