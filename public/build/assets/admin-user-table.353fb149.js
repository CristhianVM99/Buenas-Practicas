import{e as n}from"./datatables.default.6403d28a.js";import"./toast.04e64154.js";var i=$("#user-table").DataTable({ajax:"/users/datatable",columns:[{data:"id"},{data:"name"},{render:function(e,t,a,r){return a.roles?a.roles.map(l=>l.name).toString():""},searchable:!1},{data:"email"},{data:"telefono"},{data:"pais.name",render:function(e,t,a,r){return a.pais?a.pais.name:""}},{data:"actions",searchable:!1,orderable:!1}]}).on("click","a.eliminar",function(e){e.preventDefault(),n({url:this.dataset.url,data:{id:this.dataset.id},table:i})});